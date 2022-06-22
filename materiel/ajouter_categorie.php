<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Categories</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter categorie</li>
    </ol>
    <?php  include 'message.php';   ?>
    <form action="ajouter_categorie_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first">Nom categorie :</label>
                <input required type="text" name="nom" class="form-control" id="first" placeholder="nom categorie">
            </div>
          
        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="register_btn" value="Enregistrer" class="btn btn-primary" id="submit" >
            </div>
    </form>
     <div class="row">
         <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom categorie</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           mysqli_set_charset($connect, "utf8");
                        $sql = "SELECT * FROM categorie_materiel";
                        $result = mysqli_query($connect, $sql);
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<tr>';
                            echo '<td>'.$row['nom_cat'].'</td>';
                            echo '<td>
                                <a href="modifier_categorie.php?id='.$row['id_cat'].'" class="btn btn-success">Modifier</a>
                                <a href="supprimer_categorie.php?id='.$row['id_cat'].'" class="btn btn-danger">Supprimer</a>
                                </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
         </div>
     </div>



    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>