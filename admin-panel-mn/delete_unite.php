<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM unite WHERE id_u = $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] = 1;
        $_SESSION['message'] = "unité supprimé avec succès";
        header("Location: affichage_unite.php");
    }
}
else {
    header("Location:affichage_unite.php");
    exit(0);
}

?>