<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Modifier RIB </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">employés</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered border-dark mt-2">
                <tr>
                    <th>Nom et Prenom</th>
                    <th>N° de Compte</th>
                    <th>Action</th>
                </tr>
                <?php
                  mysqli_set_charset($connect, "utf8");
                $sql = "SELECT  profs.id_p ,  profs.nom , profs.prenom , profs.cin ,profs.ppr ,profs.echelle ,profs.echelon ,rib_prof.rib_p 
                FROM profs ,rib_prof
                where rib_prof.id_p=profs.id_p";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['nom'] . ' ' . $row['prenom'] . '</td>';
                    echo '<td>' . $row['rib_p'] . '</td>';
                    echo'<td><a href="modifier_rib_prof.php?id='.$row['id_p'].'" class="btn btn-success">Modifier</a>
                    <a href="supprimer_rib_prof.php?id='.$row['id_p'].'" class="btn btn-danger">Supprimer</a>
                    </td>';
                    echo '</tr>';
                }
                ?>
                  <?php
                $sql2 = "SELECT a.id, a.nom , a.prenom ,a.num_matricule  , a.cin ,a.grade ,a.echelle, rib_admin.rib_ad
                FROM administration a ,rib_admin
                where rib_admin.id=a.id";
                $result2 = mysqli_query($connect, $sql2);
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    echo '<tr>';
                    echo '<td>' . $row2['nom'] . ' ' . $row2['prenom'] . '</td>';
                    echo '<td>' . $row2['rib_ad'] . '</td>';
                    echo'<td><a href="modifier_rib_admin.php?id='.$row2['id'].'" class="btn btn-success">Modifier</a>
                    <a href="supprimer_rib_admin.php?id='.$row2['id'].'" class="btn btn-danger">Supprimer</a>
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