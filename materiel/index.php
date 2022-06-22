<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Chef matériel</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item ">Dashboard</li>
    </ol>
    <?php  include 'message.php';   ?>
    <div class="row">
    <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h4>Categories </h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link text-decoration-none" href="ajouter_categorie.php">
                    <?php
                    $sql1 = "SELECT count(id_cat) as num_cat FROM categorie_materiel ";
                    $result1 = mysqli_query($connect, $sql1);
                    $row1 =mysqli_fetch_array($result1);
                    echo '<h2>'.$row1['num_cat'].'</h2>';
                    ?> </a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h4>Article </h4>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link text-decoration-none" href="affiche_article.php">
                    <?php
                    $sql2 = "SELECT count(id_mat) as num_mat FROM  materiel ";
                    $result2 = mysqli_query($connect, $sql2);
                    $row2 =mysqli_fetch_array($result2);
                    echo '<h2>'.$row2['num_mat'].'</h2>';
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