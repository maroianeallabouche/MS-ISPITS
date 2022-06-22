<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher tout les employés </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">employés</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>List employés</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>CIN</th>
                                <th>Grade</th>
                                <th>Fonction</th>
                                <th>PPR</th>
                                <th>Echelle</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM administration";
                            mysqli_set_charset($connect, "utf8");
                            $result = mysqli_query($connect, $query);
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $nom = $row['nom'];
                                $prenom = $row['prenom'];
                                $cin = $row['cin'];
                                $grade = $row['grade'];
                                $fonction = "";
                                $matricule = $row['num_matricule'];
                                $echelle = $row['echelle'];
                                $email = $row['email'];
                                if ($row['role_as'] == '1') {
                                    $fonction = 'directeur ISPITS';
                                } else if ($row['role_as'] == '2') {
                                    $fonction = 'directeur adjoint charge des etudes';
                                } else if ($row['role_as'] == '3') {
                                    $fonction = 'chef unité des affaires estudiantines';
                                }else if ($row['role_as'] == '4') {
                                    $fonction = "Chef de l'unité pedagogique";
                                }else if ($row['role_as'] == '5') {
                                    $fonction = "Vacation";
                                }else if ($row['role_as'] == '6') {
                                    $fonction = "Comptable";
                                } else if ($row['role_as'] == '7') {
                                    $fonction = "chef matériel";
                                }
                                echo '<tr>
                                <td>' . $i++ . '</td>
                                <td>' . $nom . '</td>
                                <td>' . $prenom . '</td>
                                <td>' . $cin . '</td>
                                <td>' . $grade . '</td>
                                <td>' . $fonction . '</td>
                                <td>' . $matricule . '</td>
                                <td>' . $echelle . '</td>
                                <td>' . $email . '</td>'
                            ?>
                                <!-- <td>
                                 <?php
                                    // if($row['role_as'] == "1"){
                                    //     echo "admin";
                                    // }else{
                                    //     echo "user";
                                    // }
                                    ?>
                             </td> -->
                                <td>
                                    <?php
                                    echo '
                                    <a href="emp_edit.php?id=' . $id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="emp_delete.php?id=' . $id . '" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                ';
                                    ?>
                                </td>
                                </tr>
                            <?php
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