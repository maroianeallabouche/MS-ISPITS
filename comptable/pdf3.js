function generatePDF2(){
    const element = document.getElementById('exportContent');
     
    html2pdf()
    .from(element)
    .save();
}
