<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<style>

</style>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="pdf2.js"></script>
<div class="col-md-3 m-md-2">
    <button class="btn btn-warning text-white" onclick="generatePDF()">Print <i class="fas fa-print"></i></button>
</div>
<!-- <script>
    onclick="printCertificate()"
    function printCertificate() {
        var printContents = document.getElementById('invoice').innerHTML ;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script> -->
<div class="container-fluid px-4 mt-2 mb-2">
    <?php mysqli_set_charset($connect, "utf8");
    if (isset($_GET['id'])) {
        $id_et = $_GET['id'];
        $id_op =  $_SESSION['option'];
        $id_niv = $_SESSION['niveau'];
        $id_f =  $_SESSION['filiere'];
        $_SESSION['option_o'] = $id_op;
        $_SESSION['niveau_n'] = $id_niv;
        $_SESSION['filiere_f'] = $id_f;
        $newEndingDate = '';
        mysqli_set_charset($connect, "utf8");
        $sql = "SELECT e.id_et , e.nom , e.prenom , e.num_inscpt, e.date_naiss ,e.cin , e.cne , f.nom_fil , options.nom_op , n.nom_semestre
        from etudiant e , filiere f , options , niveau n 
        where e.id_f=f.id_f and e.id_op=options.id_op and e.id_niv=n.id_niv and e.id_et=$id_et
        and 
        options.id_op=$id_op and n.id_niv=$id_niv and f.id_f=$id_f";
        $result = mysqli_query($connect, $sql);
    ?>
        <div class="m-4 mb-4" id="invoice">
            <div class="row">
            <div class="col-md-12" style="background-image: url(newimg.jpg);background-position: center;
                background-repeat: no-repeat;
                height:200px">
                </div>
            </div>
            <div class="col-md-8 m-auto text-center">
                <h2><u> ATTESTATION DE REUSSITE </u></h2>
            </div><br> <br>
            <div class="col-md-10 m-auto pt-2">
                <b>Le Directeur de l’Institut Supérieur des Professions Infirmières et Technique de Santé de
                    Laayoune atteste par la présente que l’Etudiant (e),</b>
            </div>
            <div class="row mt-3">
                <div class="col-md-11 m-auto">
                    <?php
                    if ($row = mysqli_fetch_array($result)) {
                    ?>
                        <div class="row m-auto">
                            <div class="col-md-5">
                                <b>NOM PRENOM : <?php echo $row['nom'] . ' ' . $row['prenom']; ?></b>
                            </div>
                            <div class="col-md-5">
                                <b>Né (e) le : <?php echo $row['date_naiss']; ?></b>
                            </div>
                        </div>
                        <div class="row m-auto">
                            <div class="col-md-5">
                                <b>CIN : <?php echo $row['cin']; ?></b>
                            </div>
                            <div class="col-md-5">
                                <b>CNE : <?php echo $row['cne']; ?></b>
                            </div>
                        </div>
                        <div class="col-md-10 mx-5 mt-4  pt-2">
                            <b> A réussi les examens des Etudes du Cycle
                                &nbsp;&nbsp;
                                <input type="text" style="border: 0;font-weight:bold;" size="12" name="" id="">
                                de Licence des ISPITS : </b>
                        </div>
                        <div class="col-md-11 mx-3">
                            <b>Filière : <?php echo $row['nom_fil']; ?></b> <br>
                            <b>Option : <?php echo $row['nom_op']; ?></b> <br>
                            <b>N° inscreption : <?php echo $row['num_inscpt']; ?></b> <br>
                            <b>Promotion : <input type="text" style="border: 0;font-weight:bold;" name="" id=""> </b> <br>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-md-10 mx-5 mt-2  pt-2">
                        <b>La présente attestation est délivrée à l'intéressé (e), sur sa demande, pour servir et valoir ce que de droit.
                        </b>
                    </div>
                    <div class="col-md-10 mx-5 mt-4  pt-2">
                        <b> A Laayoune le : <?php echo date('Y/m/d'); ?> &nbsp;&nbsp;&nbsp;&nbsp; Le Directeur </b>
                    </div> <br>
                </div>
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