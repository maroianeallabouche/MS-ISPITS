<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="container-fluid px-4">
    <?php include 'message.php';   ?>
    <h1 class="mt-4">Supprimer les memoires ajouté </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <div class="row" >
       <div>
        <div class="col-md-12">
            <div class="row mb-4">
              
            </div>
            <?php
                mysqli_set_charset($connect, "utf8");
                $sql = "SELECT profs.nom,profs.prenom,p.ir_somme ,p.taux_h,p.date_d,p.date_f,nom_mod,p.nbr_h,p.id_prix_vac
                FROM profs , prix_vacataire p ,module m
                where 
                 p.id_p=profs.id_p and p.id_mod=m.id_mod ";
                $result = mysqli_query($connect, $sql);
            ?>
                <table class="table table-bordered border-dark text-center">
                    <tr>
                        <th>NOM</th>
                        <th>PRENOM</th>
                        <th>Matiere</th>
                        <th>Nembre Heure</th>
                        <th>Date</th>
                        <th>Taux horaire </th>
                        <th>Action</th>
                    </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['nom'] . '</td>';
                            echo '<td>' . $row['prenom'] . '</td>';
                            echo '<td>' . $row['nom_mod'] . '</td>';
                            echo '<td>' . $row['nbr_h'] . '</td>';
                            echo '<td>DE ' . $row['date_d'] .' AU '.$row['date_f']. '</td>';
                            echo '<td>' . $row['taux_h'] . '</td>';
                            echo '<td><a href="supp_memoire_code.php?id='.$row['id_prix_vac'].'" class="btn btn-danger" >Supprimer</a></td>';
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