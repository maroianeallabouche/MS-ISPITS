<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher tout les étudiants absents </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">étudiants</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Espace du recherche</h2>
                </div>
                <div class="card-body">
                        <div class="col-md-6 mb-3">
                            <label for="filiere">Filiere :</label> <br>
                            <select name="filiere" class="filiere" id="filiere" required>
                                <option value="" selected disabled>--Select filiere--</option>
                                <?php
                                mysqli_set_charset($connect, "utf8");
                                $id_pro = $_SESSION['auth_user']['user_id'];
                                $sql = "SELECT * FROM filiere where id_f in (SELECT id_f FROM profs where id_p=$id_pro)";
                                $result = mysqli_query($connect, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['id_f'] . '">' . $row['nom_fil'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="module">Options :</label> <br>
                            <select name="option" class="option" id="option" required>
                                <option value="" selected disabled>--Select option--</option>
                            </select>
                        </div>
                        <table class="table table-bordered border-dark" >
                        <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Niveau</th>
                        <th>Séance d'absence</th>
                        <th>Date absence</th>
                        <th>Nom module</th>
                        </tr>
                        <tbody id="etudiant">

                        </tbody>
                        </table>
                    <?php mysqli_set_charset($connect, "utf8");

                    ?>
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#filiere').on('change', function() {
                                var countryID = $(this).val();
                                if (countryID) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajax.php',
                                        data: 'id=' + countryID,
                                        success: function(html) {
                                            $('#option').html(html);
                                        }
                                    });
                                }
                            });
                        });
                        $(document).ready(function() {
                            $('#option').on('change', function() {
                                var countryID = $(this).val();
                                if (countryID) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajax3et.php',
                                        data: 'id=' + countryID,
                                        success: function(html) {
                                            $('#etudiant').html(html);
                                        }
                                    });
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>