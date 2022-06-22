<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Salles</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter salle</li>
    </ol>
    <?php include 'message.php';   ?>
    <form action="ajouter_salle_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first">Nom salle :</label>
                <input required type="text" name="nom_salle" class="form-control" id="first" placeholder="ajouter salle">
            </div>
            <div class="col-md-6 mb-3">
            <label for="fil">Option :</label>
                <select class="form-select" name="option" required id="fil">
                    <option value="" selected disabled >--Select option--</option>
                    <?php
                     mysqli_set_charset($connect,"utf8");
                    $sql = "SELECT * FROM options";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value=' . $row['id_op'] . '>' . $row['nom_op'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
            <label for="fil">Unité :</label>
                <select class="form-select" name="unite" required id="fil">
                    <option value="" selected disabled >--Select unité--</option>
                    <?php
                     mysqli_set_charset($connect,"utf8");
                    $sql = "SELECT * FROM unite";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value=' . $row['id_u'] . '>' . $row['nom_u'] . '</option>';
                    }
                    ?>
                </select>
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