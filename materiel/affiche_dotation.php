<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Dotation médicament et accessoire de pharmacie</h1>
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
                    $sql = "SELECT  profs.id_p,profs.nom,profs.prenom,cmd_medi_acs_p.id_p  
                    from  cmd_medi_acs_p , profs
                    WHERE cmd_medi_acs_p.id_p=profs.id_p 
                    GROUP BY cmd_medi_acs_p.id_p";
                    $result = mysqli_query($connect, $sql);
                    ///////////
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
                            <a href="affiche_dotation_code.php?id='.$row['id_p'].'" class="btn btn-success">Afficher</a>
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