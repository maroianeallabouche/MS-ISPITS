<?php
session_start();
include 'config/dbcon.php';
if (isset($_POST['Modifier'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $sql = "UPDATE categorie_materiel SET nom_cat = '$nom' WHERE id_cat = '$id'";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        $_SESSION['message'] = "Categorie modifié avec succès";
        $_SESSION['tm'] = 1;
        header("location:ajouter_categorie.php");
    } else {
        $_SESSION['message'] = "Erreur de modification";
        $_SESSION['tm'] = 0;
        header("location:ajouter_categorie.php");
    }
}
