<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Frais de déplaement </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="pdf.js"></script>
    <div class="col-md-6 m-md-2">
        <button class="btn btn-primary" onclick="generatePDF()">Export PDF</button>
    </div>
    <div class="row">
        <div id="invoice" class="container-fluid px-4">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12" style="background-image: url(newimg.jpg);background-position: center;
                background-repeat: no-repeat;
                height:200px">
                    </div>
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $_SESSION['id'] = $id;
                        mysqli_set_charset($connect, "utf8");
                        /////////
                        $sql = "SELECT *  FROM administration WHERE id =$id  ";
                        $result = mysqli_query($connect, $sql);
                        ////// 
                        $sql2= "SELECT *  FROM frais_dep_admins WHERE id =$id  ";
                        $result2 = mysqli_query($connect, $sql2);
                        /////////
                       if($row=mysqli_fetch_assoc($result)){
 
                    ?>
                </div>
                <div class="row text-center mb-5 mt-3">
                    <div class="col-md-12">
                   <u><h4><b> ORDRE DE MISSION</b></h4></u> 
                    </div>
                </div>
                <div class="row mb-2">
                <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        Il est prescrit à  
                    </div>
                    <div class="col-md-6 ">
                        <b>: <?php  echo $row['nom'].'  '.$row['prenom'] ?></b>  
                    </div>
                </div>
                <div class="row mb-2">
                <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        Grade  
                    </div>
                    <div class="col-md-6 ">
                        <b>: <?php  echo strtoupper($row['grade']) ; } ?></b>  
                    </div>
                </div>
                <div class="row mb-2">
                <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        Affectation 
                    </div>
                    <div class="col-md-6 ">
                        <b>: ISPITS-LAAYOUNE</b>  
                    </div>
                </div>
                <?php   while($row2=mysqli_fetch_assoc($result2)){  ?>
                <div class="row mb-2">
                <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                    De se rendre à   
                    </div>
                    <div class="col-md-6 ">
                        <b>: <?php echo strtoupper($row2['lieu_d']) ;  ?> </b>  
                    </div>
                </div>
                <div class="row mb-2">
                <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        Motif 
                    </div>
                    <div class="col-md-6 ">
                        <b>: FORMATION</b>  
                    </div>
                </div>
                <div class="row mb-2">
                <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        Date de départ 
                    </div>
                    <div class="col-md-6 ">
                        <b>: <?php  echo $row2['date_d'].' à '.$row2['h_d'] ;     ?></b>  
                    </div>
                </div>
                <div class="row mb-2">
                <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        Date de retour 
                    </div>
                    <div class="col-md-6 ">
                        <b>: <?php  echo $row2['date_r'].' à '.$row2['h_r'] ;     ?></b>  
                    </div>
                </div>
                <?php  }  ?>
                <div class="row mt-5 text-center">
                   <div class="col-md-6">
                       <b>Le chef de service</b>
                   </div>
                </div> 
            </div>
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