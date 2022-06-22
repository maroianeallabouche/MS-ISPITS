<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Notes </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Ajouter Note</h2>
                </div>
                <div class="card-body" id="user_table">
                    <?php
                            if (isset($_POST['recherche'])) {
                                $id_op =  $_SESSION['option'];
                                $id_niv = $_POST['niveau'];
                                $id_mod = $_POST['module'];
                                $id_ele = $_POST['element'];
                                $_SESSION['id_mod'] = $id_mod;
                                $_SESSION['id_el'] = $id_ele;
                                $_SESSION['id_op'] = $id_op;
                                $_SESSION['id_niv'] = $id_niv;
                                $i = 1;
                                mysqli_set_charset($connect, "utf8");
                                $sql = mysqli_query($connect, "SELECT id_et,nom,prenom from etudiant where id_op=$id_op and id_niv=$id_niv");
                                $sql2 = mysqli_query($connect, "SELECT * from module where id_mod=$id_mod");
                                $sql3 = mysqli_query($connect, "SELECT * from element where id_el=$id_ele");
                                $sql4 = mysqli_query($connect, "SELECT * from options where id_op=$id_op");
                                if($row3=mysqli_fetch_array($sql4)){
                                    echo '<b>Option : '.$row3['nom_op'].'</b><br>';
                                }
                                if($row1=mysqli_fetch_array($sql2)){
                                    echo '<b>Module : '.$row1['nom_mod'].'</b><br>';
                                }
                                if($row2=mysqli_fetch_array($sql3)){
                                    echo '<b>Element : '.$row2['nom_el'].'</b><br>';
                                }
                                echo '<b>Niveau : S-'.$id_niv.'</b>';
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['output'])) {
                                echo $_SESSION['output'];
                                unset($_SESSION['output']);
                            }
                            ?>
                            <?php mysqli_set_charset($connect, "utf8");
                                while ($row = mysqli_fetch_array($sql)) {
                                    $id_et = $row['id_et'];
                                    $_SESSION['id_et'] = $id_et;
                                    echo '<tr><td class="stud_id">' . $row['id_et'] . '</td>';
                                    echo '<td>' . $row['nom'] . '</td>';
                                    echo '<td>' . $row['prenom'] . '</td>';
                                    echo "<td class='noExport'> <a href='#' class='btn btn-success insert_btn' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='@mdo'>Note <i class='fas fa-plus-circle'></i></a> 
                                      </td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--pop up for  send degree -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier note element</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="insert_form">
                    <input type="hidden" name="insert_id" id="insert_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="recipient-name" class="col-form-label">Controle continue:</label>
                            <input type="text" required name="cc" id="cc" class="form-control" id="recipient-name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="recipient-name" class="col-form-label">Coefficient :</label>
                            <input type="text" required name="coef1" id="coef1" class="form-control" id="recipient-name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="recipient-name" class="col-form-label">Controle final:</label>
                            <input type="text" required name="cf" id="cf" class="form-control" id="recipient-name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="recipient-name" class="col-form-label">Coefficient :</label>
                            <input type="text" required name="coef2" id="coef2" class="form-control" id="recipient-name">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Session :</label>
                        <select required name="sess" class="form-select" id="sess">
                            <option value="" selected disabled>-- select session --</option>
                            <option value="n">Normal</option>
                            <option value="r">Rattrapage</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="insert_data" id="insert" class="btn btn-primary">Ajouter</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script>
    $(document).ready(function() {
        $('.insert_btn').on('click', function() {
            var insert_id = $(this).closest('tr').find('.stud_id').text();
            // $('#insert_id').val(insert_id);
          $('form').submit(function(event) {
            event.preventDefault();
            var cc=document.getElementById("cc").value;
            var cf=document.getElementById("cf").value;
            var coef1=document.getElementById("coef1").value;
            var coef2=document.getElementById("coef2").value;
            var sess=document.getElementById("sess").value;
            $.post('insert_dt.php', {
                insert_id: insert_id,
                cc: cc,
                cf: cf,
                coef1: coef1,
                coef2: coef2,
                sess: sess
            }, function(data) {
                $('#exampleModal').modal('hide');
                $('#insert_form')[0].reset();
                location.reload();
            }); 

        });
    });
});
</script>
<!--pop up for  send degree -->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>