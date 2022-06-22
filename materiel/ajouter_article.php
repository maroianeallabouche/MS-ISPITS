<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Articles</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter articles</li>
    </ol>
    <?php  include 'message.php';   ?>
    <form action="ajouter_article_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first">Article :</label>
                <input required type="text" name="art" class="form-control" id="first" placeholder="article">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Designation :</label>
                <input required type="text" name="des" class="form-control" id="first" placeholder="designation">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">N° inventaire :</label>
                <input required type="text" name="num_inv" class="form-control" id="first" placeholder="N° inventaire">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Quantité :</label>
                <input required type="number" name="qte" class="form-control" id="first" placeholder="quantité">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Date :</label>
                <input required type="date" name="dt" class="form-control" id="first" placeholder="la date">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Emplacement :</label>
                <input required type="text" name="emplc" class="form-control" id="first" placeholder="emplacement">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Unité :</label>
                <input required type="text" name="unite" class="form-control" id="first" placeholder="Unité">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Observation :</label>
                <input required type="text" name="observ" class="form-control" id="first" placeholder="Observation">
            </div>
            <?php
            $sql = "SELECT * FROM categorie_materiel";
            $result = mysqli_query($connect, $sql);
            ?>
            <div class="col-md-6 mb-3">
                <label for="first">Catégorie :</label>
                <select name="cat" class="form-select">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_cat'] . '">' . $row['nom_cat'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="register_btn" value="Ajouter" class="btn btn-primary" id="submit" >
            </div>
    </form>
    
</div>



    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>