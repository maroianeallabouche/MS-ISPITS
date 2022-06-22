<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
<h1 class="mt-4">Afficher tout les profs </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">profs</li>
    </ol>
    <?php  include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>profs enregistrés</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>N°</th>
                                <th>nom</th>
                                <th>prenom</th>
                                <th>cin</th>
                                <th>sexe</th>
                                <th>type prof</th>
                                <th>fonction</th>
                                <th>ppr</th>
                                <th>echelle</th>
                                <th>Grade</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT *,filiere.nom_fil,options.nom_op FROM profs , filiere , options WHERE profs.id_f =filiere.id_f AND profs.id_op = options.id_op ORDER BY id_p ";
                            mysqli_set_charset($connect,"utf8mb4");
                            $result = mysqli_query($connect, $query);
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id_p'];
                                $nom = $row['nom'];
                                $prenom = $row['prenom'];
                                $cin = $row['cin'];
                                $ppr = $row['ppr'];
                                $type_prof = $row['type_prof'];
                                $fonction = $row['role_as'];
                                $echelle = $row['echelle'];
                                $echelon = $row['echelon'];
                                $email = $row['email'];
                                $nom_fil = $row['nom_fil'];
                                $nom_op= $row['nom_op'];
                                $sexe = $row['sexe'];
                                $test="";
                                $ts="";
                                if($sexe=="M"){
                                    $ts="coordinateur";
                                   }else{
                                       $ts="coordinatrice";
                                   }
                                if($fonction == "2"){
                                    $test= "chef de filiére ".$nom_fil;
                                }else if($fonction == "1"){
                                    $test= $ts." de l'option ".$nom_op;
                                }else if($fonction == "3"){
                                    $test= "professeure de ".$nom_op;
                                }
                                echo '<tr>
                                <td>' . $i++ . '</td>
                                <td>' . $nom . '</td>
                                <td>' . $prenom . '</td>
                                <td>' . $cin . '</td>
                                <td>' . $sexe . '</td>
                                <td>' . $type_prof . '</td>
                               
                                <td>'.
                               $test
                                 .'</td>';
                                 ?>
                                </td>
                             <?php   echo
                                '<td>' . $ppr . '</td>
                                <td>' . $echelle . '</td>
                                <td>' . $echelon . '</td>
                                <td>' . $email . '</td>'
                             ?>

                             <td>
                             <?php
                               echo '
                                    <a href="edit_prof.php?id=' . $id . '" class="btn btn-primary btn-sm">Modifier</a> 
                                    <a href="delete_prof.php?id=' . $id . '" class="btn btn-danger btn-sm">Supprimer</a>
                                '
                            ;
                            ?>
                             </td>
                            </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>      

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>         
