<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher elements </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">elements</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>elements enregistrés</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <div class="col-md-6 mb-3">
                                <label for="option">Option :</label> <br>
                                <select name="option" class="option" id="option" required>
                                    <option value="" selected disabled>--Select option--</option>
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
                            <div class="col-md-6 mb-3">
                                <label for="module">Modules :</label> <br>
                                <select name="module" class="module" id="module" required>
                                    <option value="" selected disabled>--Select module--</option>
                                </select>
                            </div>

                            <thead class="thead-dark">
                                <tr>
                                    <th>N°</th>
                                    <th>nom element</th>
                                    <th>Volume horaire</th>
                                </tr>
                            </thead>
                            <tbody class="element" id="element">
                                <?php mysqli_set_charset($connect, "utf8");

                                ?>

                                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                                </script>
                                <script>
                                     $(document).ready(function() {
                                        $('#niveau').on('change', function() {
                                            var countryID = $(this).val();
                                            var e = $('#option').val();
                                            console.log(countryID);
                                            console.log(e);

                                            $.ajax({
                                                type: 'POST',
                                                url: 'ajax2.php',
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
                                    $(document).ready(function() {
                                        // $('#option').on('change', function() {
                                        //     var countryID = $(this).val();
                                        //     if (countryID) {
                                        //         $.ajax({
                                        //             type: 'POST',
                                        //             url: 'ajaxmodule.php',
                                        //             data: 'id=' + countryID,
                                        //             success: function(html) {
                                        //                 $('#module').html(html);
                                        //             }
                                        //         });
                                        //     }
                                        // });
 
                                        $('#module').on('change', function() {
                                            var stateID = $(this).val();
                                            if (stateID) {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'ajax6.php',
                                                    data: 'id=' + stateID,
                                                    success: function(html) {
                                                        $('#element').html(html);
                                                    }
                                                });
                                            }
                                        });
                                    });
                                </script>
                            </tbody>
                        </table>
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