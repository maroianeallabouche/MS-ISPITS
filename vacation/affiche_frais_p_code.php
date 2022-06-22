<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Frais de déplaement </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>
    <div class="col-md-6 m-md-2">
        <button class="btn btn-primary" onclick="printDiv('invoice')">Export PDF</button>
    </div>
    <!--generatePDF() <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="pdf.js"></script> -->

    <div class="row">
        <div id="invoice" class="container-fluid px-4">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12" style="background-image: url(newimg.jpg);background-position: center;
                background-repeat: no-repeat;
                height:200px">
                    </div>
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $_SESSION['id'] = $id;
                        mysqli_set_charset($connect, "utf8");
                        /////////
                        $sql = "SELECT *  FROM  frais_dep_profs WHERE id_p =$id ";
                        $result = mysqli_query($connect, $sql);
                        /////
                        $sql1 = "SELECT  SUM(nbr_t) as nbr_t , SUM(taux_b) as taux_b  , SUM(total_dec) as total
                from frais_dep_profs WHERE id_p =$id ";
                        $result1 = mysqli_query($connect, $sql1);
                        /////
                        $sql2 = "SELECT * from profs WHERE id_p =$id ";
                        $result2 = mysqli_query($connect, $sql2);
                        //////
                        $sql4 = "SELECT * FROM rib_prof WHERE id_p=$id";
                        $result4 = mysqli_query($connect, $sql4);
                        ////////
                    ?>
                </div>
                <div class="row text-center mb-2">
                    <div class="col-md-12">
                       <u><h3> <b>ETAT DES SOMMES DUES</b></h3></u>
                    </div>
                    <div class="col-md-12">
                       <h5>POUR FRAIS DE DEPLACEMENT </h5>
                    </div>
                </div>
                <?php 
                        if ($row2 = mysqli_fetch_array($result2)) {
                ?>
                    <div class="row">
                        <div class="col-md-6">
                            <b> Nom : <?php echo $row2['nom'] . '  ' . $row2['prenom'];  ?></b>
                        </div>
                        <div class="col-md-3">
                            <b> PPR : <?php echo  $row2['ppr'];  ?></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <b> Grade et class : <?php echo  $row2['echelon'];  ?></b>
                        </div>
                        <div class="col-md-3">
                            <b> CIN : <?php echo  $row2['cin'];  ?></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <b> Echelle : <?php echo  $row2['echelle'];  ?></b>
                        </div>
                        <div class="col-md-3">
                            <b> Exercice : <?php echo  date('Y');  ?></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <b> Mois : <?php echo date('Y/m/d');  ?></b>
                        </div>
                        <div class="col-md-3">
                            <b> Affectation : ISPITS</b>
                        </div>
                    </div>
                <?php
                        }
                ?>
                <div class="row">
                        <div class="col-md-12">
                            <b> Imputation : Chapitre : 1212012000 Prog : 11 Projet :20 Ligne 72 </b>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-9">
                        <b> RIB : <?php if ($row4 = mysqli_fetch_array($result4)) {
                                        echo $row4['rib_p'];
                                    } ?></b>
                    </div>
                </div>
                <table class="table table-bordered border-dark text-center">
                    <tr>
                        <th colspan="2">Date</th>
                        <th colspan="2">Lieu de déplacement</th>
                        <th colspan="2">Heure de</th>
                        <th rowspan="2" style="vertical-align : middle;">Nembre de taux</th>
                        <th rowspan="2" style="vertical-align : middle;">Taux de base</th>
                        <th rowspan="2" style="vertical-align : middle;">Total décompte</th>
                    </tr>
                    <tr>
                        <th>Départ</th>
                        <th>Retour</th>
                        <th>Départ</th>
                        <th>Retour</th>
                        <th>Départ</th>
                        <th>Retour</th>
                    </tr>
                    <tr>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr><td><b>" . $row['date_d'] . "</b></td>";
                            echo "<td><b>" . $row['date_r'] . "</b></td>";
                            echo "<td><b>" . $row['lieu_d'] . "</b></td>";
                            echo "<td><b>" . $row['lieu_r'] . "</b></td>";
                            echo "<td><b>" . $row['h_d'] . "</b></td>";
                            echo "<td><b>" . $row['h_r'] . "</b></td>";
                            echo "<td><b>" . $row['nbr_t'] . "</b></td>";
                            echo "<td><b>" . number_format($row['taux_b'], 2) . "</b></td>";
                            echo "<td><b>" . number_format($row['total_dec'], 2) . "</b></td></tr>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <th colspan="6">Total</th>
                        <?php if ($row1 = mysqli_fetch_array($result1)) { ?>
                            <th> <?php echo $row1['nbr_t']; ?> </th>
                            <th><?php echo number_format($row1['taux_b'], 2); ?></th>
                            <th><?php echo number_format($row1['total'], 2); ?></th>
                        <?php } ?>
                    </tr>
                </table>
                <div class="row mt-2">
                    <div class="col-md-12">
                        Arréte le présent état à la somme de : <b> <?php echo number_format($row1['total'], 2) . ' Dirhams Centimes'; ?> </b>
                        par la soussigné qui atteste n'avoir pas bénéficié gratuitement de logement et de nourriture à quelque titre que
                        se soit au cours du déplacement.

                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-8">
                        Certifié exact.
                    </div>
                    <div class="col-md-4">
                        L'intéressé
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        Le chef de service
                    </div>
                </div>
                <div class="row mt-5 mb-5">
                    <div class="col-md-12">
                        Arrété par nous , sous ordonnateur , à la somme de : <b> <?php echo number_format($row1['total'], 2) . ' Dirhams Centimes'; ?> </b> <br>
                        Le sous ordonnateur
                    </div>
                </div>
            </div>
        <?php
                    }
        ?>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>