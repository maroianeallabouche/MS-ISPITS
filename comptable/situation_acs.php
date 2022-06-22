<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Inventaire</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Materiél</li>
    </ol>
    <?php include 'message.php';   ?>
    <form action="situation_acs_code.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <label for="">Designation :</label>
                <input type="text" name="des" class="form-control" placeholder="designation" id="">
            </div>
            <div class="col-md-6">
                <label for="">Quantité :</label>
                <input type="number" name="qte" class="form-control" placeholder="Quantité" id="">
            </div>
            <div class="col-md-6">
                <label for="">Unité :</label>
                <select name="unite" class="form-select" id="unite">
                    <option value="" selected disabled>Choisir la unite</option>
                    <?php
                    $sql = "SELECT * FROM unite";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_u'] . '">' . $row['nom_u'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="">Salle :</label>
                <select name="salle" class="form-select" id="salle">
                    <option value="">Choisir la unite</option>
                </select>
            </div>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
            </script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#unite").change(function() {
                        var country_id = $(this).val();
                        var post_id = 'id=' + country_id;

                        $.ajax({
                            type: "POST",
                            url: "ajaxsalle.php",
                            data: post_id,
                            cache: false,
                            success: function(cities) {
                                $("#salle").html(cities);
                            }
                        });

                    });
                });
            </script>
        </div>
        <div class="col-md-6 mt-4 mb-3">
            <input required type="submit" name="ajouter" value="Ajouter" class="btn btn-warning" id="submit">
        </div>
    </form>
    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>