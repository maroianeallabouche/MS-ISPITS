<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">RIB de profs</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter RIB</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="card">
        <div class="card-header">
            <h3>Ajouter RIB</h3>
        </div>
        <div class="card-body">
            <?php
            mysqli_set_charset($connect, "utf8");
            $sql = "SELECT * FROM profs";
            $result = mysqli_query($connect, $sql);
            $i = 1;
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>N°</th>
                    <th>nom prenom</th>
                    <th>RIB</th>
                </tr>
                <tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id_p'];
                        $nom = $row['nom'];
                        $prenom = $row['prenom'];
                        echo "<tr>";
                        echo "<td class='stud_id'>" . $id . "</td>";
                        echo "<td>" . $nom . "   " . $prenom . "</td>";
                        echo "<td><a href='#' class='btn btn-success insert_btn' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='@mdo'>ajouter</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </table>
        </div>
    </div>

    <!--pop up for  send degree -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter RIB</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_form" action="insert_dt.php">
                        <input type="hidden" name="insert_id" id="insert_id">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="recipient-name" class="col-form-label">RIB:</label>
                                <input type="text" required name="rib" id="rib" class="form-control" id="recipient-name">
                            </div>
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
    <div id="res">

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script>
        $(document).ready(function() {
            $('.insert_btn').on('click', function() {
                var id = $(this).closest('tr').find('.stud_id').text();
                var rib = document.getElementById('rib').value;
                // console.log(id);
                $('#insert_id').val(id);
                $.ajax({
                    type: 'post',
                    url: 'insert_dt.php',
                    data: {
                        rib: rib,
                        id: id
                    },
                    success: function(response) {
                        $('#res').html("Your data will be saved...");
                    }
                });
                return false;
            });
        });
    </script>
    <!--pop up for  send degree -->
    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>