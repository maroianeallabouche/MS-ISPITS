<?php
session_start();
include 'config/dbcon.php';
$id_et=$_POST['id'];   //id_et  
$mg_mod=$_POST['note']; //note_module
$id_mod=$_SESSION['module'];
$id_op=$_SESSION['option'];
$id_niv=$_SESSION['niveau']; 
$sess=$_SESSION['sess'];
$sql=" INSERT INTO note_module (id_et,mg_mod ,id_mod,id_op,id_niv,sess) VALUES ($id_et,$mg_mod,$id_mod,$id_op,$id_niv,'$sess')"; 
$result=mysqli_query($connect,$sql);

?>

