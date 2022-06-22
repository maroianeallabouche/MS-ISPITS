<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Memoire </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">vacation</li>
    </ol>
    <?php include 'message.php';   ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="pdf.js"></script>
    <div class="col-md-6 m-md-2">
        <button class="btn btn-primary" onclick="generatePDF()">Export PDF</button>
    </div>
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
                $sql = "SELECT prix_vacataire.date_d,prix_vacataire.date_f,prix_vacataire.nbr_h,prix_vacataire.taux_h
                ,prix_vacataire.somme_m ,module.nom_mod,prix_vacataire.ir,prix_vacataire.ir_somme,prix_vacataire.net_payer 
                FROM prix_vacataire ,module  
                WHERE id_p=$id and prix_vacataire.id_mod=module.id_mod";
                $result = mysqli_query($connect, $sql);
                /////////
                $sql3 = "SELECT prix_vacataire.date_d,prix_vacataire.date_f,prix_vacataire.nbr_h,prix_vacataire.taux_h
                ,prix_vacataire.somme_m ,module.nom_mod,prix_vacataire.ir,prix_vacataire.ir_somme,prix_vacataire.net_payer 
                FROM prix_vacataire ,module  
                WHERE id_p=$id and prix_vacataire.id_mod=module.id_mod";
                $result3 = mysqli_query($connect, $sql3);
                /////
                $sql4="SELECT * FROM rib_prof WHERE id_p=$id";
                $result4 = mysqli_query($connect, $sql4);
                ////////
                $sql2 = "SELECT profs.nom ,profs.echelon, profs.prenom,profs.ppr,profs.cin ,options.nom_op,filiere.nom_fil 
                FROM   profs , options ,filiere
                    WHERE id_p=$id  and profs.id_op=options.id_op and profs.id_f=filiere.id_f";
                $result2 = mysqli_query($connect, $sql2);
                $row2 = mysqli_fetch_array($result2);
                ?>
            </div>
            <div class="row">
                <div class="col-md-9">
                   <b> Exercice budgétaire : <?php echo date('Y'); ?> </b>
                </div>
                <div class="col-md-3">
                    <b>Option : <?php  echo $row2['nom_op'] ; ?> </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                   <b> Rubrique budgétaire : <input type="text" style="display: inline;border:0;font-weight:bold;" size="35">  </b>
                </div>
                <div class="col-md-3">
                    <b>Promotion : <?php echo (date('Y') - 1) .'/'.date('Y') ; ?> </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                   <b> Intitulé de la rubrique : Frais de vacations et de correction des examens et concours  </b>
                </div>
                <div class="col-md-3">
                    <b>Niveau d'etude : <input type="text" style="display: inline;border:0;font-weight:bold;"> </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3 text-center">
                   <h3><b><u>MEMOIRE</u> </b></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3 ">
                  <b>Vu le décret n° 2-08-11 du 5 rejeb 1429 (09 juillet 2008 ) relatif aux indemnités allouées aux enseignants
                      vacataires de l'enseignement supérieur 
                  </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 mt-1 ">
                    <b>Doit : </b>
                </div>
                <div class="col-md-10 mt-1 ">
                    <b>Institut Superieur des Professions Infirmiers et Techniques de Santé Laayoune </b>
               </div>
               <div class="col-md-2 mt-1 ">
                    <b>Nom et Prenom : </b>
                </div>
                <div class="col-md-10 mt-1 ">
                    <b><?php echo $row2['nom'].' '.$row2['prenom'] ; ?> </b>
               </div>
               <div class="col-md-2 mt-1 ">
                    <b>Grade : </b>
                </div>
                <div class="col-md-10 mt-1 ">
                    <b><?php echo $row2['echelon']; ?> </b>
               </div>
               <div class="col-md-2 mt-1 ">
                    <b>PPR : </b>
                </div>
                <div class="col-md-10 mt-1 ">
                    <b><?php echo $row2['ppr']; ?> </b>
               </div>
               <div class="col-md-2 mt-1 ">
                    <b>CIN : </b>
                </div>
                <div class="col-md-10 mt-1 ">
                    <b><?php echo $row2['cin']; ?> </b>
               </div>
               <div class="col-md-2 mt-1 ">
                    <b>Compte N° : </b>
                </div>
                <div class="col-md-10 mt-1 ">
                    <b><?php
                    if($row4 = mysqli_fetch_array($result4)){
                        echo $row4['rib_p'];
                    }
                    ?> </b>
               </div>
               <br>
            </div>
            <b>Pour les cours dispensés durants les mois :</b> <br>
                <table class="table table-bordered border-dark">
                    <tr>
                        <th>Date d'exécution</th>
                        <th>Nembre d'heures</th>
                        <th>Désignation des cours </th>
                        <th>Taux horaire</th>
                        <th>Somme due</th>
                        <th>Situation familiale</th>
                    </tr>
                    <tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td><b>DE ' . $row['date_d'].' AU '. $row['date_f']. '</b></td>';
                            echo '<td><b>' . $row['nbr_h'] . '</b></td>';
                            echo '<td><b>' . $row['nom_mod'] . '</b></td>';
                            echo '<td><b>' . $row['taux_h'] . '</b></td>';
                            echo '<td><b>' .number_format($row['somme_m'] ,2) . '</b></td>';
                            echo '<td> </td>';
                        }
                        ?>
                    </tr>
                </table>
                <?php
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            echo '<b>Montant de la vacation : ' .number_format($row3['somme_m'],2).'</b><br>';
                            echo '<b>IR ' . $row3['ir'].'% : '.number_format($row3['ir_somme'],2).'</b><br>';
                            echo '<b>Net a payer : ' . number_format($row3['net_payer'],2) .'</b><br>';
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                               <b>L'intéressé(e)</b>
                            </div>
                            <div class="col-md-6">
                               <b>Sous Ordonnateur ou son suppléant</b>
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