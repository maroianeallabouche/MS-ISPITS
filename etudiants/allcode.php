<?php
session_start();
if(isset($_POST['logout'])){
    //session_destroy();
unset($_SESSION['auth']);
unset($_SESSION['auth_role']);
unset($_SESSION['auth_user']);
$_SESSION['message'] = "Vous êtes maintenant déconnecté";
header("Location: ../login.php");
exit(0);
}

?>