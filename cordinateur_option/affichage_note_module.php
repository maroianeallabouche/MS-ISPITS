<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Affichage Notes modules des étudiants </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Modules</h2>
                </div>
                <div class="card-body">
                    <form action="affichage_note_module_2.php" method="post">
                        <div class="row">

                        <div class="col-md-6 mb-3">
                                <label for="last">Niveau :</label> <br>
                                <select name="niveau" required class="niveau" id="niveau">
                                    <option value="" selected disabled>--Choisir niveau--</option> -->
                                    <?php
                                    $id_pro = $_SESSION['auth_user']['user_id'];
                                    $op_sql = "SELECT * from options where id_op in (select id_op from profs where id_p=$id_pro)";
                                    $op_res = mysqli_query($connect, $op_sql);
                                    $row_res = mysqli_fetch_assoc($op_res);
                                    $_SESSION['options'] = $row_res['id_op'];
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
                                    <option value="" selected disabled>--Select module--</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="recipient-name" class="col-form-label">Session :</label>
                                <select required name="sess" class="form-select" id="sess">
                                    <option value="" selected disabled>-- select session --</option>
                                    <option value="n">Normal</option>
                                    <option value="r">Rattrapage</option>
                                </select>
                            </div>
                            <?php mysqli_set_charset($connect, "utf8");

                            ?>
                        </div>
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                        </script>
                        <script>
                            $(document).ready(function() {
                                $('#niveau').on('change', function() {
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
                            <input required type="submit" name="recherche_md" value="Recherche" class="btn btn-primary" id="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>