<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">frais de deplacement </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div id="result">

    </div>
    <?php include 'message.php';  
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    ?>
    <div class="row">
        <form action="" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo $id;  ?>">
            <div class="row">
                <div class="col-md-6">
                    <label for="">date de départ : </label>
                    <input type="date" name="date_d" id="date_d" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="">date de retour: </label>
                    <input type="date" name="date_r" id="date_r" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="">Lieu de déplacement départ :</label>
                    <input type="text" name="lieu_d" id="lieu_d" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="">Lieu de déplacement retour :</label>
                    <input type="text" name="lieu_r" id="lieu_r" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="">Heure départ :</label>
                    <input type="text" name="h_d" id="h_r" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="">Heure retour :</label>
                    <input type="text" name="h_r" id="h_d" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="">Nembre de taux :</label>
                    <input type="number" name="nbr_t" id="nbr_t" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="">Taux de base :</label>
                    <input type="number" name="taux_b" id="taux_b" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <input type="submit" name="calcule" id="calcule" value="Ajouter" class="btn btn-success" required>
            </div>
        </form>
        <?php      
    }
        ?>
        <!-- <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
        <script type="text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('form').submit(function(event) {
                    event.preventDefault();
                    var id = document.getElementById('id').value;
                    var date_d = document.getElementById('date_d').value;
                    var date_r = document.getElementById('date_r').value;
                    var lieu_d = document.getElementById('lieu_d').value;
                    var lieu_r = document.getElementById('lieu_r').value;
                    var h_d = document.getElementById('h_d').value;
                    var h_r = document.getElementById('h_r').value;
                    var nbr_t = document.getElementById('nbr_t').value;
                    var taux_b = document.getElementById('taux_b').value;
                    $.post('ajouter_frais_admin_code.php', {
                            id: id,
                            date_d: date_d,
                            date_r: date_r,
                            lieu_d: lieu_d,
                            lieu_r: lieu_r,
                            h_d: h_d,
                            h_r: h_r,
                            nbr_t: nbr_t,
                            taux_b: taux_b
                        },
                        function(data) {
                            $('#result').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Ajouter avec succée <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        });
                })
            });
        </script>


    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>