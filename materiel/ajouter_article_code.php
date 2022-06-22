<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['register_btn']))
{
    mysqli_set_charset($connect, "utf8");
    $art = $_POST['art'];
    $des = $_POST['des'];
    $num_inv = $_POST['num_inv'];
    $qte = $_POST['qte'];
    $dt = $_POST['dt'];
    $emplc = $_POST['emplc'];
    $observ = $_POST['observ'];
    $cat = $_POST['cat'];
    $unite=$_POST['unite'];
    $sql = "INSERT INTO materiel (article, designation, num_inventaire, quantite,unite ,date_aj, emplacement, observation, id_cat) 
    VALUES ('$art', '$des', '$num_inv', $qte,' $unite' ,'$dt', '$emplc', '$observ', $cat)";
    $result = mysqli_query($connect, $sql);
    if($result)
    {
        $_SESSION['message'] = "Article ajouté avec succès";
        $_SESSION['tm'] = 1;
        header("location: ajouter_article.php");
    }
    else
    {
        $_SESSION['message'] = "Erreur lors de l'ajout";
        $_SESSION['tm'] = 0;
        header("location: ajouter_article.php");
    }
}

?>