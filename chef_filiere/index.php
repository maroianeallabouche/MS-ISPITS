<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Chef de filière</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item ">Dashboard</li>
    </ol>
    <?php  include 'message.php';   ?>
    <div class="row">
    <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h4>Options</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link text-decoration-none" href="affichage_op.php">
                    <?php
                    $id_p=$_SESSION['auth_user']['user_id'];
                    $sql1 = "SELECT count(nom_op) as num_op FROM options where id_f in (SELECT id_f FROM profs WHERE id_p=$id_p)";
                    $result1 = mysqli_query($connect, $sql1);
                    $row1 =mysqli_fetch_array($result1);
                    echo '<h2>'.$row1['num_op'].'</h2>';
                    ?> </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h4>Modules</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link text-decoration-none" href="affichage_module.php">
                    <?php
                    $id_p=$_SESSION['auth_user']['user_id'];
                    $sql1 = "SELECT count(nom_mod) as num_el FROM module where id_f in (SELECT id_f FROM profs WHERE id_p=$id_p)";
                    $result1 = mysqli_query($connect, $sql1);
                    $row1 =mysqli_fetch_array($result1);
                    echo '<h2>'.$row1['num_el'].'</h2>';
                    ?> </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h4>Elements</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link text-decoration-none" href="affichage_element.php">
                    <?php
                    $id_p=$_SESSION['auth_user']['user_id'];
                    $sql1 = "SELECT count(nom_el) as num_el FROM element , module where 
                    element.id_mod=module.id_mod and 
                     module.id_f in (SELECT id_f FROM profs WHERE id_p=$id_p)";
                    $result1 = mysqli_query($connect, $sql1);
                    $row1 =mysqli_fetch_array($result1);
                    echo '<h2>'.$row1['num_el'].'</h2>';
                    ?> </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-dark text-white mb-4">
                <div class="card-body">
                    <h4>Emplois du temps</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link text-decoration-none" href="emplois_2.php">
                    <?php
                    $id_p=$_SESSION['auth_user']['user_id'];
                    $sql1 = "SELECT count(pdf_name) as num_emp FROM emploi_pdf , options 
                    where emploi_pdf.id_op=options.id_op and options.id_f in (SELECT id_f FROM profs WHERE id_p=$id_p)";
                    $result1 = mysqli_query($connect, $sql1);
                    $row1 =mysqli_fetch_array($result1);
                    echo '<h2>'.$row1['num_emp'].'</h2>';
                    ?> </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <h4>Absence rattrapage</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link text-decoration-none" href="rat_abs.php">
                    <?php
                    $id_p=$_SESSION['auth_user']['user_id'];
                    $sql1 = "SELECT count(id_rat) as num_rat FROM rattrapage_et , options where rattrapage_et.id_op=options.id_op
                    and options.id_f in (SELECT id_f FROM profs WHERE id_p=$id_p)";
                    $result1 = mysqli_query($connect, $sql1);
                    $row1 =mysqli_fetch_array($result1);
                    echo '<h2>'.$row1['num_rat'].'</h2>';
                    ?> </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-light text-dark mb-4">
                <div class="card-body">
                    <h4>L'absence</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-dark stretched-link text-decoration-none" href="affichage_absence.php">
                    <?php
                     $id_p=$_SESSION['auth_user']['user_id'];
                    $sql1 = "SELECT count(id_abs) as num_abs FROM absence where id_p in (SELECT id_p FROM profs WHERE id_p=$id_p)";
                    $result1 = mysqli_query($connect, $sql1);
                    $row1 =mysqli_fetch_array($result1);
                    echo '<h2>'.$row1['num_abs'].'</h2>';
                    ?> </a>
                    <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
      
    </div>   
</div>      





<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>