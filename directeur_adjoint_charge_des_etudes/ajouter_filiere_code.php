<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter_fil']))
{
    function testdata($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    mysqli_set_charset($connect,"utf8");
    $nom=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom_fil']))) ;
    $sql="INSERT INTO filiere(nom_fil) VALUES('$nom')";
    $result=mysqli_query($connect,$sql);
    if($result)
    {
        $_SESSION['tm'] =1;
      $_SESSION['message']="Filiere ajoutée avec succès";
      header("location: ajouter_filiere.php");
    }

} else {
    header("Location: ajouter_filiere.php");
    exit(0);
}

?>