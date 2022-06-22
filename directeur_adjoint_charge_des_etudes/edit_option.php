<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Option</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">edit option</li>
    </ol>
    <?php  include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>modifier les info d'option</h2>
                </div>
                <div class="card-body">
                    <?php
                       mysqli_set_charset($connect, "utf8mb4");
                     if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $_SESSION['op_id'] = $id;
                        $sql = "SELECT * FROM options WHERE id_op = $id";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if(mysqli_num_rows($result) > 0){
                            // foreach($result as $row){
                            //     $id = $row['id'];
                            // }
                    ?>
                 <form action="edit_option_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="hidden" value="<?php  echo $row['id_op'] ; ?>" name="">
                <label for="first">Nom option :</label>
                <input required type="text" name="option" class="form-control" id="first" value="<?php echo $row['nom_op'] ; ?>" placeholder="Enter first name">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Code option :</label>
                <input required type="text" name="code_op" class="form-control" id="first" value="<?php echo $row['code_op'] ; ?>" placeholder="ajouter code option">
            </div>
            <div class="col-md-6 mb-3">
                <label for="filiere">Filiere :</label> <br>
                <select class="form-select" name="filiere" class="filiere" id="filiere" required>
                    <option value="" selected disabled>--Select filiere--</option>
                    <?php
                   
                    $sql = "SELECT * FROM filiere";
                    $result = mysqli_query($connect, $sql);
                    while ($rows = mysqli_fetch_assoc($result)) {
                        mysqli_set_charset($connect, "utf8mb4");
                        echo '<option value="' . $rows['id_f'] . '">' .$rows['nom_fil']  . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="Modifier" value="Modifier" class="btn btn-success" id="submit" >
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
