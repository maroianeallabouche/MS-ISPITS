<?php
if(isset($_SESSION['message'])){
  if( $_SESSION['tm'] ==0){
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<?php   echo $_SESSION['message'];    ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
  }
  else if($_SESSION['tm'] ==1){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<?php   echo $_SESSION['message'];    ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
  }
  unseT($_SESSION['message']);
}
?>