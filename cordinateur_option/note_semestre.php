<?php
session_start();
include 'config/dbcon.php';
if (isset($_GET['id'])) {
$id_et=$_GET['id'];   //id_et   
$id_op=$_SESSION['option'];
$id_niv=$_SESSION['niveau']; 
$id_fil=$_SESSION['filiere'];
$sess=$_SESSION['sess'];
mysqli_set_charset($connect, "utf8");
$sql=" UPDATE etudiant SET id_niv=id_niv+1 WHERE id_et=$id_et"; 
$result=mysqli_query($connect,$sql);
if($result)
{
$_SESSION['message']='Admi avec succès'; //message de succes
$_SESSION['tm'] =1; 
$output .= '';
$select_query = "SELECT e.nom, e.prenom,e.id_et, SUM(mg_mod)/(COUNT(m.id_mod)) as 'note_semestre' ,
options.id_op,n.id_niv,options.nom_op,n.nom_semestre,note_module.sess  
from note_module ,etudiant e ,module m ,niveau n, options
WHERE note_module.id_mod=m.id_mod and note_module.id_op=options.id_op 
and note_module.id_et=e.id_et and note_module.id_niv=n.id_niv 
and  options.id_op=$id_op and n.id_niv=$id_niv and e.id_niv=$id_niv 
GROUP by e.id_et,options.id_op,n.id_niv";
$result = mysqli_query($connect, $select_query);
$result2 = mysqli_query($connect, $select_query);
$rows = mysqli_fetch_array($result2);
$output .= ' 
<b>Option :  '. $rows['nom_op']. '</b><br>
<b>Niveau :  S-'. $rows['nom_semestre']. '</b><br>
<b>Année universitaire :  '. (date("Y")-1) .'/'.date("Y"). '</b><br>
<table class="table table-bordered">
<thead>
    <tr>
        <th>N°</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Note</th>
        <th>Session</th>
        <th>Validation</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
                <tr>  

';
while($row = mysqli_fetch_array($result))
{
    if($row['note_semestre']>=10){
        $type_s='V';
    }else if($row['note_semestre']<10){
        $type_s='NV';
    }
    if($row['sess']=='n'){
        $type_sess='Normal';
    } else if($row['sess']=='r'){
        $type_sess='Rattrapage';
    }
        $output .= '
        <tr> <td>' . $row['id_et'] . '</td>
        <td>' . $row['nom'] . '</td>
        <td>' . $row['prenom'] . '</td>
        <td>' . number_format($row['note_semestre'], 2, '.', '') . '</td>
        <td>' . $type_sess. '</td>
        <td>' . $type_s. '</td>
        <td>  <a href="note_semestre.php?id='.$row['id_et'] .'&note='.$row['note_semestre'].'" class="btn btn-success" >Admi <i class="fas fa-user-check"></i></a> 
        
        </td></tr>
        ';
}
$output .= '</tr></tbody></table>';  
}
if(isset($output)){
$_SESSION['output']= $output;
header('location:affichage_note_semestre_2.php');
}
}
?>
