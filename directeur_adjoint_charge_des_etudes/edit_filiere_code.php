<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['Modifier']))
{
    if(isset($_SESSION['fil_id'])){
        $id = $_SESSION['fil_id'];
        function testdata($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        mysqli_set_charset($connect,"utf8");
        $nom=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['filiere']))) ;
                $insert="UPDATE filiere SET nom_fil='$nom' WHERE id_f=$id";
                $insert_run=mysqli_query($connect,$insert);
                if($insert_run){
                    $_SESSION['tm'] =1;
                    $_SESSION['message']="Modification réussie";
                    header("Location:affichage_fil_op.php");
                    exit();
                }
                else{
                    $_SESSION['tm'] =0;
                    $_SESSION['message']="Échec de la modification";
                    header("Location: affichage_fil_op.php");
                    exit();
                }
         

    }
  
} else {
    header("Location: affichage_fil_op.php");
    exit(0);
}
