<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['modifier']))
{
    if(isset($_SESSION['id_u'])){
        $id = $_SESSION['id_u'];
        function testdata($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        mysqli_set_charset($connect,"utf8");
        $nom_u=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom_unite']))) ;
                $insert="UPDATE unite SET nom_u='$nom_u' WHERE id_u=$id";
                $insert_run=mysqli_query($connect,$insert);
                if($insert_run){
                    $_SESSION['tm'] =1;
                    $_SESSION['message']="Modification réussie";
                    header("Location:affichage_unite.php");
                    exit();
                }
                else{
                    $_SESSION['tm'] =0;
                    $_SESSION['message']="Échec de la modification";
                    header("Location: affichage_unite.php");
                    exit();
                }
         

    }
  
} else {
    header("Location: affichage_salle.php");
    exit(0);
}
