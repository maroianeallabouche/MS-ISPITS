<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher tout les employés </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">employés</li>
    </ol>
    <?php include 'message.php';   ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="pdf.js"></script>
    <div class="col-md-6 m-md-2">
        <button class="btn btn-primary" onclick="generatePDF()">Export PDF</button>
    </div>
    <div class="container-fluid px-4" id="invoice"> 
    <div class="row">
            <div class="col-md-12" style="background-image: url(newimg.jpg);background-position: center;
                background-repeat: no-repeat;
                height:200px">
                </div>
        </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered border-dark mt-2">
                <tr>
                    <th>Nom et Prenom</th>
                    <th>PPR</th>
                    <th>CIN</th>
                    <th>Grade</th>
                    <th>Echelle</th>
                    <th>N° de Compte</th>
                </tr>
                <?php
                  mysqli_set_charset($connect, "utf8");
                $sql = "SELECT  profs.id_p ,  profs.nom , profs.prenom , profs.cin ,profs.ppr ,profs.echelle ,profs.echelon ,rib_prof.rib_p 
                FROM profs ,rib_prof
                where rib_prof.id_p=profs.id_p";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['nom'] . ' ' . $row['prenom'] . '</td>';
                    echo '<td>' . $row['ppr'] . '</td>';
                    echo '<td>' . $row['cin'] . '</td>';
                    echo '<td>' . $row['echelon'] . '</td>';
                    echo '<td>' . $row['echelle'] . '</td>';
                    echo '<td>' . $row['rib_p'] . '</td>';
                    echo '</tr>';
                }

                ?>
                  <?php
                $sql2 = "SELECT a.id, a.nom , a.prenom ,a.num_matricule  , a.cin ,a.grade ,a.echelle, rib_admin.rib_ad
                FROM administration a ,rib_admin
                where rib_admin.id=a.id";
                $result2 = mysqli_query($connect, $sql2);
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    echo '<tr>';
                    echo '<td>' . $row2['nom'] . ' ' . $row2['prenom'] . '</td>';
                    echo '<td>' . $row2['num_matricule'] . '</td>';
                    echo '<td>' . $row2['cin'] . '</td>';
                    echo '<td>' . $row2['grade'] . '</td>';
                    echo '<td>' . $row2['echelle'] . '</td>';
                    echo '<td>' . $row2['rib_ad'] . '</td>';
                    echo '</tr>';
                }

                ?>
            </table>
        </div>
    </div>
  </div>  
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>