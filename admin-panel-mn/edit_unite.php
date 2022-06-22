<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Salle</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">edit salle</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>modifier les info de salle</h2>
                </div>
                <div class="card-body">
                    <?php
                    mysqli_set_charset($connect, "utf8mb4");
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $_SESSION['id_u'] = $id;
                        $sql = "SELECT * FROM unite WHERE id_u = $id";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if (mysqli_num_rows($result) > 0) {
                    ?>
                            <form action="edit_unite_code.php" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first">Unité :</label>
                                        <input required type="text" value="<?php echo $row['nom_u'] ; ?>" name="nom_unite" class="form-control" id="first" placeholder="ajouter unité">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <input required type="submit" name="modifier" value="Modifier" class="btn btn-success" id="submit">
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