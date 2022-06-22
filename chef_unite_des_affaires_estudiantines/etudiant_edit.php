<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Modifier étudiant</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">étudiant</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>modifier les info d'étudiant</h2>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $_SESSION['user_id'] = $id;
                        $id_fil=$_SESSION['id_fil'];
                        $id_niv=$_SESSION['id_niv'];
                        $id_op=$_SESSION['id_op'];
                        mysqli_set_charset($connect, "utf8");
                        $sql = "SELECT * FROM etudiant WHERE id_et = $id";
                        ///////////
                        $sql2="SELECT * from filiere where id_f = $id_fil";
                        $res_fil=mysqli_query($connect,$sql2);
                        $row_fil=mysqli_fetch_assoc($res_fil); 
                        ///////////
                        $sql3="SELECT * from niveau where id_niv = $id_niv";
                        $res_niv=mysqli_query($connect,$sql3);
                        $row_niv=mysqli_fetch_assoc($res_niv);
                        ///////////
                        $sql4="SELECT * from options where id_op = $id_op";
                        $res_op=mysqli_query($connect,$sql4);
                        $row_op=mysqli_fetch_assoc($res_op);
                        ///////////
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if (mysqli_num_rows($result) > 0) {
                            // foreach($result as $row){
                            //     $id = $row['id'];
                            // }
                    ?>
                            <form action="etudiant_edit_code.php" method="post">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first">Nom :</label>
                                        <input required type="text" name="nom" class="form-control" value="<?php echo $row['nom']  ?>" id="first" placeholder="nom : juste les caractères entre a-z">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Prenom :</label>
                                        <input required type="text" name="prenom" class="form-control" value="<?php echo $row['prenom']  ?>" id="last" placeholder="prenom : juste les caractères entre a-z">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">: الاسم الشخصي </label>
                                        <input required type="text" name="prenom_ar" class="form-control" value="<?php echo $row['nom_ar']  ?>" id="last" placeholder="الاسم الشخصي">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">: الاسم العائلي</label>
                                        <input required type="text" name="nom_ar" class="form-control" value="<?php echo $row['prenom_ar']  ?>" id="last" placeholder="الاسم العائلي">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Sexe :</label>
                                        <select class="form-select" name="sexe" required id="">
                                            <option value="<?php echo $row['sexe']; ?>"><?php echo $row['sexe']; ?></option>
                                            <option value="f">F</option>
                                            <option value="m">M</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="first"> N° inscription :</label>
                                        <input required type="text" name="num_insc" class="form-control" value="<?php echo $row['num_inscpt']  ?>" id="first" placeholder="numero d'inscreption">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">CIN :</label>
                                        <input required type="text" name="cin" class="form-control" value="<?php echo $row['cin']  ?>" id="last" placeholder="cin">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">CNE :</label>
                                        <input required type="text" name="cne" class="form-control" value="<?php echo $row['cne']  ?>" id="last" placeholder="CNE">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Date de naissance :</label>
                                        <input required type="date" name="date_naiss" class="form-control" value="<?php echo $row['date_naiss']  ?>" id="last" placeholder="Date naissence">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Lieu de naissance :</label>
                                        <input required type="text" name="lieu_naiss" class="form-control" value="<?php echo $row['lieu_naiss']  ?>" id="last" placeholder="lieu naissance">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Telephone :</label>
                                        <input required type="text" name="tel" class="form-control" value="<?php echo $row['tel']  ?>" id="last" placeholder="telephone">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Année du bac :</label>
                                        <!-- <input required type="date" name="ann_bac" class="form-control" id="last" placeholder="Année du bac"> -->
                                        <?php
                                        echo '<select name="ann_bac" required class="form-select">';
                                        echo '<option value="' .$row['annee_bac']  . '">' . $row['annee_bac']  . '</option>';
                                        for ($year = date('Y'); $year >= 2000; $year--) {
                                            echo '<option value="' . $year . '">' . $year . '</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">mention du bac :</label>
                                        <input required type="text" name="men_bac" class="form-control" value="<?php echo $row['mention_bac']  ?>" id="last" placeholder="mention du bac">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">serie du bac :</label>
                                        <input required type="text" name="serie_bac" class="form-control" value="<?php echo $row['serie_bac']  ?>" id="last" placeholder="serie du bac">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Lieu d'obtention du bac :</label>
                                        <input required type="text" name="lieu_o_bac" class="form-control" value="<?php echo $row['lieu_obtn']  ?>" id="last" placeholder="Lieu d'obtention du bac">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Boursier :</label>
                                        <input required type="text" name="bourse" class="form-control" value="<?php echo $row['boursier']  ?>" id="last" placeholder="non / oui">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Nom pére :</label>
                                        <input required type="text" name="n_p" class="form-control" id="last" value="<?php echo $row['nom_pere']  ?>" placeholder="Nom pére">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Nom mére :</label>
                                        <input required type="text" name="n_m" class="form-control" id="last" value="<?php echo $row['nom_mere']  ?>" placeholder="Nom mére">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Profession du pére :</label>
                                        <input required type="text" name="pro_p" class="form-control" id="last" value="<?php echo $row['profession_pere']  ?>" placeholder="Profession du pére">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Profession du mére :</label>
                                        <input required type="text" name="pro_m" class="form-control" id="last" value="<?php echo $row['profession_mere']  ?>" placeholder="Profession du mére">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Adress :</label>
                                        <input required type="text" name="adress" class="form-control" id="last" value="<?php echo $row['adress']  ?>" placeholder="Adress">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Telephone du parents :</label>
                                        <input required type="text" name="tel_p" class="form-control" id="last" value="<?php echo $row['tel_p']  ?>" placeholder="Telephone du parents">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last">Année scolaire :</label>
                                        <select name="ann_sc" required class="form-select" id="">
                                            <?php 
                                            $an_sc_et_sql="SELECT id_ann_sc FROM  etudiant where id_et=$id";
                                            $an_sc_et_query=mysqli_query($connect,$an_sc_et_sql);
                                            $row_an_sc_et=mysqli_fetch_array($an_sc_et_query);
                                            $an_sc_et=$row_an_sc_et['id_ann_sc'];
                                            $an_sc_sql="SELECT * FROM  annee_scolaire where id_ann_sc=$an_sc_et";
                                            $an_sc_query=mysqli_query($connect,$an_sc_sql);
                                            $row_an_sc=mysqli_fetch_array($an_sc_query);
                                            ?>
                                            <option value="<?php echo $row_an_sc['id_ann_sc']  ?>"><?php echo $row_an_sc['ann_sc']  ?></option>
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
                                        <label for="first">Promotion :</label>
                                        <input type="text" name="startyear" class="form-control" required value="<?php echo $row['promotion'] ?> ">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="filiere">Filiere :</label> <br>
                                        <select name="filiere" class="filiere" id="filiere" required>
                                            <option value="<?php echo $row_fil['id_f'];  ?>"><?php echo $row_fil['nom_fil'];  ?></option>
                                            <?php
                                            mysqli_set_charset($connect, "utf8");
                                            $sql = "SELECT * FROM filiere";
                                            $result = mysqli_query($connect, $sql);
                                            while ($rows = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $rows['id_f'] . '">' . $rows['nom_fil'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="options">Option :</label> <br>
                                        <select name="option" class="option" required>
                                        <option value="<?php echo $row_op['id_op'];   ?>"><?php echo $row_op['nom_op'];  ?></option>
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
                                            <option value="<?php echo $row_niv['id_niv'];  ?>"><?php echo 'S-'.$row_niv['id_niv'];  ?></option>
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
                                        <input required type="email" name="email" class="form-control" value="<?php echo $row['email']  ?>" id="email" placeholder="cin@gmail.com">
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