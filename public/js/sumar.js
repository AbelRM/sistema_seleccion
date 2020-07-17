const inputs=document.querySelectorAll("input.sumar");
 
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