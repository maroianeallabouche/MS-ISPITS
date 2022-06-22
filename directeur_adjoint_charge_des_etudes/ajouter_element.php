<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Element</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter element</li>
    </ol>
    <?php include 'message.php';   ?>

    <form action="ajouter_element_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="option">Option :</label> <br>
                <select name="option" class="option" id="option" required>
                    <option value="" selected disabled>--Select option--</option>
                    <?php
                    mysqli_set_charset($connect, "utf8");
                    $sql = "SELECT * FROM options";
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
            <div class="col-md-6 mb-3">
                <label for="module">Module :</label> <br>
                <select name="module" class="module" id="module" required>
                    <option selected disabled>--Select module--</option>>
                </select>
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                </script>
                <script type="text/javascript">
                    // $(document).ready(function() {
                    //     $(".option").change(function() {
                    //         var country_id = $(this).val();
                    //         var post_id = 'id=' + country_id;

                    //         $.ajax({
                    //             type: "POST",
                    //             url: "ajax2.php",
                    //             data: post_id,
                    //             cache: false,
                    //             success: function(cities) {
                    //                 $(".module").html(cities);
                    //             }
                    //         });

                    //     });
                    // });
                    $(document).ready(function() {
                        $('#niveau').on('change', function() {
                            var countryID = $(this).val();
                            var e = $('#option').val();
                            console.log(countryID);
                            console.log(e);

                            $.ajax({
                                type: 'POST',
                                url: 'ajaxniv.php',
                                data: {
                                    id: countryID,
                                    id_op: e
                                },
                                success: function(html) {
                                    $('#module').html(html);
                                }
                            });

                        });
                    });
                </script>
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Nom element :</label>
                <input required type="text" name="nom_el" class="form-control" id="first" placeholder="ajouter nom element">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Volume horaire :</label>
                <input required type="text" name="mass_h" class="form-control" id="first" placeholder="ajouter Volume horaire">
            </div>

        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="ajouter_element" value="Ajouter" class="btn btn-success" id="submit">
        </div>
    </form>




    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>