<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Modifier RIB </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"></li>
        <li class="breadcrumb-item">profs</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="card">
        <div class="card-header">
            <h2>Modifier</h2>
        </div>
        <div class="card-body">
            <?php
             if(isset($_GET['id'])){
                mysqli_set_charset($connect, "utf8");
                 $id=$_GET['id'];
                 $_SESSION['id']=$id;
                 $sql='SELECT * from rib_prof where id_p='.$id;    
                 $result=mysqli_query($connect,$sql);
                $row=mysqli_fetch_assoc($result);
       
            ?>
            <form action="modifier_rib_prof_code.php" method="post">
                <div class="row">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="col-md-6">
                        <label for="">RIB :</label>
                        <input type="text" name="rib" class="form-control" value="<?php echo $row['rib_p']; ?>">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <input type="submit" name="submit" class="btn btn-success" value="Modifier">
                </div>
            </form>
            <?php
      }
            ?>
        </div>
    </div>
</div>


<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>
