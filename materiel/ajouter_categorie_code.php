<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['register_btn']))
{
    mysqli_set_charset($connect, "utf8");
   $nome=$_POST['nom'];
    $sql="INSERT INTO categorie_materiel (nom_cat) VALUES ('$nome')";
    $result=mysqli_query($connect,$sql);
    if($result)
    {
      $_SESSION['message']="Categorie ajouté avec succès";
        $_SESSION['tm']=1;
        header("location:ajouter_categorie.php");
    } else {
        $_SESSION['message']="Erreur d'ajout";
        $_SESSION['tm']=0;
        header("location:ajouter_categorie.php");
    }
}

?>