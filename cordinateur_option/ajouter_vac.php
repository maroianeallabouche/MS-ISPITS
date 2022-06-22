<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Emplois du Temps</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter vacataire</li>
    </ol>
    <?php include 'message.php';   ?>
    <form action="ajouter_vac_2.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="vacataire">Vacataire :</label> <br>
                <select name="vacataire" class="form-select" id="vacataire" required>
                    <option value="" selected disabled>--Select vacataire--</option>
                    <?php
                    mysqli_set_charset($connect, "utf8");
                    $id=$_SESSION['auth_user']['user_id'];
                    $sql = "SELECT * FROM profs where type_prof = 'Enseignants vacataires' and id_op in
                     ( select id_op from profs where id_p = $id)";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_p'] . '">' . $row['nom'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Niveau :</label> <br>
                <select name="niveau" required class="niveau" id="niveau">
                    <option value="" selected disabled>--Choisir niveau--</option> -->
                    <?php
                    $id_pro = $_SESSION['auth_user']['user_id'];
                    $op_sql="SELECT * from options where id_op in (select id_op from profs where id_p=$id_pro)";
                    $op_res= mysqli_query($connect, $op_sql);
                    $row_res=mysqli_fetch_assoc($op_res);
                    $_SESSION['option']=$row_res['id_op'];
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
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Date :</label> <br>
                <input required type="date" name="date" class="form-control" id="date" placeholder=" date">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Nembre Heure :</label> <br>
                <input required type="number" name="number" class="form-control" id="date" placeholder=" Nembre Heure">
            </div>


        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="ajouter_vac" value="Enregistrer" class="btn btn-success" id="submit">
        </div>
    </form>




    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>