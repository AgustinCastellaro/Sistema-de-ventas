<?php
    include "../database/database.php";


    //Datos Usuario.
    $idUsuario = $_GET['idUsuario'];

    $datos = mysqli_query($conection, "SELECT u.Usuario, u.Email, u.CodigoDeArea, u.Telefono 
                                        FROM usuarios u 
                                        WHERE u.idUsuario = $idUsuario ");
    
    $resultado = mysqli_num_rows($datos);

    while($data = mysqli_fetch_array($datos)){
        $Usuario = $data['Usuario'];
        $Email = $data['Email'];
        $CodigoDeArea = $data['CodigoDeArea'];
        $Telefono = $data['Telefono'];
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
    <div class="contenido_config">
        <!-- Opciones -->
        <div class="opciones">
            <h1 class="titulo">MI PERFIL</h1>

            <a class="configuracion_usuario" href="configuracion_usuario.php ? idUsuario=<?php echo $_SESSION["idUsuario"]; ?>" id="configuracionUsuario">Editar</a>
        </div>

        <div class="formulario_config">
            <div class="top">
                <div class="img">
                    <img src="/sistema ventas/img/usuarios/<?php echo $_SESSION['Imagen'];?>" alt="">
                </div>
                <div class="nombre">
                    <h1><?php echo $Usuario;?></h1>
                </div>
            </div>
            <div class="bottom">
                <div class="centro">
                    <div class="info">
                        <div class="icon">
                            <img src="../img/icons/usuario.svg" alt="">
                        </div>
                        <div class="datos">
                            <p>Usuario</p>
                            <h1><?php echo $Usuario;?></h1>
                        </div>
                    </div>
                    <div class="info">
                        <div class="icon">
                            <img src="../img/icons/email.svg" alt="">
                        </div>
                        <div class="datos">
                            <p>Email</p>
                            <h1><?php echo $Email;?></h1>
                        </div>
                    </div>
                    <div class="info">
                        <div class="icon">
                            <img src="../img/icons/telefono.svg" alt="">
                        </div>
                        <div class="datos">
                            <p>Telefono</p>
                            <h1><?php echo  $CodigoDeArea;?> - <?php echo $Telefono;?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>