<?php
    $alert = '';

    //Inicia la sesión.
    session_start();
    if(!empty($_SESSION['active'])){
        header("Location: inicio/index.php");
    }else{
        if(!empty($_POST)){
            if(empty($_POST['Usuario']) || empty($_POST['Contraseña'])){
                $alert = "Ingrese su usuario y contraseña";
            }else{
                require_once "database/database.php";

                $Usuario = mysqli_real_escape_string($conection, $_POST['Usuario']);
                $Contraseña = mysqli_real_escape_string($conection, $_POST['Contraseña']);

                $query = mysqli_query($conection,"SELECT * FROM usuarios
                                                    WHERE Usuario = '$Usuario' 
                                                    AND Contraseña = '$Contraseña' ");
                                                        
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                if($result > 0){
                    $data = mysqli_fetch_array($query);
                    $_SESSION['active'] = true;
                    $_SESSION['idUsuario']  = $data['idUsuario'];
                    $_SESSION['Usuario']    = $data['Usuario'];
                    $_SESSION['Email']      = $data['Email'];
                    $_SESSION['Contraseña'] = $data['Contraseña'];
                    $_SESSION['Rol']        = $data['Rol'];
                    $_SESSION['Imagen']     = $data['Imagen'];

                    header("Location: inicio/index.php");
                }else{
                    $alert = "Nombre de usuario o contraseña incorrectos";
                    session_destroy();
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="iniciar sesion/css-login/style.css">
        <script src="https://kit.fontawesome.com/2711e27f29.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
        <title>Sistema ventas</title>
    </head>
    <body class="body">
        <br>
        <br>
        <form action="" method="post">
            <div class="form">
                <div class="img">
                    <img src="iniciar sesion/img/1.jpg" alt="">
                </div>
                <div class="IS">
                    
                    <div class="top">
                        <p class="sv"> SISTEMA VENTAS</p>
                    </div>                    
                        
                    <div class="middle">
                        <label for="Usuario">Usuario</label>
                        <input type="text" name="Usuario" id="Usuario" class="Usuario" placeholder="Usuario">
                            
                        <label for="Contraseña">Contraseña</label>
                        <input type="password" name="Contraseña" id="Contraseña" class="contraseña" placeholder="Contraseña">

                        <input type="submit" class="boton-InicioSesion" value="Iniciar Sesión">
                        <p>No tienes cuenta?<a href="registrarse/index.php"> Regístrate</a></p>
                        <p><a href="#" class="contraseña">¿Olvidaste tu contraseña?</a></p>
                    </div>
                </div>
            </div>

        </form>

    </body>
</html>