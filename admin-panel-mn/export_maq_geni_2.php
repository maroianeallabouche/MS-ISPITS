<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<style>
    .selected {
        background-color: #FABB51;
        font-weight: bold;
        color: #fff;
    }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4">Export Notes modules et elements des étudiants </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="pdf3.js"></script>
                <div class="col-md-6 m-md-2">
                    <button class="btn btn-warning" onclick="generatePDF2()">Export PDF</button>
                    <button class="btn btn-primary" onclick="Export2Word('exportContent', 'word-content.docx');">Export Word</button>
                </div>
    <div class="row">
        <div class="col-md-12">

            <?php mysqli_set_charset($connect, "utf8");
            if (isset($_POST['recherche_md'])) {
                $id_op =  $_SESSION['option'];
                $id_niv = $_POST['niveau'];
                $id_mod = $_POST['module'];
                $sess = $_POST['sess'];
                $_SESSION['option'] = $id_op;
                $_SESSION['niveau'] = $id_niv;
                $_SESSION['module'] = $id_mod;
                $_SESSION['sess'] = $sess;
                $_SESSION['inc'] = 1;
                $i = 1;
                mysqli_set_charset($connect, "utf8");
                $query = "SELECT etudiant.id_et,etudiant.nom,etudiant.prenom,note_el.cc,note_el.cf,note_el.mg,element.nom_el,
                        module.nom_mod,note_el.sess,etudiant.id_niv,options.nom_op  
                        from note_el , etudiant ,element , module ,options where note_el.id_et=etudiant.id_et and note_el.id_el=element.id_el
                        and note_el.id_mod=module.id_mod and note_el.id_op=options.id_op
                        and note_el.id_op=$id_op  and note_el.id_mod=$id_mod and  note_el.id_niv=$id_niv and note_el.sess='$sess'
                        ORDER BY etudiant.nom,etudiant.prenom,etudiant.id_et,note_el.id_el
                        ";
                        //////
                $query_el = "SELECT element.nom_el  
                from note_el  ,element   where note_el.id_el=element.id_el
                 and note_el.id_mod=$id_mod ";
                $res_element = mysqli_query($connect, $query_el);
                /////////
                $query3 = "SELECT DISTINCT count(element.id_el) as nb_el 
                         from element where element.id_mod=$id_mod";
                $result = mysqli_query($connect, $query3);
                $row3 = mysqli_fetch_array($result);
                ////////
                $sql_md = " SELECT etudiant.id_et,etudiant.nom,etudiant.prenom , 
                        SUM(note_el.mg)/(COUNT(note_el.id_note_el)) as 'note_m' 
                        from note_el , etudiant ,element where note_el.id_et=etudiant.id_et 
                        and note_el.id_el=element.id_el and note_el.id_op=$id_op and note_el.id_mod=$id_mod 
                        and note_el.id_niv=$id_niv GROUP BY etudiant.id_et,etudiant.nom,etudiant.prenom 
                        ORDER BY etudiant.id_et,etudiant.nom,etudiant.prenom ";
                $res_mod = mysqli_query($connect, $sql_md);

                //////

               $sql_type_mod="SELECT type_mod from module where id_mod=$id_mod;";
               $res_type_mod= mysqli_query($connect, $sql_type_mod);
               $row_type_mode=mysqli_fetch_assoc($res_type_mod);

                /////////
                $nb_el = $row3['nb_el'];
                $sql = mysqli_query($connect, $query);
                $sql2 = mysqli_query($connect, $query);
                $sql3 = mysqli_query($connect, $query);

            ?>
                <script src="word.js"></script>
                <div id="exportContent">
                    <?php
                    if ($rows = mysqli_fetch_array($sql2)) {
                        echo   '<b>Option :  ' . $rows['nom_op'] . '</b><br>';
                        echo   '<b>Niveau :  S-' .  $id_niv . '</b> <br>';
                        if ($rows['sess'] == 'n') {
                            echo   '<b>Session :  Normal' . '</b><br>';
                        } else {
                            echo   '<b>Session :  Ratrapage' . '</b> <br>';
                        }
                        echo  '<b>Année universitaire :  ' . (date('Y') - 1) . '/' . date("Y") . '</b><br>';
                    }
                    ?>
                    <table class="table table-bordered border-dark tab1 text-center">
                        <?php
                        if ($nb_el == 3) {
                        ?>
                            <tr>
                                <th colspan="2" rowspan="2"></th>
                                <?php
                                if ($rows = mysqli_fetch_array($sql2)) {
                                    echo '<th colspan="' . (($nb_el * 3) + 2) . '">' . $rows['nom_mod'] . '</th>';
                                }
                                ?>
                            </tr>
                            <tr>
                                <?php
                                $el = 1;
                                while ($row_el = mysqli_fetch_array($res_element)) {
                                    echo '<th colspan="3" style="color:red;">' . $row_el['nom_el'] . '</th>';
                                    if ($el == $nb_el) {
                                        break;
                                    }
                                    $el++;
                                }
                                ?>
                                <th colspan="2" style="color: red;">Note Module</th>
                            </tr>
                        <?php
                        }
                        else if($nb_el == 2){
                        ?>
                          <tr>
                                <th colspan="2" rowspan="2"></th>
                                <?php
                                if ($rows = mysqli_fetch_array($sql2)) {
                                    echo '<th colspan="' . (($nb_el * 3) + 2) . '">' . $rows['nom_mod'] . '</th>';
                                }
                                ?>
                            </tr>
                            <tr>
                                <?php
                                $el = 1;
                                while ($row_el = mysqli_fetch_array($sql2)) {
                                    echo '<th colspan="3" style="color:red;">' . $row_el['nom_el'] . '</th>';
                                    if ($el == $nb_el) {
                                        break;
                                    }
                                    $el++;
                                }
                                ?>
                                <th colspan="2" style="color: red;">Note Module</th>
                            </tr>

                        <?php
                        }
                        else if($nb_el==1) {
                        ?>
                            <tr>
                                <th colspan="2" rowspan="2"></th>
                                <?php
                                if ($row2 = mysqli_fetch_array($sql3)) {
                                    echo '<th colspan="5">' . $row2['nom_mod'] . '</th>';
                                ?>
                            </tr>
                            <tr>
                            <?php
                                    echo '<th colspan="3" style="color:red;">' . $row2['nom_el'] . '</th>';
                                }
                            ?>
                            <th colspan="2" style="color: red;">Note Module</th>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <th>N°</th>
                            <th>Nom Prenom</th>
                            <?php
                            for ($j = 1; $j <= $nb_el; $j++) {
                                echo '<th>CC</th>';
                                echo '<th>CF</th>';
                                echo '<th>NM</th>';
                                if ($j == $nb_el) {
                                    break;
                                }
                            }
                            ?>
                            <th>Note</th>
                            <th>V ou NV</th>
                        </tr>
                    <?php
                    $note_el1=0;
                    $note_el2=0;
                    $note_el3=0;
                    $note_elmax=0;
                    $p = 1;
                    $ze=1;
                    $m = 0;
                    if($nb_el==1){
                         ///////////
                    while ($row = mysqli_fetch_array($sql)) {
                        echo '<tr><td>' . $i++ . '</td>';
                        echo '<td>' . $row['nom'] . ' ' . $row['prenom']  . '</td>';
                        echo '<td>' . $row['cc'] . '</td>';
                        echo '<td>' . $row['cf'] . '</td>';
                        echo '<td>' . number_format($row['mg'], 2, '.', '') . '</td>';
                        if($ze==$nb_el){
                          
                        }else{
                            while ($row = mysqli_fetch_array($sql)) {
                                echo '<td>' . $row['cc'] . '</td>';
                                echo '<td>' . $row['cf'] . '</td>';
                                echo '<td>' . number_format($row['mg'], 2, '.', '') . '</td>';
                                if ($i == $nb_el) {
                                    break;
                                }
                            }
                        }
                       
                        while ($row_mod = mysqli_fetch_array($res_mod)) {
                            echo '<td>' . number_format($row['mg'], 2, '.', '') . '</td>';
                            if ($row_type_mode['type_mod'] == 'MAJEUR' &&  $row['mg'] >= 10) {
                                echo '<td>V</td>';
                            } else if ($row_type_mode['type_mod'] == 'MAJEUR' &&  $row['mg'] < 10) {
                                echo '<td>NV</td>';
                            } else if ($row_type_mode['type_mod'] == 'COMPLEMENTAIRE') {
                                if ($row['mg'] >= 8 && $row['mg'] < 10) {
                                    echo '<td>VPC</td>';
                                } else if ($row['mg'] >= 10) {
                                    echo '<td>V</td>';
                                }
                            } else if ($row_type_mode['type_mod'] == 'COMPLEMENTAIRE' &&  $row['mg'] < 8) {
                                echo '<td>NV</td>';
                            }
                            if ($m < $p) {
                                break;
                            }
                            $m++;
                            $p++;
                        }
                        echo "</tr>";
                    }
                    //////////////////
                  } else if($nb_el==2){
                       ////////////
                    while ($row = mysqli_fetch_array($sql)) {
                        $note_el1=$row['mg'];
                        echo '<tr><td>' . $i++ . '</td>';
                        echo '<td>' . $row['nom'] . ' ' . $row['prenom']  . '</td>';
                        echo '<td>' . $row['cc'] . '</td>';
                        echo '<td>' . $row['cf'] . '</td>';
                        echo '<td>' . number_format($row['mg'], 2, '.', '') . '</td>';
                        if($ze==$nb_el){
                          
                        }else{
                            while ($row = mysqli_fetch_array($sql)) {
                                $note_el2=$row['mg'];
                                echo '<td>' . $row['cc'] . '</td>';
                                echo '<td>' . $row['cf'] . '</td>';
                                echo '<td>' . number_format($row['mg'], 2, '.', '') . '</td>';
                                if ( $nb_el==2) {
                                    break;
                                }
                            }
                        }
                       
                        while ($row_mod = mysqli_fetch_array($res_mod)) {
                            $note_elmax=($note_el1+$note_el2)/2;
                            echo '<td>' . number_format($note_elmax, 2, '.', '') . '</td>';
                            if ($row_type_mode['type_mod'] == 'MAJEUR' &&  $note_elmax >= 10) {
                                echo '<td>V</td>';
                            } else if ($row_type_mode['type_mod'] == 'MAJEUR' &&  $note_elmax < 10) {
                                echo '<td>NV</td>';
                            } else if ($row_type_mode['type_mod'] == 'COMPLEMENTAIRE') {
                                if ($note_elmax >= 8 && $note_elmax < 10) {
                                    echo '<td>VPC</td>';
                                } else if ($note_elmax >= 10) {
                                    echo '<td>V</td>';
                                }
                            } else if ($row_type_mode['type_mod'] == 'COMPLEMENTAIRE' &&  $note_elmax < 8) {
                                echo '<td>NV</td>';
                            }
                            if ($m < $p) {
                                break;
                            }
                            $m++;
                            $p++;
                        }
                        echo "</tr>";
                    }
                     ///////////
                  } else if($nb_el==3){
                    ////////////
                 while ($row = mysqli_fetch_array($sql)) {
                     $note_el1=$row['mg'];
                     echo '<tr><td>' . $i++ . '</td>';
                     echo '<td>' . $row['nom'] . ' ' . $row['prenom']  . '</td>';
                     echo '<td>' . $row['cc'] . '</td>';
                     echo '<td>' . $row['cf'] . '</td>';
                     echo '<td>' . number_format($row['mg'], 2, '.', '') . '</td>';
                     if($ze==$nb_el){
                       
                     }else{
                         while ($row = mysqli_fetch_array($sql)) {
                             $note_el2=$row['mg'];
                             echo '<td>' . $row['cc'] . '</td>';
                             echo '<td>' . $row['cf'] . '</td>';
                             echo '<td>' . number_format($row['mg'], 2, '.', '') . '</td>';
                             if ( $nb_el==3) {
                                 break;
                             }
                         }
                         while ($row = mysqli_fetch_array($sql)) {
                            $note_el3=$row['mg'];
                            echo '<td>' . $row['cc'] . '</td>';
                            echo '<td>' . $row['cf'] . '</td>';
                            echo '<td>' . number_format($row['mg'], 2, '.', '') . '</td>';
                            if ( $nb_el==3) {
                                break;
                            }
                        }
                     }
                    
                     while ($row_mod = mysqli_fetch_array($res_mod)) {
                         $note_elmax=($note_el1+$note_el2+$note_el3)/3;
                         echo '<td>' . number_format($note_elmax, 2, '.', '') . '</td>';
                         if ($row_type_mode['type_mod'] == 'MAJEUR' &&  $note_elmax >= 10) {
                             echo '<td>V</td>';
                         } else if ($row_type_mode['type_mod'] == 'MAJEUR' &&  $note_elmax < 10) {
                             echo '<td>NV</td>';
                         } else if ($row_type_mode['type_mod'] == 'COMPLEMENTAIRE') {
                             if ($note_elmax >= 8 && $note_elmax < 10) {
                                 echo '<td>VPC</td>';
                             } else if ($note_elmax >= 10) {
                                 echo '<td>V</td>';
                             }
                         } else if ($row_type_mode['type_mod'] == 'COMPLEMENTAIRE' &&  $note_elmax < 8) {
                             echo '<td>NV</td>';
                         }
                         if ($m < $p) {
                             break;
                         }
                         $m++;
                         $p++;
                     }
                     echo "</tr>";
                 }
                  ///////////
               }
                }
                    ?>
                    </table>
                    <?php echo '<b>Laayoune Le :' . date('Y/m/d') . '</b>';   ?>
                </div>
               
        </div>
    </div>
</div>
<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>