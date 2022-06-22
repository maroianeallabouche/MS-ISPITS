<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['ajouter_year']))
{
    function testdata($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    mysqli_set_charset($connect,"utf8");
    $startyear=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['startyear']))) ;
    $endyear=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['endyear']))) ;
    $annee_scolaire=$startyear."/".$endyear;
    $sql="INSERT INTO annee_scolaire( ann_sc ) VALUES('$annee_scolaire')";
    $result=mysqli_query($connect,$sql);
    if($result)
    {
        $_SESSION['tm'] =1;
      $_SESSION['message']="Année scolaire ajoutée avec succès";
      header("location: ajouter_year.php");
    }

} else {
    header("Location: ajouter_year.php");
    exit(0);
}

?>