<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM categorie_materiel WHERE id_cat = '$id'";
    $result = mysqli_query($connect, $sql);
    if($result)
    {
        $_SESSION['message']="Categorie supprimé avec succès";
        $_SESSION['tm']=1;
        header("location:ajouter_categorie.php");
    } else {
        $_SESSION['message']="Erreur de suppression";
        $_SESSION['tm']=0;
        header("location:ajouter_categorie.php");
    }
}


?>