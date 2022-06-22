<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM annee_scolaire WHERE id_ann_sc = $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] = 1;
        $_SESSION['message'] = "supprimé avec succès";
        header("Location:ajouter_year.php");
    }
}
else {
    header("Location:ajouter_year.php");
    exit(0);
}

?>