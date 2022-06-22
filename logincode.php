<?php
session_start();
include 'admin-panel-mn/config/dbcon.php';
if(isset($_POST['login_btn']))
{
    $email=mysqli_real_escape_string($connect,$_POST['email']);
    $password=mysqli_real_escape_string($connect,$_POST['password']);
    //table adminnistration  
    $sql="SELECT * FROM administration WHERE email='$email'  LIMIT 1 ;";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($result);
    //table profs
    $sql2="SELECT * FROM profs WHERE email='$email'  LIMIT 1 ;";
    $result2=mysqli_query($connect,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    ///
    ///table student
   $sql3="SELECT * FROM etudiant WHERE email='$email'  LIMIT 1 ;";
   $result3=mysqli_query($connect,$sql3);
   $row3=mysqli_fetch_assoc($result3);
      ////////
        if(mysqli_num_rows($result)===1)
        {
            if(password_verify($password,$row['password'])){
             foreach($result as $data)
             {
                    $user_id=$data['id'];
                    $user_name=$data['nom'].' '.$data['prenom'];
                    $user_email=$data['email'];
                    $role_as=$data['role_as'];
             }                                                 
             $_SESSION['auth']=true;
             $_SESSION['auth_role']="$role_as"; 
             $_SESSION['auth_user']=[
                'user_id'=>$user_id,
                'user_name'=>$user_name,
                'user_email'=>$user_email,
            ];
    
            if($_SESSION['auth_role']=="1"){ // directeur ispits 
                $_SESSION['tm'] =1;
                $_SESSION['message'] = "bonjour directeur de l'ISPITS"; 
                header("Location: admin-panel-mn/index.php");
                exit(0);
             } else if($_SESSION['auth_role']=="2"){ //directeur_adjoint_charge_des_etudes
                $_SESSION['tm'] = 1;
                $_SESSION['message'] = "bonjour directeur adjoint de charge des etudes";
                header("Location: directeur_adjoint_charge_des_etudes/index.php");
                exit(0);
             }else if($_SESSION['auth_role']=="3"){ //chef_unite_des_affaires_estudiantines
                $_SESSION['tm'] =1;
                $_SESSION['message'] = "bonjour chef de l'unité des affaires estudiantines";
                header("Location: chef_unite_des_affaires_estudiantines/index.php");
                exit(0);
             }else if($_SESSION['auth_role']=="4"){ //chef de l'unité pedagogique
               $_SESSION['tm'] =1;
               $_SESSION['message'] = "bonjour chef de l'unité pedagogique";
               header("Location: chef_unite_pedagogique/index.php");
               exit(0);
            }else if($_SESSION['auth_role']=="5"){ //chef de vacation
               $_SESSION['tm'] =1;
               $_SESSION['message'] = "bonjour chef de vacation";
               header("Location: vacation/index.php");
               exit(0);
            }else if($_SESSION['auth_role']=="6"){ // comptable
               $_SESSION['tm'] =1;
               $_SESSION['message'] = "bonjour comptable";
               header("Location: comptable/index.php");
               exit(0);
            }else if($_SESSION['auth_role']=="7"){ // comptable
               $_SESSION['tm'] =1;
               $_SESSION['message'] = "bonjour chef matériel";
               header("Location: materiel/index.php");
               exit(0);
            }
     
      }  else {
        $_SESSION['tm'] =0;
        $_SESSION['message'] = "Le mot de passe est incorrect";
        header("Location: login.php");
        exit(0);
    }
        
     } 
     else if(mysqli_num_rows($result2)===1){
        if(password_verify($password,$row2['password'])){
            foreach($result2 as $data)
            {
                   $user_id=$data['id_p'];
                   $user_name=$data['nom'].' '.$data['prenom'];
                   $user_email=$data['email'];
                   $role_as=$data['role_as'];
            }                                                 
            $_SESSION['auth']=true;
            $_SESSION['auth_role']="$role_as"; //profs 
            $_SESSION['auth_user']=[
               'user_id'=>$user_id,
               'user_name'=>$user_name,
               'user_email'=>$user_email,
           ];
   
           if($_SESSION['auth_role']=="2"){ // chef de filiere
            $_SESSION['tm'] =1;
               $_SESSION['message'] = "bonjour chef de filiére";
               header("Location: chef_filiere/index.php");
               exit(0);
            } else if($_SESSION['auth_role']=="1"){ // cordinateur d'option
                $_SESSION['tm'] =1;
                $_SESSION['message'] = "bonjour cordinateur d'option";
                header("Location: cordinateur_option/index.php");
                exit(0);
             } else if($_SESSION['auth_role']=="3"){ // professeur
                $_SESSION['tm'] =1;
                $_SESSION['message'] = "bonjour professeure ";
                header("Location: profs/index.php");
                exit(0);
             }
    
     } 
     else {
      $_SESSION['tm'] =0;
      $_SESSION['message'] = "Le mot de passe est incorrect";
      header("Location: login.php");
      exit(0);
     }
    }   else if(mysqli_num_rows($result3)===1){
      if(password_verify($password,$row3['password'])){
          foreach($result3 as $data)
          {
                 $user_id=$data['id_et'];
                 $user_name=$data['nom'].' '.$data['prenom'];
                 $user_email=$data['email'];
                 $role_as=$data['role_as'];
          }                                                 
          $_SESSION['auth']=true;
          $_SESSION['auth_role']="$role_as"; //etudiant 
          $_SESSION['auth_user']=[
             'user_id'=>$user_id,
             'user_name'=>$user_name,
             'user_email'=>$user_email,
         ];
 
         if($_SESSION['auth_role']=="E"){ // etudiant
          $_SESSION['tm'] =1;
             $_SESSION['message'] = "bonjour l'etudiant";
             header("Location: etudiants/index.php");
             exit(0);
          } 
  
   } 
   else {
    $_SESSION['tm'] =0;
    $_SESSION['message'] = "Le mot de passe est incorrect";
    header("Location: login.php");
    exit(0);
   }
  }
     else {
        $_SESSION['tm'] =0;
        $_SESSION['message'] = "E-mail ou mot de passe incorrect";
        header("Location: login.php");
        exit(0);
    }

} else {
    $_SESSION['tm'] =0;
    $_SESSION['message'] = "Tu dois d'abord te connecter";
    header("Location: login.php");
    exit(0);
}
