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
        $newEndingDate='';
        mysqli_set_charset($connect, "utf8");
        $sql = "SELECT e.id_et , e.nom , e.prenom , e.num_inscpt, e.date_naiss ,e.cin , e.cne , f.nom_fil , options.nom_op , n.nom_semestre
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
        <div class="col-md-8 m-auto text-center pt-2">
            <h4><u> ATTESTATION D’INSCRIPTION </u></h4>
        </div><br> <br>
        <div class="col-md-10 m-auto mt-4  pt-2">
            <b> Je soussigné, Monsieur le Directeur de l’Institut Supérieur 
                des Professions Infirmières et Techniques de Santé de Laayoune, atteste que l’Etudiante  : </b>
        </div>
        <div class="row mt-3">
            <div class="col-md-11 m-auto">
                <?php
                if ($row = mysqli_fetch_array($result)) {
                ?>
                    <ul>
                        <li><b>NOM PRENOM : <?php echo $row['nom'].' '.$row['prenom'] ; ?></b> </li> <br>
                        <li><b>CIN : <?php echo $row['cin'] ; ?></b> </li> <br>
                        <li><b>CNE : <?php echo $row['cne'] ; ?></b> </li> <br>
                        <li><b>DATE DE NAISSANCE : <?php echo $row['date_naiss'] ; ?></b> </li> <br>
                        <li><b>N° INSCRIPTION : <?php echo $row['num_inscpt'] ; ?></b> </li> 
                    </ul>
                <div class="col-md-10 mx-5 mt-4  pt-2">
                    <b> Est inscrite au niveau de cet Institut au titre de l’Année Universitaire  <?php echo (date('Y') - 1) .'/'.date('Y');  ?> : </b>
                </div> <br>
                <ul>
                        <li><b>Filière : <?php echo $row['nom_fil']; ?></b> </li> <br>
                        <li><b>Option  : <?php echo $row['nom_op'] ; ?></b> </li> <br>
                        <li><b>NIVEAU : S-<?php echo $row['nom_semestre'] ; ?></b> </li> <br> 
                    </ul>
                <?php
                }
                ?>
                 <div class="col-md-10 mx-5 mt-2  pt-2">
                    <b>Cette Attestation est délivrée à l’intéressé, sur sa demande, pour servir et valoir ce que de droit. </b>
                </div> <br>
                <div class="col-md-10 mx-5 mt-4  pt-2">
                    <b> Fait à : Laayoune le : <?php echo date('Y/m/d'); ?> &nbsp;&nbsp;&nbsp;&nbsp; Le Directeur </b>
                </div> <br>
            </div>
        </div>

    <?php
    }
    ?>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>