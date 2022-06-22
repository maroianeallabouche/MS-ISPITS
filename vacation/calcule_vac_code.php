<?php
session_start();
include 'config/dbcon.php';
mysqli_set_charset($connect, "utf8");
$id=$_POST['id_p'];
$module=$_POST['module'];
$date_d=$_POST['date_d'];
$date_f=$_POST['date_f'];
$nbr_h=$_POST['nbr_h'];
$taux_h=$_POST['taux_h'];
$ir=$_POST['ir'];
//new
$banque=$_POST['banque'];
$ville=$_POST['ville'];
$cle=$_POST['cle'];
$org=$_POST['org'];
////
$nbr_h_1=(int)$nbr_h;
$taux_h_1=(double)$taux_h;
$ir_1=(double)$ir; 
$somme=$nbr_h_1*$taux_h_1;
$ir_somme=($somme*$ir_1)/100;
$net_payer=$somme-$ir_somme;
$sql="INSERT INTO prix_vacataire(`id_p`, `id_mod`, `date_d`, `date_f`, `nbr_h`, `taux_h`, `ir`, `somme_m`, `ir_somme`, `net_payer`,
 `banque`, `ville`, `cle`,org)
        VALUES ($id,$module,'$date_d','$date_f',$nbr_h,$taux_h,$ir,$somme,$ir_somme,$net_payer,
        $banque,$ville,$cle,'$org')";
$result=mysqli_query($connect,$sql);
?>