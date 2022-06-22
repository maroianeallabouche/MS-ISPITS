<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter'])){
    $id_ad = $_SESSION['id_ad'];
    $des = $_POST['des'];
    $qte = $_POST['qte'];
    $unite = $_POST['unite'];
    $salle = $_POST['salle'];
    $sql = "INSERT INTO situation_mat_pr (`des`, qte, id_u,id_p,id_salle ) VALUES ('$des', $qte,$unite,$id_ad,$salle)";
    $result = mysqli_query($connect, $sql);
        if($sql){
            $_SESSION['message'] = "Ajouter avec succès";
            $_SESSION['tm']=1;
            header("location:situation_acs.php");
        } else {
            $_SESSION['message'] = "Erreur d'ajout";
            $_SESSION['tm']=0;
            header("location:situation_acs.php");
        }
    
  
}  else{
    $_SESSION['message'] = "Veuillez remplir";
    $_SESSION['tm']=0;
    header("location:situation_acs.php");
}

?>