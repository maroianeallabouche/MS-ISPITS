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
                    $sql = "SELECT   materiel.designation , cmd_medi_acs_p.qte , 
                    cmd_medi_acs_p.date_cmd ,cmd_medi_acs_p.id_mat , cmd_medi_acs_p.unite_cmd
                    from cmd_medi_acs_p , materiel
                    WHERE cmd_medi_acs_p.id_mat=materiel.id_mat and cmd_medi_acs_p.id_p=$id";
                    $result = mysqli_query($connect, $sql);
                    ///////////                
                    $sql2 = "SELECT * FROM profs WHERE id_p=$id";
                    $result2 = mysqli_query($connect, $sql2);
                ?>
                <form action="remove_qte_2.php" method="post">
                    <div class="m-3" id="invoice">
                    <div class="row mt-5">
                    <div class="col-md-12" style="background-image: url(newimg.jpg);background-position: center;
                background-repeat: no-repeat;
                height:200px">
                </div>
                    <div class="col-md-10 m-auto text-center">
                       <h5><b> Dotation de médicament et accessoire de pharmacie </b></h5>
                    </div>
                    <div class="col-md-10 mx-3">
                      <b> Service : <input type="text"  style="border:0;" size="50"> </b>
                    </div>
                    <div class="col-md-10 mx-3">
                       <?php  if($row2 = mysqli_fetch_array($result2)){
                        echo  '<b>Encadrant(e) : '.$row2['nom']." ".$row2['prenom'].'</b>';
                    }  ?>
                    </div>
                    <div id="order_table">
                        <table class="table table-bordered">
                                <tr>
                                    <th>Designation</th>
                                    <th>Qantité</th>
                                    <th>Unité</th>
                                    <th>Date</th>
                                    <th>Observation</th>
                                </tr>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<input type="hidden" name="id_mat[]" value="' . $row['id_mat'] . '">';
                                        echo '<input type="hidden" name="id" value="' . $id . '">';
                                        echo '<tr>';
                                        echo '<td>' . $row['designation'] . '</td>';
                                        echo '<td>' . $row['qte'] . '</td>';
                                        echo '<td>' . $row['unite_cmd'] . '</td>';
                                        echo '<td>' . $row['date_cmd'] . '</td>';
                                        echo '<td>
                            <input type="number" name="qte[]" id="qte" value="" class="form-control" placeholder="Qantité">
                            </td>';
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
                          url:"filtere_dotation.php",  
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