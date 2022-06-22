<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['Modifier']))
{
    if(isset($_SESSION['id_salle'])){
        $id = $_SESSION['id_salle'];
        function testdata($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        mysqli_set_charset($connect,"utf8");
        $nom_salle=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom_salle']))) ;
        $id_op=testdata(mysqli_real_escape_string($connect,$_POST['option']));
        $id_u=testdata(mysqli_real_escape_string($connect,$_POST['unite']));
                $insert="UPDATE salle SET nom_salle='$nom_salle',id_op=$id_op , id_u=$id_u WHERE id_salle=$id";
                $insert_run=mysqli_query($connect,$insert);
                if($insert_run){
                    $_SESSION['tm'] =1;
                    $_SESSION['message']="Modification réussie";
                    header("Location:affichage_salle.php");
                    exit();
                }
                else{
                    $_SESSION['tm'] =0;
                    $_SESSION['message']="Échec de la modification";
                    header("Location: affichage_salle.php");
                    exit();
                }
         

    }
  
} else {
    header("Location: affichage_salle.php");
    exit(0);
}
