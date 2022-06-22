<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Articles</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter articles</li>
    </ol>
    <?php  include 'message.php';   ?>
    <?php
   if(isset($_GET['id'])){
       $id=$_GET['id'];
       mysqli_set_charset($connect, "utf8");
         $sql="SELECT * FROM materiel WHERE id_mat=$id";
            $result=mysqli_query($connect,$sql);
            $row=mysqli_fetch_array($result);
            
            /////
            $sql2="SELECT * FROM categorie_materiel WHERE id_cat in (SELECT id_cat FROM materiel WHERE id_mat=$id)";
            $result2=mysqli_query($connect,$sql2);
            $row2=mysqli_fetch_array($result2);

    ?>
    <form action="edit_article_code.php" method="post">
        <div class="row">
            <input type="hidden" name="id" value="<?php echo $row['id_mat']  ?>">
            <div class="col-md-6 mb-3">
                <label for="first">Article :</label>
                <input required type="text" value="<?php echo $row['article']  ?>" name="art" class="form-control" id="first" placeholder="article">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Designation :</label>
                <input required type="text" value="<?php echo $row['designation']  ?>" name="des" class="form-control" id="first" placeholder="designation">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">N° inventaire :</label>
                <input required type="text" name="num_inv" value="<?php echo $row['num_inventaire']  ?>" class="form-control" id="first" placeholder="N° inventaire">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Quantité :</label>
                <input required type="number" name="qte" value="<?php echo $row['quantite']  ?>" class="form-control" id="first" placeholder="quantité">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Date :</label>
                <input required type="date" name="dt" value="<?php echo $row['date_aj']  ?>" class="form-control" id="first" placeholder="la date">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Emplacement :</label>
                <input required type="text" name="emplc" value="<?php echo $row['emplacement']  ?>" class="form-control" id="first" placeholder="emplacement">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Unité :</label>
                <input required type="text" name="unite" value="<?php echo $row['unite']  ?>" class="form-control" id="first" placeholder="Unité">
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Observation :</label>
                <input required type="text" name="observ" value="<?php echo $row['observation']  ?>" class="form-control" id="first" placeholder="Observation">
            </div>
            <?php
            $sql = "SELECT * FROM categorie_materiel";
            $result = mysqli_query($connect, $sql);
            ?>
            <div class="col-md-6 mb-3">
                <label for="first">Catégorie :</label>
                <select name="cat" class="form-select">
                    <option value="<?php echo $row2['id_cat']  ?>"><?php echo $row2['nom_cat']  ?></option>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_cat'] . '">' . $row['nom_cat'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="modifier" value="Modifier" class="btn btn-primary" id="submit" >
            </div>
    </form>
     <?php } ?>
</div>



    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>