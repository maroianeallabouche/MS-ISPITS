<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select option</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = "SELECT * FROM options WHERE id_op = '$id'";
        $result = mysqli_query($connect, $sql);
        echo '<option value="" selected disabled>---</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['id_op'] . '">' . $row['nom_op'] . '</option>';
        }
    }
}
?>