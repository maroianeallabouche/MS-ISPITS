<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edite employé</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">employé</li>
    </ol>
    <?php  include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>modifier les info d'employé</h2>
                </div>
                <div class="card-body">
                    <?php
                     if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $_SESSION['user_id'] = $id;
                        mysqli_set_charset($connect, "utf8");
                        $sql = "SELECT * FROM administration WHERE id = $id";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if(mysqli_num_rows($result) > 0){
                            // foreach($result as $row){
                            //     $id = $row['id'];
                            // }
                    ?>
                 <form action="epm_edit_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="hidden" value="<?php  echo $row['id'] ; ?>" name="">
                <label for="first">Nom :</label>
                <input required type="text" name="nom" class="form-control" id="first" value="<?php echo $row['nom'] ; ?>" placeholder="nom : juste les caractères entre a-z">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Prenom :</label>
                <input required type="text" name="prenom" class="form-control" id="last" value="<?php echo $row['prenom'] ; ?>" placeholder="prenom : juste les caractères entre a-z">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Sexe :</label>
                <select name="sexe" id="" class="form-select" required>
                    <option value="<?php echo $row['sex'] ; ?>"><?php echo $row['sex'] ; ?></option>
                    <option value="f">F</option>
                    <option value="m">M</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">CIN</label>
                <input required type="text" name="cin" class="form-control" id="last" value="<?php echo $row['cin'] ; ?>" placeholder="cin">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">PPR</label>
                <input required type="text" name="num_matricule" class="form-control" id="last" value="<?php echo $row['num_matricule'] ; ?>" placeholder="ppr">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Echelle</label>
                <input required type="text" name="echelle" class="form-control" id="last" value="<?php echo $row['echelle'] ; ?>" placeholder="num_matricule">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Grade</label>
                <input required type="text" name="grade" class="form-control" id="last" value="<?php echo $row['grade'] ; ?>" placeholder="grade">
            </div>
            <div class="col-md-6 mb-3">
            <label for="role_as">Fonction</label>
                <select class="form-select" name="role_as" required id="roles_as">
                    <option value="" >--Select--</option>
                    <option value="1">directeur ISPITS</option>
                    <option value="2">directeur adjoint charge des etudes</option>
                    <option value="3">chef unité des affaires estudiantines</option>
                    <option value="4">Chef de l'unité pedagogique</option> 
                    <option value="5">Vacation</option> 
                    <option value="6">Comptable</option> 
                    <option value="7">chef matériel </option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input required type="email" name="email" class="form-control" id="email" value="<?php echo $row['email'] ; ?>" placeholder="cin@gmail.com">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Password">Mot de pass</label>
                <input required type="password" name="password" class="form-control" id="Password" placeholder="Mot de pass">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Password">confirm Mot de pass</label>
                <input required type="password" name="cpassword" class="form-control" id="Password" placeholder="Confirmer le Mot de pass">
            </div>
          
        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="Modifier" value="Modifier" class="btn btn-primary" id="submit" >
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
