<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher les frais</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered border-dark mt-2">
                <tr>
                    <th>N°</th>
                    <th>Nom et Prenom</th>
                    <th>Action</th>
                </tr>
                <?php
                  mysqli_set_charset($connect, "utf8");
                $sql = "SELECT  profs.id_p ,  profs.nom , profs.prenom  FROM profs ";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id_p'] . '</td>';
                    echo '<td>' . $row['nom'] . ' ' . $row['prenom'] . '</td>';
                    echo'<td><a href="affiche_frais_p_code.php?id='.$row['id_p'].'" class="btn btn-success">Afficher</a>
                    </td>';
                    echo '</tr>';
                }
                ?>
                  <?php
                  mysqli_set_charset($connect, "utf8");
                $sql1 = "SELECT  id , nom ,prenom  FROM administration ";
                $result1 = mysqli_query($connect, $sql1);
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    echo '<tr>';
                    echo '<td>' . $row1['id'] . '</td>';
                    echo '<td>' . $row1['nom'] . ' ' . $row1['prenom'] . '</td>';
                    echo'<td><a href="affiche_frais_ad_code.php?id='.$row1['id'].'" class="btn btn-success">Afficher</a>
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