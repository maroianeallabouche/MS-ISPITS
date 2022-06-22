<?php
session_start();
include 'config/dbcon.php';
if ($_GET['id']) {
    $id = $_GET['id'];
    $name = $_GET['name'];
    $sql = "DELETE FROM emploi_pdf WHERE id_emp_pdf = $id";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        unlink("../pdf/" . $name);
        $_SESSION['message'] = "PDF supprimé avec succès";
        $_SESSION['tm'] = 1;
        header("location:emplois_2.php");
    } else {
        $_SESSION['message'] = "PDF non supprimé";
        $_SESSION['tm'] = 0;
        header("location:emplois_2.php");
    }
}
?>
