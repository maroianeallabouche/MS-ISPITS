<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select option</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * FROM `salle` , unite WHERE id_op=$id and salle.id_u=unite.id_u");
        $i=1;
        while ($row = mysqli_fetch_array($sql)) {
            $id_salle=$row['id_salle'];
            $nom_salle=$row['nom_salle'];
            $nom_u=$row['nom_u'];
            echo '<tr><td>' . $i++ . '</td>';
            echo '<td>' .$nom_salle . '</td>';
            echo '<td>' .$nom_u . '</td>';
            echo "<td> <a href='edit_salle.php?id=$id_salle' class='btn btn-primary'>Modifier</a>
            <a href='delete_salle.php?id=$id_salle' class='btn btn-danger'>Supprimer</a> </td></tr>";
        }
    }
}
?>