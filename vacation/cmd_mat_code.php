<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter'])){
    if(isset($_POST['qte'])){
        $id_ad = $_SESSION['id_ad'];
        $id_mat=$_POST['id_mat'];//id matériel
        $qte=$_POST['qte'];//quantité
        $date=date('Y-m-d');
        $i=0;
        while($i < count($id_mat)){
            $id_mat1=$id_mat[$i];
            $qte1=$qte[$i];
            $sql = mysqli_query($connect, "INSERT INTO cmd_admin (id, id_mat, qte, date_cmd) VALUES ($id_ad,$id_mat1,$qte1,'$date')");
            $i++;
        }
        if($sql){
            $_SESSION['message'] = "Ajouter avec succès";
            $_SESSION['tm']=1;
            header("location:cmd_mat.php");
        } else {
            $_SESSION['message'] = "Ajouter avec succès";
            $_SESSION['tm']=1;
            header("location:cmd_mat.php");
        }
    
    } else{
        $_SESSION['message'] = "Veuillez remplir";
        $_SESSION['tm']=0;
        header("location:cmd_mat.php");
    }
  
}

?>