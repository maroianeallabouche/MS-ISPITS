<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM profs WHERE id_p = $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] = 1;
        $_SESSION['message'] = "Prof supprimé avec succès";
        header("Location: affichage_profs.php");
    }
}
else {
    header("Location:affichage_profs.php");
    exit(0);
}

?>