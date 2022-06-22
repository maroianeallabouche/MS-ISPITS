<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="pdf.js"></script>
<div class="col-md-3 m-md-2">
    <button class="btn btn-primary" onclick="generatePDF()">Export PDF</button>
</div>
<div class="container-fluid px-4" >
    <h1 class="mt-4">Matériel reste au depot</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">articles</li>
    </ol>
    <?php include 'message.php';   ?>
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
           <div class="row m-3"  id="invoice">
              
                <div class="row mt-5">
                    <div class="row mb-3  text-center">
                        <div class="col-md-10 m-auto">
                       <b> <h3> <p id="nom_c" style="display:inline"></p> reste au depot : <?php  echo date('Y/m/d') ?></h3> </b>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Designation</th>
                                <th>Qantité</th>
                                <th>Observation</th>
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
                                        url: 'ajax_1.php',
                                        data: 'id=' + countryID,
                                        success: function(html) {
                                            $('#article').html(html);
                                        }
                                    });
                                }
                            });
                        });
                        $(document).ready(function() {
                            $('#categorie').on('change', function() {
                                var countryID = $(this).val();
                                if (countryID) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajax_nom_cat.php',
                                        data: 'id=' + countryID,
                                        success: function(html) {
                                            $('#nom_c').html(html);
                                        }
                                    });
                                }
                            });
                        });
                    </script>
                </div>
            </div>
</div>



<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>