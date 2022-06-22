<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
$id_et=$_GET['id'];
$id_op=$_GET['id_op'];
$sql="INSERT INTO rattrapage_et(`id_et`,id_op) VALUES ('$id_et','$id_op')";
$result=mysqli_query($connect,$sql);
if($result)
{
    $_SESSION['message']='Ajout avec succès';
    $_SESSION['tm']=1;
    header("location:affichage_absence.php");
}
else
{
    $_SESSION['message']='Erreur d\'ajout'.mysqli_error($connect);
    $_SESSION['tm']=0;
    header("location:affichage_absence.php");
}
}

?>
