function generatePDF(){
    var element = document.getElementById('invoice');
    var opt = {
        margin:       0,
        filename:     'attestation_reusite.pdf',
        html2canvas:  { scale: 2 },
        jsPDF:        { orientation: 'landscape' }
      };
    html2pdf().set(opt)
    .from(element)
    .save();
}