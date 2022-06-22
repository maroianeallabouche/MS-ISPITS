<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM  frais_dep_admins WHERE id_f_d_ad= $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] =1;
        $_SESSION['message'] = "supprimé avec succès";
        header("Location: supp_frais.php");
    }
}
else {
    header("Location:supp_frais.php");
    exit(0);
}

?>