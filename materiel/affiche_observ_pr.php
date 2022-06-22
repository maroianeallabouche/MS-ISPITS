<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Les demandes</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">/</li>
    </ol>
    <?php include 'message.php';   ?>
            <div class="row m-3">

                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT   materiel.designation ,  observ_pr.obs_qte ,  observ_pr.date_cmd , observ_pr.id_mat
                    ,  observ_pr.id_obs_pr
                    from  observ_pr , materiel
                    WHERE  observ_pr.id_mat=materiel.id_mat and  observ_pr.id_p=$id";
                    $result = mysqli_query($connect, $sql);
                    ///////////
                    $sql2 = "SELECT * FROM profs WHERE id_p=$id";
                    $result2 = mysqli_query($connect, $sql2);
                ?>
                <form action="remove_qte_ad.php" method="post">
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
                                        $id_obs=$row['id_obs_pr'];
                                        echo '<tr>';
                                        echo '<td>' . $row['designation'] . '</td>';
                                        echo '<td>' . $row['date_cmd'] . '</td>';
                                        echo '<td>' . $row['obs_qte'] . '</td>';
                                        echo '<td> <a href="edit_qte_pr.php?id=' . $id_obs  . '" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                        <a href="supp_obs_pr.php?id=' . $id_obs . '" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>';
                                      ?>
                                     <?php 
                                        echo '</tr>';
                                    }

                                    ?>
                            </tbody>
                        </table>
                        </div>
                        </div>  
                        <input type="submit" value="Ajouter" class="btn btn-success" name="ajouter">
                </form>    
                    <?php
                }
                    ?>

                    
            </div>
        

</div>



<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>