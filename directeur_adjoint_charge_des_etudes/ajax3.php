<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select option</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * FROM `options` WHERE id_f=$id");
        $i=1;
        while ($row = mysqli_fetch_array($sql)) {
            $id_op=$row['id_op'];
            $nom_op=$row['nom_op'];
            $code_op=$row['code_op'];
            echo '<tr><td>' . $i++ . '</td>';
            echo '<td>' .$nom_op . '</td>';
            echo '<td>' . $code_op . '</td>';
            echo "<td> <a href='edit_option.php?id=$id_op' class='btn btn-primary'>Modifier</a>
            <a href='delete_option.php?id=$id_op' class='btn btn-danger'>Supprimer</a> </td></tr>";
        }
    }
}
?>