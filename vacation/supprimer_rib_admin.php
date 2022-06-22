<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM  rib_admin WHERE id= $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] =1;
        $_SESSION['message'] = "RIB supprimé avec succès";
        header("Location: affichage_rib_2.php");
    }
}
else {
    header("Location:affichage_rib_2.php");
    exit(0);
}

?>