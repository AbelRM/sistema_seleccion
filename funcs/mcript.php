<?php
//NUEVA FORMA DE ENCRIPTADO


define('METHOD', 'AES-256-CBC');
define('SECRET_KEY', 'diresa.micox');
define('SECRET_IV', '101712');
class SED
{
  public static function encryption($string)
  {
    $output = FALSE;
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
  }
  public static function decryption($string)
  {
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
    return $output;
  }
}
// $encriptado = SED::encryption($dni);
// echo "DATO ENCRIPTADO: " . $encriptado . "<br>";
// $encriptado = SED::decryption($encriptado);
// echo "DATO DESENCRIPTADO: " . $encriptado;

// //Configuración del algoritmo de encriptación

// //Debes cambiar esta cadena, debe ser larga y unica
// //nadie mas debe conocerla
// $clave  = 'micox.clave.diresa.seleccion';

// //Metodo de encriptación
// $method = 'aes-256-cbc';

// // Puedes generar una diferente usando la funcion $getIV()
// $iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw==");

// /*
//  Encripta el contenido de la variable, enviada como parametro.
//   */
// $encriptar = function ($valor) use ($method, $clave, $iv) {
//   return openssl_encrypt($valor, $method, $clave, false, $iv);
// };

// /*
//  Desencripta el texto recibido
//  */
// $desencriptar = function ($valor) use ($method, $clave, $iv) {
//   $encrypted_data = base64_decode($valor);
//   return openssl_decrypt($valor, $method, $clave, false, $iv);
// };

// /*
//  Genera un valor para IV
//  */
// $getIV = function () use ($method) {
//   return base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length($method)));
// };
