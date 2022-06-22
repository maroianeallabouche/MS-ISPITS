<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select materiel</option>";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql=mysqli_query($connect,"SELECT * FROM unite WHERE id_u=$id");
        while ($row2 = mysqli_fetch_array($sql)) {
            echo  $row2['nom_u'] ;
        }
    }
}
?>