<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Element</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">edit element</li>
    </ol>
    <?php  include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>modifier les info d'element</h2>
                </div>
                <div class="card-body">
                    <?php
                       mysqli_set_charset($connect, "utf8mb4");
                     if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $_SESSION['el_id'] = $id;
                        $sql = "SELECT * FROM element WHERE id_el = $id";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if(mysqli_num_rows($result) > 0){
                            // foreach($result as $row){
                            //     $id = $row['id'];
                            // }
                    ?>
                   <form action="edit_element_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="option">Option :</label> <br>
                <select name="option" class="option" id="filiere" required>
                    <option value="" selected disabled>--Select option--</option>
                    <?php
                    mysqli_set_charset($connect, "utf8");
                    $sql = "SELECT * FROM options";
                    $result = mysqli_query($connect, $sql);
                    while ($rows = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $rows['id_op'] . '">' . $rows['nom_op'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="module">Module :</label> <br>
                <select name="module" class="module" required>
                    <option selected disabled>--Select module--</option>>
                </select>
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                </script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".option").change(function() {
                            var country_id = $(this).val();
                            var post_id = 'id=' + country_id;

                            $.ajax({
                                type: "POST",
                                url: "ajax2.php",
                                data: post_id,
                                cache: false,
                                success: function(cities) {
                                    $(".module").html(cities);
                                }
                            });

                        });
                    });
                </script>
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Nom element :</label>
                <input required type="text" name="nom_el" class="form-control" value="<?php echo $row['nom_el']   ?>" id="first" placeholder="ajouter nom element">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Volume horaire :</label>
                <input required type="text" name="mass_h" class="form-control" value="<?php echo $row['mass_h']   ?>" id="first" placeholder="ajouter Volume horaire">
            </div>

        </div>
            <div class="col-md-6 mb-3">
                <input required type="submit" name="edit_element" value="Modifier" class="btn btn-success" id="submit">
            </div>
    </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>      

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>         
