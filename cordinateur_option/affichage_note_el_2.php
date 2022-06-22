<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Affichage Notes elements des étudiants </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <div id="result">

    </div>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Note element</h2>
                </div>
                <div class="card-body" id="user_table">
                    <?php mysqli_set_charset($connect, "utf8");
                    if (isset($_POST['recherche_el'])) {
                        $id_op = $_SESSION['options'];
                        $id_niv = $_POST['niveau'];
                        $id_mod = $_POST['module'];
                        $id_el = $_POST['element'];
                        $sess = $_POST['sess'];
                        $_SESSION['element']=$id_el;
                        $_SESSION['module']=$id_mod;
                        $_SESSION['option']=$id_op;
                        $_SESSION['niveau']=$id_niv;
                        $_SESSION['sess']=$sess;
                        $i = 1;
                        mysqli_set_charset($connect, "utf8");
                        $query = "SELECT e.nom, e.prenom, e.id_et, n.cc, n.cf, n.mg,op.nom_op,m.nom_mod,el.nom_el,n.sess,n.id_note_el,e.id_niv from etudiant e , note_el n ,niveau ni ,element el , options op , module m 
                                where e.id_et=n.id_et and n.id_op=op.id_op and n.id_mod=m.id_mod and n.id_el=el.id_el and n.id_niv=ni.id_niv and  el.id_el=$id_el 
                                and op.id_op=$id_op and n.id_niv=$id_niv and e.id_niv=$id_niv  and m.id_mod=$id_mod and n.sess='$sess'
                                order by e.nom , e.prenom ";
                        $sql = mysqli_query($connect, $query);
                        $sql2 = mysqli_query($connect, $query);
                        $newEndingDate =date('Y')+1;
                       if($rows= mysqli_fetch_array($sql2)){
                        echo   '<b>Option :  '. $rows['nom_op']. '</b><br>';
                        echo   '<b>Module :  '. $rows['nom_mod']. '</b><br>';
                        echo   '<b>Element :  '. $rows['nom_el']. '</b><br>';
                        echo   '<b>Niveau :  S-'. $id_niv. '</b><br>';
                        if($rows['sess']=='n'){
                            echo   '<b>Session :  Normal'. '</b></br>';
                        }else{
                            echo   '<b>Session :  Ratrapage'. '</b><br>';
                        }
                        echo  '<b>Année universitaire :  '. (date("Y")-1) .'/'.date("Y"). '</b><br>';
                    }
                    ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>CC</th>
                                    <th>CF</th>
                                    <th>NM</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            while ($row = mysqli_fetch_array($sql)) {
                                $id_note_el=$row['id_note_el'];
                                echo '<tr><td class="stud_id">' . $row['id_et'] . '</td>';
                                echo '<td>' . $row['nom'] . '</td>';
                                echo '<td>' . $row['prenom'] . '</td>';
                                echo '<td>' . number_format($row['cc'], 2, '.', '')  . '</td>';
                                echo '<td>' . number_format($row['cf'], 2, '.', '')   . '</td>';
                                echo '<td>' . number_format($row['mg'], 2, '.', '')   . '</td>';
                                echo "<td class='noExport'> <a href='#' class='btn btn-success insert_btn' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='@mdo'> <i class='fas fa-edit'></i></a> 
                                      </td>";
                                   echo "<td class='noExport'> <a href='#' id=$id_note_el class='btn btn-danger delete_btn'> <i class='fas fa-trash-alt'></i></a>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter note element</h5>
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
                <button type="submit" name="insert_data" id="insert" class="btn btn-primary">Modifier</button>
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
            $.post('edit_dt.php', {
                insert_id: insert_id,
                cc: cc,
                cf: cf,
                coef1: coef1,
                coef2: coef2,
                sess: sess
            }, function(data) {
                $('#result').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Modifier avec succée <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                $('#exampleModal').modal('hide');
                $('#insert_form')[0].reset();
                location.reload();    
            }); 

        });
    });
});
$(document).ready(function() {
        $('.delete_btn').click(function() {
            var id = $(this).attr("id");
                $.post('delete_note_el.php', {
                   id: id
                }, function(data) {
                    $('#result').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Supprimer avec succée <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    location.reload();
                }); 
        });
    });

</script>
<!--pop up for  send degree -->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>