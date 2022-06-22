<?php
session_start();
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    if ($id == 0) {
        echo "<option>Select option</option>";
    } else {
        $id_pro = $_SESSION['auth_user']['user_id'];
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * FROM `module` WHERE 
         module.id_op in (select id_op from profs where id_p=$id_pro) and module.id_niv=$id");
        echo '<option value="" selected disabled>-----</option>';
        while ($row = mysqli_fetch_array($sql)) {
            echo '<option value=' . $row['id_mod'] . '>' . $row['nom_mod'] . '</option>';
        }
    }
}
?>
