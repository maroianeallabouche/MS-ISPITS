<?php
session_start();
include 'config/dbcon.php';
if (isset($_POST['Modifier'])) {
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
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
            header("Location: emp_edit.php");
                exit();
          }
        $prenom = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['prenom'])));
        if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom)) {
            $_SESSION['message'] = "Invalid format de prenom !";
            $_SESSION['tm'] =0;
            header("Location: emp_edit.php");
                exit();
          }
        $cin = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['cin'])));
        $grade = testdata(mysqli_real_escape_string($connect, $_POST['grade']));
        $num_matricule = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['num_matricule'])));
        $role_as = testdata(mysqli_real_escape_string($connect, $_POST['role_as']));
        $echelle = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['echelle'])));
        $sexe = strtoupper(testdata(mysqli_real_escape_string($connect, $_POST['sexe'])));
        $email = testdata(mysqli_real_escape_string($connect, $_POST['email']));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Invalid email format";
            $_SESSION['tm'] =0;
            header("Location: emp_edit.php");
                exit();
          }
        $password = testdata(mysqli_real_escape_string($connect, $_POST['password']));
        $confirm_password = testdata(mysqli_real_escape_string($connect, $_POST['cpassword']));
        if ($password == $confirm_password) {
            $p1 = password_hash($password, PASSWORD_DEFAULT);
            $insert = "UPDATE administration SET nom='$nom',prenom='$prenom',sex='$sexe',cin='$cin',num_matricule='$num_matricule',grade='$grade',role_as='$role_as',echelle='$echelle',email='$email',password='$p1' WHERE id=$id";
            $insert_run = mysqli_query($connect, $insert);
            if ($insert_run) {
                $_SESSION['tm'] =1;
                $_SESSION['message'] = "Modification réussie";
                header("Location: emp_edit.php");
                exit();
            } else {
                $_SESSION['tm'] =0;
                $_SESSION['message'] = "Échec de la modification,  ne pas entrer les caractéres comme:  ' ' ";
                header("Location: emp_edit.php");
                exit();
            }
        } else {
            $_SESSION['tm'] =0;
            $_SESSION['message'] = "Confirmer le mot de passe ne correspond pas";
            header("Location: emp_edit.php");
            exit();
        }
    }
} else {
    header("Location: emp_edit.php");
    exit(0);
}
