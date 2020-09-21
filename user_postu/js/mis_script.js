//binds to onchange event of your input field
$('#expe_archivo').bind('change', function () {

  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido").style.display = "block";
    document.getElementById("peso_archivo_no").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById('peso_archivo_no').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido").style.display = "none";
    document.getElementById("peso_archivo_no").style.display = "block";
    document.getElementById("expe_archivo").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);

});

$('#expe_archivo_3').bind('change', function () {

  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido_3').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido_3").style.display = "block";
    document.getElementById("peso_archivo_no_3").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById('peso_archivo_no_3').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido_3").style.display = "none";
    document.getElementById("peso_archivo_no_3").style.display = "block";
    document.getElementById("expe_archivo_3").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);

});

$('#expe_archivo_1').bind('change', function () {

  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido_1').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido_1").style.display = "block";
    document.getElementById("peso_archivo_no_1").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById('peso_archivo_no_1').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido_1").style.display = "none";
    document.getElementById("peso_archivo_no_1").style.display = "block";
    document.getElementById("expe_archivo_1").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);

});

$('#expe_archivo_tipo2').bind('change', function () {

  //this.files[0].size gets the size of your file.
  var peso = (this.files[0].size);
  if (peso <= 3000000) {
    document.getElementById('peso_archivo_valido_tipo2').innerHTML = "Archivo válido";
    document.getElementById("peso_archivo_valido_tipo2").style.display = "block";
    document.getElementById("peso_archivo_no_tipo2").style.display = "none";
    // alert("Archivo valido");
  } else {
    document.getElementById('peso_archivo_no_tipo2').innerHTML = "El archivo sobre pasa los 3Mb máximos";
    document.getElementById("peso_archivo_valido_tipo2").style.display = "none";
    document.getElementById("peso_archivo_no_tipo2").style.display = "block";
    document.getElementById("expe_archivo_tipo2").value = '';
    // alert("Archivo NO valido");
  }
  // alert(this.files[0].size);

});