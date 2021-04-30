<?php
    include "../database/database.php";

    //Datos Usuario.
    $idUsuario = $_GET['idUsuario'];

    $datos = mysqli_query($conection, "SELECT u.Usuario, u.Email, u.CodigoDeArea, u.Telefono, u.Contraseña 
                                        FROM usuarios u 
                                        WHERE u.idUsuario = $idUsuario ");
    
    $resultado = mysqli_num_rows($datos);

    while($data = mysqli_fetch_array($datos)){
        $Usuario = $data['Usuario'];
        $Email = $data['Email'];
        $CodigoDeArea = $data['CodigoDeArea'];
        $Telefono = $data['Telefono'];
        $Contraseña = $data['Contraseña'];
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!-- css -->
        <link rel="stylesheet" href="../includes/css/style.css">
        <!-- Font Roboto -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <!-- fontawesome icons -->
        <script src="https://kit.fontawesome.com/2711e27f29.js" crossorigin="anonymous"></script>
        <!-- bootstrap link -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- jquery -->
        <script src="../includes/js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <script src="../includes/js/funciones.js" type="text/javascript"></script>
        <!-- Titulo -->
        <title>Configuración</title>
    </head>
<body style="background-color: rgb(238, 238, 238);">
    <!-- Menu -->
    <?php include "../includes/nav.php"?>
    
    <br>
    <br>
    <div class="contenido_config_usuario">
        <!-- Opciones -->
        <div class="opciones">
            <h1 class="titulo">MI PERFIL</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="configuracion.php ? idUsuario=<?php echo $_SESSION["idUsuario"]; ?>" id="configuracionUsuario">Cancelar</a>
            </div>
            <input type="submit" value="Guardar" class="boton_success">
        </div>

        <!-- Script imagen -->
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#Imagen')
                            .attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <div class="formulario_config_edit">
            <div class="izq">
                <div class="img">
                    <img src="/sistema ventas/img/usuarios/<?php echo $_SESSION['Imagen'];?>" alt="" name="Imagen" id="Imagen">
                    <input type="file" onchange="readURL(this);" name="Img" id="Img" title="">
                </div>
            </div>
            <div class="medio">
                <p class="info1">INFORMACIÓN BASICA</p>
                <div class="info">
                    <div class="datos">
                        <p>Usuario</p>
                        <input type="text" name="Usuario" id="Usuario" class="form-control" placeholder="Usuario" tabindex="2" value="<?php echo $Usuario; ?>">
                    </div>
                    <div class="datos">
                        <p>Email</p>
                        <input type="text" name="Email" id="Email" class="form-control" placeholder="Email" tabindex="2" value="<?php echo $Email; ?>">
                    </div>
                    <div class="info_par">
                        <div class="datos">
                            <p>Codigo de area</p>
                            <input type="text" name="CodigoDeArea" id="CodigoDeArea" class="form-control" placeholder="CodigoDeArea" tabindex="2" value="<?php echo $CodigoDeArea; ?>">
                        </div>
                        <div class="datos">
                            <p>Telefono</p>
                            <input type="text" name="Telefono" id="Telefono" class="form-control" placeholder="Telefono" tabindex="2" value="<?php echo $Telefono; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="der">
                <p class="info2">CAMBIAR CONTRASEÑA</p>
                <div class="info">
                    <div class="datos">
                        <p>Contraseña Actual</p>
                        <input type="text" name="contraseñaActual" id="contraseñaActual" class="form-control" placeholder="Contraseña Actual" tabindex="2" value="<?php echo $Contraseña; ?>">
                    </div>
                    <div class="datos">
                        <p>Nueva Contraseña</p>
                        <input type="text" name="nuevaContraseña" id="nuevaContraseña" class="form-control" placeholder="Contraseña" tabindex="2">
                    </div>
                    <div class="datos">
                        <p>Confirmar Contraseña</p>
                        <input type="text" name="confirmarContraseña" id="confirmarContraseña" class="form-control" placeholder="Confirmar Contraseña" tabindex="2">
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>