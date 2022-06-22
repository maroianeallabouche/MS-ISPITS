<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Releve du notes </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"></li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Note</h2>
                </div>
                <div class="card-body" id="user_table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php mysqli_set_charset($connect, "utf8");
                            if (isset($_POST['recherche'])) {
                                $id_op = $_POST['option'];
                                $id_niv = $_POST['niveau'];
                                $id_f = $_POST['filiere'];
                                $_SESSION['filiere'] = $id_f;
                                $_SESSION['option'] = $id_op;
                                $_SESSION['niveau'] = $id_niv;
                                $i = 1;
                                mysqli_set_charset($connect, "utf8");
                                $sql = mysqli_query($connect, "SELECT id_et,nom,prenom from etudiant where id_f=$id_f and id_op=$id_op and id_niv=$id_niv");
                                while ($row = mysqli_fetch_array($sql)) {
                                    $id_et = $row['id_et'];
                                    $_SESSION['id_et'] = $id_et;
                                    echo '<tr><td>' . $row['id_et'] . '</td>';
                                    echo '<td>' . $row['nom'] . '</td>';
                                    echo '<td>' . $row['prenom'] . '</td>';
                                    echo "<td class='noExport'> <a href='affichage_releve.php?id=" . $row['id_et'] . "' class='btn btn-warning'>Releve du notes</i></a> 
                                      </td></tr>";
                                }
                            }
                            ?>
                            <?php
                            if (isset($_SESSION['output'])) {
                                echo $_SESSION['output'];
                                unset($_SESSION['output']);
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