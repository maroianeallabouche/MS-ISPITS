<?php
session_start();
include 'config/dbcon.php';
if (isset($_POST['retour'])) {
$output = '';
$id_op =$_SESSION['option_o'];
$id_niv =$_SESSION['niveau_n'];
$id_f = $_SESSION['filiere_f'];
 $select_query = "SELECT id_et,nom,prenom from etudiant where id_f=$id_f and id_op=$id_op and id_niv=$id_niv";
 $result = mysqli_query($connect, $select_query);
 $output .= ' 
                <tr>  

 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
  <tr> <td class="stud_id">' . $row['id_et'] . '</td>
      <td>' . $row['nom'] . '</td>
   <td>' . $row['prenom'] . '</td>
   <td> <a href="affichage_releve.php?id=' . $row['id_et'] . '" class="btn btn-warning">Releve du notes</i></a>
    
  </td></tr>
  ';
 }
 $output .= '</tr>';
if(isset($output)){
$_SESSION['output']= $output;
header('location:affichage_etude.php');
}
}
?>
