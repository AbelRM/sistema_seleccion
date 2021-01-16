// $(document).ready(function (){
//   $('#contenido').on('change','#valor_1','#valor_2','#valor_3','#valor_4','#valor_5',function(){
//     var num1= parseInt($('#valor_1').val());
//     var num2= parseInt($('#valor_2').val());
//     var num3= parseInt($('#valor_3').val());
//     var num4= parseInt($('#valor_4').val());
//     var num5= parseInt($('#valor_5').val());
//     if(isNaN(num1)){
//       num1=0;
//     }
//     if(isNaN(num2)){
//       num2=0;
//     }
//     if(isNaN(num3)){
//       num3=0;
//     }
//     if(isNaN(num4)){
//       num4=0;
//     }
//     if(isNaN(num5)){
//       num5=0;
//     }
//     $('#total').val(num1+num2+num3+num4+num5);
//   });
// });

const inputs=document.querySelectorAll("input.valor");
 
// creamos el evento keyup para cada input que tiene la clase .sumar
for(el of inputs) {
    el.addEventListener("keyup", sumar);
}
 
/**
 * Funcion que se ejecuta cada vez que se añade una letra en un cuadro de texto
 * Suma los valores de los cuadros de texto
 */
function sumar()
{
    let sum=[...inputs].reduce((acum, el)=>{
        return (verificar(el)) ? acum+parseFloat(el.value) : acum;
    },0);
    document.getElementById("total").value=sum.toFixed(2);
}
 
/**
 * Funcion para verificar los valores de los cuadros de texto. Si no es un
 * valor numerico, cambia de color el borde del cuadro de texto y devuelve false
 *
 * @param object el - elemento input
 *
 * @return boolean
 */
function verificar(el)
{
    el.classList.remove("red", "green");
    if (/^[0-9]*\.?[0-9]+$/.test(el.value)) {
        el.classList.add("green");
        return true;
    } else {
        if (el.value) {
            el.classList.add("red");
        }
        return false;
    }
}
