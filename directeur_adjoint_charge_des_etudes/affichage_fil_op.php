<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Afficher filiéres / options </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">filiéres / options</li>
    </ol>
    <?php include 'message.php';   ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>filières enregistrées</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>N°</th>
                                <th>nom filiére</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM filiere ";
                            mysqli_set_charset($connect, "utf8mb4");
                            $result = mysqli_query($connect, $query);
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id_f'];
                                $nom = $row['nom_fil'];
                                echo "<tr>";
                                echo "<td>".$i++."</td>";
                                echo "<td>$nom</td>";
                                echo "<td>
                                <a href='edit_filiere.php?id=$id' class='btn btn-primary'>Modifier</a>
                                <a href='delete_filiere.php?id=$id' class='btn btn-danger'>supprimer</a>
                                ";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>options enregistrées</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <div class="col-md-6 mb-3">
                                <label for="filiere">Filiere :</label> <br>
                                <select name="filiere" class="filiere" id="filiere" required>
                                    <option value="" selected disabled>--Select filiere--</option>
                                    <?php
                                    mysqli_set_charset($connect, "utf8");
                                    $sql = "SELECT * FROM filiere";
                                    $result = mysqli_query($connect, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['id_f'] . '">' . $row['nom_fil'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <thead class="thead-dark">
                                <tr>
                                    <th>N°</th>
                                    <th>nom option</th>
                                    <th>code option</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody class="option">
                                <?php mysqli_set_charset($connect, "utf8");

                                ?>

                                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
                                </script>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $(".filiere").change(function() {
                                            var country_id = $(this).val();
                                            var post_id = 'id=' + country_id;

                                            $.ajax({
                                                type: "POST",
                                                url: "ajax3.php",
                                                data: post_id,
                                                cache: false,
                                                success: function(cities) {
                                                    $(".option").html(cities);
                                                }
                                            });

                                        });
                                    });
                                </script>
                            </tbody>
                        </table>
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