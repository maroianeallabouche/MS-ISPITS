<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM options WHERE id_op = $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] = 1;
        $_SESSION['message'] = "Option supprimé avec succès";
        header("Location: affichage_fil_op.php");
    }
}
else {
    header("Location:affichage_fil_op.php");
    exit(0);
}

?>