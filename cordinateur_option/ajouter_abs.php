<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter'])){
    $id_mod = $_SESSION['id_mod'];
    $id_p=$_SESSION['id_p'];
    $t=$_POST['id'];//tableau des étudiants avec id 
    $i=0;
    while($i < count($t)){
        $id_et=$t[$i];
        $sql = mysqli_query($connect, "INSERT INTO absence (id_et,id_mod,id_p) VALUES ($id_et,$id_mod,$id_p)");
        $i++;
    }
    if($sql){
        $_SESSION['message'] = "Les étudiants sont bien ajoutés à la liste d'absence";
        $_SESSION['tm']=1;
        header("location:recherche_etude.php");
    }
    else{
        $_SESSION['message'] = "Erreur lors de l'ajout des étudiants à la liste d'absence";
        $_SESSION['tm']=0;
        header("location:recherche_etude.php");
    }

}

?>