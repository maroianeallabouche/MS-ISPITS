<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Module</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">edit module</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>modifier les info de module</h2>
                </div>
                <div class="card-body">
                    <?php
                    mysqli_set_charset($connect, "utf8mb4");
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $_SESSION['mod_id'] = $id;
                        $sql = "SELECT * FROM module WHERE id_mod = $id";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if (mysqli_num_rows($result) > 0) {
                            // foreach($result as $row){
                            //     $id = $row['id'];
                            // }
                    ?>
                            <form action="edit_module_code.php" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="filiere">Filiere :</label> <br>
                                        <select name="filiere" class="filiere" id="filiere" required>
                                            <option value="" selected disabled>--Select filiere--</option>
                                            <?php
                                            mysqli_set_charset($connect, "utf8");
                                            $sql = "SELECT * FROM filiere";
                                            $result = mysqli_query($connect, $sql);
                                            while ($rows = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $rows['id_f'] . '">' . $rows['nom_fil'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="options">Option :</label> <br>
                                        <select name="option" class="option" required>
                                            <?php mysqli_set_charset($connect, "utf8"); ?>
                                            <option selected disabled>--Select option--</option>>
                                        </select>
                                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                                        </script>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $(".filiere").change(function() {
                                                    var country_id = $(this).val();
                                                    var post_id = 'id=' + country_id;

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "ajax.php",
                                                        data: post_id,
                                                        cache: false,
                                                        success: function(cities) {
                                                            $(".option").html(cities);
                                                        }
                                                    });

                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="first">Nom module :</label>
                                        <input required type="text" name="nom_mod" class="form-control" value="<?php echo $row['nom_mod'];  ?>" id="first" placeholder="ajouter module">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="first">Volume horaire :</label>
                                        <input required type="text" name="mass_h" class="form-control" value="<?php echo $row['mass_h'];  ?>" id="first" placeholder="ajouter Volume horaire">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="first">Nembre element :</label>
                                        <select class="form-select" name="nbr_element" class="nbr_element" required>
                                            <option selected disabled>--Select Nembre element--</option>>
                                            <option value="1">1</option>>
                                            <option value="2">2</option>>
                                            <option value="3">3</option>>
                                            <option value="4">4</option>>
                                            <option value="5">5</option>>
                                            <option value="6">6</option>>
                                            <option value="7">7</option>>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="first">Type module :</label>
                                        <select class="form-select" name="type_mod" class="nbr_element" required>
                                            <option selected disabled>--Select type module--</option>>
                                            <option value="majeur">Majeur</option>>
                                            <option value="complementaire">complémentaire</option>>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Niveau :</label>
                                        <select name="niveau" required class="form-select" id="">
                                            <option value="" selected disabled>--Choisir niveau--</option>
                                            <?php
                                            $nvsql = "SELECT * FROM  niveau";
                                            $res = mysqli_query($connect, $nvsql);
                                            while ($rowab = mysqli_fetch_assoc($res)) {
                                                echo '<option value="' . $rowab['id_niv'] . '"> S-' . $rowab['nom_semestre'] . '</option>';
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