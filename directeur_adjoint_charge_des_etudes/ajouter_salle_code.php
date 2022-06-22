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
    $nom_salle=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom_salle']))) ;
    $id_op=testdata(mysqli_real_escape_string($connect,$_POST['option']));
    $id_u=testdata(mysqli_real_escape_string($connect,$_POST['unite']));
    $sql="INSERT INTO salle(nom_salle,id_op,id_u) VALUES('$nom_salle',$id_op,$id_u)";
    $result=mysqli_query($connect,$sql);
    if($result)
    {
        $_SESSION['tm'] =1;
      $_SESSION['message']="salle ajoutée avec succès";
      header("location: ajouter_salle.php");
    }

} else {
    header("Location: ajouter_salle.php");
    exit(0);
}

?>