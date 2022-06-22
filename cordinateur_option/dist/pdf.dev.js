"use strict";

function generatePDF() {
  var element = document.getElementById('invoice');
  html2pdf().from(element).save();
}