<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<?php
if(isset($_SESSION['auth_user']['user_id'])){
$id_et=$_SESSION['auth_user']['user_id'];
$sql = "SELECT pdf_name,id_emp_pdf FROM  emploi_pdf where id_op in( SELECT id_op from etudiant where id_et=$id_et) 
and id_niv in ( SELECT id_niv from etudiant where id_et=$id_et)
";
$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $id_pdf= $row['id_emp_pdf'];
    $pdf_name= $row['pdf_name'];
?>
<div class="container-fluid px-4 mt-4">
<div class="row">
<div class="col-md-5">
<a href="../pdf/<?php echo $pdf_name; ?>" download class="btn btn-primary">Télécharger </a>
<p><?php echo $pdf_name; ?></p>
</div>
<div class="col-md-10">
<embed src="../pdf/<?php echo $row['pdf_name']; ?>" type="application/pdf"  width="100%" height="500px">
</div>

</div>
</div>
   

<?php
}
}
?>


<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>