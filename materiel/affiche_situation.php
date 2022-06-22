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
<div class="container-fluid px-4">
    <h1 class="mt-4">Inventaire</h1>
    <ol class="breadcrumb ">
        <li class="breadcrumb-item active">matériel</li>
    </ol>
    <?php include 'message.php';   ?>
            <div class="row m-3">
                <div class="col-md-6">
                    <?php
                    $sql = "SELECT * FROM unite";
                    $result = mysqli_query($connect, $sql);
                    ?>
                    <label for="">Unité :</label>
                    <select name="unité" class="form-select" id="unite">
                        <option value="" selected disabled>--select unité--</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $_SESSION['nom_u'] = $row['nom_u'];
                            echo '<option value="' . $row['id_u'] . '">' . $row['nom_u'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                <label for="">Salle :</label>
                <select name="salle" class="form-select" id="salle">
                    <option value="">Choisir la unite</option>
                </select>
            </div>

                <div class="row mt-5">
                <div class="m-3" id="invoice">  
                <div class="col-md-12" style="background-image: url(newimg.jpg);background-position: center;
                background-repeat: no-repeat;
                height:200px">
                </div>
                    <div class="col-md-10 m-auto text-center">
                       <h5><b> Situation de <p style="display: inline;" id="unt"></p>  au <?php echo date('Y/m/d') ?> </b></h5>
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
                            $('#unite').on('change', function() {
                                var countryID = $(this).val();
                                if (countryID) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajaxsalle.php',
                                        data: 'id=' + countryID,
                                        success: function(html) {
                                            $('#salle').html(html);
                                        }
                                    });
                                }
                            });
                        });
                        $(document).ready(function() {
                            $('#unite').on('change', function() {
                                var countryID = $(this).val();
                                if (countryID) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajax_nom_u.php',
                                        data: 'id=' + countryID,
                                        success: function(html) {
                                            $('#unt').html(html);
                                        }
                                    });
                                }
                            });
                        });
                        $(document).ready(function() {
                            $('#salle').on('change', function() {
                                var countryID = $(this).val();
                                if (countryID) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajax_sit.php',
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



<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>