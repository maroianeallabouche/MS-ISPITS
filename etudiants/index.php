<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-xl-12 col-md-12 mt-3">
            <?php include 'message.php';   ?>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h4>Emplois du temps</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link text-decoration-none" href="display_pdf_emp.php">
                        <?php
                        $id_et = $_SESSION['auth_user']['user_id'];
                        $sql1 = "SELECT count(pdf_name) as num_emp FROM emploi_pdf 
                        where id_op in (SELECT id_op FROM etudiant WHERE id_et=$id_et)
                        and id_niv in (SELECT id_niv FROM etudiant WHERE id_et=$id_et)";
                        $result1 = mysqli_query($connect, $sql1);
                        $row1 = mysqli_fetch_array($result1);
                        echo '<h2>' . $row1['num_emp'] . '</h2>';
                        ?> </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h4>Fichiers</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link text-decoration-none" href="display_pdf.php">
                    <?php
                    $sql1 = "SELECT count(id_f_p) as num_f FROM  fiche_pdf";
                    $result1 = mysqli_query($connect, $sql1);
                    $row1 =mysqli_fetch_array($result1);
                    echo '<h2>'.$row1['num_f'].'</h2>';
                    ?> </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>