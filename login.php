<?php
session_start();
if(isset($_SESSION['auth'])){
    if(!isset($_SESSION['message'])){
        $_SESSION['message'] = "you are already logged in ";
    }
    header("Location:index.php");
    exit(0);
} 
include 'includes/header.php';
include 'includes/navbar.php';

?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
            <?php  include 'message.php';   ?>
               <div class="card">
                   <div class="card-header">
                   <img src="isml.png" width="150px" height="90px" class="rounded mx-auto d-block" alt="...">
                   </div>
                   <div class="card-body">
                   <h3 class="text-center">Login</h3>
                       <form action="logincode.php" method="post">
                       <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input required type="email" name="email" class="form-control" id="email" placeholder="email">
                       </div>
                       <div class="form-group mb-3">
                            <label for="Password">Mot de passe</label>
                            <input required type="password" name="password" class="form-control" id="Password" placeholder="Mot de passe">
                       </div>
                       <div class="form-group mb-3">
                            <input required type="submit" name="login_btn" value="Connecter" class="btn btn-primary" id="submit" >
                       </div>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';

?>