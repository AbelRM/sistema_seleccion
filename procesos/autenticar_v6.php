<?php
session_start();
if(!empty($_SESSION['active'])){
    $dni = $_POST['dni'];
    header("Location: ../user_postu/index.php?dni=$dni");
}else{
    if(empty($_POST['dni']) || empty($_POST['clave'])){
        header("Location: ../");
        echo '<script>
            alert("Ingrese su usuario y su contraseña!");
            window.location="../index.php";

        </script>';
        // $alert = 'Ingrese su clave y su clave';
    }else{
        require_once "../conexion.php";

        $dni = mysqli_real_escape_string($con,$_POST['dni']);
        $clave = md5(mysqli_real_escape_string($con,$_POST['clave']));

        $query = mysqli_query($con, "SELECT * FROM usuarios WHERE dni='$dni' AND clave='$clave' ");
        $result = mysqli_num_rows($query);

        if($result > 0){
            $data = mysqli_fetch_array($query);

            $query2 = mysqli_query($con,"SELECT * FROM usuarios WHERE dni='$dni' AND tipo_user='ESTUDIANTE' ");
            $resultado = mysqli_num_rows($query2);

            if($resultado > 0){
                $prueba="SELECT * FROM postulante where dni=$dni";
                $datos=mysqli_query($con,$prueba); 
                $fila= mysqli_fetch_array($datos);
                $idpostulante=$fila['idpostulante'];

                $resultado=$con->query("SELECT EXISTS (SELECT * FROM familia_post WHERE postulante_idpostulante=$idpostulante);");
                $row=mysqli_fetch_row($resultado);
                if ($row[0]=="1") {
                $idpostulante=$fila['idpostulante'];
                $_SESSION['active']=true;
                $_SESSION['idUser']=$data['iduser'];
                $_SESSION['dni']=$data['dni'];
                $_SESSION['correo']=$data['correo'];
                $_SESSION['rol']=$data['tipo_user'];

                header("Location: ../user_postu/index.php?dni=$dni");
                   
                }else{
                    header("Location: ../user_postu/ficha_wizard.php?dni=$dni");
                } 
            }else{
                $query3 = mysqli_query($con,"SELECT * FROM usuarios WHERE dni='$dni' AND tipo_user='ADMINISTRADOR' ");
                $resultado2 = mysqli_num_rows($query3);
                if($resultado2 > 0)
                $data2 = mysqli_fetch_array($query);
                $_SESSION['active']=true;
                $_SESSION['idUser']=$data2['iduser'];
                $_SESSION['dni']=$data2['dni'];
                $_SESSION['correo']=$data2['correo'];
                $_SESSION['rol']=$data2['tipo_user'];

                header("Location: ../user_admi/index.php?dni=$dni");
            }
            
        }else{
            echo '<script>
                alert("Usuario y/o contraseña incorrecta!");
                window.location="../index.php";
                </script>';
            
            // header("Location: ../");
            session_destroy();
        }
    }
}
?>