<?php
session_start();
include 'config/dbcon.php';
mysqli_set_charset($connect, "utf8");
$id=$_POST['id_p'];
$date_d=$_POST['date_d'];
$date_r=$_POST['date_r'];
$lieu_d=$_POST['lieu_d'];
$lieu_r=$_POST['lieu_r'];
$h_d=$_POST['h_d'];
$h_r=$_POST['h_r'];
$nbr_t=$_POST['nbr_t'];
$taux_b=$_POST['taux_b'];
$nbr_t_f=(double)$nbr_t;
$taux_b_f=(double)$taux_b;
$total_f=($nbr_t_f*$taux_b_f);
$sql="INSERT INTO `frais_dep_profs`(`id_p`, `date_d`, `date_r`, `lieu_d`, `lieu_r`, `h_d`, `h_r`, `nbr_t`, `taux_b`, `total_dec`) 
VALUES ($id,'$date_d','$date_r','$lieu_d','$lieu_r','$h_d','$h_r',$nbr_t,$taux_b,$total_f)";
$result=mysqli_query($connect,$sql);
?>