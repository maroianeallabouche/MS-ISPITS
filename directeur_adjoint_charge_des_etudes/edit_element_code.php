<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['edit_element']))
{
    if(isset($_SESSION['el_id'])){
        $id = $_SESSION['el_id'];
        function testdata($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        mysqli_set_charset($connect,"utf8");
        $nom_el=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom_el']))) ;
        $mass_h=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['mass_h']))) ; 
        $option=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['option']))) ;
        $module=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['module']))) ;
                $insert="UPDATE element SET nom_el='$nom_el',mass_h=$mass_h,id_op=$option,id_mod=$module WHERE id_el=$id";
                $insert_run=mysqli_query($connect,$insert);
                if($insert_run){
                    $_SESSION['tm'] =1;
                    $_SESSION['message']="Modification réussie";
                    header("Location:affichage_element.php");
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
    header("Location:affichage_element.php");
    exit(0);
}
