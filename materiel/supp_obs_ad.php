<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id']))
{
    mysqli_set_charset($connect, "utf8");
    $id=$_GET['id'];
    $sql = "DELETE from observ_ad where id_obs_ad=$id";
    $result = mysqli_query($connect, $sql);
    if($result)
    {
        $_SESSION['message'] = "Supprimer avec succès";
        $_SESSION['tm'] = 1;
        header("location: affiche_observ_ad.php");
    }
    else
    {
        $_SESSION['message'] = "Erreur lors de la Suppression";
        $_SESSION['tm'] = 0;
        header("location: affiche_observ_ad.php");
    }

}

?>