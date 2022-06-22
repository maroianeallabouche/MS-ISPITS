<?php
session_start();
include 'config/dbcon.php';
if (isset($_POST['modifier'])) {
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
        $nom=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom']))) ;
        if (!preg_match("/^[a-zA-Z-' ]*$/",$nom)) {
            $_SESSION['message'] = "Invalid format de nom !";
            $_SESSION['tm'] =0;
            header("Location:etudiant_edit.php");
                exit();
          }
        $prenom=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['prenom']))) ;
        if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom)) {
            $_SESSION['message'] = "Invalid format de prenom !";
            $_SESSION['tm'] =0;
            header("Location: etudiant_edit.php");
                exit();
          }
        $nom_ar=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['nom_ar']))) ;
        $prenom_ar=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['prenom_ar']))) ;
        $num_insc=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['num_insc'])))  ;
        $date_naiss=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['date_naiss'])))  ;
        $lieu_naiss=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['lieu_naiss'])))  ;
        $tel=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['tel'])))  ;
        $cin=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['cin'])))  ;
        $cne=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['cne'])))  ;
        $lieu_o_bac=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['lieu_o_bac'])))  ;
        $niveau=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['niveau'])))  ;
        $bourse=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['bourse'])))  ;
        $n_p=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['n_p'])))  ;
        $n_m=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['n_m'])))  ;
        $pro_p=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['pro_p'])))  ;
        $pro_m=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['pro_m'])))  ;
        $adress=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['adress'])))  ;
        $tel_p=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['tel_p'])))  ;
        $filiere=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['filiere'])))  ;
        $option=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['option'])))  ;
        $ann_sc=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['ann_sc'])))  ;
        $startyear=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['startyear']))) ;
        $endyear=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['endyear']))) ;
        $promotion=$startyear;
        $ann_bac=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['ann_bac'])))  ;
        $men_bac=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['men_bac'])))  ;
        $serie_bac=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['serie_bac'])))  ;
        $sexe=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['sexe'])));
        $email=testdata(mysqli_real_escape_string($connect,$_POST['email']));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Invalid email format";
            $_SESSION['tm'] =0;
            header("Location: etudiant_edit.php");
                exit();
          }
        $password=testdata(mysqli_real_escape_string($connect,$_POST['password'])) ;
        $confirm_password= testdata(mysqli_real_escape_string($connect,$_POST['cpassword']));
        if ($password == $confirm_password) {
            $p1 = password_hash($password, PASSWORD_DEFAULT);
            $insert = "UPDATE etudiant SET nom='$nom',prenom='$prenom',nom_ar='$nom_ar',prenom_ar='$prenom_ar',sexe='$sexe'
            ,num_inscpt='$num_insc',date_naiss='$date_naiss',lieu_naiss='$lieu_naiss',tel='$tel',cin='$cin',cne='$cne',promotion='$promotion'
            ,lieu_obtn='$lieu_o_bac',id_niv='$niveau',boursier='$bourse',nom_pere='$n_p',nom_mere='$n_m',profession_pere='$pro_p',profession_mere='$pro_m'
            ,adress='$adress',tel_p='$tel_p',id_f='$filiere',id_op='$option',id_ann_sc='$ann_sc',mention_bac='$men_bac',annee_bac='$ann_bac', serie_bac='$serie_bac',
            email='$email' , password='$p1' where id_et=$id";
            $insert_run = mysqli_query($connect, $insert);
            if ($insert_run) {
                $_SESSION['tm'] =1;
                $_SESSION['message'] = "Modification réussie";
                header("Location: etudiant_edit.php");
                exit();
            } else {
                $_SESSION['tm'] =0;
                $_SESSION['message'] = "Échec de la modification";
                header("Location: etudiant_edit.php");
                exit();
            }
        } else {
            $_SESSION['tm'] =0;
            $_SESSION['message'] = "Confirmer le mot de passe ne correspond pas";
            header("Location: etudiant_edit.php");
            exit();
        }
    }
} else {
    header("Location: etudiant_edit.php");
    exit(0);
}
