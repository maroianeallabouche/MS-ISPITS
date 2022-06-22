<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<style>
    .selected {
        background-color: #FABB51;
        font-weight: bold;
        color: #fff;
    }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4">Export Notes modules des étudiants </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Note module</h2>
                    <div class="col-md-6 m-md-2">
                        <button id="export" class="btn btn-success" name="export">Export <i class='fas fa-download'></i></button>
                    </div>
                </div>
                <?php

                ?>
                <div class="card-body" id="user_table">
                    <?php mysqli_set_charset($connect, "utf8");
                    if (isset($_POST['recherche_md'])) {
                        $id_op = $_POST['option'];
                        $id_niv = $_POST['niveau'];
                        $id_mod = $_POST['module'];
                        $sess = $_POST['sess'];
                        $_SESSION['option'] = $id_op;
                        $_SESSION['niveau'] = $id_niv;
                        $_SESSION['module'] = $id_mod;
                        $_SESSION['sess'] = $sess;
                        $_SESSION['inc'] = 1;
                        $i = 1;
                        mysqli_set_charset($connect, "utf8");
                        $query = "SELECT etudiant.id_et,etudiant.nom,etudiant.prenom , note_module.mg_mod ,note_module.sess ,module.nom_mod ,options.nom_op
                        , note_module.id_niv ,module.type_mod
                        from  note_module , etudiant ,module ,options
                        where note_module.id_et=etudiant.id_et and note_module.id_mod=module.id_mod and note_module.id_op=options.id_op
                        and note_module.id_mod=$id_mod and note_module.id_op=$id_op 
                        and note_module.id_niv=$id_niv and note_module.sess='$sess'";
                        $sql = mysqli_query($connect, $query);
                        $sql2 = mysqli_query($connect, $query);
                      
                    ?>
                        <table  class="table table-bordered tab1">
                        <tr>
                            <?php
                              if ($rows = mysqli_fetch_array($sql2)) {
                                echo   '<td><b>Option :  ' . $rows['nom_op'] . '</b></td>';
                                echo   '<td> <b>Module :  ' . $rows['nom_mod'] . '</b> </td>';
                                echo   '<td><b>Niveau :  S-' . $rows['id_niv'] . '</b> </td>';
                                if ($rows['sess'] == 'n') {
                                    echo   '<td><b>Session :  Normal' . '</b> </td>';
                                } else {
                                    echo   '<td><b>Session :  Ratrapage' . '</b> </td>';
                                }
                                echo  '<td colspan="3"><b>Année universitaire :  ' . (date('Y') - 1) . '/' . date("Y") . '</b></td>';
                            }
                            ?>
                            </tr>
                            <tr><td colspan="7" ></td></tr>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Note</th>
                                    <th>Session</th>
                                    <th>Validation</th>
                                </tr>
                         
                        
                            <?php
                            $type_mod='';
                            while ($row = mysqli_fetch_array($sql)) {
                                if ($row['type_mod'] == 'MAJEUR' &&  $row['mg_mod'] >= 10) {
                                    $type_mod = 'V';
                                } else if ($row['type_mod'] == 'MAJEUR' &&  $row['mg_mod'] < 10) {
                                    $type_mod = 'NV';
                                } else if ($row['type_mod'] == 'COMPLEMENTAIRE') {
                                    if ($row['mg_mod'] >= 8 && $row['mg_mod'] < 10) {
                                        $type_mod = 'VPC';
                                    } else if ($row['mg_mod'] >= 10) {
                                        $type_mod = 'V';
                                    }
                                } else if ($row['type_mod'] == 'COMPLEMENTAIRE' &&  $row['mg_mod'] < 8) {
                                    $type_mod = 'NV';
                                }
                                //
                                if ($row['sess'] == 'n') {
                                    $type_sess = 'Normal';
                                } else if ($row['sess'] == 'r') {
                                    $type_sess = 'Rattrapage';
                                }
                                $note = $row['mg_mod'];
                                $id_et = $row['id_et'];
                                echo '<tr><td>' . $i++ . '</td>';
                                echo '<td>' . $row['nom'] . '</td>';
                                echo '<td>' . $row['prenom'] . '</td>';
                                echo '<td>' . number_format($row['mg_mod'], 2, '.', '') . '</td>';
                                echo '<td>' . $type_sess . '</td>';
                                echo '<td>' . $type_mod . '</td>';
                                echo "</tr>";
                            }
                        }
                            ?>
                         
                        </table>
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                      <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#export').on('click', function(e) {
                                    $(".tab1").table2excel({
                                        exclude: ".noExport",
                                        name: "Data",
                                        filename: "note_module",
                                        fileext: ".xls"
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