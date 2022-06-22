<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="pdf.js"></script>
<div class="col-md-3 m-md-2">
    <button class="btn btn-primary" onclick="generatePDF()">Export PDF</button>
</div>
<div class="container-fluid px-4">
    <h1 class="mt-4">Les demandes</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">/</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-3">
            <label for="">Date debut :</label>
            <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
        </div>
        <div class="col-md-3">
        <label for="">Date fin :</label>
            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
        </div>
        <div class="col-md-5 mt-4">
            <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
        </div>
    </div>
            <div class="row m-3">
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $_SESSION['id']=$id;
                    $sql = "SELECT   materiel.designation , cmd_prof.qte , cmd_prof.date_cmd ,cmd_prof.id_mat
                    from cmd_prof , materiel
                    WHERE cmd_prof.id_mat=materiel.id_mat and cmd_prof.id_p=$id";
                    $result = mysqli_query($connect, $sql);
                    ///////////
                    $sql2 = "SELECT * FROM profs WHERE id_p=$id";
                    $result2 = mysqli_query($connect, $sql2);

                ?>
                <form action="remove_qte_pr.php" method="post"> 
                   <div class="m-3" id="invoice">
                    <div class="row mt-5">
                    <div class="col-md-12" style="background-image: url(newimg.jpg);background-position: center;
                background-repeat: no-repeat;
                height:200px">
                </div>
                    <div class="col-md-10 m-auto text-center">
                    <h5><b> Besoin consomable de <input type="text" style="font-weight: bold;border:0;" size="40"> </b></h5>
                       <h5><b><?php echo 'au :'.date('Y/m/d'); ?></b></h5> 
                    </div>
                    <div class="col-md-10 mx-3">
                       <?php  if($row2 = mysqli_fetch_array($result2)){
                        echo  '<b>Nom - Prenom : '.$row2['nom']." ".$row2['prenom'].'</b>';
                    }  ?>
                    </div>
                    <div id="order_table">
                        <table class="table table-bordered">
                                <tr>
                                    <th>Designation</th>
                                    <th>Qantité</th>
                                    <th>Date</th>
                                    <th>Observation</th>
                                    <th>Status</th>
                                </tr>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<input type="hidden" name="id_mat[]" value="' . $row['id_mat'] . '">';
                                        echo '<input type="hidden" name="id" value="' . $id . '">';
                                        echo '<tr>';
                                        echo '<td>' . $row['designation'] . '</td>';
                                        echo '<td>' . $row['qte'] . '</td>';
                                        echo '<td>' . $row['date_cmd'] . '</td>';
                                        echo '<td>
                            <input type="number" name="qte[]" id="qte" value="" class="form-control" placeholder="Qantité">
                            </td>';
                                   ?>
                                        <td>
                                            <select  id="status" class="form-control">
                                                <option value="" selected disabled>Status</option>
                                                <option value="1">confirmer</option>
                                                <option value="2">non confirmé</option>
                                            </select>
                                        </td>
                                   <?php
                                        echo '</tr>';
                                    }

                                    ?>
                        </table>
                    </div>
                        </div>
                        </div>   
                        <input type="submit" value="Ajouter" class="btn btn-success" name="ajouter">
                </form>    
                    <?php
                }
                    ?>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script>  
      $(document).ready(function(){    
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val(); 
                console.log(from_date);
                console.log(to_date); 
                     $.ajax({  
                          url:"filtere_pr.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });    
           });  
      });  
 </script>
                    
            </div>
      
  

</div>



<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>