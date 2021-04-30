<?php

    if(!empty($_POST)){

        if(empty($_POST['Usuario']) || empty($_POST['Email']) || empty($_POST['CodigoDeArea']) || empty($_POST['Telefono']) || empty($_POST['Contraseña']) || empty($_POST['ConfirmarContraseña'])){
            echo "Debes rellenar todos los campos";
        }else{
            include "../database/database.php";

            $Usuario = $_POST['Usuario'];
            $Email = $_POST['Email'];
            $CodigoDeArea = $_POST['CodigoDeArea'];
            $Telefono = $_POST['Telefono'];
            $Contraseña = $_POST['Contraseña'];
            $ConfirmarContraseña = $_POST['ConfirmarContraseña'];

            if($Contraseña == $ConfirmarContraseña){
                
                $query = mysqli_query($conection,"SELECT * FROM usuarios
                                                    WHERE Email = '$Email' ");
                                                    
                $result = mysqli_fetch_array($query);
    
                if($result > 0){
                    echo "El Correo electronico ya existe";
                }else{
                    $query_insert = mysqli_query($conection,"INSERT INTO usuarios(Usuario, Email, Rol, Imagen, CodigoDeArea, Telefono, Contraseña)
                                                            VALUES ('$Usuario', '$Email', '2', 'user.png', '$CodigoDeArea', '$Telefono', '$Contraseña')");
    
                    if($query_insert){
                        echo "Cliente creado correctamente";
                        header("Refresh:2; url=tabla_usuarios.php");
                    }else{
                        echo "Error al crear el cliente";
                    }
                }
            }else{
                echo "Contraseñas distintas";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../includes/css/style.css">
    <script src="https://kit.fontawesome.com/2711e27f29.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
    <title>Nuevo cliente</title>
</head>
<body style="background-color: rgb(238, 238, 238);">
    <!-- Menu  -->
    <?php include "../includes/nav.php"?>
    
    <br>
    <br>
    <br>
    <div class="contenido">
    <form action="" method="POST">
        <!-- Opciones -->
        <div class="opciones">
            <h1 class="titulo">NUEVO CLIENTE</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="tabla_usuarios.php">Cancelar</a>
            </div>
            <input type="submit" value="Añadir" class="boton_success">
        </div>
        
        <!-- Formulario -->        
        <div class="formulario">

            <div class="input-group">
                <div class="Nombre">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="Usuario" id="Usuario" class="form-control" placeholder="Usuario" tabindex="1">
                </div>
                <div class="Nombre">
                    <label for="rol">Rol</label>
                    <input type="text" name="Rol" id="Rol" class="form-control" placeholder="Rol" tabindex="1" value="Supervisor" disabled>
                </div>
            </div>

            <label for="Email">Email</label>
            <input type="text" name="Email" id="Email" class="form-control" placeholder="Email" tabindex="1">

            <div class="input-group">
                <div class="Codigo de Area">
                    <label for="Codigo de Area">Codigo de Area</label>
                    <input type="text" name="CodigoDeArea" id="CodigoDeArea" class="form-control" placeholder="CodigoDeArea" tabindex="1">
                </div>
                <div class="Telefono">
                    <label for="Telefono">Telefono</label>
                    <input type="text" name="Telefono" id="Telefono" class="form-control" placeholder="Telefono" tabindex="2">
                </div>
            </div>

            <div class="input-group">
                <div class="Apellido">
                    <label for="Contraseña">Contraseña</label>
                    <input type="text" name="Contraseña" id="Contraseña" class="form-control" placeholder="Contraseña" tabindex="1">
                </div>
                <div class="Nombre">
                    <label for="Contraseña">Confirmar Contraseña</label>
                    <input type="text" name="ConfirmarContraseña" id="ConfirmarContraseña" class="form-control" placeholder="Confirmar Contraseña" tabindex="2">
                </div>
            </div>
                
        </div>
        </form>

    </div>
</body>
</html>