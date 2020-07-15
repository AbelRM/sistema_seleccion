$(document).on('ready',constructor);
function constructor()
{
  SumarEntradas();
}

function SumarEntradas()
{
  $('#contenido').on('change','#curricular','#entrevista','#escrito',function(){
    var num1=parseInt($('#curricular').val());
    var num2=parseInt($('#entrevista').val());
    var num3=parseInt($('#escrito').val());
    if (isNaN(num1)) 
    {
      num1=0;
    }
    if (isNaN(num2)) 
    {
      num2=0;
    }
    if (isNaN(num3)) 
    {
      num3=0;
    }
    $('$total').val(num1+num2+num3);
  })
}