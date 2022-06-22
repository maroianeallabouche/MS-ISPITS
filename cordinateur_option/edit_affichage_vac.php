<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit la date et nembre d'heure </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Vacataire</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <?php
             if(isset($_GET['id'])){
                 $id=$_GET['id'];
                 $sql="SELECT * FROM vacataire WHERE id=$id";
                $result=mysqli_query($connect,$sql);
                $row=mysqli_fetch_assoc($result);
             ?>
           <form action="edit_vac.php" method="post">
           <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ; ?>" required>
               <div class="row mb-2">
               <div class="col-md-6 mb-3">
                <label for="Option">Option :</label> <br>
                <select name="option" class="form-select" class="option" id="option" required>
                    <option value="" selected disabled>--Select option--</option>
                    <?php
                    mysqli_set_charset($connect, "utf8");
                    $sql = "SELECT * FROM options ;";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_op'] . '">' . $row['nom_op'] . '</option>';
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
                        $('#option').on('change', function() {
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
               <div class="col-md-6">
                   <label for="">Date :</label> <br>
                     <input type="date" name="date" class="form-control" value="<?php echo $row['date_vac'] ; ?>" required>
               </div>
               <div class="col-md-6">
                   <label for="">Nembre heure :</label> <br>
                     <input type="number" name="nbr_h" class="form-control"  value="<?php echo $row['nbr_h'] ; ?>" required>
               </div>
               </div>
               <div class="col-md-6">
                     <input type="submit" name="modifier" class="btn btn-primary" value="Modifier" required>
               </div>
               <?php
                }
               ?>
           </form>
        </div>
        
    </div>
</div>


<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>