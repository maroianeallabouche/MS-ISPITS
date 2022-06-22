<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<?php

$sql = "SELECT id_f_p,pdf_name FROM   fiche_pdf ";
$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $pdf_name= $row['pdf_name'];
    $id_f_p= $row['id_f_p'];
?>
<div class="container-fluid px-4 mt-4">
<div class="row">
<div class="col-md-5">
<a href="../fiche_pdf/<?php echo $pdf_name; ?>" download class="btn btn-success">Télécharger</a>
<p><?php echo $pdf_name; ?></p>
</div>
<div class="col-md-10">
<embed src="../fiche_pdf/<?php echo $row['pdf_name']; ?>" type="application/pdf"  width="100%" height="500px">
</div>
</div>
</div>
<?php
}
?>
<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>