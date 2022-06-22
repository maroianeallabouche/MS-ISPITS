<?php
session_start();
include 'config/dbcon.php';


mysqli_set_charset($connect, "utf8");
$id_et=$_POST['insert_id'];   //id_et
$id_el=$_SESSION['element'];
$id_mod=$_SESSION['module'];
$id_op=$_SESSION['option'];
$id_niv=$_SESSION['niveau']; 
$sess=$_SESSION['sess'];
$cc= $_POST['cc'];
$coef1=$_POST['coef1'];
$cf=$_POST['cf'];
$coef2=$_POST['coef2'];
$sess1=$_POST['sess'];
$coco=(double)$cc;
$cofi=(double)$cf;
$coe1=(double)$coef1;
$coe2=(double)$coef2;
$mg=($coco*$coe1)+($cofi*$coe2);// $coco controle continue * $coe1 coefficient 1 + $cofi controle final * $coe2 coefficient 2
$sql="UPDATE  note_el SET cc=$coco , cf=$cofi , mg=$mg , sess='$sess' where id_et=$id_et and id_el=$id_el and id_mod=$id_mod 
and id_op=$id_op and id_niv=$id_niv "; 
$result=mysqli_query($connect,$sql);


?>
