<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher unités </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">unités</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>unités enregistrés</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        mysqli_set_charset($connect, "utf8");
                        $sql = "SELECT * FROM unite";
                        $result = mysqli_query($connect, $sql);
                        $i=1;
                        ?>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom unité</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>' . $i++ . '</td>';
                                            echo '<td>' . $row['nom_u'] . '</td>';
                                            echo '<td>
                                            <a href="edit_unite.php?id=' . $row['id_u'] . '" class="btn btn-primary">Modifier</a>
                                            <a href="delete_unite.php?id=' . $row['id_u'] . '" class="btn btn-danger">Supprimer</a>
                                            </td>';
                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>