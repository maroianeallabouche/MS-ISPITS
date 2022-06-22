<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Les articles</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">articles</li>
    </ol>
    <?php include 'message.php';   ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="pdf3.js"></script>
                <div class="col-md-6 m-md-2">
                    <button class="btn btn-warning" onclick="generatePDF2()">Export PDF</button>
                </div>
    <div class="card text-dark mb-3">
        <div class="card-header">
            <h4>Afficher articles</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?php
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
                    <div class="m-2" id="exportContent">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Article</th>
                                <th>Designation</th>
                                <th>Qantité</th>
                                <th>N° inventaire</th>
                                <th>Unité</th>
                                <th>Date</th>
                                <th>Emplacement</th>
                                <th>Observation</th>
                            </tr>
                        </thead>
                        <tbody id="article">

                        </tbody>
                    </table>
                    </div>
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#categorie').on('change', function() {
                                var countryID = $(this).val();
                                if (countryID) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajax_mt.php',
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
        </div>
    </div>

</div>



<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>