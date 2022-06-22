<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter'])){
        $id_mat=$_POST['id_mat'];//id matériel
        $qte=$_POST['qte'];//quantité
        $id=$_POST['id'];//id admin
        $date=date('Y-m-d');
        $i=0;
        while($i < count($id_mat)){
            $id_mat1=$id_mat[$i];
            $qte1=$qte[$i];
            $sql = mysqli_query($connect, "UPDATE materiel SET quantite=quantite-$qte1 WHERE id_mat=$id_mat1");
            $sql2 = mysqli_query($connect, "INSERT INTO observ_ad (id_mat,obs_qte,id,date_cmd) VALUES ($id_mat1,$qte1,$id,'$date')");
            $i++;
        }
        if($sql){
            $_SESSION['message'] = "Ajouter avec succès";
            $_SESSION['tm']=1;
            header("location:affiche_demande.php");
        } else {
            $_SESSION['message'] = "Ajouter avec succès";
            $_SESSION['tm']=1;
            header("location:affiche_demande.php");
        }
  
} else{
    $_SESSION['message'] = "Veuillez remplir";
    $_SESSION['tm']=0;
    header("location:affiche_demande.php");
}

?>