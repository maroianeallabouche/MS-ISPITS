<?php
session_start();
include 'config/dbcon.php';
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql=mysqli_query($connect,"DELETE FROM  absence_justif WHERE id_abs_j=$id");
    if($sql){
        $_SESSION['message']='Suppression avec succès';
        $_SESSION['tm']=1;
        header("location:list_abs.php");
    }
    else{
        $_SESSION['message']='Erreur de suppression';
        $_SESSION['tm']=0;
        header("location:list_abs.php");
    }
}
?>
