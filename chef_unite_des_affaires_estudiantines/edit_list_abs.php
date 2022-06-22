<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edite list d'absence</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">étudiant</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>modifier les info </h2>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $_SESSION['abs_id'] = $id;
                        mysqli_set_charset($connect, "utf8");
                        $sql = "SELECT *  FROM   absence_justif where id_abs_j=$id";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if (mysqli_num_rows($result) > 0) {
                            // foreach($result as $row){
                            //     $id = $row['id'];
                            // }
                    ?>
                            <form action="edit_list_abs_code.php" method="post">
                                <div class="row">
                                <div class="col-md-3">
                             <label for="">N° inscreption :</label> <br>
                             <input type="text" class="form-control" value="<?php echo $row['num_inc'] ?>" required name="num_insc" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">Nom / Prenom :</label> <br>
                             <input type="text" class="form-control" value="<?php echo $row['nom'] ?>" required name="full_name" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">Option :</label> <br>
                             <input type="text" class="form-control" value="<?php echo $row['ops'] ?>" required name="ops" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">Niveau :</label> <br>
                             <input type="text" class="form-control" value="<?php echo $row['niv'] ?>" required name="niv" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">Justification :</label> <br>
                             <select name="justif" id="" required class="form-select">
                                 <option value="" selected disabled>justification</option>
                               <option value="justifie">justifié</option>
                                 <option value="non justifie">non justifié</option>
                             </select>
                         </div>
                         <div class="col-md-3">
                             <label for="">PIECE JUSTIFICATIVE :</label> <br>
                             <input type="text" class="form-control" value="<?php echo $row['pieace'] ?>" required name="piece_j" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">AUTEUR DE LA PIECE :</label> <br>
                             <input type="text" class="form-control" value="<?php echo $row['auth_p'] ?>" required name="auth_p" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">N° PIECE :</label> <br>
                             <input type="text" class="form-control" value="<?php echo $row['nup_p'] ?>" required name="num_p" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">DELIVE LE :</label> <br>
                             <input type="date" class="form-control" value="<?php echo $row['delv'] ?>" required name="delv" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">DUREE D'ABSENCE :</label> <br>
                             <input type="text" class="form-control" value="<?php echo $row['duree_abs'] ?>" required name="duree_abs" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">DEPOSE LE :</label> <br>
                             <input type="date" class="form-control" value="<?php echo $row['depose'] ?>" required name="depose" id="">
                         </div>
                                </div>
                                <div class="col-md-6 mb-3 mt-3">
                                    <input required type="submit" name="modifier" value="Modifier" class="btn btn-success" id="submit">
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