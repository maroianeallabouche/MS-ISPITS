<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select option</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * FROM `element` WHERE id_mod=$id");
        $i=1;
        while ($row = mysqli_fetch_array($sql)) {
            $id_op=$row['id_el'];
            $nom_op=$row['nom_el'];
            echo '<tr><td>' . $i++ . '</td>';
            echo '<td>' .$nom_op . '</td>';
            echo '<td>' .$row['mass_h'] . '</td>';
        }
    }
}
?>