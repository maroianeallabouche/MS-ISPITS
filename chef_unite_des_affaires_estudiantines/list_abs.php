<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">List d'absence </h1>
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
                    <div class="col-md-6 mb-3">
                        <!-- <form method="post" action="export.php"> -->
                            <button id="export" class="btn btn-success" name="export">Export <i class='fas fa-download'></i></button>
                        <!-- </form> -->
                    </div>
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>N° inscreption </th>
                                <th>Nom / Prenom</th>
                                <th>Option</th>
                                <th>Niveau</th>
                                <th>Justification</th>
                                <th>PIECE JUSTIFICATIVE</th>
                                <th>AUTEUR DE LA PIECE</th>
                                <th>N° PIECE</th>
                                <th>DELIVE LE</th>
                                <th>DUREE D'ABSENCE</th>
                                <th>DEPOSE LE</th>  
                                <th>ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php mysqli_set_charset($connect, "utf8");
                                $i=1;
                                mysqli_set_charset($connect, "utf8");
                                $sql = mysqli_query($connect, "SELECT *  FROM   absence_justif");
                                while ($row = mysqli_fetch_array($sql)) {
                                    $num_id = $row['id_abs_j'];
                                    echo '<tr><td>' . $i++  . '</td>';
                                    echo '<td>' . $row['num_inc'] . '</td>'; 
                                    echo '<td>' . $row['nom'] . '</td>';
                                    echo '<td>' . $row['ops'] . '</td>';
                                    echo '<td>' . $row['niv'] . '</td>';
                                    echo '<td>' . $row['justif'] . '</td>';
                                    echo '<td>' . $row['pieace'] . '</td>';
                                    echo '<td>' . $row['auth_p'] . '</td>';
                                    echo '<td>' . $row['nup_p'] . '</td>';
                                    echo '<td>' . $row['delv'] . '</td>';
                                    echo '<td>' . $row['duree_abs'] . '</td>'; 
                                    echo '<td>' . $row['depose'] . '</td>';
                                    echo "<td class='noExport'> <a href='edit_list_abs.php?id=$num_id' class='btn btn-primary'>Modifier</a>
                                        <a href='delete_list_abs.php?id=$num_id' class='btn btn-danger'>Supprimer</a> </td></tr>";
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
                                    filename: "List_Etudiant_abs",
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