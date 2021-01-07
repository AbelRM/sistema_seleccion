
<?php
$micarpeta = $_SERVER['DOCUMENT_ROOT'] . '/sistema_seleccion/user_postu/archivos/' . $dni . '/Diplomados/';

echo $micarpeta;
// $dni = 45817607;

// define('METHOD', 'AES-256-CBC');
// define('SECRET_KEY', 'diresa.micox');
// define('SECRET_IV', '101712');
// class SED
// {
//   public static function encryption($string)
//   {
//     $output = FALSE;
//     $key = hash('sha256', SECRET_KEY);
//     $iv = substr(hash('sha256', SECRET_IV), 0, 16);
//     $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
//     $output = base64_encode($output);
//     return $output;
//   }
//   public static function decryption($string)
//   {
//     $key = hash('sha256', SECRET_KEY);
//     $iv = substr(hash('sha256', SECRET_IV), 0, 16);
//     $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
//     return $output;
//   }
// }
// $encriptado = SED::encryption($dni);
// echo "DATO ENCRIPTADO: " . $encriptado . "<br>";
// $encriptado = SED::decryption($encriptado);
// echo "DATO DESENCRIPTADO: " . $encriptado;
