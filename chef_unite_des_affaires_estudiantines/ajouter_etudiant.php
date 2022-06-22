<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Etudiant</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter étudiant</li>
    </ol>
    <?php include 'message.php';   ?>
    <form action="ajouter_etudiant_code.php" method="post">
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
                <label for="last">: الاسم الشخصي </label>
                <input required type="text" name="prenom_ar" class="form-control" id="last" placeholder="الاسم الشخصي">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">: الاسم العائلي</label>
                <input required type="text" name="nom_ar" class="form-control" id="last" placeholder="الاسم العائلي">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Sexe :</label>
                <select class="form-select" name="sexe" required id="">
                    <option value="" selected disabled>--select sexe--</option>
                    <option value="f">F</option>
                    <option value="m">M</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="first"> N° inscription :</label>
                <input required type="text" name="num_insc" class="form-control" id="first" placeholder="N° inscription">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">CIN :</label>
                <input required type="text" name="cin" class="form-control" id="last" placeholder="cin">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">CNE :</label>
                <input required type="text" name="cne" class="form-control" id="last" placeholder="CNE">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Date de naissance :</label>
                <input required type="date" name="date_naiss" class="form-control" id="last" placeholder="Date naissence">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Lieu de naissance :</label>
                <input required type="text" name="lieu_naiss" class="form-control" id="last" placeholder="lieu naissance">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Telephone :</label>
                <input required type="text" name="tel" class="form-control" id="last" placeholder="telephone">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Année du bac :</label>
                <!-- <input required type="date" name="ann_bac" class="form-control" id="last" placeholder="Année du bac"> -->
                <?php
                echo '<select name="ann_bac" required class="form-select">';
                for ($year = date('Y'); $year >= 2000; $year--) {
                    echo '<option value="' . $year . '">' . $year . '</option>';
                }
                echo '</select>';
                ?>
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Mention du bac :</label>
                <input required type="text" name="men_bac" class="form-control" id="last" placeholder="mention du bac">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Serie du bac :</label>
                <input required type="text" name="serie_bac" class="form-control" id="last" placeholder="serie du bac">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Lieu d'obtention du bac :</label>
                <input required type="text" name="lieu_o_bac" class="form-control" id="last" placeholder="Lieu d'obtention du bac">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Boursier :</label>
                <input required type="text" name="bourse" class="form-control" id="last" placeholder="non / oui">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Nom pére :</label>
                <input required type="text" name="n_p" class="form-control" id="last" placeholder="Nom pére">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Nom mére :</label>
                <input required type="text" name="n_m" class="form-control" id="last" placeholder="Nom mére">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Profession du pére :</label>
                <input required type="text" name="pro_p" class="form-control" id="last" placeholder="Profession du pére">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Profession du mére :</label>
                <input required type="text" name="pro_m" class="form-control" id="last" placeholder="Profession du mére">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Adress :</label>
                <input required type="text" name="adress" class="form-control" id="last" placeholder="Adress">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Telephone du parents :</label>
                <input required type="text" name="tel_p" class="form-control" id="last" placeholder="Telephone du parents">
            </div>
            <div class="col-md-6 mb-3">
                <label for="last">Année scolaire :</label>
                <select name="ann_sc" required class="form-select" id="">
                    <option value="" selected disabled>--Choisir année scolaire--</option>
                    <?php
                    $sql1 = "SELECT * FROM  annee_scolaire";
                    $result1 = mysqli_query($connect, $sql1);
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        echo '<option value="' . $row1['id_ann_sc'] . '">' . $row1['ann_sc'] . '</option>';
                    }

                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Promotion debut de l'année :</label>
                <select class="form-select" name="startyear" required>
                    <?php
                    for ($year = 2010; $year <= 2099; $year++) : ?>
                        <option value="<?= $year; ?>"><?= $year; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Promotion fin de l'année :</label>
                <select class="form-select" name="endyear" required>
                    <?php
                    for ($year = 2010; $year <= 2099; $year++) : ?>
                        <option value="<?= $year; ?>"><?= $year; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="filiere">Filiere :</label> <br>
                <select name="filiere" class="filiere" id="filiere" required>
                    <option value="" selected disabled>--Select filiere--</option>
                    <?php
                    mysqli_set_charset($connect, "utf8");
                    $sql = "SELECT * FROM filiere";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_f'] . '">' . $row['nom_fil'] . '</option>';
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
                <label for="last">Niveau :</label>
                <select name="niveau" required class="form-select" id="">
                    <option value="" selected disabled>--Choisir niveau--</option>
                    <?php
                    $nvsql = "SELECT * FROM  niveau";
                    $res = mysqli_query($connect, $nvsql);
                    while ($rowab = mysqli_fetch_assoc($res)) {
                        echo '<option value="' . $rowab['id_niv'] . '"> S-' . $rowab['nom_semestre'] . '</option>';
                    }
                    ?>

                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="email">Email :</label>
                <input required type="email" name="email" class="form-control" id="email" placeholder="cin@gmail.com">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Password">Mot de pass :</label>
                <input required type="password" name="password" class="form-control" id="Password" placeholder="Mot de pass">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Password">Confirm Mot de pass :</label>
                <input required type="password" name="cpassword" class="form-control" id="Password" placeholder="Confirmer le Mot de pass">
            </div>

        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="ajouter_etude" value="Enregistrer" class="btn btn-success" id="submit">
        </div>
    </form>


</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>