function generatePDF2(){
    var element = document.getElementById('exportContent');
    var opt = {
        margin:       0,
        filename:     'fileemp.pdf',
        html2canvas:  { scale: 2 },
        jsPDF:        { orientation: 'landscape' }
      };
    html2pdf().set(opt)
    .from(element)
    .save();
}
