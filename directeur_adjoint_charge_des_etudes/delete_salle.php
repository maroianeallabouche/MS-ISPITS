<?php
session_start();
include 'config/dbcon.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM salle WHERE id_salle = $id";
    $result = mysqli_query($connect, $sql);
    if($result){
        $_SESSION['tm'] = 1;
        $_SESSION['message'] = "Salle supprimé avec succès";
        header("Location: affichage_salle.php");
    }
}
else {
    header("Location:affichage_salle.php");
    exit(0);
}

?>