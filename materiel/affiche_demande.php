<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Les demandes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">/</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="card text-dark mb-3">
        <div class="card-header">
            <h4>Afficher les demandes</h4>
        </div>
        <div class="card-body">
            <div class="row">
            <?php
                    $sql = "SELECT  administration.id,administration.nom,administration.prenom,cmd_admin.id  
                    from cmd_admin , administration
                    WHERE cmd_admin.id=administration.id 
                    GROUP BY cmd_admin.id";
                    $result = mysqli_query($connect, $sql);
                    ///////////
                    $sql1="SELECT  profs.id_p,profs.nom,profs.prenom,cmd_prof.id_p  
                    from cmd_prof , profs
                    WHERE cmd_prof.id_p=profs.id_p
                    GROUP BY cmd_prof.id_p";
                    $result1 = mysqli_query($connect, $sql1);
                    ?>
                <div class="row mt-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                 <th>Nom Prenom</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="article">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['nom'].' '.$row['prenom'] . '</td>';
                            echo '<td>
                            <a href="affiche_demande_ad.php?id='.$row['id'].'" class="btn btn-success">Afficher</a>
                            </td>';
                            echo '</tr>';
                        }
                        ?>
                         <?php
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            echo '<tr>';
                            echo '<td>' . $row1['nom'].' '.$row1['prenom'] . '</td>';
                            echo '<td>
                            <a href="affiche_demande_pr.php?id='.$row1['id_p'].'" class="btn btn-success">Afficher</a>
                            </td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
           
                </div>
            </div>
        </div>
    </div>

</div>



<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>