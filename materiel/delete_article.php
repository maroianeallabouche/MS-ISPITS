<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
$sql="DELETE FROM materiel WHERE id_mat=$id  ";
$result=mysqli_query($connect,$sql);
if($result){
    $_SESSION['message']="Suppression avec succès";
    $_SESSION['tm']=1;
    header("location:affiche_article.php");
} else{
    $_SESSION['message']="Echec de suppression";
    $_SESSION['tm']=0;
    header("location:affiche_article.php");
}
}

?>