<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select materiel</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * FROM  situation_mat_pr WHERE id_salle=$id");
        $sql1 = mysqli_query($connect, "SELECT * FROM  situation_mat_ad WHERE id_salle=$id");
        $i=1;
        while ($row = mysqli_fetch_array($sql)) {
            echo '<tr><td>' . $i++ . '</td>';
            echo '<td>' . $row['des'] . '</td>';
            echo '<td>' . $row['qte'] . '</td>';
            echo '<td> <input type="text" > </td>';
            echo '</tr>';
        }
        while ($row1 = mysqli_fetch_array($sql1)) {
            echo '<tr><td>' . $i++ . '</td>';
            echo '<td>' . $row1['des'] . '</td>';
            echo '<td>' . $row1['qte'] . '</td>';
            echo '<td> <input type="text" > </td>';
            echo '</tr>';
        }
    }
}
?>