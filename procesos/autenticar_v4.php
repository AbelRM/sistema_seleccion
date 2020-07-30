<?php 
    include_once '../conexion.php';

    session_start();

    if(isset($_GET['cerrar_sesion'])){
        session_unset();

        session_destroy();
    }
    // para q no ingrese a otra pagina q no debe
    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
            case 1:
                header("Location: ../user_postu/index.php?dni=$dni");
            break;

            case 2:
                header("Location: ../user_admi/index.php?dni=$dni");
            break;

            default:
        }
    }

    if(isset($_POST['dni']) && isset($_POST['clave'])){
        $dni=$_POST['dni'];
        $clave=$_POST['clave'];

        $query = mysqli_query ($con, "SELECT * FROM usuarios WHERE dni = '$dni' AND clave = '$password'");  
        // $db = new Database();
        // $query= $db->connect()->prepare('SELECT * FROM user WHERE dni= :dni and clave=:clave');
        $query->execute(['dni' => $dni, 'clave' => $clave]);

        $row = $query->fetch(PDO::FETCH_NUM);
        if($row == true){
            $rol = $row[10];
            $_SESSION['rol']=$rol;
            switch($_SESSION['rol']){
                case 1:
                    header("Location: ../user_postu/index.php?dni=$dni");
                break;
    
                case 2:
                    header("Location: ../user_admi/index.php?dni=$dni");
                break;
    
                default:
            }
        }else{
            echo "El usuario o la contraseña son incorrectos";
        }
    }
?>