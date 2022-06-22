<?php
session_start();
include 'config/dbcon.php';
if ($_GET['id']) {
    $id = $_GET['id'];
    $name=$_GET['name'];
    $sql = "DELETE FROM fiche_pdf WHERE id_f_p = $id and pdf_name='$name'";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        unlink("../fiche_pdf/" . $name);
        $_SESSION['message'] = "PDF supprimé avec succès";
        $_SESSION['tm'] = 1;
        header("location:display_pdf.php");
    } else {
        $_SESSION['message'] = "PDF non supprimé";
        $_SESSION['tm'] = 0;
        header("location:display_pdf.php");
    }
}
?>
