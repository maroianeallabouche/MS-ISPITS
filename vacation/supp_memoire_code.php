<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM  prix_vacataire WHERE id_prix_vac= $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] =1;
        $_SESSION['message'] = "supprimé avec succès";
        header("Location: supp_memoire.php");
    }
}
else {
    header("Location:supp_memoire.php");
    exit(0);
}

?>