<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Plannification</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">/</li>
    </ol>
    <?php include 'message.php';   ?>
    <form action="affichage_planing.php" method="post">
        <div class="row">
        <div class="col-md-6 mb-3">
                <label for="option">Option :</label>
                <select name="option" class="option" id="option" required>
                    <option value="" selected disabled>--select option--</option>
                    <?php
                    $id_pro = $_SESSION['auth_user']['user_id'];
                    mysqli_set_charset($connect, "utf8");
                    $sql = "SELECT options.id_op,options.nom_op FROM profs , options where profs.id_op=options.id_op and id_p=$id_pro";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_op'] . '">' . $row['nom_op'] . '</option>';
                    }
                    ?>
                </select>
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
        </script>
        <script>
            $(document).ready(function() {
                $('#option').on('change', function() {
                    var countryID = $(this).val();
                    if (countryID) {
                        $.ajax({
                            type: 'POST',
                            url: 'ajax2.php',
                            data: 'id=' + countryID,
                            success: function(html) {
                                $('#module').html(html);
                            }
                        });
                    }
                });
            });
        </script>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="recherche" value="Recherche" class="btn btn-primary" id="submit">
        </div>
    </form>




    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>