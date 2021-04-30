<?php

    include "../database/database.php";

    if(!empty($_POST)){
        $idUsuario = $_POST['idUsuario'];

        $query_eliminar = mysqli_query($conection, "DELETE FROM usuarios WHERE idUsuario = $idUsuario");

        if($query_eliminar){
            header("Location: tabla_usuarios.php");
        }else{
            echo "Error al eliminar al usuario";
        }
    }


    if(empty($_REQUEST['idUsuario'])){
        header("Location: tabla_usuarios.php");
    }else{
        $idUsuario = $_REQUEST['idUsuario'];
        $query = mysqli_query($conection, "SELECT u.Usuario, u.Email, u.Contraseña, r.Rol 
                                            FROM usuarios u 
                                            INNER JOIN roles r 
                                            ON u.rol = r.idRol 
                                            WHERE u.idUsuario = $idUsuario");

        $result = mysqli_num_rows($query);

        if($result > 0){
            while($data = mysqli_fetch_array($query)){
                $Usuario = $data['Usuario'];
                $Email = $data['Email'];
                $Contraseña = $data['Contraseña'];
                $Rol = $data['Rol'];
            }
        }else{
            header("Location: tabla_usuarios.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="../includes/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- fontawesome icons -->
    <script src="https://kit.fontawesome.com/2711e27f29.js" crossorigin="anonymous"></script>
    <!-- bootstrap link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jquery -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    <title>Eliminar usuario</title>
</head>
<body style="background-color: rgb(238, 238, 238);">
    <!-- Menu  -->
    <?php include "../includes/nav.php"?>
    
    <br>
    <br>
    <br>
    <div class="contenido">
        <!-- Opciones -->
        <form action="" method="POST">
        <div class="opciones">
            <h1 class="titulo">ELIMINAR USUARIO</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="tabla_usuarios.php">Cancelar</a>
            </div>
            <input type="submit" value="Eliminar" class="boton_success">
        </div>
        
        <!-- Formulario -->
        <div class="formulario">

            <div class="mensaje">
                <p class="dato">¿SEGURO QUE QUIERE ELIMINAR AL USUARIO</p>
                <p class="nombre"> <?php echo $Usuario; ?></p>
                <p class="dato">?</p>
            </div>

            <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
            <div class="input-group">
                <div class="Usuario">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="Usuario" id="Usuario" class="form-control" placeholder="Usuario" tabindex="2" value="<?php echo $Usuario; ?>" disabled>
                </div>
                <div class="Contraseña">
                    <label for="contraseña">Contraseña</label>
                    <input type="text" name="Contraseña" id="Contraseña" class="form-control" placeholder="Contraseña" tabindex="1" value="<?php echo $Contraseña; ?>" disabled>
                </div>
            </div>

            <label for="Email">Correo electronico</label>
            <input type="text" name="Email" id="Email" class="form-control" placeholder="Correo electronico" tabindex="1" value="<?php echo $Email; ?>" disabled>

            <label for="Rol">Rol</label>
            <input type="text" name="Rol" id="Rol" class="form-control" placeholder="Correo electronico" tabindex="1" value="<?php echo $Rol; ?>" disabled>

        </div>
        </form>
    </div>
</body>
</html>