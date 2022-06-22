<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['rib']))
{
    mysqli_set_charset($connect, "utf8");
    $id_p = $_POST['insert_id'];
    $rib = $_POST['rib'];
    $sql = "INSERT INTO rib_prof (id_p, rib_p) VALUES ($id_p, '$rib')";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['message'] = "RIB ajouté avec succès";
        $_SESSION['tm'] = 1;
        header("Location: ajouter_rib_p.php");
    }else{
        $_SESSION['message'] = "RIB n'a pas été ajouté";
        $_SESSION['tm'] = 0;
        header("Location: ajouter_rib_p.php");
    }
}

?>