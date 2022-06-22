<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['modifier']))
{
    mysqli_set_charset($connect, "utf8");
    $id=$_POST['id'];
    $obs_qte=$_POST['obs_qte'];
 
    $sql = "UPDATE  observ_ad SET obs_qte=$obs_qte  WHERE id_obs_ad=$id";
    $result = mysqli_query($connect, $sql);
    if($result)
    {
        $_SESSION['message'] = "Modifier avec succès";
        $_SESSION['tm'] = 1;
        header("location: affiche_observ_ad.php");
    }
    else
    {
        $_SESSION['message'] = "Erreur lors de la modification";
        $_SESSION['tm'] = 0;
        header("location: affiche_observ_ad.php");
    }

}

?>