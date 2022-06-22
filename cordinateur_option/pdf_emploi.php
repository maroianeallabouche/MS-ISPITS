<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['up'])){
    $pdf=$_FILES['pdf']['name'];
    $pdf_type=$_FILES['pdf']['type'];
    $pdf_size=$_FILES['pdf']['size'];
    $pdf_tmp_loc=$_FILES['pdf']['tmp_name'];
    $pdf_store="../pdf/".$pdf;
    move_uploaded_file($pdf_tmp_loc,$pdf_store);
    $id_op=$_SESSION['option'];
    $id_niv=$_SESSION['niveau'];
    $_SESSION['op']=$id_op;
    $_SESSION['niv']=$id_niv;

    $sql="INSERT INTO emploi_pdf (id_op, id_niv, pdf_name) VALUES ($id_op,$id_niv,'$pdf')";
    $result=mysqli_query($connect,$sql);
    if($result){
        $_SESSION['message']="Emploi du temps ajouté avec succès";
        $_SESSION["tm"]=1;
        header("location:emplois.php");
    }
    else{
        $_SESSION['message']="Erreur d'ajout";
        $_SESSION["tm"]=0;
        header("location:emplois.php");
    }
}
?>
