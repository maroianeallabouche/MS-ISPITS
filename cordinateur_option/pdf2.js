function generatePDF2(){
    const element = document.getElementById('invoice2');

    html2pdf()
    .from(element)
    .save();
}
