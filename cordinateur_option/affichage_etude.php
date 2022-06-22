<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">List des étudiants </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Absence</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h4>Sélectionner les étudiants absent </h4>
                </div>
                <?php mysqli_set_charset($connect, "utf8");
                if (isset($_POST['recherche'])) {
                    $id_op =  $_SESSION['option'];
                    $id_niv = $_POST['niveau'];
                    $id_mod = $_POST['module'];
                    $id_p=$_POST['prof'];
                    $_SESSION['id_mod'] = $id_mod;
                    $_SESSION['id_op'] = $id_op;
                    $_SESSION['id_niv'] = $id_niv;
                    $_SESSION['id_p'] = $id_p;
                    $i = 1;
                    mysqli_set_charset($connect, "utf8");
                    $sql = mysqli_query($connect, "SELECT id_et,nom,prenom from etudiant where id_op=$id_op and id_niv=$id_niv");
                    $sql2 = mysqli_query($connect, "SELECT options.nom_op,filiere.nom_fil,module.nom_mod from options , filiere ,module 
                    where options.id_f=filiere.id_f and options.id_op=module.id_op and options.id_op=$id_op and module.id_mod=$id_mod");
                     $newEndingDate = date('Y') + 1;
                   if($row2 = mysqli_fetch_assoc($sql2)){
                ?>
                    <div class="card-body" id="user_table">
                        <div class="row">
                          <div class="col-xl-7 col-md-8">
                          <?php
                    echo '<b>Filiere : ' . $row2['nom_fil'] . '</b><br>';
                    echo '<b>Option : ' . $row2['nom_op'] . '</b><br>';
                    echo '<b>Module : ' . $row2['nom_mod'] . '</b><br>';
                    echo "<b>Niveau d'etude : Semestre-" . $id_niv . '</b><br>';
                    echo '<b>Année universitaire : ' . (date('Y') - 1) . '/' . date("Y"). '</b><br>';}
                    ?>
                          </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Absent</th>
                                </tr>
                            </thead>
                            <tbody>
                              <form action="ajouter_abs.php" method="post" id="myform"> 
                            <?php
                            while ($row = mysqli_fetch_array($sql)) {
                                $id_et = $row['id_et'];
                                $_SESSION['id_et'] = $id_et;
                                echo '<tr><td class="stud_id">' . $row['id_et'] . '</td>';
                                echo '<td>' . $row['nom'] . '</td>';
                                echo '<td>' . $row['prenom'] . '</td>';
                                echo "<td class='noExport'>  <input class='form-check-input' type='checkbox' name='id[]' value='" . $row['id_et'] . "' >
                                  </td></tr>";
                            }
                        }
                            ?>
                            </tbody>
                        </table>
                        <input type="submit" class="btn btn-warning m-3" name="ajouter" value="ajouter">
                           </form> 
                    </div>
            </div>
        </div>
    </div>
</div>



<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>