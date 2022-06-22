<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM element WHERE id_el = $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] = 1;
        $_SESSION['message'] = "Element supprimé avec succès";
        header("Location: affichage_element.php");
    }
}
else {
    header("Location:affichage_element.php");
    exit(0);
}

?>