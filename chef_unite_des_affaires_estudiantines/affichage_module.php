<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher modules </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">modules</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>modules enregistrées</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
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
                            <thead class="thead-dark">
                                <tr>
                                    <th>N°</th>
                                    <th>nom module</th>
                                    <th>Volume horaire</th>
                                    <th>Nembre element</th>
                                    <th>Niveau</th>
                                    <th>type module</th>
                                </tr>
                            </thead>
                            <tbody id="module">
                                <?php mysqli_set_charset($connect, "utf8");

                                ?>

                                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                                </script>
                                <script type="text/javascript">
                                     $(document).ready(function() {
                                        $('#niveau').on('change', function() {
                                            var countryID = $(this).val();
                                            var e = $('#option').val();
                                            console.log(countryID);
                                            console.log(e);

                                            $.ajax({
                                                type: 'POST',
                                                url: 'ajax4.php',
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
                                    // $(document).ready(function() {
                                    //     $(".option").change(function() {
                                    //         var country_id = $(this).val();
                                    //         var post_id = 'id=' + country_id;

                                    //         $.ajax({
                                    //             type: "POST",
                                    //             url: "ajax4.php",
                                    //             data: post_id,
                                    //             cache: false,
                                    //             success: function(cities) {
                                    //                 $(".module").html(cities);
                                    //             }
                                    //         });

                                    //     });
                                    // });
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