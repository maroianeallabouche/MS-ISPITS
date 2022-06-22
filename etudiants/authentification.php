<?php
 session_start();
 include 'config/dbcon.php';
 if(!isset($_SESSION['auth'])){
    $_SESSION['tm'] =0;
     $_SESSION['message'] = "vous ne pouvez pas accéder au admin panel , la prochaine fois, nous supprimerons votre compte";
     header("Location: ../login.php");
     exit(0);
 } else {
     if($_SESSION['auth_role'] != "E"){
        $_SESSION['tm'] =0;
         $_SESSION['message'] = "vous ne pouvez pas accéder au admin panel , la prochaine fois, nous supprimerons votre compte";
         header("Location: ../login.php");
         exit(0);
     }
 }

?>