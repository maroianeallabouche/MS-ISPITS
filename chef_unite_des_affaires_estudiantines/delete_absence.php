<?php
session_start();
include 'config/dbcon.php';
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql=mysqli_query($connect,"DELETE FROM absence WHERE id_et=$id");
    if($sql){
        $_SESSION['message']='Suppression avec succès';
        $_SESSION['tm']=1;
        header("location:affichage_absence.php");
    }
    else{
        $_SESSION['message']='Erreur de suppression'.mysqli_error($connect);
        $_SESSION['tm']=0;
        header("location:affichage_absence.php");
    }
}
?>
