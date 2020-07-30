
<?php
// $alert = '';

session_start();
if(!empty($_SESSION['active'])){
    $dni = $_POST['dni'];
    header("Location: ../user_postu/index.php?dni=$dni");
}else{
    if(empty($_POST['dni']) || empty($_POST['clave'])){
        header("Location: ../");
          
        // $alert = 'Ingrese su clave y su clave';
    }else{
        require_once "../conexion.php";

        $dni = mysqli_real_escape_string($con,$_POST['dni']);
        $clave = md5(mysqli_real_escape_string($con,$_POST['clave']));

        $query = mysqli_query($con, "SELECT * FROM usuarios WHERE dni='$dni' AND clave='$clave' ");
        $result = mysqli_num_rows($query);

        if($result > 0){
            $data = mysqli_fetch_array($query);
            // $tipo_user=$data['tipo_user'];

            $query2 = mysqli_query($con,"SELECT * FROM usuarios WHERE dni='$dni' AND tipo_user='POSTULANTE' ");
            $resultado = mysqli_num_rows($query2);

            if($resultado > 0){
                $_SESSION['active']=true;
                $_SESSION['idUser']=$data['iduser'];
                $_SESSION['dni']=$data['dni'];
                $_SESSION['correo']=$data['correo'];
                $_SESSION['rol']=$data['tipo_user'];

                header("Location: ../user_postu/index.php?dni=$dni");
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
            
            header("Location: ../");
            session_destroy();
        }
    }
}
?>