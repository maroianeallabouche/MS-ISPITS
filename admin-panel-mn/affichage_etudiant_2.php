<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher tout les étudiants </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">étudiants</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="card-header">
                    <h2>List étudiants</h2>
                </div>
                <div class="col-md-6 mt-3 mb-3">
                        <button type="submit" class="btn btn-success" id="export" name="export">Export <i class='fas fa-download'></i></button>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>nom</th>
                                <th>prenom</th>
                                <th>الاسم الشخصي</th>
                                <th>الاسم العائلي</th>
                                <th>N° inscription</th>
                                <th>CIN</th>
                                <th>Sexe</th>
                                <th>Année scolaire</th>
                                <th>Promotion</th>
                                <th>Filiere</th>
                                <th>Option</th>
                                <th>Code option</th>
                                <th>Niveau</th>
                                <th>Email</th>
                                <th>CNE</th>
                                <th>Date de naissance</th>
                                <th>Lieu de naissance</th>
                                <th>Telephone</th>
                                <th>Année du bac</th>
                                <th>mention du bac</th>
                                <th>serie du bac</th>
                                <th>Lieu d'obtention du bac</th>
                                <th>Boursier</th>
                                <th>Nom pére </th>
                                <th>Nom mére </th>
                                <th>Profession du pére</th>
                                <th>Profession du mére</th>
                                <th>Adress</th>
                                <th>Telephone du parents</th>
                            </tr>
                        </thead>
                        <tbody id="etude">
                            <?php mysqli_set_charset($connect, "utf8");
                            if (isset($_POST['recherche'])) {
                                $id_op = $_POST['option'];
                                $id_niv = $_POST['niveau'];
                                $_SESSION['id_op'] = $id_op;
                                $_SESSION['id_niv'] = $id_niv;
                                $i = 1;
                                mysqli_set_charset($connect, "utf8");
                                $sql = mysqli_query($connect, "SELECT * ,filiere.nom_fil,options.nom_op,niveau.nom_semestre,annee_scolaire.ann_sc FROM etudiant,filiere,options,niveau,annee_scolaire WHERE options.id_op=$id_op and niveau.id_niv=$id_niv
                                     and  etudiant.id_f=filiere.id_f and etudiant.id_op=options.id_op and etudiant.id_niv=niveau.id_niv and etudiant.id_ann_sc=annee_scolaire.id_ann_sc ;");
                                while ($row = mysqli_fetch_array($sql)) {
                                    $nom_f = $row['nom_fil'];
                                    $nom_op = $row['nom_op'];
                                    $nv = $row['nom_semestre'];
                                    $ansc = $row['ann_sc'];
                                    $id_et = $row['id_et'];
                                    echo '<tr><td>' . $i++  . '</td>';
                                    echo '<td>' . $row['nom'] . '</td>';
                                    echo '<td>' . $row['prenom'] . '</td>';
                                    echo '<td>' . $row['nom_ar'] . '</td>';
                                    echo '<td>' . $row['prenom_ar'] . '</td>';
                                    echo '<td>' . $row['num_inscpt'] . '</td>';
                                    echo '<td>' . $row['cin'] . '</td>';
                                    echo '<td>' . $row['sexe'] . '</td>';
                                    echo '<td>' . $ansc . '</td>';
                                    echo '<td>' . $row['promotion'] . '</td>';
                                    echo '<td>' . $nom_f . '</td>';
                                    echo '<td>' . $nom_op . '</td>';
                                    echo '<td>' . $row['code_op'] . '</td>';
                                    echo '<td>S-' . $nv . '</td>';
                                    echo '<td>' . $row['email'] . '</td>';
                                    echo '<td>' . $row['cne'] . '</td>';
                                    echo '<td>' . $row['date_naiss'] . '</td>';
                                    echo '<td>' . $row['lieu_naiss'] . '</td>';
                                    echo '<td>' . $row['tel'] . '</td>';
                                    echo '<td>' . $row['annee_bac'] . '</td>';
                                    echo '<td>' . $row['mention_bac'] . '</td>';
                                    echo '<td>' . $row['serie_bac'] . '</td>';
                                    echo '<td>' . $row['lieu_obtn'] . '</td>';
                                    echo '<td>' . $row['boursier'] . '</td>';
                                    echo '<td>' . $row['nom_pere'] . '</td>';
                                    echo '<td>' . $row['nom_mere'] . '</td>';
                                    echo '<td>' . $row['profession_pere'] . '</td>';
                                    echo '<td>' . $row['profession_mere'] . '</td>';
                                    echo '<td>' . $row['adress'] . '</td>';
                                    echo '<td>' . $row['tel_p'] . '</td>';
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                    <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#export').on('click', function(e) {
                                $("#table").table2excel({
                                    exclude: ".noExport",
                                    name: "Data",
                                    filename: "List_Etudiant_test",
                                    fileext:".xls"
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>