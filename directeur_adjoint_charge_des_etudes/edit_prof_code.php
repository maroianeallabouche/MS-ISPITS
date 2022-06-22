<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['Modifier']))
{
    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        function testdata($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        mysqli_set_charset($connect,"utf8");
        $nom=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom']))) ;
        if (!preg_match("/^[a-zA-Z-' ]*$/",$nom)) {
            $_SESSION['message'] = "Invalid format de nom !";
            $_SESSION['tm'] =0;
            header("Location: edit_prof.php");
                exit();
          }
        $prenom=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['prenom']))) ;
        if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom)) {
            $_SESSION['message'] = "Invalid format de prenom !";
            $_SESSION['tm'] =0;
            header("Location:edit_prof.php");
                exit();
          }
        $cin=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['cin'])))  ;
        $ppr=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['ppr'])))  ;
        $role_as=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['role_as'])))  ;
        $echelle=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['echelle'])))  ;
        $echelon=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['echelon'])))  ;
        $filiere=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['filiere'])))  ;
        $option=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['option']))) ;
        $sexe = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['sexe'])));
        $type_prof=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['type_prof']))) ;
        $email=testdata(mysqli_real_escape_string($connect,$_POST['email']));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Invalid email format";
            $_SESSION['tm'] =0;
            header("Location:edit_prof.php");
                exit();
          }
        $password=testdata(mysqli_real_escape_string($connect,$_POST['password'])) ;
        $confirm_password= testdata(mysqli_real_escape_string($connect,$_POST['cpassword']));
        if($password==$confirm_password){
            $p1=password_hash($password,PASSWORD_DEFAULT);
                $insert="UPDATE profs SET nom='$nom',prenom='$prenom',cin='$cin',sexe='$sexe',ppr='$ppr',role_as='$role_as',type_prof='$type_prof',echelle='$echelle',echelon='$echelon',email='$email',password='$p1',id_f=$filiere,id_op=$option WHERE id_p=$id";
                $insert_run=mysqli_query($connect,$insert);
                if($insert_run){
                    $_SESSION['tm'] =1;
                    $_SESSION['message']="Modification réussie";
                    header("Location:affichage_profs.php");
                    exit();
                }
                else{
                    $_SESSION['tm'] =0;
                    $_SESSION['message']="Échec de la modification";
                    header("Location: edit_prof.php");
                    exit();
                }
         
        }  else{
            $_SESSION['tm'] =0;
            $_SESSION['message']="Confirmer le mot de passe ne correspond pas";
            header("Location: edit_prof.php");
            exit();
        }
    }
  
} else {
    header("Location: affichage_profs.php");
    exit(0);
}


?>