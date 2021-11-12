
 var jsPDF = window.jspdf.jsPDF;
 $(document).ready(function() {
     if(jsPDF && jsPDF.version) {
         $('#dversion').text('Version ' + jsPDF.version);
     }
 });
