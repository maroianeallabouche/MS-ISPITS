<?php  
session_start();
include 'config/dbcon.php';
 //filter.php    
     $fd=$_POST["from_date"];
     $td= $_POST["to_date"];
     $id=$_SESSION['id'];
      $output = ''; 
      $query="SELECT   materiel.designation , cmd_medi_acs_p.qte , 
      cmd_medi_acs_p.date_cmd ,cmd_medi_acs_p.id_mat , cmd_medi_acs_p.unite_cmd
      from cmd_medi_acs_p , materiel
      WHERE cmd_medi_acs_p.id_mat=materiel.id_mat and cmd_medi_acs_p.id_p=$id
     and cmd_medi_acs_p.date_cmd BETWEEN '$fd' and '$td'"; 
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <table class="table table-bordered">
          <tr>
          <th>Designation</th>
          <th>Qantité</th>
          <th>Unité</th>
          <th>Date</th>
          <th>Observation</th>
          </tr> 
      ';    
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                 <input type="hidden" name="id_mat[]" value="' . $row['id_mat'] . '">
                                     <input type="hidden" name="id" value="' . $id . '">
                                     <tr>
                                     <td>' . $row['designation'] . '</td>
                                     <td>' . $row['qte'] . '</td>
                                     <td>' . $row['unite_cmd'] . '</td>
                                     <td>' . $row['date_cmd'] . '</td>
                                     <td>
                            <input type="number" name="qte[]" id="qte" value="" class="form-control" placeholder="Qantité">
                            </td> 
                                    </tr>
                ';  
           }    
      $output .= '</table>';  
      echo $output;  

 ?>