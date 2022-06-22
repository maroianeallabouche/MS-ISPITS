<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter'])){
    if(isset($_POST['qte'])){
        $id_ad = $_SESSION['id_ad'];
        $id_mat=$_POST['id_mat'];//id matériel
        $qte=$_POST['qte'];//quantité
        $unt=$_POST['unt'];//unité
        $date=date('Y-m-d');
        $i=0;
        while($i < count($id_mat)){
            $id_mat1=$id_mat[$i];
            $qte1=$qte[$i];
            $unt1=$unt[$i];
            $sql = mysqli_query($connect, "INSERT INTO  cmd_medi_acs_p (id_p, id_mat, qte, unite_cmd ,date_cmd) VALUES ($id_ad,$id_mat1,$qte1,'$unt1' ,'$date')");
            $i++;
        }
        if($sql){
            $_SESSION['message'] = "Ajouter avec succès";
            $_SESSION['tm']=1;
            header("location:dm_medi_acs.php");
        } else {
            $_SESSION['message'] = "Ajouter avec succès";
            $_SESSION['tm']=1;
            header("location:dm_medi_acs.php");
        }
    
    } else{
        $_SESSION['message'] = "Veuillez remplir";
        $_SESSION['tm']=0;
        header("location:dm_medi_acs.php");
    }
  
}

?>