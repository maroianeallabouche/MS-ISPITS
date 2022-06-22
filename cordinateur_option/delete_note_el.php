<?php
session_start();
include 'config/dbcon.php';

$id=$_POST['id'];
$sql="DELETE FROM note_el WHERE id_note_el=$id  ";
$result=mysqli_query($connect,$sql);


?>