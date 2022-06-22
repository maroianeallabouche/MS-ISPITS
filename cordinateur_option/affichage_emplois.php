<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<style>
    .mal {
        border: 0;
    }
    tr {
        text-align: center;
    }

    td {
        height: 30px;
    }
</style>
<div class="row">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="pdf.js"></script>
    <div class="col-md-6 m-md-2">
        <button class="btn btn-primary" onclick="generatePDF()">Export PDF</button>
    </div>
    <div class="col-md-3 m-md-2">
        <form action="pdf_emploi.php" method="post" enctype="multipart/form-data">
            <input type="file" name="pdf" class="form-control" id="">
    </div>
    <div class="col-md-2 m-md-2">
        <input type="submit" name="up" class="btn btn-warning" value="Import PDF">
    </div>
    </form>
</div>
<div class="container-fluid mt-2">
    </ol>
    <?php include 'message.php';   ?>
    <div class="row mb-5">
        <div class="col-md-12">
            <?php mysqli_set_charset($connect, "utf8");
            if (isset($_POST['recherche'])) {
                $id_op = $_POST['option'];
                $id_niv = $_POST['niveau'];
                $_SESSION['option'] = $id_op;
                $_SESSION['niveau'] = $id_niv;
                $i = 1;
                mysqli_set_charset($connect, "utf8");
                /////////////

                ////////////
                $sql2 = mysqli_query($connect, "SELECT options.nom_op ,filiere.nom_fil FROM options , filiere
                        where options.id_f=filiere.id_f and  options.id_op=$id_op");
                $row2 = mysqli_fetch_array($sql2);
                /////////////
                $newEndingDate = date('Y') + 1;
            }
            
            ?>
            <!-- //////////////////// -->
            <div class="row mb-1">
                <div class="col-md-3">
                    <select class="form-control" id="jour">

                        <option value="" disabled selected>Jour</option>
                        <option value="lundi">Lundi</option>
                        <option value="mardi">Mardi</option>
                        <option value="mercredi">Mercredi</option>
                        <option value="jeudi">Jeudi</option>
                        <option value="vendredi">Vendredi</option>
                        <option value="samedi">Samedi</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="" class="form-control" id="ladate">
                </div> <br>
                <!-- ///////////////////////////// -->
                <div class="row mb-1 mt-1">
                    <div class="col-md-3">
                        <select class="form-control" id="m1">
                            <option value="" disabled selected>Module : 09h00min - 10h55min</option>
                            <?php
                            $sql = mysqli_query($connect, "SELECT m.nom_mod  from module m 
                    where   m.id_op=$id_op 
                    and m.id_niv=$id_niv");
                            while ($row = mysqli_fetch_array($sql)) {
                                echo '<option>' . $row['nom_mod'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" id="p1">
                            <option value="" disabled selected>Profs : 09h00min - 10h55min</option>
                            <?php
                            $sql3 = mysqli_query($connect, "SELECT profs.nom from profs
                                where   profs.id_op=$id_op ");
                            while ($row3 = mysqli_fetch_array($sql3)) {
                                echo '<option>' . $row3['nom'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" id="m2">
                            <option value="" disabled selected>Module : 11h05min - 13h00min</option>
                            <?php
                            $sql = mysqli_query($connect, "SELECT m.nom_mod  from module m 
                    where   m.id_op=$id_op 
                    and m.id_niv=$id_niv");
                            while ($row = mysqli_fetch_array($sql)) {
                                echo '<option>' . $row['nom_mod'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" id="p2">
                            <option value="" disabled selected>Profs : 11h05min - 13h00min</option>
                            <?php
                            $sql3 = mysqli_query($connect, "SELECT profs.nom from profs
                                where   profs.id_op=$id_op ");
                            while ($row3 = mysqli_fetch_array($sql3)) {
                                echo '<option>' . $row3['nom'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div> <br>
                <!-- ...... -->
                <div class="row mb-1">
                    <div class="col-md-3">
                        <select class="form-control" id="m3">
                            <option value="" disabled selected>Module : 15h00min - 16h55min</option>
                            <?php
                            $sql = mysqli_query($connect, "SELECT m.nom_mod  from module m 
                    where   m.id_op=$id_op 
                    and m.id_niv=$id_niv");
                            while ($row = mysqli_fetch_array($sql)) {
                                echo '<option>' . $row['nom_mod'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="" id="p3">
                            <option value="" disabled selected>Profs :15h00min - 16h55min</option>
                            <?php
                            $sql3 = mysqli_query($connect, "SELECT profs.nom from profs
                                where   profs.id_op=$id_op ");
                            while ($row3 = mysqli_fetch_array($sql3)) {
                                echo '<option>' . $row3['nom'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" id="m4">
                            <option value="" disabled selected>Module : 17h05min - 19h00min</option>
                            <?php
                            $sql = mysqli_query($connect, "SELECT m.nom_mod  from module m 
                    where   m.id_op=$id_op 
                    and m.id_niv=$id_niv");
                            while ($row = mysqli_fetch_array($sql)) {
                                echo '<option>' . $row['nom_mod'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="" id="p4">
                            <option value="" disabled selected>Profs : 17h05min - 19h00min</option>
                            <?php
                            $sql3 = mysqli_query($connect, "SELECT profs.nom from profs
                                where   profs.id_op=$id_op ");
                            while ($row3 = mysqli_fetch_array($sql3)) {
                                echo '<option>' . $row3['nom'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-1 mt-1">
                    <div class="col-md-8">
                        <input type="submit" name="button" id="btn" onclick="AddRow()" value="ajouter" class="btn btn-success">
                        <input type="submit" name="re" id="btn" onclick="remove()" value="effacer" class="btn btn-danger">
                    </div>
                </div>
                <!-- ///////////////////////////// -->
                <br>
                <div class="container-fluid" id="invoice">
                    <?php
                    echo '<b>Filiere : ' . $row2['nom_fil'] . '</b><br>';
                    echo '<b>Option : ' . $row2['nom_op'] . '</b><br>';
                    echo "<b>Niveau d'etude : Semestre-" . $id_niv . '</b><br>';
                    echo '<b>Année universitaire : ' .  (date("Y") - 1) . '/' .date("Y") . '</b><br>';
                    ?>
                    <br>
                    <div class="row">
                        <div class="col-md-4 m-auto">
                            <h4>Emplois du Temps</h4>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control mal" name="" >
                                <option value="" disabled selected>Salle</option>
                                <?php
                                $sql12 = mysqli_query($connect, "SELECT nom_salle from salle
                                where   id_op=$id_op ");
                                while ($row12 = mysqli_fetch_array($sql12)) {
                                    echo '<option>Salle : ' . $row12['nom_salle'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <table class="table border-dark table-bordered" id="show">
                        <thead>
                            <tr style="background-color:#C8C8C8;" class="text-center">
                                <th>Date / Heure</th>
                                <th>09h00min - 10h55min</th>
                                <th>11h05min - 13h00min</th>
                                <th>15h00min - 16h55min</th>
                                <th>17h05min - 19h00min</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="row">
            <div class="col-md-3">
                <p><b>Le cordinateur de l'option</b></p>
            </div>
            <div class="col-md-3">
                <p><b>Le coordinateur de la filiére</b></p>
            </div>
            <div class="col-md-3">
                <p><b>Dac des études</b></p>
            </div>
            <div class="col-md-3">
                <p><b>Le directeur de l'ispits</b></p>
            </div>
        </div>
                </div>
                <script>
                    var list1 = [];
                    var list2 = [];
                    var list3 = [];
                    var list4 = [];
                    var list5 = [];

                    var n = 1;
                    var x = 0;

                    function AddRow() {

                        var AddRown = document.getElementById('show');
                        var NewRow = AddRown.insertRow(n);
                        jour = document.getElementById('jour').value;
                        ladate = document.getElementById('ladate').value;
                        m1 = document.getElementById('m1').value;
                        p1 = document.getElementById('p1').value;
                        m2 = document.getElementById('m2').value;
                        p2 = document.getElementById('p2').value;
                        m3 = document.getElementById('m3').value;
                        p3 = document.getElementById('p3').value;
                        m4 = document.getElementById('m4').value;
                        p4 = document.getElementById('p4').value;

                        list1[x] = jour + '<hr> ' + ladate;
                        list2[x] = m1 + '<hr>' + p1;
                        list3[x] = m2 + '<hr>' + p2;
                        list4[x] = m3 + '<hr>' + p3;
                        list5[x] = m4 + '<hr>' + p4;

                        var cel1 = NewRow.insertCell(0);
                        var cel2 = NewRow.insertCell(1);
                        var cel3 = NewRow.insertCell(2);
                        var cel4 = NewRow.insertCell(3);
                        var cel5 = NewRow.insertCell(4);

                        cel1.innerHTML = list1[x];
                        cel2.innerHTML = list2[x];
                        cel3.innerHTML = list3[x];
                        cel4.innerHTML = list4[x];
                        cel5.innerHTML = list5[x];

                        n++;
                        x++;
                    }

                    function remove() {
                        // document.getElementById('show').deleteRow(n-1);
                        // n--;
                        // x--;
                        document.getElementById('jour').value = '';
                        document.getElementById('ladate').value = '';
                        document.getElementById('m1').value = "";
                        document.getElementById('p1').value = "";
                        document.getElementById('m2').value = "";
                        document.getElementById('p2').value = "";
                        document.getElementById('m3').value = "";
                        document.getElementById('p3').value = "";
                        document.getElementById('m4').value = "";
                        document.getElementById('p4').value = "";
                    }
                </script>
            </div>
        </div>
    </div>

    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>