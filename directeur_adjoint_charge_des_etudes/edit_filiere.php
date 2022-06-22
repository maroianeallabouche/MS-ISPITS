<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Filiere</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">edit filiere</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>modifier les info de filiere</h2>
                </div>
                <div class="card-body">
                    <?php
                    mysqli_set_charset($connect, "utf8mb4");
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $_SESSION['fil_id'] = $id;
                        $sql = "SELECT * FROM filiere WHERE id_f = $id";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if (mysqli_num_rows($result) > 0) {
                            // foreach($result as $row){
                            //     $id = $row['id'];
                            // }
                    ?>
                            <form action="edit_filiere_code.php" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="hidden" value="<?php echo $row['id_f']; ?>" name="">
                                        <label for="first">Nom filiere :</label>
                                        <input required type="text" name="filiere" class="form-control" id="first" value="<?php echo $row['nom_fil']; ?>" placeholder="Enter nom filiere">
                                    </div>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <input required type="submit" name="Modifier" value="Modifier" class="btn btn-success" id="submit">
                                </div>
                            </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>