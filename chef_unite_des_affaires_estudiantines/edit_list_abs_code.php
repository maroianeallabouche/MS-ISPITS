<?php
session_start();
include 'config/dbcon.php';
if (isset($_POST['modifier'])) {
    if (isset($_SESSION['abs_id'])) {
        $id = $_SESSION['abs_id'];
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
        $sql="UPDATE absence_justif set num_inc='$num_insc',nom='$nom',ops='$ops',niv='$niv',justif='$justif'
        ,pieace='$piece_j',auth_p='$auth_p',nup_p='$num_p',delv='$delv',duree_abs='$duree_abs',depose='$depose' where id_abs_j='$id'";
        $result=mysqli_query($connect,$sql);
        if($result)
        {
            $_SESSION['message']='Modifier avec succès';
            $_SESSION['tm']=1;
            header("location:list_abs.php");
          }
        else
        {
            $_SESSION['message']='Erreur de modification';
            $_SESSION['tm']=0;
            header("location:list_abs.php");
        }


    }
}  else
{
    $_SESSION['message']='Erreur d\'ajout'.mysqli_error($connect);
    $_SESSION['tm']=0;
    header("location:affichage_absence.php");
}
