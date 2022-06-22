<?php
session_start();
include 'config/dbcon.php';
if (isset($_POST['ajouter_prof'])) {
    function testdata($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    mysqli_set_charset($connect, "utf8");
    $nom = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['nom'])));
    if (!preg_match("/^[a-zA-Z-' ]*$/",$nom)) {
        $_SESSION['message'] = "Invalid format de nom !";
        $_SESSION['tm'] =0;
        header("Location: ajouter_profs.php");
            exit();
      }
    $prenom = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['prenom'])));
    if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom)) {
        $_SESSION['message'] = "Invalid format de prenom !";
        $_SESSION['tm'] =0;
        header("Location:ajouter_profs.php");
            exit();
      }
    $cin = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['cin'])));
    $role_as = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['role_as'])));
    $echelle = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['echelle'])));
    $echelon = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['echelon'])));
    $PPR = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['PPR'])));
    $filiere = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['filiere'])));
    $option = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['option'])));
    $sexe = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['sexe'])));
    $email = testdata(mysqli_real_escape_string($connect, $_POST['email']));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
        $_SESSION['tm'] =0;
        header("Location: ajouter_profs.php");
            exit();
      }
    $type_prof = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['type_prof'])));
    $password = testdata(mysqli_real_escape_string($connect, $_POST['password']));
    $confirm_password = testdata(mysqli_real_escape_string($connect, $_POST['cpassword']));
    // $p2C=password_hash($confirm_password,PASSWORD_BCRYPT);
    if ($password == $confirm_password) {
        $p1 = password_hash($password, PASSWORD_DEFAULT);
        //check if email already exists
        $checkemail = "SELECT * FROM profs WHERE email='$email'";
        $checkemail_run = mysqli_query($connect, $checkemail);
        $checkemail2 = "SELECT * FROM etudiant WHERE email='$email'";
        $checkemail_run2 = mysqli_query($connect, $checkemail2);
        $checkemail3 = "SELECT * FROM administration WHERE email='$email'";
        $checkemail_run3 = mysqli_query($connect, $checkemail3);

        if (mysqli_num_rows($checkemail_run) >= 1) {
            $_SESSION['tm'] =0;
            //already exists
            $_SESSION['message'] = "Cette email il existe déja";
            header("Location: ajouter_profs.php");
            exit();
        } else if (mysqli_num_rows($checkemail_run2) >= 1) {
            $_SESSION['tm'] =0;
            //already exists
            $_SESSION['message'] = "Cette email il existe déja";
            header("Location: ajouter_profs.php");
            exit();
        } else if (mysqli_num_rows($checkemail_run3) >= 1) {
            $_SESSION['tm'] =0;
            //already exists
            $_SESSION['message'] = "Cette email il existe déja";
            header("Location: ajouter_profs.php");
            exit();
        } else {
            $insert = "INSERT INTO profs(nom,prenom,cin,sexe,ppr,echelle,echelon,role_as,type_prof,email,password,id_f,id_op) VALUES ('$nom','$prenom','$cin','$sexe','$PPR','$echelle','$echelon','$role_as','$type_prof','$email','$p1',$filiere,$option)";
            $insert_run = mysqli_query($connect, $insert);
            if ($insert_run) {
                $_SESSION['tm'] =1;
                $_SESSION['message'] = "Inscription réussie";
                header("Location: ajouter_profs.php");
                exit();
            } else {
                $_SESSION['tm'] =0;
                $_SESSION['message'] = "Échec de l'enregistremen";
                header("Location: ajouter_profs.php");
                exit();
            }
        }
    } else {
        $_SESSION['tm'] =0;
        $_SESSION['message'] = "Le mot de passe et le mot de passe de confirmation ne correspondent pas";
        header("Location:ajouter_profs.php");
        exit(0);
    }
} else {
    header("Location: ajouter_profs.php");
    exit(0);
}
