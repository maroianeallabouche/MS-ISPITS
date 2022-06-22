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
                <div class="card-body">
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>nom</th>
                                <th>prenom</th>
                                <th class="noExport">ATTESTATION</th>
                            </tr>
                        </thead>
                        <tbody id="etude">
                            <?php mysqli_set_charset($connect, "utf8");
                            if (isset($_POST['recherche'])) {
                                $filiere = $_POST['filiere'];
                                $id_op = $_POST['option'];
                                $id_niv = $_POST['niveau'];
                                $_SESSION['option'] = $id_op;
                                $_SESSION['niveau'] = $id_niv;
                                $_SESSION['filiere'] = $filiere;
                                $i=1;
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
                                    echo "<td class='noExport'> <a href='att_reusite.php?id=$id_et' target='_blank' class='btn btn-danger'>REUSSITE</a>
                                    <a href='att_scolarite.php?id=$id_et' target='_blank' class='btn btn-warning'>SCOLARITE</a>
                                        <a href='att_insc.php?id=$id_et' target='_blank' class='btn btn-success'>INSCRIPTION</a>
                                        <a href='att_reusite_2.php?id=$id_et' target='_blank' class='btn btn-primary'>REUSSITE</a>
                                        </td></tr>";
                                }
                            }
                            ?>
                        <?php
                            if(isset($_SESSION['output'])){
                                echo $_SESSION['output'];
                                unset($_SESSION['output']);
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
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
                    </script> -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>