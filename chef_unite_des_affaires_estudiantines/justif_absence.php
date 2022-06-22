<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';

?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Voir l'absence de cette étudiant  </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">étudiant</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>l'absence</h2>
                </div>
                <div class="card-body">
                    <?php
                mysqli_set_charset($connect, "utf8");
                if(isset($_GET['id'])){
                $id_et=$_GET['id'];
                $_SESSION['id_et']=$id_et;
                $sql="SELECT etudiant.id_et,etudiant.nom,etudiant.prenom,etudiant.id_niv,etudiant.num_inscpt,module.nom_mod,options.nom_op,
                absence.date_abs
                from absence ,etudiant ,options ,module
                where absence.id_et=etudiant.id_et and etudiant.id_op=options.id_op 
                and absence.id_mod=module.id_mod and absence.id_et=$id_et";
                $result=mysqli_query($connect,$sql);
                    ?>
                     <table class="table table-bordered border-dark">
                         <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Numero d'inscreption</th>
                                <th>Niveau</th>
                                <th>Module</th>
                                <th>Options</th>
                                <th>Date absent</th>
                         </tr>
                            <?php while($row=mysqli_fetch_assoc($result)){ ?>
                            <tr>
                                <td><?php echo $row['nom']; ?></td>
                                <td><?php echo $row['prenom']; ?></td>
                                <td><?php echo $row['num_inscpt']; ?></td>
                                <td><?php echo 'S-'.$row['id_niv']; ?></td>
                                <td><?php echo $row['nom_mod']; ?></td>
                                <td><?php echo $row['nom_op']; ?></td>
                                <td><?php echo $row['date_abs']; ?></td>
                            </tr>
                            <?php }                 }   ?>
                     </table>
                     <form action="ajouter_table_justif.php" method="post">
                     <div class="row mt-5">
                         <div class="col-md-3">
                             <label for="">N° inscreption :</label> <br>
                             <input type="text" class="form-control" required name="num_insc" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">Nom / Prenom :</label> <br>
                             <input type="text" class="form-control" required name="full_name" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">Option :</label> <br>
                             <input type="text" class="form-control" required name="ops" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">Niveau :</label> <br>
                             <input type="text" class="form-control" required name="niv" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">Justification :</label> <br>
                             <select name="justif" id="" required class="form-select">
                               <option value="justifie">justifié</option>
                                 <option value="non justifie">non justifié</option>
                             </select>
                         </div>
                         <div class="col-md-3">
                             <label for="">PIECE JUSTIFICATIVE :</label> <br>
                             <input type="text" class="form-control" required name="piece_j" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">AUTEUR DE LA PIECE :</label> <br>
                             <input type="text" class="form-control" required name="auth_p" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">N° PIECE :</label> <br>
                             <input type="text" class="form-control" required name="num_p" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">DELIVE LE :</label> <br>
                             <input type="date" class="form-control" required name="delv" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">DUREE D'ABSENCE :</label> <br>
                             <input type="text" class="form-control" required name="duree_abs" id="">
                         </div>
                         <div class="col-md-3">
                             <label for="">DEPOSE LE :</label> <br>
                             <input type="date" class="form-control" required name="depose" id="">
                         </div>
                         <div class="col-md-6 mt-2">
                             <input type="submit" class="btn btn-success" name="ajouter" value="Ajouter" id="">
                         </div>
                     </div>
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