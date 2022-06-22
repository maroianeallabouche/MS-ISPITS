<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['Modifier']))
{
    if(isset($_SESSION['mod_id'])){
        $id = $_SESSION['mod_id'];
        function testdata($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        mysqli_set_charset($connect,"utf8");
        $nom_mod=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom_mod']))) ;
        $mass_h=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['mass_h']))) ; 
        $nbr_element=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nbr_element']))) ;
        $niveau=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['niveau']))) ;
        $type_mod=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['type_mod']))) ;
        $option=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['option']))) ;
        $filiere=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['filiere']))) ;
        $id_f=testdata(mysqli_real_escape_string($connect,$_POST['filiere']));
                $insert="UPDATE module SET nom_mod='$nom_mod',mass_h=$mass_h,nbr_element=$nbr_element,id_niv='$niveau',type_mod='$type_mod',id_f=$id_f,id_op=$option WHERE id_mod=$id";
                $insert_run=mysqli_query($connect,$insert);
                if($insert_run){
                    $_SESSION['tm'] =1;
                    $_SESSION['message']="Modification réussie";
                    header("Location:affichage_module.php");
                    exit();
                }
                else{
                    $_SESSION['tm'] =0;
                    $_SESSION['message']="Échec de la modification";
                    header("Location: edit_module.php");
                    exit();
                }
         

    }
  
} else {
    header("Location: affichage_module.php");
    exit(0);
}
