<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter_op']))
{
    function testdata($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    mysqli_set_charset($connect,"utf8");
    $nom_op=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom_op']))) ;
    $code_op=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['code_op']))) ;
    $id_f=testdata(mysqli_real_escape_string($connect,$_POST['id_f']));
    $sql="INSERT INTO options(nom_op,code_op,id_f) VALUES('$nom_op','$code_op',$id_f)";
    $result=mysqli_query($connect,$sql);
    if($result)
    {
        $_SESSION['tm'] =1;
      $_SESSION['message']="option ajoutée avec succès";
      header("location: ajouter_option.php");
    }

} else {
    header("Location: ajouter_option.php");
    exit(0);
}

?>