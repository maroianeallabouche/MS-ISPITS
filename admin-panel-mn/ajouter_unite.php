<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Unités</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter unité</li>
    </ol>
    <?php include 'message.php';   ?>
    <form action="ajouter_unite_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first">Unité :</label>
                <input required type="text" name="nom_unite" class="form-control" id="first" placeholder="ajouter unité">
            </div>
        </div>
 
        <div class="col-md-6 mb-3">
            <input required type="submit" name="ajouter_salle" value="Ajouter" class="btn btn-success" id="submit">
        </div>
    </form>




    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>