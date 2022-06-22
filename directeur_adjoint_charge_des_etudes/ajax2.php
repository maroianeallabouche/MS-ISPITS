<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select module</option>";
    } else {
        $sql = mysqli_query($connect, "SELECT * FROM `module` WHERE id_op=$id");
        echo '<option value="" selected disabled>---</option>';
        while ($row = mysqli_fetch_array($sql)) {
            echo '<option value=' . $row['id_mod'] . '>' . $row['nom_mod'] . '</option>';
        }
    }
}
?>