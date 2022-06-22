<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter_salle']))
{
    function testdata($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    mysqli_set_charset($connect,"utf8");
    $nom_unite=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom_unite']))) ;
    $sql="INSERT INTO unite(nom_u) VALUES('$nom_unite')";
    $result=mysqli_query($connect,$sql);
    if($result)
    {
        $_SESSION['tm'] =1;
      $_SESSION['message']="unité ajoutée avec succès";
      header("location: ajouter_unite.php");
    }

} else {
    header("Location: ajouter_unite.php");
    exit(0);
}

?>