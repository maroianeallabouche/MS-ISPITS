<?php
include 'config/dbcon.php';
if ($_POST['id']) {
    $id = $_POST['id'];
    $id_op=$_POST['id_op'];
    if (empty($id_op)) {
        echo " ";
    } else {
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT *, niveau.nom_semestre FROM `module` , niveau WHERE module.id_niv=$id and
         module.id_op=$id_op AND module.id_niv=niveau.id_niv");
        $i=1;
        while ($row = mysqli_fetch_array($sql)) {
            $id_op=$row['id_mod'];
            $nom_op=$row['nom_mod'];
            echo '<tr><td>' . $i++ . '</td>';
            echo '<td>' .$nom_op . '</td>';
            echo '<td>' . $row['mass_h'] . ' H</td>';
            echo '<td>' . $row['nbr_element'] . '</td>';
            echo '<td>S-' . $row['nom_semestre'] . '</td>';
            echo '<td>' . $row['type_mod'] . '</td>';
        }
    }
}
?>