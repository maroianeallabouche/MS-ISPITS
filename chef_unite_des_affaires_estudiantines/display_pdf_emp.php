<?php
include 'config/dbcon.php';
include 'authentification.php';
include 'includes/header.php';
?>

<?php
if(isset($_POST['recherche'])){
$id_op=$_POST['option'];
$id_niv=$_POST['niveau'];
$sql = "SELECT pdf_name,id_emp_pdf FROM  emploi_pdf where id_op=$id_op and id_niv=$id_niv";
$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $id_pdf= $row['id_emp_pdf'];
    $pdf_name= $row['pdf_name'];
?>
<div class="container-fluid px-4 mt-4">
<div class="row">
<div class="col-md-11">
<embed src="../pdf/<?php echo $row['pdf_name']; ?>" type="application/pdf"  width="950px" height="500px">
</div>
<!-- <div class="col-md-1">
 <a href="delete_emp_pdf.php?id=<?php //echo $id_pdf; ?>&name=<?php //echo $pdf_name; ?>" class="btn btn-danger">Delete</a>
</div> -->
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