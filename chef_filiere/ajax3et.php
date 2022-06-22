<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    $rat='';
    if ($id == 0) {
        echo "<option>Select option</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT etudiant.id_et,etudiant.nom,etudiant.prenom,etudiant.id_niv,etudiant.id_op,
        COUNT(absence.id_et) as nembreabsence ,absence.date_abs,module.nom_mod
        from absence ,etudiant ,module WHERE absence.id_et=etudiant.id_et and absence.id_mod=module.id_mod 
        and etudiant.id_op=$id
        GROUP BY absence.id_et");
        while ($row = mysqli_fetch_array($sql)) {
            $id_et=$row['id_et'];
            $id_op=$row['id_op'];
            if($row['nembreabsence']>=3){
                $rat='<span style="color:red;"> Rattrapage<span>';
            }
            echo '<tr><td>' . $row['id_et']. '</td>';
            echo '<td>' .$row['nom'] . '</td>';
            echo '<td>' .$row['prenom'] . '</td>';
            echo '<td>S-' .$row['id_niv'] . '</td>';
            echo '<td>' .$row['nembreabsence'].' '.$rat. '</td>';
            echo '<td>' .$row['date_abs'] . '</td>';
            echo '<td>' .$row['nom_mod'] . '</td>';
            echo "</tr>";
        }
    }
}
?>
