<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select option</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * FROM `salle` WHERE id_op=$id");
        $i=1;
        while ($row = mysqli_fetch_array($sql)) {
            $id_salle=$row['id_salle'];
            $nom_salle=$row['nom_salle'];
            echo '<tr><td>' . $i++ . '</td>';
            echo '<td>' .$nom_salle . '</td>';
        }
    }
}
?>