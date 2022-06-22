<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql="DELETE FROM vacataire WHERE id=$id";
    $result=mysqli_query($connect,$sql);
    if($result){
        $_SESSION['message'] = "La date et nembre heure de vacataire a supprimé avec succès";
        $_SESSION['tm'] = 1;
        header("location:edit_affichage_vac.php");
    }else{
        $_SESSION['message'] = "Erreur de suppression";
        $_SESSION['tm'] = 0;
        header("location:edit_affichage_vac.php");
    }
}

?>