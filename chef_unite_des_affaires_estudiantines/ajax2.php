<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select option</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * ,filiere.nom_fil,options.nom_op,niveau.nom_semestre,annee_scolaire.ann_sc FROM etudiant,filiere,options,niveau,annee_scolaire WHERE options.id_op=$id
         and  etudiant.id_f=filiere.id_f and etudiant.id_op=options.id_op and etudiant.id_niv=niveau.id_niv and etudiant.id_ann_sc=annee_scolaire.id_ann_sc ;");
        while ($row = mysqli_fetch_array($sql)) {
            $nom_f=$row['nom_fil'];
            $nom_op=$row['nom_op'];
            $nv=$row['nom_semestre'];
            $ansc=$row['ann_sc'];
            echo '<tr><td>' . $row['id_et']. '</td>';
            echo '<td>' .$row['nom'] . '</td>';
            echo '<td>' .$row['prenom'] . '</td>';
            echo '<td>' .$row['nom_ar'] . '</td>';
            echo '<td>' .$row['prenom_ar'] . '</td>';
            echo '<td>' .$row['num_inscpt'] . '</td>';
            echo '<td>' .$row['cin'] . '</td>';
            echo '<td>' . $ansc . '</td>';
            echo '<td>' .$nom_f. '</td>';
            echo '<td>' .$nom_op . '</td>';
            echo '<td>S-' .$nv . '</td>';
            echo '<td>' .$row['email'] . '</td>';
            echo '<td>' .$row['cne'] . '</td>';
            echo '<td>' .$row['date_naiss'] . '</td>';
            echo '<td>' .$row['lieu_naiss'] . '</td>';
            echo '<td>' .$row['tel'] . '</td>';
            echo '<td>' .$row['annee_bac'] . '</td>';
            echo '<td>' .$row['mention_bac'] . '</td>';
            echo '<td>' .$row['serie_bac'] . '</td>';
            echo '<td>' .$row['lieu_obtn'] . '</td>';
            echo '<td>' .$row['boursier'] . '</td>';
            echo '<td>' .$row['nom_pere'] . '</td>';
            echo '<td>' .$row['nom_mere'] . '</td>';
            echo '<td>' .$row['profession_pere'] . '</td>';
            echo '<td>' .$row['profession_mere'] . '</td>';
            echo '<td>' .$row['adress'] . '</td>';
            echo '<td>' .$row['tel_p'] . '</td>';
            echo "<td> <a href='edit_etudiant.php?id=$id_op' class='btn btn-primary'>Edit</a>
            <a href='delete_etudiant.php?id=$id_op' class='btn btn-danger'>Delete</a> </td></tr>";
        }
    }
}
?>
