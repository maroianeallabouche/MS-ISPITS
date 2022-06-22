<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';

?>

<div class="container-fluid px-4">
    <h3 class="mt-4">activer / desactiver page register des étudiants </h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="col-md-6">
        <form action="page_register_action_code.php" method="post">
            <select class="form-select" name="activation" id="">
                <option value="" selected disabled>--choisir--</option>
                <option value="1">activer</option>
                <option value="0">desactiver</option>
            </select>
            <div class="col-md-6 m-3">
            <input type="submit" name="submit" value="valider" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>