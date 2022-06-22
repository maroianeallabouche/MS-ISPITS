<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Commander matériel</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Article</li>
    </ol>
    <?php  include 'message.php';   ?>
    <form action="cmd_mat_code.php" method="post">
    <div class="row">
                <div class="col-md-6">
                    <?php
                    $id_ad = $_SESSION['auth_user']['user_id'];
                    $_SESSION['id_ad'] = $id_ad;
                    $sql = "SELECT * FROM categorie_materiel";
                    $result = mysqli_query($connect, $sql);
                    ?>
                    <label for="">Catégories :</label>
                    <select name="categorie" class="form-select" id="categorie">
                        <option value="" selected disabled>--select categorie--</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['id_cat'] . '">' . $row['nom_cat'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="row mt-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Article</th>
                                <th>Designation</th>
                                <th>Quantité</th>
                            </tr>
                        </thead>
                        <tbody id="article">

                        </tbody>
                    </table>
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#categorie').on('change', function() {
                                var countryID = $(this).val();
                                if (countryID) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajax.php',
                                        data: 'id=' + countryID,
                                        success: function(html) {
                                            $('#article').html(html);
                                        }
                                    });
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        <div class="col-md-6 mt-4 mb-3">
            <input required type="submit" name="ajouter" value="Commander" class="btn btn-warning" id="submit" >
            </div>
    </form>




    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>