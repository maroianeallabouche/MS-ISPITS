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
                        mysqli_set_charset($connect, "utf8");
                        $sql = "SELECT *,etudiant.id_et,etudiant.nom,etudiant.prenom,options.nom_op,etudiant.id_niv 
                        FROM rattrapage_et  ,etudiant,options 
                        WHERE etudiant.id_et=rattrapage_et.id_et AND etudiant.id_op=options.id_op ";
                        $result = mysqli_query($connect, $sql);
                        ?>
                    </div>
                    <table class="table table-bordered border-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Niveau</th>
                            <th>Option</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr><td> ' . $row['nom'] . '</td>';
                                echo '<td> ' . $row['prenom'] . '</td>';
                                echo '<td> S-' . $row['id_niv'] . '</td>';
                                echo '<td> ' . $row['nom_op'] . '</td>';
                                echo '<td> <a href="delete_rat_abs.php?id_et=' . $row['id_et'] . '" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></a>
                                    </td></tr>';
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