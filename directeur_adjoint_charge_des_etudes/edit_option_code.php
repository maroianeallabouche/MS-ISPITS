<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['Modifier']))
{
    if(isset($_SESSION['op_id'])){
        $id = $_SESSION['op_id'];
        function testdata($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        mysqli_set_charset($connect,"utf8");
        $nom_op=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['option']))) ;
        $code_op=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['code_op']))) ;
        $id_f=testdata(mysqli_real_escape_string($connect,$_POST['filiere']));
                $insert="UPDATE options SET nom_op='$nom_op',code_op='$code_op',id_f=$id_f WHERE id_op=$id";
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
