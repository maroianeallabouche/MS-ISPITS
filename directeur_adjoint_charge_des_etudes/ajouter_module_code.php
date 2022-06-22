<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter_module']))
{
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
    $sql="INSERT INTO `module`(`nom_mod`, `mass_h`, `nbr_element`, `id_niv`,`type_mod`, `id_f`, `id_op`) VALUES ('$nom_mod',$mass_h,$nbr_element,'$niveau','$type_mod',$filiere,$option)";
    $result=mysqli_query($connect,$sql);
    if($result)
    {
        $_SESSION['tm'] =1;
      $_SESSION['message']="module ajoutée avec succès";
      header("location: ajouter_module.php");
    }

} else {
    header("Location: ajouter_module.php");
    exit(0);
}

?>