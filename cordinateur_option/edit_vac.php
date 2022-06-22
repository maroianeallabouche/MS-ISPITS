<?php
session_start();
include 'config/dbcon.php';
if ($_POST['modifier']) {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $nbr_h = $_POST['nbr_h'];
    $option = $_POST['option'];
    $module = $_POST['module'];
    $sql = "UPDATE vacataire SET date_vac='$date', nbr_h='$nbr_h' ,id_op=$option,id_mod=$module WHERE id=$id";
    if (mysqli_query($connect, $sql)) {
        $_SESSION['message'] = "Vacataire modifié avec succès";
        $_SESSION['tm'] = 1;
        header("location:edit_affichage_vac.php");
    } else {
        $_SESSION['message'] = "Erreur de modification";
        $_SESSION['tm'] = 0;
        header("location:edit_affichage_vac.php");
    }
}
?>
