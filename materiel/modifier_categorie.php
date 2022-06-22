<?php

include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edite categori</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">categorie</li>
    </ol>
    <?php  include 'message.php';   ?>
    <div class="row">
        <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = "SELECT * FROM categorie_materiel WHERE id_cat = '$id'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
        ?>
    <form action="modifier_categorie_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="hidden" name="id" value="<?php echo $row['id_cat'] ; ?>">
                <label for="first">Nom categorie :</label>
                <input required type="text" value="<?php echo $row['nom_cat']  ?>" name="nom" class="form-control" id="first" placeholder="nom categorie">
            </div>
          
        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="Modifier" value="Modifier" class="btn btn-primary" id="submit" >
            </div>
    </form>   
  <?php } ?>
    </div>
</div>      

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>         
