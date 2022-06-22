<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher l'observation</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">/</li>
    </ol>
    <?php include 'message.php';   ?>
            <div class="row m-3">

                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT   materiel.designation , observ_ad.obs_qte , observ_ad.date_cmd ,observ_ad.id_mat,
                    observ_ad.id_obs_ad
                    from observ_ad , materiel
                    WHERE observ_ad.id_mat=materiel.id_mat and observ_ad.id=$id";
                    $result = mysqli_query($connect, $sql);
                    ///////////
                    $sql2 = "SELECT * FROM administration WHERE id=$id";
                    $result2 = mysqli_query($connect, $sql2);
                ?>
                    <div class="m-3" id="invoice">
                    <div class="row mt-5">
                    <div class="col-md-10 mx-3">
                       <?php  if($row2 = mysqli_fetch_array($result2)){
                        echo  '<b>Nom - Prenom : '.$row2['nom']." ".$row2['prenom'].'</b>';
                    }  ?>
                    </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Designation</th>
                                    <th>Date</th>
                                    <th>Observation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="article">
               
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id_obs=$row['id_obs_ad'];
                                        echo '<tr>';
                                        echo '<td>' . $row['designation'] . '</td>';
                                        echo '<td>' . $row['date_cmd'] . '</td>';
                                        echo '<td>' . $row['obs_qte'] . '</td>';
                                        echo '<td> <a href="edit_qte_ad.php?id=' . $id_obs  . '" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                        <a href="supp_obs_ad.php?id=' . $id_obs . '" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>';
                                      ?>
                                     <?php 
                                        echo '</tr>';
                                    }

                                    ?>
                            </tbody>
                        </table>
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