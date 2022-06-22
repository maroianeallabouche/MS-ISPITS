<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">List des Vacataire </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Vacataire</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4> Vacataire </h4>
                </div>
                <div class="card-body" id="user_table">
                    <div class="row">
                        <div class="col-xl-7 col-md-8">

                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="vacataire">Vacataire :</label> <br>
                        <select name="vacataire" class="form-select" id="vacataire" required>
                            <option value="" selected disabled>--Select vacataire--</option>
                            <?php
                            mysqli_set_charset($connect, "utf8");
                            $id_p=$_SESSION['auth_user']['user_id'];
                            $sql = "SELECT * FROM profs where type_prof = 'Enseignants vacataires' and
                            id_op in (SELECT id_op FROM profs WHERE id_p=$id_p)
                            ";
                            $result = mysqli_query($connect, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['id_p'] . '">' . $row['nom'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>date</th>
                                <th>Nembre Heure</th>
                                <th>Module</th>
                                <th>Niveau</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody id="info">


                        </tbody>
                    </table>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#vacataire').on('change', function() {
                                var countryID = $(this).val();
                                if (countryID) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajax4.php',
                                        data: 'id=' + countryID,
                                        success: function(html) {
                                            $('#info').html(html);
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