<?php
include 'admin-panel-mn/config/dbcon.php';
$sql="SELECT * FROM page_reg WHERE id_re = 1";
$result=mysqli_query($connect,$sql);
$row=mysqli_fetch_assoc($result);
if($row['action_p']==1){
    $activation ='';
} else {
    $activation = 'disabled';
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="./index.php">ISPITS-LAAYOUNE </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Accueil</a>
        </li>
        <?php  if(isset($_SESSION['auth_user'])) :   ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['auth_user']['user_name']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">profile</a></li>
            <li>
          <form action="allcode.php" method="post">
            <button class="dropdown-item" name="logout" type="submit">Se déconnecter </button>
          </form>
          </li>
          </ul>
        </li>
        <?php else :   ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Connecter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $activation;   ?>"  href="register.php">S'inscrire</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>