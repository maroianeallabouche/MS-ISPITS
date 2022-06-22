<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['insert_id'])){
    $id_et=$_POST['insert_id'];   //id_et
    $btn='<i class="fas fa-check-circle"></i>';
    $id_el=$_SESSION['id_el'];
    $id_mod=$_SESSION['id_mod'];
    $id_op=$_SESSION['id_op'];
    $id_niv=$_SESSION['id_niv']; 
    $cc=$_POST['cc'];
    $coef1=$_POST['coef1'];
    $cf=$_POST['cf'];
    $coef2=$_POST['coef2'];
    $coco=(double)$cc;
    $cofi=(double)$cf;
    $coe1=(double)$coef1;
    $coe2=(double)$coef2;
    // $sess=$_POST['sesseion_n_v'];
    $sess=$_POST['sess'];
    $mg=($coco*$coe1)+($cofi*$coe2);// $coco controle continue * $coe1 coefficient 1 + $cofi controle final * $coe2 coefficient 2
    $mg1=(double)$mg;
    mysqli_set_charset($connect, "utf8");
    $sql=" INSERT INTO note_el (cc,cf,mg, sess,id_et ,id_op ,id_mod,id_niv, id_el) VALUES ('$cc','$cf','$mg1','$sess',$id_et,$id_op,$id_mod,$id_niv,$id_el)"; 
    $result=mysqli_query($connect,$sql);
}


?>
