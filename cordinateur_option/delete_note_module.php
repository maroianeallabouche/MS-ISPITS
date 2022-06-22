<?php
session_start();
include 'config/dbcon.php';
$id_et=$_POST['id'];   //id_et  
$id_mod=$_SESSION['module'];
$id_op=$_SESSION['option'];
$id_niv=$_SESSION['niveau']; 
$sess=$_SESSION['sess'];
mysqli_set_charset($connect, "utf8");
$sql="DELETE FROM note_module WHERE id_et=$id_et and id_mod=$id_mod and id_op=$id_op and id_niv=$id_niv and sess='$sess'";
$result=mysqli_query($connect,$sql);

?>
