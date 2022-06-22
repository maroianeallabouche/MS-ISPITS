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
                        $_SESSION['id_salle'] = $id;
                        $sql = "SELECT * FROM salle WHERE id_salle = $id";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if (mysqli_num_rows($result) > 0) {
                            // foreach($result as $row){
                            //     $id = $row['id'];
                            // }
                    ?>
                            <form action="edit_salle_code.php" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="hidden" value="<?php echo $row['id_salle']; ?>" name="">
                                        <label for="first">Nom salle :</label>
                                        <input required type="text" name="nom_salle" class="form-control" id="first" value="<?php echo $row['nom_salle']; ?>" placeholder="Enter first name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="first">Option :</label>
                                        <select class="form-select" name="option" required id="option">
                                            <option value="" selected disabled>--select option--</option>
                                            <?php
                                            mysqli_set_charset($connect, "utf8");
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
                                            <option value="" selected disabled>--Select unité--</option>
                                            <?php
                                            mysqli_set_charset($connect, "utf8");
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