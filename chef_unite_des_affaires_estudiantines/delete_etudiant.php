<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM etudiant WHERE id_et = $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] =1;
        $_SESSION['message'] = "Etudiant supprimé avec succès";
        header("Location: affichage_etudiant.php");
    }
}
else {
    header("Location:affichage_etudiant.php");
    exit(0);
}

?>