<?php
session_start();
include 'admin-panel-mn/config/dbcon.php';
if(isset($_POST['ajouter_etude']))
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
        header("Location:register.php");
            exit();
      }
    $prenom=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['prenom']))) ;
    if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom)) {
        $_SESSION['message'] = "Invalid format de prenom !";
        $_SESSION['tm'] =0;
        header("Location:register.php");
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
    $promotion=$startyear."/".$endyear;
    $ann_bac=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['ann_bac'])))  ;
    $men_bac=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['men_bac'])))  ;
    $serie_bac=strtoupper(testdata(mysqli_real_escape_string($connect,$_POST['serie_bac'])))  ;
    $email=testdata(mysqli_real_escape_string($connect,$_POST['email']));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
        $_SESSION['tm'] =0;
        header("Location:register.php");
            exit();
      }
    $sexe=testdata(mysqli_real_escape_string($connect,$_POST['sexe']));
    $password=testdata(mysqli_real_escape_string($connect,$_POST['password'])) ;
    $confirm_password= testdata(mysqli_real_escape_string($connect,$_POST['cpassword']));
    // $p2C=password_hash($confirm_password,PASSWORD_BCRYPT);
    if($password==$confirm_password){
        $p1=password_hash($password,PASSWORD_DEFAULT);
        //check if email already exists
        $checkemail="SELECT * FROM etudiant WHERE email='$email' or cin='$cin'";
        $checkemail_run=mysqli_query($connect,$checkemail);
        $checkemail2="SELECT * FROM profs WHERE email='$email' or cin='$cin'";
        $checkemail_run2=mysqli_query($connect,$checkemail2);
        $checkemail3="SELECT * FROM administration WHERE email='$email' or cin='$cin'";
        $checkemail_run3=mysqli_query($connect,$checkemail3);

        if(mysqli_num_rows($checkemail_run)>=1){
            $_SESSION['tm'] =0;
            //already exists
            $_SESSION['message']="Cette email ou cin  il existe déja";
            header("Location: register.php");
            exit();
        } else if(mysqli_num_rows($checkemail_run2)>=1){
            $_SESSION['tm'] =0;
            //already exists
            $_SESSION['message']="Cette email ou cin il existe déja";
            header("Location: register.php");
            exit();
        } else if(mysqli_num_rows($checkemail_run3)>=1){
            $_SESSION['tm'] =0;
            //already exists
            $_SESSION['message']="Cette email ou cin il existe déja";
            header("Location: register.php");
            exit();
        }
        else{
            $insert="INSERT INTO etudiant (nom,prenom,nom_ar,prenom_ar,sexe,num_inscpt,date_naiss,lieu_naiss,tel,cin,cne,promotion,lieu_obtn,id_niv,boursier,nom_pere,nom_mere,profession_pere,profession_mere,adress,tel_p,id_f,id_op,id_ann_sc,annee_bac,serie_bac,mention_bac,email,password)
             VALUES ('$nom','$prenom','$nom_ar','$prenom_ar','$sexe','$num_insc','$date_naiss','$lieu_naiss','$tel','$cin','$cne','$promotion','$lieu_o_bac','$niveau','$bourse','$n_p','$n_m','$pro_p','$pro_m','$adress','$tel_p',$filiere,$option,$ann_sc,'$ann_bac','$serie_bac','$men_bac','$email','$p1')";
            $insert_run=mysqli_query($connect,$insert);
            if($insert_run){
                $_SESSION['tm'] =1;
                $_SESSION['message']="Inscription réussie";
                header("Location: login.php");
                exit();
            }
            else{
                $_SESSION['tm'] =0;
                $_SESSION['message']="Échec de l'enregistrement";
                header("Location: register.php");
                exit();
            }
        }
    }
    else{
        $_SESSION['tm'] =0;
        $_SESSION['message']="Le mot de passe et le mot de passe de confirmation ne correspondent pas";
        header("Location: register.php");
        exit(0);
    }
} else {
    header("Location: register.php");
    exit(0);
}


?>