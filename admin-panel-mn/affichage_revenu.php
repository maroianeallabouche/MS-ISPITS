<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="pdf.js"></script>
    <div class="col-md-6 m-md-2">
        <button class="btn btn-primary" onclick="generatePDF()">Export PDF</button>
    </div>
<div class="container-fluid px-4" id="invoice">
    <?php include 'message.php';   ?>

    <div class="row" >
       <div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12" style="background-image: url(newimg.jpg);background-position: center;
                background-repeat: no-repeat;
                height:200px">
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <h5>IMPOT SUR LE REVENU RELATIF AUX FRAIS DE VACATION ET DE CORRECTION ET DES EXAMENS ET CONCOURS EXERCICES
                      <?php  echo date('Y');  ?>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                   <b>Rubrique budgétaire : </b>  <input type="text" style="display: inline;border:0;font-weight:bold;" size="35">
                </div>
                <div class="col-md-12">
                    <b>Intitulé de la rubrique : </b>  <input type="text" style="display: inline;border:0;font-weight:bold;" size="45">
                </div>
            </div>
            <?php
                mysqli_set_charset($connect, "utf8");
                $sql = "SELECT profs.nom,profs.prenom,profs.cin,profs.ppr,p.ir_somme FROM profs , prix_vacataire p 
                where 
                 p.id_p=profs.id_p ";
                $result = mysqli_query($connect, $sql);
            ?>
                <table class="table table-bordered border-dark text-center">
                    <tr>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>CIN </th>
                        <th>PPR</th>
                        <th>MONTANT IR</th>
                    </tr>
                    <tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['nom'] . '</td>';
                            echo '<td>' . $row['prenom'] . '</td>';
                            echo '<td>' . $row['cin'] . '</td>';
                            echo '<td>' . $row['ppr'] . '</td>';
                            echo '<td>' .number_format($row['ir_somme'],2)  . '</td>';
                        }
                        ?>
                    </tr>
                    <tr>
                        <th colspan="4">TOTAL GENERAL</th>
                        <th>
                            <?php
                            $sql2 = "SELECT SUM(ir_somme) as total FROM prix_vacataire ";
                            $result2 = mysqli_query($connect, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            echo number_format($row2['total'],2);
                            ?>
                        </th>    
                    </tr>
                </table>
                <div class="row">
                    <div class="col-md-12">
                   <b>Arrété le présent état à la somme de : </b><input type="text" style="display: inline;border:0;font-weight:bold;" size="50">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 text-center">
                       <b> Signature </b>
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