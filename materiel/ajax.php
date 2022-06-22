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
            echo '<tr><td>' . $i++ . '</td>';
            echo '<td>' .$row['article'] . '</td>';
            echo '<td>' . $row['designation'] . '</td>';
            echo '<td>' . $row['quantite'] . '</td>';
            echo '<td>' . $row['num_inventaire'] . '</td>';
            echo '<td>' . $row['unite'] . '</td>';
            echo '<td>' . $row['date_aj'] . '</td>';
            echo '<td>' . $row['emplacement'] . '</td>';
            echo '<td>' . $row['observation'] . '</td>';
            echo '<td><a href="edit_article.php?id=' . $row['id_mat'] . '" class="btn btn-success"><i class="fas fa-edit"></i></a>
            <a href="delete_article.php?id=' . $row['id_mat'] . '" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td></tr>';
        }
    }
}
?>