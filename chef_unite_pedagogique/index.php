<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Chef de l'unité pedagogique</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item ">Dashboard</li>
    </ol>
    <?php  include 'message.php';   ?>
    <div class="row"> 
    <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h4>Etudiants</h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-light stretched-link text-decoration-none" href="affichage_etudiant.php">
                    <?php
                    $sql1 = "SELECT count(nom) as num_et FROM etudiant";
                    $result1 = mysqli_query($connect, $sql1);
                    $row1 =mysqli_fetch_array($result1);
                    echo '<h2>'.$row1['num_et'].'</h2>';
                    ?> 
                    </a>
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