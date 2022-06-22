<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Importer les fichiers PDF</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Import</h2>
                </div>
                <div class="card-body">
                <form action="pdf_emploi.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-md-6 m-md-2">
                        <input type="file" name="pdf" class="form-control" id="">
                    </div>
                    <div class="col-md-4 m-md-2">
                        <input type="submit" name="up" class="btn btn-warning" value="Import PDF">
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>