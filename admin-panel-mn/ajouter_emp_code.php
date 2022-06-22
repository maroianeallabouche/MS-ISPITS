<?php
session_start();
include 'config/dbcon.php';
if(isset($_POST['register_btn']))
{
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
        header("Location: ajouter_employe.php");
            exit();
      }
    $prenom=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['prenom']))) ;
    if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom)) {
        $_SESSION['message'] = "Invalid format de prenom !";
        $_SESSION['tm'] =0;
        header("Location: ajouter_employe.php");
            exit();
      }
    $cin=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['cin'])))  ;
    $grade=testdata(mysqli_real_escape_string($connect,$_POST['grade']));
    $num_matricule=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['num_matricule']))) ;
    $role_as=testdata(mysqli_real_escape_string($connect,$_POST['role_as']));
    $echelle=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['echelle']))) ;
    $sexe = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['sexe'])));
    $email=testdata(mysqli_real_escape_string($connect,$_POST['email']));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
        $_SESSION['tm'] =0;
        header("Location: ajouter_employe.php");
            exit();
      }
    $password=testdata(mysqli_real_escape_string($connect,$_POST['password'])) ;
    $confirm_password= testdata(mysqli_real_escape_string($connect,$_POST['cpassword']));
    // $p2C=password_hash($confirm_password,PASSWORD_BCRYPT);
    if($password==$confirm_password){
        $p1=password_hash($password,PASSWORD_DEFAULT);
        //check if email already exists
        $checkemail="SELECT * FROM administration WHERE email='$email' or cin='$cin'";
        $checkemail_run=mysqli_query($connect,$checkemail);
        $checkemail2 = "SELECT * FROM profs WHERE email='$email' or cin='$cin'";
        $checkemail_run2 = mysqli_query($connect, $checkemail2);
        $checkemail3 = "SELECT * FROM etudiant WHERE email='$email'or cin='$cin'";
        $checkemail_run3 = mysqli_query($connect, $checkemail3);

        if(mysqli_num_rows($checkemail_run)>=1){
            $_SESSION['tm'] =0;
            //already exists
            $_SESSION['message']="Cette email ou cin il existe déja";
            header("Location: ajouter_employe.php");
            exit();
        } else if(mysqli_num_rows($checkemail_run2)>=1){
            $_SESSION['tm'] =0;
            //already exists
            $_SESSION['message']="Cette email ou cin il existe déja";
            header("Location: ajouter_employe.php");
            exit();
        } else if(mysqli_num_rows($checkemail_run3)>=1){
            $_SESSION['tm'] =0;
            //already exists
            $_SESSION['message']="Cette email ou cin il existe déja";
            header("Location: ajouter_employe.php");
            exit();
        }
        else{
            $insert="INSERT INTO administration(nom,prenom,sex,cin,num_matricule,grade,email,password,role_as,echelle) VALUES('$nom','$prenom','$sexe','$cin','$num_matricule','$grade','$email','$p1','$role_as','$echelle')";
            $insert_run=mysqli_query($connect,$insert);
            if($insert_run){
                $_SESSION['tm'] =1;
                $_SESSION['message']="Inscription réussie";
                header("Location: ajouter_employe.php");
                exit();
            }
            else{
                $_SESSION['tm'] =0;
                $_SESSION['message']="Échec de l'enregistrement";
                header("Location: ajouter_employe.php");
                exit();
            }
        }
    }
    else{
        $_SESSION['tm'] =0;
        $_SESSION['message']="Le mot de passe et le mot de passe de confirmation ne correspondent pas";
        header("Location: ajouter_employe.php");
        exit(0);
    }
} else {
    header("Location: ajouter_employe.php");
    exit(0);
}

?>