<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Année scolaire</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Ajouter Année scolaire</li>
    </ol>
    <?php include 'message.php';   ?>
    <form action="ajouter_year_code.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first">Debut de l'année :</label>
                <select class="form-select" name="startyear">
                    <?php
                    for ($year = (int)date('Y');  $year <= 2099; $year++) : ?>
                        <option value="<?= $year; ?>"><?= $year; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="first">Fin de l'année :</label>
                <select class="form-select" name="endyear">
                    <?php
                    for ($year = (int)date('Y');  $year <= 2099; $year++) : ?>
                        <option value="<?= $year; ?>"><?= $year; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <input required type="submit" name="ajouter_year" value="Ajouter" class="btn btn-success" id="submit">
        </div>
    </form>
    <!-- new Année scolaire in server -->
      <div class="col-md-6">
          <table class="table table-bordered">
              <tr>
                    <th>Année scolaire</th>
                    <th>Action</th>
              </tr>
                <?php
                $sql = "SELECT * FROM  annee_scolaire order by ann_sc ";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $row['ann_sc']; ?></td>
                        <td>
                            <a href="supprimer_year.php?id=<?= $row['id_ann_sc']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
          </table>
      </div>

    <?php
    include 'includes/footer.php';
    include 'includes/scripts.php';
    ?>