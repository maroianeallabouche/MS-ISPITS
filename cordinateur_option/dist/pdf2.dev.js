"use strict";

function generatePDF2() {
  var element = document.getElementById('invoice2');
  html2pdf().from(element).save();
}