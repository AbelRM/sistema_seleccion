 //binds to onchange event of your input field
 $('#expe1_archivo').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido").style.display = "block";
     document.getElementById("peso_archivo_no").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido").style.display = "none";
     document.getElementById("peso_archivo_no").style.display = "block";
     document.getElementById("expe1_archivo").value = '';
   }
 });

 //binds to onchange event of your input field
 $('#expe2_archivo').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido1').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido1").style.display = "block";
     document.getElementById("peso_archivo_no1").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no1').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido1").style.display = "none";
     document.getElementById("peso_archivo_no1").style.display = "block";
     document.getElementById("expe1_archivo1").value = '';
   }
 });

 //binds to onchange event of your input field
 $('#expe3_archivo').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido2').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido2").style.display = "block";
     document.getElementById("peso_archivo_no2").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no2').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido2").style.display = "none";
     document.getElementById("peso_archivo_no2").style.display = "block";
     document.getElementById("expe1_archivo2").value = '';
   }
 });

 //binds to onchange event of your input field
 $('#expe4_archivo').bind('change', function () {
   var peso = (this.files[0].size);
   if (peso <= 3000000) {
     document.getElementById('peso_archivo_valido3').innerHTML = "Archivo válido";
     document.getElementById("peso_archivo_valido3").style.display = "block";
     document.getElementById("peso_archivo_no3").style.display = "none";
   } else {
     document.getElementById('peso_archivo_no3').innerHTML = "El archivo sobre pasa los 3Mb máximos";
     document.getElementById("peso_archivo_valido3").style.display = "none";
     document.getElementById("peso_archivo_no3").style.display = "block";
     document.getElementById("expe1_archivo3").value = '';
   }
 });