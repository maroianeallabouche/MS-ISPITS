<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';

?>
<style>
.wrapper {
    height: 600px;
    width: 100%;
    text-align: center;
    padding-top: 100px;
    color: white;
    overflow: hidden;
    background: #C04848;  /* fallback for old browsers */
    background: linear-gradient(rgb(0,0,50,0.9), rgb(42,72,140,0.4)), url("ispf.jpg");  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(rgb(0,0,50,0.9), rgb(42,72,140,0.4)), url("ispf.jpg"); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background-size: cover;
    background-repeat: no-repeat;
    -webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
}
</style>
<div  class="wrapper">
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7 mt-2 m-auto">
                <?php
                include 'message.php';
                ?>
                <h1 class="text-light" >ISPITS-LAAYOUNE </h1>
                <p>L’Institut Supérieur des Professions Infirmières et Technique de Santé de Laâyoune est un établissement 
                    d’enseignement supérieur non universitaire. Il est régi par le décret n° 2.13.658 du 30/09/2013 et par
                     les dispositions de la loi n° 01.00 portant organisation de l’enseignement supérieur. IL est sous 
                     la tutelle du Ministère de la santé.</p>
                <form action="login.php" method="post">
                    <button class="btn btn-primary px-4 mt-5 rounded-3"> Connecter </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php
include 'includes/footer.php';

?>