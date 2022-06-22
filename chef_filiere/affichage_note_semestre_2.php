<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="container-fluid px-4">
<h1 class="mt-4">Affichage Notes semestres des étudiants </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Note semestre</h2>
                </div>
                <?php

                ?>
                <div class="card-body" id="user_table">
                <?php mysqli_set_charset($connect, "utf8");
                            if (isset($_POST['recherche_md'])) {
                                $id_op = $_POST['option'];
                                $id_niv = $_POST['niveau'];
                                $id_fil=$_POST['filiere'];
                                $sess=$_POST['sess'];
                                $_SESSION['option'] = $id_op;
                                $_SESSION['niveau'] = $id_niv;
                                $_SESSION['filiere'] = $id_fil;
                                $_SESSION['sess'] = $sess; 
                                // $_SESSION['sess'] = $sess; 
                                $i = 1;
                                mysqli_set_charset($connect, "utf8");
                                $query="SELECT e.nom, e.prenom,e.id_et, SUM(mg_mod)/(COUNT(m.id_mod)) as 'note_semestre' ,
                                options.id_op,n.id_niv,options.nom_op,n.nom_semestre,f.nom_fil,note_module.sess  
                                from note_module ,etudiant e ,module m ,niveau n, options,filiere f 
                                WHERE note_module.id_mod=m.id_mod and note_module.id_op=options.id_op 
                                and note_module.id_et=e.id_et and note_module.id_niv=n.id_niv 
                                and  options.id_op=$id_op and n.id_niv=$id_niv and e.id_niv=$id_niv and f.id_f=$id_fil
                                GROUP by e.id_et,options.id_op,n.id_niv";
                                $sql = mysqli_query($connect,$query);
                                $sql2 = mysqli_query($connect,$query);
                            ?>
                            <?php
                          if( $rows = mysqli_fetch_array($sql2)) {
                            echo   '<b>Filiére :  '. $rows['nom_fil']. '</b><br>';
                            echo   '<b>Option :  '. $rows['nom_op']. '</b><br>';
                            echo   '<b>Niveau :  S-'. $rows['nom_semestre']. '</b><br>';
                            echo  '<b>Année universitaire :  '. (date('Y') - 1) .'/'.date("Y"). '</b><br>';
                          }
                            ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Note</th>
                                <th>Session</th>
                                <th>Validation</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($sql)) {
                            if($row['note_semestre']>=10){
                                $type_s='V';
                            }else if($row['note_semestre']<10){
                                $type_s='NV';
                            }
                            if($row['sess']=='n'){
                                $type_sess='Normal';
                            } else if($row['sess']=='r'){
                                $type_sess='Rattrapage';
                            }
                            //
                            echo '<tr><td>' .$row['id_et'] . '</td>';
                            echo '<td>' . $row['nom'] . '</td>';
                            echo '<td>' . $row['prenom'] . '</td>';
                            echo '<td>' .number_format($row['note_semestre'], 2, '.', '') . '</td>';
                            echo '<td>' .$type_sess . '</td>';
                            echo '<td>' .$type_s . '</td>';
                            echo "</tr>";
                                 }
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