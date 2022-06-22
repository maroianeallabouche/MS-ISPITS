<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Employés</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter employés</li>
    </ol>
    <?php  include 'message.php';   ?>
    <form action="ajouter_emp_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first">Nom :</label>
                <input required type="text" name="nom" class="form-control" id="first" placeholder="nom : juste les caractères entre a-z">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Prenom :</label>
                <input required type="text" name="prenom" class="form-control" id="last" placeholder="prenom : juste les caractères entre a-z">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Sexe :</label>
                <select name="sexe" id="" class="form-select" required>
                    <option value="" selected disabled>--select sexe--</option>
                    <option value="f">F</option>
                    <option value="m">M</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">CIN :</label>
                <input required type="text" name="cin" class="form-control" id="last" placeholder="cin">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">PPR :</label>
                <input required type="text" name="num_matricule" class="form-control" id="last" placeholder="ppr">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Echelle :</label>
                <input required type="text" name="echelle" class="form-control" id="last" placeholder="echelle">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Grade :</label>
                <input required type="text" name="grade" class="form-control" id="last" placeholder="grade">
            </div>
            <div class="col-md-6 mb-3">
            <label for="role_as">Fonction :</label>
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
                <label for="email">Email :</label>
                <input required type="email" name="email" class="form-control" id="email" placeholder="cin@gmail.com">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Password">Mot de pass :</label>
                <input required type="password" name="password" class="form-control" id="Password" placeholder="le Mot de pass">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Password">confirm Mot de pass :</label>
                <input required type="password" name="cpassword" class="form-control" id="Password" placeholder="Confirmer le Mot de pass">
            </div>
          
        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="register_btn" value="Enregistrer" class="btn btn-primary" id="submit" >
            </div>
    </form>




    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>