<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM module WHERE id_mod = $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] = 1;
        $_SESSION['message'] = "Module supprimé avec succès";
        header("Location: affichage_module.php");
    }
}
else {
    header("Location:affichage_module.php");
    exit(0);
}

?>