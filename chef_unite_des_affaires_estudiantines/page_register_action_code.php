<?php
session_start();
include 'config/dbcon.php';
if ($_POST['submit']) {
    $activation = $_POST['activation'];
    $sql = "UPDATE `page_reg` SET `action_p` = '$activation' WHERE id_re = 1";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        if($activation == 1){
        $_SESSION['message'] = "activation de la page register des étudiants effectuée avec succès";
        header("location: page_register_action.php");
        exit(0);
        } else {
        $_SESSION['message'] = "desactivation de la page register des étudiants effectuée avec succès";
        header("location: page_register_action.php");
        exit(0);
        }
    } else {
        $_SESSION['message'] = "erreur lors de l'activation de la page register des étudiants";
        header("location: page_register_action.php");
    }
}
?>
