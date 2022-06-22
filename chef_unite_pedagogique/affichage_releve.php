<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="pdf.js"></script>
<div class="col-md-3 m-md-2">
    <button class="btn btn-primary" onclick="generatePDF()">Export PDF</button>
</div>
<div class="col-md-3 m-md-2">
    <form action="retour_et.php" method="post">
        <button type="submit" name="retour" class="btn btn-warning"> <i class='fas fa-angle-double-left'></i> Retour - </button>
    </form>
</div>
<div class="container-fluid px-4 mt-3 mb-4" id="invoice">
    <?php mysqli_set_charset($connect, "utf8");
    if (isset($_GET['id'])) {
        $id_et = $_GET['id'];
        $id_op =  $_SESSION['option'];
        $id_niv = $_SESSION['niveau'];
        $id_f =  $_SESSION['filiere'];
        $_SESSION['option_o'] = $id_op;
        $_SESSION['niveau_n'] = $id_niv;
        $_SESSION['filiere_f'] = $id_f;
        mysqli_set_charset($connect, "utf8");
        $sql = "SELECT e.id_et , e.nom , e.prenom , e.cin , e.cne , f.nom_fil , options.nom_op , n.nom_semestre
        from etudiant e , filiere f , options , niveau n 
        where e.id_f=f.id_f and e.id_op=options.id_op and e.id_niv=n.id_niv and e.id_et=$id_et
        and 
        options.id_op=$id_op and n.id_niv=$id_niv and f.id_f=$id_f";
        $result = mysqli_query($connect, $sql);
    ?>
        <div class="row">
        <div class="col-md-12" style="background-image: url(newimg.jpg);background-position: center;
                background-repeat: no-repeat;
                height:200px">
                </div>
        </div>
        <div class="col-md-4 border border-4 border-dark m-auto text-center pt-2">
            <h4>RELEVE DE NOTES</h4>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($row = mysqli_fetch_array($result)) {
                ?>
                    <table class="table table-bordered border-dark m-auto">
                        <tr>
                            <th>Nom et Prénom :</th>
                            <th><?php echo $row['nom'] . ' ' . $row['prenom']; ?></th>
                            <th>CNE :</th>
                            <th><?php echo $row['cne']; ?></th>
                            <th>CINE :</th>
                            <th><?php echo $row['cin']; ?></th>
                        </tr>

                        <tr>
                            <th>Inscrit (e) en Filiére :</th>
                            <th><?php echo $row['nom_fil'] ?></th>
                            <th>Option :</th>
                            <th colspan="3"><?php echo $row['nom_op'] ?></th>
                        </tr>

                        <tr>
                            <th colspan="6">a obtenu les notes suivantes en semestre :<?php echo ' ' . $row['nom_semestre'] ?> </th>
                        </tr>
                    </table>
                <?php
                }
                ?>
            </div>
        </div>
        <br> <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered border-dark m-auto">
                    <tr style="background-color:#C8C8C8 ;">
                        <th class="text-center">Module</th>
                        <th class="text-center">Resultat du module</th>
                        <th class="text-center">Validation du module</th>
                        <th class="text-center">Session de validation</th>
                        <th class="text-center">Année universitaire</th>
                    </tr>
                    <?php
                    $sql2 = "SELECT n.mg_mod , n.sess , m.nom_mod ,m.type_mod 
                    from note_module n , module m 
                    where n.id_mod=m.id_mod AND n.id_et=$id_et and n.id_niv=$id_niv";
                    $result2 = mysqli_query($connect, $sql2);
                    while ($row2 = mysqli_fetch_array($result2)) {
                        if ($row2['type_mod'] == 'MAJEUR' &&  $row2['mg_mod'] >= 10) {
                            $type_mod = 'V';
                        } else if ($row2['type_mod'] == 'MAJEUR' &&  $row2['mg_mod'] < 10) {
                            $type_mod = 'NV';
                        } else if ($row2['type_mod'] == 'COMPLEMENTAIRE') {
                            if ($row2['mg_mod'] >= 8 && $row2['mg_mod'] < 10) {
                                $type_mod = 'VPC';
                            } else if ($row2['mg_mod'] >= 10) {
                                $type_mod = 'V';
                            }
                        } else if ($row2['type_mod'] == 'COMPLEMENTAIRE' &&  $row2['mg_mod'] < 8) {
                            $type_mod = 'NV';
                        }
                        //
                        if ($row2['sess'] == 'n') {
                            $type_sess = 'Normal';
                        } else if ($row2['sess'] == 'r') {
                            $type_sess = 'Rattrapage';
                        }
                    ?>
                        <tr>
                            <td><b> <?php echo $row2['nom_mod']; ?></b></td>
                            <td><b> <?php echo number_format($row2['mg_mod'], 2, '.', ''); ?></b></td>
                            <td><b> <?php echo $type_mod; ?></b></td>
                            <td><b> <?php echo $type_sess; ?></b></td>
                            <td><b> <?php echo (date("Y")-1) . '/' .date("Y") ; ?></b></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <br>
        <?php
        mysqli_set_charset($connect, "utf8");
        $sql3 = "SELECT  SUM(mg_mod)/(COUNT(note_module.id_mod)) as 'note_semestre' ,note_module.sess
        from note_module ,etudiant e 
        WHERE note_module.id_et=e.id_et and note_module.id_niv=$id_niv and e.id_et=$id_et 
        AND e.id_niv=$id_niv 
        GROUP by note_module.id_et,note_module.id_niv";
        $result3 = mysqli_query($connect, $sql3);
        if ($row3 = mysqli_fetch_array($result3)) {
            if ($row3['note_semestre'] >= 10) {
                $type_s = 'V';
            } else if ($row3['note_semestre'] < 10) {
                $type_s = 'NV';
            }
            if ($row3['sess'] == 'n') {
                $type_sess = 'Normal';
            } else if ($row3['sess'] == 'r') {
                $type_sess = 'Rattrapage';
            }
        ?>
            <div class="col-md-11 m-auto">
                <p class="mb-0"><b> V : validé , NV : non validé , VPC : validé par compensation </b></p>
                <u>
                    <p><b>NB : il ne peut etre délivré qu'un seul exemplaire du présent relvé de notes ; aucun duplicata ne sera fourni </b></p>
                </u>
            </div>
            <div class="col-md-11 m-auto">
                <div class="row">
                    <div class="col-md-6 col-sm-4">
                        <p><b>Moyenne générale du semestre</b></p>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <p><b>: <?php echo number_format($row3['note_semestre'], 2, '.', ''); ?></b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-11 m-auto">
                <div class="row">
                    <div class="col-md-6 col-sm-4">
                        <p><b>Validation du semestre</b></p>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <p><b>: <?php echo $type_s; ?></b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-11 m-auto">
                <div class="row">
                    <div class="col-md-6 col-sm-4">
                        <p><b>Semestre validé en session</b></p>
                    </div>
                    <div class="col-md-3 col-sm-2">
                        <p><b>: <input type="text" style="font-weight: bold;border:0;"> </b></p>
                    </div>
                </div>
            </div>
        <?php

        }
        ?>
        <div class="col-md-11 m-auto">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <p><b>Responsable de l'unité de gestion pédagogique </b></p>
                </div>
                <div class="col-md-2 col-sm-2 text-center">
                    <p> <b> Le Directeur </b> </p>
                </div>
            </div>
        </div>
        <div class="col-md-10 m-auto mb-5 m-lg-5">
        </div>
    <?php
    }
    ?>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>