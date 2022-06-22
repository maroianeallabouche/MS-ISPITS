<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['submit']))
{
    mysqli_set_charset($connect, "utf8");
    $id=$_POST['id'];
    $rib=$_POST['rib'];
    $sql = "UPDATE rib_admin SET rib_ad='$rib' WHERE id=$id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['message'] = "RIB modifié avec succès";
        $_SESSION['tm'] = 1;
        header("Location: affichage_rib_2.php");
    }else{
        $_SESSION['message'] = "Erreur lors de la modification du RIB";
        $_SESSION['tm'] = 0;
        header("Location: affichage_rib_2.php");
    }
}

?>