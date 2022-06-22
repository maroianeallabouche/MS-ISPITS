<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher tout les étudiants absents </h1>
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
               
                        <table class="table table-bordered border-dark" >
                        <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Niveau</th>
                        <th>Date</th>
                        <th>Action</th>
                        </tr>
                        <tbody>
                        <?php mysqli_set_charset($connect, "utf8");
                        $id=$_SESSION['auth_user']['user_id'];
                        $query = "SELECT * FROM absence , etudiant WHERE etudiant.id_op in (select id_op from profs where id_p=$id)
                         AND absence.id_et=etudiant.id_et";
                        $result = mysqli_query($connect, $query);
                        $i=1;
                        while ($row = mysqli_fetch_array($result)) {
                             echo '<tr>';
                                echo '<td>'.$i++.'</td>';
                                echo '<td>'.$row['nom'].'</td>';
                                echo '<td>'.$row['prenom'].'</td>';
                                echo '<td>S-'.$row['id_niv'].'</td>';
                                echo '<td>'.$row['date_abs'].'</td>';
                                echo '<td>
                                <a href="delete_absence.php?id='.$row['id_abs'].'" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>';
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