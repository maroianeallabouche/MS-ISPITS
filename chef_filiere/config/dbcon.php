<?php
$localhost = "127.0.0.1:3325";
$username = "root";
$password = "";
$dbname = "ispits";
$connect = mysqli_connect($localhost, $username, $password, $dbname);
if(!$connect){
    header("Location: ../errors/dberror.php");
    die();
}
?>