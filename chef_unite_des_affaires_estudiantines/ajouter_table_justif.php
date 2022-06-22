<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter']))
{
    $id_et=$_SESSION['id_et'];
    function testdata($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    mysqli_set_charset($connect,"utf8");
    $num_insc=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['num_insc']))) ;
    $nom=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['full_name']))) ;
    $ops=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['ops']))) ;
    $niv=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['niv']))) ;
    $justif=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['justif']))) ;
    $piece_j=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['piece_j']))) ;
    $auth_p=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['auth_p']))) ;
    $num_p=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['num_p']))) ;
    $delv=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['delv']))) ;
    $duree_abs=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['duree_abs']))) ;
    $depose=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['depose']))) ;
    $sql="INSERT INTO absence_justif(`num_inc`, `nom`, `ops`, `niv`, `justif`, `pieace`, `auth_p`, `nup_p`, `delv`, `duree_abs`, `depose`) 
    VALUES ('$num_insc','$nom','$ops','$niv','$justif','$piece_j','$auth_p','$num_p','$delv','$duree_abs','$depose')";
    $result=mysqli_query($connect,$sql);
    if($result)
    {
        $_SESSION['message']='Ajout avec succès';
        $_SESSION['tm']=1;
        header("location:affichage_absence.php");
}
    else
    {
        $_SESSION['message']='Erreur d\'ajout'.mysqli_error($connect);
        $_SESSION['tm']=0;
        header("location:affichage_absence.php");
    }
     
}

?>