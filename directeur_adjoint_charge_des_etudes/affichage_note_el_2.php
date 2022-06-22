<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Affichage Notes elements des étudiants </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Note element</h2>
                </div>
                <div class="card-body" id="user_table">
                    <?php mysqli_set_charset($connect, "utf8");
                    if (isset($_POST['recherche_el'])) {
                        $id_op = $_POST['option'];
                        $id_niv = $_POST['niveau'];
                        $id_mod = $_POST['module'];
                        $id_el = $_POST['element'];
                        $sess = $_POST['sess'];
                        $_SESSION['element']=$id_el;
                        $_SESSION['module']=$id_mod;
                        $_SESSION['option']=$id_op;
                        $_SESSION['niveau']=$id_niv;
                        $_SESSION['sess']=$sess;
                        $i = 1;
                        mysqli_set_charset($connect, "utf8");
                        $query = "SELECT e.nom, e.prenom, e.id_et, n.cc, n.cf, n.mg,op.nom_op,m.nom_mod,el.nom_el,n.sess from etudiant e , note_el n ,niveau ni ,element el , options op , module m 
                                where e.id_et=n.id_et and n.id_op=op.id_op and n.id_mod=m.id_mod and n.id_el=el.id_el and n.id_niv=ni.id_niv and  el.id_el=$id_el 
                                and op.id_op=$id_op and n.id_niv=$id_niv and e.id_niv=$id_niv  and m.id_mod=$id_mod and n.sess='$sess'";
                        $sql = mysqli_query($connect, $query);
                        $sql2 = mysqli_query($connect, $query);
                        $newEndingDate =date('Y')+1;
                       if($rows= mysqli_fetch_array($sql2)){
                        echo   '<b>Option :  '. $rows['nom_op']. '</b><br>';
                        echo   '<b>Module :  '. $rows['nom_mod']. '</b><br>';
                        echo   '<b>Element :  '. $rows['nom_el']. '</b><br>';
                        echo   '<b>Niveau :  S-'. $id_niv. '</b><br>';
                        if($rows['sess']=='n'){
                            echo   '<b>Session :  Normal'. '</b></br>';
                        }else{
                            echo   '<b>Session :  Ratrapage'. '</b><br>';
                        }
                        echo  '<b>Année universitaire :  '. (date("Y") - 1)  .'/'.date("Y"). '</b><br>';
                    }
                    ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>CC</th>
                                    <th>CF</th>
                                    <th>NM</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            while ($row = mysqli_fetch_array($sql)) {
                                echo '<tr><td class="stud_id">' . $row['id_et'] . '</td>';
                                echo '<td>' . $row['nom'] . '</td>';
                                echo '<td>' . $row['prenom'] . '</td>';
                                echo '<td>' . number_format($row['cc'], 2, '.', '')  . '</td>';
                                echo '<td>' . number_format($row['cf'], 2, '.', '')   . '</td>';
                                echo '<td>' . number_format($row['mg'], 2, '.', '')   . '</td>';
                                echo "</tr>";
                            }
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