<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="col-md-6 m-md-2">
<button id="export" class="btn btn-success" name="export">Export <i class='fas fa-download'></i></button>
</div>
<div class="container-fluid px-4" id="invoice">
    <?php include 'message.php';   ?>

    <div class="row">
        <div class="col-md-12">
            <?php
            mysqli_set_charset($connect, "utf8");
            $sql = "SELECT * FROM profs , prix_vacataire p ,rib_prof 
                where p.id_p=profs.id_p and profs.id_p=rib_prof.id_p ";
            $result = mysqli_query($connect, $sql);
            ?>
            <table id="table" class="table table-bordered border-dark text-center">
                <tr>
                    <th>Grade/Echelle</th>
                    <th>Date début</th>
                    <th>Date Fin</th>
                    <th>Nembre</th>
                    <th>Taux</th>
                    <th>Brut</th>
                    <th>Retenues</th>
                    <th>Montant net</th>
                    <th>CIN</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>PPR</th>
                    <th>Mode de paiement</th>
                    <th>Type référence réglement</th>
                    <th>Banque</th>
                    <th>VILLE</th>
                    <th>Numéro compte RiB</th>
                    <th>clé</th>
                    <th>objet réglement</th>

                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['echelle'] . ' ' . $row['echelon']  . '</td>';
                    echo '<td>' . $row['date_d'] . '</td>';
                    echo '<td>' . $row['date_f'] . '</td>';
                    echo '<td>' . $row['nbr_h'] . '</td>';
                    echo '<td>' . $row['taux_h'] . '</td>';
                    echo '<td>' .number_format($row['somme_m'],2) . '</td>';
                    echo '<td>' .number_format($row['ir_somme'],2) . '</td>';
                    echo '<td>' .number_format($row['net_payer'],2) . '</td>';
                    echo '<td>' . $row['cin'] . '</td>';
                    echo '<td>' . $row['nom'] . '</td>';
                    echo '<td>' . $row['prenom'] . '</td>';
                    echo '<td>' . $row['ppr'] . '</td>';
                    echo '<td>VIR</td>';
                    echo '<td>RIB</td>';
                    echo '<td>' . $row['banque'] . '</td>';
                    echo '<td>' . $row['ville'] . '</td>';
                    echo '<td>' . $row['rib_p'] . '</td>';
                    echo '<td>' . $row['cle'] . '</td>';
                    echo '<td>' . $row['org'] . '</td>';
                    echo '</tr>';
                }
                ?>
                <?php
               $sql1="SELECT SUM(somme_m) as somme_m,SUM(ir_somme) as ir_somme,SUM(net_payer) as net_payer FROM prix_vacataire";
                $result1 = mysqli_query($connect, $sql1);
               if( $row1 = mysqli_fetch_assoc($result1)){
                ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo number_format($row1['somme_m'],2)  ; ?></td>
                <td><?php echo number_format( $row1['ir_somme'],2) ; ?></td>
                <td><?php echo number_format($row1['net_payer'],2) ; } ?></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td>
            </tr>
            </table>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
            <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#export').on('click', function(e) {
                        $("#table").table2excel({
                            exclude: ".noExport",
                            name: "Data",
                            filename: "table_rv_g",
                            fileext: ".xls"
                        });
                    });
                });
            </script>
        </div>

    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>