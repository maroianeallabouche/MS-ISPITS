<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Supprimer les frais de déplacement </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered border-dark mt-2">
                <tr>
                    <th>Nom et Prenom</th>
                    <th>date de départ</th>
                    <th>date de retour</th>
                    <th>lieu de départ</th>
                    <th>lieu de retour</th>
                    <th>Action</th>
                </tr>
                <?php
                  mysqli_set_charset($connect, "utf8");
                $sql = "SELECT  * 
                FROM profs p ,  frais_dep_profs fp
                where p.id_p = fp.id_p ";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['nom'] . ' ' . $row['prenom'] . '</td>';
                    echo '<td>' . $row['date_d'] . '</td>';
                    echo '<td>' . $row['date_r'] . '</td>';
                    echo '<td>' . $row['lieu_d'] . '</td>';
                    echo '<td>' . $row['lieu_r'] . '</td>';
                    echo'<td><a href="supp_frais_prof.php?id='.$row['id_f_d_p'].'" class="btn btn-danger">Supprimer</a>
                    </td>';
                    echo '</tr>';
                }
                ?>
                  <?php
                  mysqli_set_charset($connect, "utf8");
                $sql1 = "SELECT  * 
                FROM administration ad ,  frais_dep_admins fad
                where ad.id = fad.id ";
                $result1 = mysqli_query($connect, $sql1);
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    echo '<tr>';
                    echo '<td>' . $row1['nom'] . ' ' . $row1['prenom'] . '</td>';
                    echo '<td>' . $row1['date_d'] . '</td>';
                    echo '<td>' . $row1['date_r'] . '</td>';
                    echo '<td>' . $row1['lieu_d'] . '</td>';
                    echo '<td>' . $row1['lieu_r'] . '</td>';
                    echo'<td><a href="supp_frais_admin.php?id='.$row1['id_f_d_ad'].'" class="btn btn-danger">Supprimer</a>
                    </td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>