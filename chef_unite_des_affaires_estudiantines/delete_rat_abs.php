<?php
session_start();
include 'config/dbcon.php';
if ($_GET['id_et']) {
    $id = $_GET['id_et'];
    $sql=mysqli_query($connect,"DELETE FROM rattrapage_et WHERE id_et=$id");
    if($sql){
        $_SESSION['message']='Suppression avec succès';
        $_SESSION['tm']=1;
        header("location:rat_abs.php");
    }
    else{
        $_SESSION['message']='Erreur de suppression'.mysqli_error($connect);
        $_SESSION['tm']=0;
        header("location:rat_abs.php");
    }
}
?>
