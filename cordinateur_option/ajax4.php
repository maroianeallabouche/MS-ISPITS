<?php
session_start();
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select option</option>";   
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT *,module.nom_mod,module.id_niv FROM `vacataire` ,module WHERE id_p=$id and vacataire.id_mod=module.id_mod");
        while ($row = mysqli_fetch_array($sql)) {
            echo '<tr>
            <td>' . $row['date_vac'] . 
            '</td><td>' . $row['nbr_h'] . 
            '</td><td>' . $row['nom_mod'] . 
            '</td><td>S-' . $row['id_niv'] .
            '</td><td>
            <a href="edit_affichage_vac.php?id=' . $row['id'].'" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
            <a href="delete_vac.php?id=' . $row['id'].'"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
            </td></tr>';
        }
    }
}
?>
