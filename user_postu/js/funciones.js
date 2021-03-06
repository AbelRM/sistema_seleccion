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

//TIPO 2
$(document).ready(function(){
    $('#titulo_value > option[value="<?php echo $titulo_value ?>"]').attr('selected', 'selected');
});
$(document).ready(function(){
    $('#grado_bachiller_value > option[value="<?php echo $titulo_value_2 ?>"]').attr('selected', 'selected');
});
$(document).ready(function(){
    $('#titulo_especialidad_value > option[value="<?php echo $titulo_value_3?>"]').attr('selected', 'selected');
});
$(document).ready(function(){
    $('#egresado_especialidad_value > option[value="<?php echo $titulo_value_4?>"]').attr('selected', 'selected');
});
$(document).ready(function(){
    $('#grado_maestria_value > option[value="<?php echo $titulo_value_5?>"]').attr('selected', 'selected');
});
$(document).ready(function(){
    $('#constancia_egre_maestria_value > option[value="<?php echo $titulo_value_6?>"]').attr('selected', 'selected');
});
$(document).ready(function(){
    $('#grado_doctorado_value > option[value="<?php echo $titulo_value_7?>"]').attr('selected', 'selected');
});
$(document).ready(function(){
    $('#constancia_egre_doctorado_value > option[value="<?php echo $titulo_value_8?>"]').attr('selected', 'selected');
});

function titulo(value)
{
    if(value=="SI" || value==true)
    {
        document.getElementById("grado_bachiller").disabled=true;
    }else if(value=="NO" || value==false){
        document.getElementById("grado_bachiller").disabled=false;
    }
}

function bachiller(value)
{
    if(value=="SI" || value==true)
    {
        document.getElementById("titulo_profesional").disabled=true;
    }else if(value=="NO" || value==false){
        document.getElementById("titulo_profesional").disabled=false;
    }
}

function especialidad(value)
{
    if(value=="SI" || value==true)
    {
        document.getElementById("egresado_especialidad").disabled=true;
    }else if(value=="NO" || value==false){
        document.getElementById("egresado_especialidad").disabled=false;
    }
}

function egre_especialidad(value)
{
    if(value=="SI" || value==true)
    {
        document.getElementById("titulo_especialidad").disabled=true;
    }else if(value=="NO" || value==false){
        document.getElementById("titulo_especialidad").disabled=false;
    }
}

function maestria(value)
{
    if(value=="SI" || value==true)
    {
        document.getElementById("constancia_egre_maestria").disabled=true;
    }else if(value=="NO" || value==false){
        document.getElementById("constancia_egre_maestria").disabled=false;
    }
}

function egre_maestria(value)
{
    if(value=="SI" || value==true)
    {
        document.getElementById("grado_maestria").disabled=true;
    }else if(value=="NO" || value==false){
        document.getElementById("grado_maestria").disabled=false;
    }
}

function doctorado(value)
{
    if(value=="SI" || value==true)
    {
        document.getElementById("constancia_egre_doctorado").disabled=true;
    }else if(value=="NO" || value==false){
        document.getElementById("constancia_egre_doctorado").disabled=false;
    }
}

function egre_doctorado(value)
{
    if(value=="SI" || value==true)
    {
        document.getElementById("grado_doctorado").disabled=true;
    }else if(value=="NO" || value==false){
        document.getElementById("grado_doctorado").disabled=false;
    }
}