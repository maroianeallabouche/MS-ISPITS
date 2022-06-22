<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select materiel</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * FROM `materiel` WHERE id_cat=$id");
        $i=1;
        while ($row = mysqli_fetch_array($sql)) {
            echo "<input type='hidden' name='id_mat[]' value='" . $row['id_mat'] . "'>";
            echo '<tr><td>' . $i++ . '</td>';
            echo '<td>' .$row['article'] . '</td>';
            echo '<td>' . $row['designation'] . '</td>';
            echo '<td> 
            <input type="number" name="qte[]"  value="">
            </td></tr>';
        }
    }
}
?>