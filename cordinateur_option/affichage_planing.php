<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>
<style>
    <?php include 'tablestyle.css'; ?>
</style>
<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }
    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }
    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }
</script>
<div class="container-fluid px-4" >
    <h1 class="mt-3"></h1>
    <?php include 'message.php';   ?>
    <div class="row mb-3">
        <div class="col-md-12">
            <?php mysqli_set_charset($connect, "utf8");
            if (isset($_POST['recherche'])) {
                $id_op = $_POST['option'];
                $id_niv = $_POST['niveau'];
                $_SESSION['id_op'] = $id_op;
                $_SESSION['id_niv'] = $id_niv;
                $i = 1;
                mysqli_set_charset($connect, "utf8");
                $sql = mysqli_query($connect, "SELECT id_et,nom,prenom from etudiant where id_op=$id_op and id_niv=$id_niv");
                $sql2 = mysqli_query($connect, "SELECT options.nom_op,filiere.nom_fil from options , filiere  
                where options.id_f=filiere.id_f and options.id_op=$id_op ");
            ?>
                <div class="row">
                <div class="col-md-3">
                        <label for="">Nembre Groupe :</label> <br>
                        <input type="text" name="nbr_groupe" id="cols" class="form-control" placeholder="Nombre de groupe">
                    </div>
                    <div class="col-md-3">
                        <label for="">Nembre SG :</label> <br>
                        <input type="text" name="nbr_et" id="rows" class="form-control" placeholder="Nombre SG">
                    </div>
                    <div class="col-md-2 mt-4">
                        <button type="submit" id='make' class="btn btn-dark mb-3">Ajouter</button>
                    </div>
                    <div class="col-md-4">
                        <table class="table1">
                            <thead>
                                <tr>
                                    <th class="th1">Nom / Prenom</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($sql)) {
                                    echo '<tr><td class="td1"><div id="drag' . $i . '" draggable="true" ondragstart="drag(event)">' . $row['nom'] . ' ' . $row['prenom']  . '</div></td> </tr>';
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <input type="date" name="" id="date1" class="form-controm">
                        <input type="date" name="" id="date2" class="form-controm">
                        <input type="text" name="" id="sg1" class="form-controm" placeholder="G/SG la première heure">
                        <input type="text" name="" id="sg2" class="form-controm" placeholder="G/SG la deuxième heure"> <br>
                        <input type="submit" name="button" id="btn" onclick="AddRow()" value="ajouter" class="btn btn-success mt-2">
                        <input type="submit" name="re" id="btn" onclick="removel()" value="effacer ligne" class="btn btn-warning mt-2">
                        <input type="submit" name="re" id="btn" onclick="remove()" value="effacer" class="btn btn-danger mt-2">
                    </div> 
                    <div class="col-md-6 d-flex">
                    <div class="" id="drag200" draggable="true" ondragstart="drag(event)">SG1</div>
                    <div class="mx-2" id="drag201" draggable="true" ondragstart="drag(event)">SG2</div>
                    <div class="mx-2" id="drag202" draggable="true" ondragstart="drag(event)">SG3</div>
                    <div class="mx-2" id="drag203" draggable="true" ondragstart="drag(event)">SG4</div>
                    <div class="mx-2" id="drag204" draggable="true" ondragstart="drag(event)">SG5</div>
                    <div> 
                    </div>
                </div>
        </div>
    </div>
    <div class="row" id="table-export">
        <script src="js/table.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="pdf2.js"></script>
        <div class="col-md-3">
            <button class="btn btn-primary" onclick="generatePDF2()">Export PDF</button>
        </div>
        <div class="container-fluid px-4 mt-1" id="invoice2">
            <div class="row">
             <div class="col-md-8 mx-5 text-center">
            <?php
                $newEndingDate = date('Y') + 1;
                if ($row2 = mysqli_fetch_assoc($sql2)) {
                    echo '<b>Repartition des groupes de stage pratique par site et par periode de stage </b> ';
                    echo '<b>Filiere : ' . $row2['nom_fil'] . '</b> // ';
                    echo '<b>Option : ' . $row2['nom_op'] . '</b> // ';
                    echo "<b>Niveau d'etude : Semestre-" . $id_niv . '</b> //';
                    echo '<b>Année universitaire : ' . (date('Y') - 1) . '/' . date("Y"). '<br>';
                }
            }
                ?> 
                </div>
                <br>
            <table class="table2 mb-1" id="tab">
                <!-- <tr>
                    <th class="th2">Group 1</th>
                    <th class="th2">Group 2</th>
                </tr> -->
                <!-- <tr>
                    <td class="td2" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                    <td class="td2"  ondrop="drop(event)" ondragover="allowDrop(event)"></td>
                </tr> -->
            </table>
            <div class="col-md-8">
           <b><input type="text" name="" class="form-control fm" id="" placeholder="localisation"></b> 
            </div>
            <table class="table2" id="show">
             <tr class="tr">
                 <th class="th2">Date</th>
                 <th class="th2"><input type="text" name="" class="form-control fm" id="" placeholder="la première heure"></th>
                 <th class="th2"><input type="text" name="" class="form-control fm" id="" placeholder="la deuxième heure"></th>
             </tr>
            </table>
            <script src="js/showtb.js"></script>
            </div>
            <div class="row m-lg-1">
            <div class="col-md-2 ">
                <p><b>Le cordinateur de l'option</b></p>
            </div>
            <div class="col-md-2">
                <p><b>Le coordinateur de la filiére</b></p>
            </div>
            <div class="col-md-2">
                <p><b>Dac des études</b></p>
            </div>
            <div class="col-md-2">
                <p><b>Le directeur de l'ispits</b></p>
            </div>
        </div>
        </div>
    
</div>
</div>

<div class="col-md-4 mb-5">

</div>

<?php

include 'includes/scripts.php';
?>