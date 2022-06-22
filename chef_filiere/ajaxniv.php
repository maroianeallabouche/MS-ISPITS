<?php
session_start();
include 'config/dbcon.php';
if ($_POST['id']) {
    $id_niv = $_POST['id'];
    $id_op=$_POST['id_op'];
    if (empty($id_op)) {
        echo "<option selected diasabled>select option </option> ";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * FROM `module` WHERE id_niv=$id_niv and id_op=$id_op ");
        echo '<option value="" selected disabled>-----</option>';
        while ($row = mysqli_fetch_array($sql)) {
            echo '<option value=' . $row['id_mod'] . '>' . $row['nom_mod'] . '</option>';
        }
    }
}
?>
