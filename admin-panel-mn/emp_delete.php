<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM administration WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] =1;
        $_SESSION['message'] = "Employé supprimé avec succès";
        header("Location: affichage_emp.php");
    }
}
else {
    header("Location:affichage_emp.php");
    exit(0);
}

?>