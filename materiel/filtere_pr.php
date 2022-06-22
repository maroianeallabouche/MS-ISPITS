<?php  
session_start();
include 'config/dbcon.php';
 //filter.php    
     $fd=$_POST["from_date"];
     $td= $_POST["to_date"];
     $id=$_SESSION['id'];
      $output = ''; 
      $query="SELECT materiel.designation , cmd_prof.qte , cmd_prof.date_cmd ,cmd_prof.id_mat 
      from cmd_prof , materiel WHERE cmd_prof.id_mat=materiel.id_mat 
      and cmd_prof.id_p=$id and date_cmd BETWEEN '$fd' and '$td'"; 
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <table class="table table-bordered">
          <tr>
              <th>Designation</th>
              <th>Qantité</th>
              <th>Date</th>
              <th>Observation</th>
              <th>Status</th>
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
                                     <td>' . $row['date_cmd'] . '</td>
                                     <td>
                            <input type="number" name="qte[]" id="qte" value="" class="form-control" placeholder="Qantité">
                            </td> 
                                  <td> 
                                        <select id="status" class="form-control">
                                            <option value="" selected disabled>Status</option>
                                            <option value="1">confirmer</option>
                                            <option value="2">non confirmé</option>
                                        </select>
                                    </td>
                                    </tr>
                ';  
           }    
      $output .= '</table>';  
      echo $output;  

 ?>