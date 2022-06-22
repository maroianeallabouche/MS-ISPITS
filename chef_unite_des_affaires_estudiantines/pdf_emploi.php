<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['up'])){
    $pdf=$_FILES['pdf']['name'];
    $pdf_type=$_FILES['pdf']['type'];
    $pdf_size=$_FILES['pdf']['size'];
    $pdf_tmp_loc=$_FILES['pdf']['tmp_name'];
    $pdf_store="../fiche_pdf/".$pdf;
    move_uploaded_file($pdf_tmp_loc,$pdf_store);
    $sql="INSERT INTO fiche_pdf (pdf_name) VALUES ('$pdf')";
    $result=mysqli_query($connect,$sql);
    if($result){
        $_SESSION['message']="Ajouté avec succès";
        $_SESSION["tm"]=1;
        header("location:fichier_import.php");
    }
    else{
        $_SESSION['message']="Erreur d'ajout";
        $_SESSION["tm"]=0;
        header("location:fichier_import.php");
    }
}
?>
