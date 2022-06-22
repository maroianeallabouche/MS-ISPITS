<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher L'mplois du temps</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Vacataires</li>
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
                $sql = "SELECT  profs.id_p ,  profs.nom , profs.prenom  
                FROM profs 
                where type_prof='ENSEIGNANTS VACATAIRES'";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id_p'] . '</td>';
                    echo '<td>' . $row['nom'] . ' ' . $row['prenom'] . '</td>';
                    echo'<td><a href="calcule_vac.php?id='.$row['id_p'].'" class="btn btn-success">Afficher</a>
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