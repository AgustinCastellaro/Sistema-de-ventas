<?php
    if(!empty($_POST)){

        if(empty($_POST['Usuario']) || empty($_POST['Email']) || empty($_POST['Contraseña'])){
            echo "Debes rellenar todos los campos";
        }else{
            include "../database/database.php";

            $Usuario = $_POST['Usuario'];
            $Email = $_POST['Email'];
            $Contraseña = $_POST['Contraseña'];

            $query = mysqli_query($conection,"SELECT * FROM usuarios
                                                WHERE Usuario = '$Usuario' ");
                                                    
            $resultado_nombre_usuario = mysqli_fetch_array($query);

            $query = mysqli_query($conection,"SELECT * FROM usuarios 
                                                WHERE Email = '$Email' ");
                                                    
            $resultado_email_usuario = mysqli_fetch_array($query);

            if($resultado_nombre_usuario > 0){
                echo "Nombre de usuario ya existe";
            }else if($resultado_email_usuario > 0){
                    echo "Email ya existe";
            }else{
                $query_insert = mysqli_query($conection,"INSERT INTO usuarios(Usuario, Email, Contraseña, Rol, Imagen)
                                                        VALUES ('$Usuario', '$Email', '$Contraseña', '2', 'user.svg')");

                if($query_insert){
                    echo "Usuario creado correctamente";
                }else{
                    echo "Error al crear el usuario";
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
        <link rel="stylesheet" href="css-register/style.css">
        <script src="https://kit.fontawesome.com/2711e27f29.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
        <title>Registración</title>
    </head>
    <body class="body">
        <br>
        <br>
        <form action="" method="post">
            <div class="form">
                <div class="img">
                    <img src="img/1.jpg" alt="">
                </div>
                
                <div class="IS">
                    <div class="top">
                        <p class="sv"> SISTEMA VENTAS</p>
                    </div>                    
                        
                    <div class="middle">
                        <label for="Usuario">Usuario</label>
                        <input type="text" name="Usuario" id="Usuario" class="Usuario" placeholder="Usuario">

                        <label for="Email">Email</label>
                        <input type="text" name="Email" id="Email" class="Email" placeholder="Usuario">
                            
                        <label for="Contraseña">Contraseña</label>
                        <input type="password" name="Contraseña" id="Contraseña" class="contraseña" placeholder="Contraseña">

                        <input type="submit" class="boton-InicioSesion" value="Registrarse">
                        <p>Tienes cuenta?<a href="../index.php"> Inicia Sesión</a></p>
                    </div>
                </div>
            </div>

        </form>

    </body>
</html>