<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<style>
    .selected {
        background-color: #FABB51 ;
        font-weight: bold;
        color: #fff;
    }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4">Affichage Notes modules des étudiants </h1>
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
                </div>
                <?php

                ?>
                <div class="card-body" id="user_table">
                    <?php mysqli_set_charset($connect, "utf8");
                    if (isset($_POST['recherche_md'])) {
                        $id_op =$_SESSION['options'];
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
                        $query = "SELECT e.nom, e.prenom,e.id_et, SUM(mg)/(COUNT(id_el)) as 'note_module',m.id_mod,options.id_op,n.id_niv,note_el.sess,m.type_mod,
                                m.nom_mod,options.nom_op,n.nom_semestre 
                                from note_el ,etudiant e ,module m ,niveau n, options 
                                WHERE 
                                note_el.id_mod=m.id_mod and note_el.id_op=options.id_op 
                                and note_el.id_et=e.id_et and note_el.id_niv=n.id_niv 
                                and  options.id_op=$id_op  and e.id_niv=$id_niv  and m.id_mod=$id_mod and note_el.sess='$sess'
                                GROUP by e.id_et, m.id_mod,options.id_op ,note_el.sess";
                        $sql = mysqli_query($connect, $query);
                        $sql2 = mysqli_query($connect, $query);
                        $newEndingDate = date('Y') + 1;
                    ?>
                        <?php
                        if ($rows = mysqli_fetch_array($sql2)) {
                            echo   '<b>Option :  ' . $rows['nom_op'] . '</b><br>';
                            echo   '<b>Module :  ' . $rows['nom_mod'] . '</b><br>';
                            echo   '<b>Niveau :  S-' . $rows['nom_semestre'] . '</b><br>';
                            if ($rows['sess'] == 'n') {
                                echo   '<b>Session :  Normal' . '</b></br>';
                            } else {
                                echo   '<b>Session :  Ratrapage' . '</b><br>';
                            }
                            echo  '<b>Année universitaire :  ' . (date('Y') - 1) . '/' . date("Y") . '</b><br>';
                        }
                        ?>
                        <table id="table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Note</th>
                                    <th>Session</th>
                                    <th>Validation</th>
                                    <th>Valide</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $type_mod='';
                            while ($row = mysqli_fetch_array($sql)) {
                                if ($row['type_mod'] == 'MAJEUR' &&  $row['note_module'] >= 10) {
                                    $type_mod = 'V';
                                } else if ($row['type_mod'] == 'MAJEUR' &&  $row['note_module'] < 10) {
                                    $type_mod = 'NV';
                                } else if ($row['type_mod'] == 'COMPLEMENTAIRE') {
                                    if ($row['note_module'] >= 8 && $row['note_module'] < 10) {
                                        $type_mod = 'VPC';
                                    } else if ($row['note_module'] >= 10) {
                                        $type_mod = 'V';
                                    }
                                } else if ($row['type_mod'] == 'COMPLEMENTAIRE' &&  $row['note_module'] < 8) {
                                    $type_mod = 'NV';
                                }
                                //
                                if ($row['sess'] == 'n') {
                                    $type_sess = 'Normal';
                                } else if ($row['sess'] == 'r') {
                                    $type_sess = 'Rattrapage';
                                }
                                $note = $row['note_module'];
                                $id_et=$row['id_et'] ;
                                echo '<tr><td>' . $i++ . '</td>';
                                echo '<td>' . $row['nom'] . '</td>';
                                echo '<td>' . $row['prenom'] . '</td>';
                                echo '<td>' . number_format($row['note_module'], 2, '.', '') . '</td>';
                                echo '<td>' . $type_sess . '</td>';
                                echo '<td>' . $type_mod . '</td>';
                                echo "<td class='noExport'> <a href='#' id=$id_et title=$note class='btn btn-success insert_btn' >Valide <i class='fas fa-check-square'></i></a> 
                                      </td></tr>";
                            }
                        }
                            ?>
                            <?php
                            // if (isset($_SESSION['output'])) {
                            //     echo $_SESSION['output'];
                            //     unset($_SESSION['output']);
                            // }
                            ?>
                            </tbody>
                        </table>
                        <script type="text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
                        
                        <script>
                            function selectedRow() {

                                var index,
                                    table = document.getElementById("table");

                                for (var i = 1; i < table.rows.length; i++) {
                                    table.rows[i].onclick = function() {

                                        // get the selected row index
                                        index = this.rowIndex;
                                        // add class selected to the row
                                        this.classList.toggle("selected");
                                       
                                    };
                                }

                            }
                            selectedRow();

                            $(document).ready(function() {
                                $('.insert_btn').click(function() {
                                    var id = $(this).attr("id");
                                    var note = $(this).attr("title");
                                    // console.log(id);
                                    $.post('note_module.php', {
                                        id: id ,
                                        note: note
                                    }, function(data) {
                                       
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