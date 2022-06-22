<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];

    if ($id == 0) {
        echo "<option>Select materiel</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * FROM `salle` WHERE id_u=$id");
        echo "<option value='' selected disabled>---</option>";
        while ($row = mysqli_fetch_array($sql)) {
            $id_salle=$row['id_salle'];
            $nom_salle=$row['nom_salle'];
            echo '<option value="' . $id_salle . '">' . $nom_salle . '</option>';
        }
    }
}
?>