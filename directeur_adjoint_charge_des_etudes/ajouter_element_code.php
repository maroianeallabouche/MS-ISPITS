<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter_element']))
{
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
    $sql="INSERT INTO element(nom_el,mass_h,id_op,id_mod) VALUES('$nom_el','$mass_h',$option,$module)";
    $result=mysqli_query($connect,$sql);
    if($result)
    {
    $_SESSION['tm'] =1;
      $_SESSION['message']="element ajoutée avec succès";
      header("location: ajouter_element.php");
    }

} else {
    header("Location: ajouter_element.php");
    exit(0);
}

?>