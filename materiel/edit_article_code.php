<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['modifier']))
{
    mysqli_set_charset($connect, "utf8");
    $id=$_POST['id'];
    $art = $_POST['art'];
    $des = $_POST['des'];
    $num_inv = $_POST['num_inv'];
    $qte = $_POST['qte'];
    $dt = $_POST['dt'];
    $emplc = $_POST['emplc'];
    $observ = $_POST['observ'];
    $cat = $_POST['cat'];
    $unite=$_POST['unite'];
    $sql = "UPDATE materiel SET article='$art', designation='$des', 
    num_inventaire='$num_inv', quantite=$qte, unite='$unite' , date_aj='$dt', emplacement='$emplc', 
    observation='$observ', id_cat='$cat' WHERE id_mat=$id";
    $result = mysqli_query($connect, $sql);
    if($result)
    {
        $_SESSION['message'] = "Modifier avec succès";
        $_SESSION['tm'] = 1;
        header("location: affiche_article.php");
    }
    else
    {
        $_SESSION['message'] = "Erreur lors de la modification";
        $_SESSION['tm'] = 0;
        header("location: affiche_article.php");
    }

}

?>