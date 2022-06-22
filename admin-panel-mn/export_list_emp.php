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
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="pdf3emp.js"></script>
                <div class="col-md-6 m-md-2">
                    <button class="btn btn-warning" onclick="generatePDF2()">Export PDF</button>
                </div>
                <div class="card-body">
                    <div class="m-3" id="exportContent">
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
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>