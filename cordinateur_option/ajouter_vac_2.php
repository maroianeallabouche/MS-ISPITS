<?php
session_start();
include 'config/dbcon.php';
if ($_POST['ajouter_vac']) {
    $vacataire = $_POST['vacataire'];
    $option = $_SESSION['option'];
    $date = $_POST['date'];
    $number = $_POST['number'];
    $module= $_POST['module'];
    $sql = "INSERT INTO `vacataire`(id_p, id_op, date_vac, nbr_h,id_mod) VALUES ($vacataire,$option,'$date',$number,$module)";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        $_SESSION['message'] = "Vacataire ajouter avec succes";
        $_SESSION['tm'] = 1;
        header("location:ajouter_vac.php");
    } else {
        $_SESSION['message'] = "Erreur d'ajout".mysqli_error($connect);
        $_SESSION['tm'] = 0;
        header("location:ajouter_vac.php");
    }
  
}
?>
