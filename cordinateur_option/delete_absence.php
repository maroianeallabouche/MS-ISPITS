<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query="DELETE FROM absence WHERE id_abs=$id";
    $result=mysqli_query($connect,$query);
    if($result){
        header('location:affichage_absence.php');
    }
}
?>