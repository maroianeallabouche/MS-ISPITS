<?php
session_start();
include 'config/dbcon.php';
if (isset($_POST["export"])) {
    if (isset($_SESSION['id_op']) && isset($_SESSION['id_niv'])) {
        $id_op = $_SESSION['id_op'];
        $id_niv = $_SESSION['id_niv'];
        $output = '';
        $i=1;
        mysqli_set_charset($connect, "utf8");
        $sql = mysqli_query($connect, "SELECT * ,filiere.nom_fil,options.nom_op,niveau.nom_semestre,annee_scolaire.ann_sc FROM etudiant,filiere,options,niveau,annee_scolaire WHERE options.id_op=$id_op and niveau.id_niv=$id_niv
        and  etudiant.id_f=filiere.id_f and etudiant.id_op=options.id_op and etudiant.id_niv=niveau.id_niv and etudiant.id_ann_sc=annee_scolaire.id_ann_sc ;");
        if (mysqli_num_rows($sql) > 0) {
            $output .= '
            <table class="table"  border="1">
                <tr  border="2">
                    <th>N°</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>الاسم الشخصي</th>
                    <th>الاسم العائلي</th>
                    <th>N° inscription</th>
                    <th>CIN</th>
                    <th>Sexe</th>
                    <th>Année scolaire</th>
                    <th>Promotion</th>
                    <th>Filiere</th>
                    <th>Option</th>
                    <th>Code option</th>
                    <th>Niveau</th>
                    <th>Email</th>
                    <th>CNE</th>
                    <th>Date de naissance</th>
                    <th>Lieu de naissance</th>
                    <th>Telephone</th>
                    <th>Année du bac</th>
                    <th>mention du bac</th>
                    <th>serie du bac</th>
                    <th>Lieu obtention du bac</th>
                    <th>Boursier</th>
                    <th>Nom pére </th>
                    <th>Nom mére </th>
                    <th>Profession du pére</th>
                    <th>Profession du mére</th>
                    <th>Adress</th>
                    <th>Telephone du parents</th>
                </tr>';
            while ($row = mysqli_fetch_array($sql)) {
                $nom_f = $row['nom_fil'];
                $nom_op = $row['nom_op'];
                $nv = $row['nom_semestre'];
                $ansc = $row['ann_sc'];
                $id_et = $row['id_et'];
                $output .= '
               <tr><td>' . $i++ . '</td>
                <td>' . $row['nom'] . '</td>
                 <td>' . $row['prenom'] . '</td>
                <td>' . $row['nom_ar'] . '</td>
                 <td>' . $row['prenom_ar'] . '</td>
                 <td>' . $row['num_inscpt'] . '</td>
                 <td>' . $row['cin'] . '</td>
                 <td>' . $row['sexe'] . '</td>
                 <td>' . $ansc . '</td>
                 <td>' . $row['promotion'] . '</td>
                 <td>' . $nom_f . '</td>
                 <td>' . $nom_op . '</td>
                 <td>' . $row['code_op'] . '</td>
                 <td>S-' . $nv . '</td>
                 <td>' . $row['email'] . '</td>
                 <td>' . $row['cne'] . '</td>
                 <td>' . $row['date_naiss'] . '</td>
                 <td>' . $row['lieu_naiss'] . '</td>
                 <td>' . $row['tel'] . '</td>
                 <td>' . $row['annee_bac'] . '</td>
                 <td>' . $row['mention_bac'] . '</td>
                 <td>' . $row['serie_bac'] . '</td>
                 <td>' . $row['lieu_obtn'] . '</td>
                 <td>' . $row['boursier'] . '</td>
                 <td>' . $row['nom_pere'] . '</td>
                 <td>' . $row['nom_mere'] . '</td>
                 <td>' . $row['profession_pere'] . '</td>
                 <td>' . $row['profession_mere'] . '</td>
                 <td>' . $row['adress'] . '</td>
                 <td>' . $row['tel_p'] . '</td> </tr>
                ';
            }
            $output .= '</table>';
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment; filename=List_Etudiants.xls");
            echo $output;
        }
    }
}
