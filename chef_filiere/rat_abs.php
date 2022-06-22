<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher tout les étudiants rattrapé avec l'absence </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">étudiants</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Espace du recherche</h2>
                </div>
                <div class="card-body">
                    <div class="col-md-6 mb-3">
                        <?php
                        $id_p=$_SESSION['auth_user']['user_id'];
                        mysqli_set_charset($connect, "utf8");
                        $sql = "SELECT etudiant.nom , etudiant.prenom , etudiant.id_niv , options.nom_op from rattrapage_et , etudiant , options
                        where rattrapage_et.id_et=etudiant.id_et and rattrapage_et.id_op=options.id_op
                        and options.id_f in (SELECT profs.id_f from profs where profs.id_p=$id_p);";
                        $result = mysqli_query($connect, $sql);
                        ?>
                    </div>
                    <table class="table table-bordered border-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Niveau</th>
                            <th>Option</th>
                        </tr>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr><td> ' . $row['nom'] . '</td>';
                                echo '<td> ' . $row['prenom'] . '</td>';
                                echo '<td> S-' . $row['id_niv'] . '</td>';
                                echo '<td> ' . $row['nom_op'] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>