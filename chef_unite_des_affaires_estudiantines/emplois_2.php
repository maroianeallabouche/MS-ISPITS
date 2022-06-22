<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Affichage l'emplois du Temps</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Sélectionner l'option , semestre :</li>
    </ol>
    <?php include 'message.php';   ?>
    <form action="display_pdf_emp.php" method="post">
        <div class="row">
        <div class="col-md-6 mb-3">
                <label for="filiere">Filiere :</label> <br>
                <select   name="filiere" class="filiere" id="filiere" required>
                    <option value="" selected disabled>--Select filiere--</option>
                    <?php
                    mysqli_set_charset($connect, "utf8");
                    $sql = "SELECT * FROM filiere";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_f'] . '">' . $row['nom_fil'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="options">Option :</label> <br>
                <select  name="option" class="option"  required>
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
                <label for="last">Niveau :</label> <br>
                <select name="niveau" required class="niveau" id="niveau">
                    <option value="" selected disabled>--Choisir niveau--</option> -->
                    <?php
                    $nvsql = "SELECT * FROM  niveau";
                    $res = mysqli_query($connect, $nvsql);
                    while ($rowab = mysqli_fetch_assoc($res)) {
                        echo '<option value="' . $rowab['id_niv'] . '"> S-' . $rowab['nom_semestre'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <?php mysqli_set_charset($connect, "utf8");

            ?>
        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="recherche" value="Recherche" class="btn btn-primary" id="submit">
        </div>
    </form>




    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>