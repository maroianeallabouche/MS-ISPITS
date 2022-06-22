<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Options</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter option</li>
    </ol>
    <?php include 'message.php';   ?>
    <form action="ajouter_option_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first">Nom option :</label>
                <input required type="text" name="nom_op" class="form-control" id="first" placeholder="ajouter option">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Code option :</label>
                <input required type="text" name="code_op" class="form-control" id="first" placeholder="ajouter code option">
            </div>
            <div class="col-md-6 mb-3">
            <label for="fil">Filiere :</label>
                <select class="form-select" name="id_f" required id="fil">
                    <option value="" selected disabled >--Select filiere--</option>
                    <?php
                     mysqli_set_charset($connect,"utf8");
                    $sql = "SELECT * FROM filiere";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value=' . $row['id_f'] . '>' . $row['nom_fil'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="ajouter_op" value="Ajouter" class="btn btn-success" id="submit">
        </div>
    </form>




    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>