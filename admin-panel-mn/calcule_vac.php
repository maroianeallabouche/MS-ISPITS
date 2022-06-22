<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Emplois du Temps </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">vacation</li>
    </ol>
    <?php include 'message.php';   ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="pdf.js"></script>
    <div class="col-md-6 m-md-2">
        <button class="btn btn-primary" onclick="generatePDF()">Export PDF</button>
    </div>
    <div class="row"  id="invoice">
       <div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12" style="background-image: url(newimg.jpg);background-position: center;
                background-repeat: no-repeat;
                height:200px">
                </div>
            </div>
            <?php
            if (isset($_GET['id'])) {
                mysqli_set_charset($connect, "utf8");
                $id = $_GET['id'];
                $_SESSION['id'] = $id;
                mysqli_set_charset($connect, "utf8");
                $sql = "SELECT *,module.nom_mod,module.id_niv FROM vacataire ,module  WHERE id_p=$id and vacataire.id_mod=module.id_mod";
                $result = mysqli_query($connect, $sql);
                //////////

                /////////
                $sql2 = "SELECT profs.nom ,profs.echelon , profs.prenom ,options.nom_op,filiere.nom_fil FROM   profs , options ,filiere
                  WHERE id_p=$id  and profs.id_op=options.id_op and profs.id_f=filiere.id_f";
                $result2 = mysqli_query($connect, $sql2);
                $row2 = mysqli_fetch_array($result2);
                echo '<b>Année unniversitaire : ' . (date('Y') - 1) . '/' . date('Y') . '</b><br>';
                echo '<b>Filiére : ' . $row2['nom_fil'] . '</b><br>';
                echo '<b>Option : ' . $row2['nom_op'] . '</b><br>';
                echo '<b>Nom - Prenom : ' . $row2['nom'] . ' ' . $row2['prenom'] . '</b><br>';
                echo '<b>Grade : ' . $row2['echelon'] . '</b><br>';

            ?>
                <table class="table table-bordered border-dark">
                    <tr>
                        <th>Nom module</th>
                        <th>Niveau</th>
                        <th>Date </th>
                        <th>Nombre d'heure</th>
                    </tr>
                    <tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['nom_mod'] . '</td>';
                            echo '<td>Semestre-' . $row['id_niv'] . '</td>';
                            echo '<td>' . $row['date_vac'] . '</td>';
                            echo '<td>' . $row['nbr_h'] . '</td>';
                        }
                        ?>
                    </tr>
                </table>
                <p><b>Total Heure de chaque module :</b></p>
                <?php
                $sql3 = "SELECT vacataire.id_p,vacataire.id_mod,module.nom_mod ,SUM(nbr_h) as num_h
                        FROM vacataire , module 
                        WHERE id_p=$id and vacataire.id_mod=module.id_mod 
                        GROUP BY id_p,id_mod ";
                $result3 = mysqli_query($connect, $sql3);
                while ($row3 = mysqli_fetch_assoc($result3)) {
                    echo '<b>' . $row3['nom_mod'] . ' : ' . $row3['num_h'] . '</b><br>';
                }
                ?>
                <br>
                </div>               
               </div>  
            <?php
            }
            ?>
                           
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>