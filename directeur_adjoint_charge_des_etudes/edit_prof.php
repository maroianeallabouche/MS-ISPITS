<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Prof</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">edit prof</li>
    </ol>
    <?php  include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>modifier les info de prof</h2>
                </div>
                <div class="card-body">
                    <?php
                       mysqli_set_charset($connect, "utf8mb4");
                     if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $_SESSION['user_id'] = $id;
                        $sql = "SELECT * FROM profs WHERE id_p = $id";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if(mysqli_num_rows($result) > 0){
                            // foreach($result as $row){
                            //     $id = $row['id'];
                            // }
                    ?>
                 <form action="edit_prof_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="hidden" value="<?php  echo $row['id_p'] ; ?>" name="">
                <label for="first">Nom :</label>
                <input required type="text" name="nom" class="form-control" id="first" value="<?php echo $row['nom'] ; ?>" placeholder="nom : juste les caractères entre a-z">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Prenom :</label>
                <input required type="text" name="prenom" class="form-control" id="last" value="<?php echo $row['prenom'] ; ?>" placeholder="prenom : juste les caractères entre a-z">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">CIN :</label>
                <input required type="text" name="cin" class="form-control" id="last" value="<?php echo $row['cin'] ; ?>" placeholder="cin">
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
                <label for="last">Echelle :</label>
                <input required type="text" name="echelle" class="form-control" id="last" value="<?php echo $row['echelle'] ; ?>" placeholder="echelle">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Grade :</label>
                <input required type="text" name="echelon" class="form-control" id="last" value="<?php echo $row['echelon'] ; ?>" placeholder="grade">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">PPR :</label>
                <input required type="text" name="ppr" class="form-control" id="last" value="<?php echo $row['ppr'] ; ?>" placeholder="PPR">
            </div>
            <div class="col-md-6 mb-3">
                <label for="role_as">fonction :</label>
                <select class="form-select" name="role_as" required id="roles_as">
                    <option value="" disabled selected>--Select fonction--</option>
                    <option value="2">chef de filiére Soins infirmiers</option>
                    <option value="2">chef de filiére des Techniques de santé</option>
                    <option value="2">chef de filiére Sage femme</option>
                    <option value="1">coordinateur/coordinatrice de l'option Infirmier polyvalent</option>
                    <option value="1">coordinateur/coordinatrice de l'option Infirmier en anesthésie réanimation</option>
                    <option value="1">coordinateur/coordinatrice de l'option Infirmier en soin d’urgence et soins intensifs</option>
                    <option value="1">coordinatrice de l'option Sage femme</option>
                    <option value="1">coordinateur/coordinatrice de l'option Radiologie</option>
                    <option value="1">coordinateur/coordinatrice de l'option Laboratoire</option>
                    <option value="3">professeure</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="filiere">Filiere :</label> <br>
                <select name="filiere" class="filiere" id="filiere" required>
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
            <div class="col-md-6 mb-3">
                <label for="options">Option :</label> <br>
                <select name="option" class="option" required>
                    <option selected disabled>--Select option--</option>>
                </select>
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                </script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".filiere").change(function() {
                            var country_id = $(this).val();
                            var post_id = 'id=' + country_id;

                            $.ajax({
                                type: "POST",
                                url: "ajax.php",
                                data: post_id,
                                cache: false,
                                success: function(cities) {
                                    $(".option").html(cities);
                                }
                            });

                        });
                    });
                </script>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">type :</label>
                <select class="form-select" name="type_prof" class="option" required>
                    <option selected disabled>--Select type de profs--</option>>
                    <option value="Enseignants vacataires">Enseignants vacataires</option>
                    <option value="Enseignants permaments">Enseignants permaments</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Email :</label>
                <input required type="email" name="email" class="form-control" id="email" value="<?php echo $row['email'] ; ?>" placeholder="cin@gmail.com">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Password">Mot de pass :</label>
                <input required type="password" name="password" class="form-control" id="Password" placeholder="Mot de pass">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Password">confirm Mot de pass :</label>
                <input required type="password" name="cpassword" class="form-control" id="Password" placeholder="Confirmer le Mot de pass">
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
