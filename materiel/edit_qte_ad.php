<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Editer l'observation</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">/</li>
    </ol>
    <?php  include 'message.php';   ?>
    <?php
   if(isset($_GET['id']) ){
       $id=$_GET['id'];
       mysqli_set_charset($connect, "utf8");
         $sql="SELECT * FROM  observ_ad WHERE id_obs_ad=$id";
            $result=mysqli_query($connect,$sql);
            $row=mysqli_fetch_array($result);

    ?>
    <form action="edit_qte_ad_code.php" method="post">
        <div class="row">
            <input type="hidden" name="id" value="<?php echo $row['id_obs_ad']  ?>">
            <div class="col-md-6 mb-3">
                <label for="first">Article :</label>
                <input required type="number" value="<?php echo $row['obs_qte']  ?>" name="obs_qte" class="form-control" id="first" placeholder="article">
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