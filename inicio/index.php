<?php
    include "../database/database.php";

    $sql = mysqli_query($conection, "SELECT COUNT(*) total FROM clientes");
    $count_clientes = mysqli_fetch_assoc($sql);
    $clientes = $count_clientes["total"];

    $sql = mysqli_query($conection, "SELECT COUNT(*) total FROM productos");
    $count_productos = mysqli_fetch_assoc($sql);
    $productos = $count_productos["total"];

    $sql = mysqli_query($conection, "SELECT COUNT(*) total FROM proveedores");
    $count_proveedores = mysqli_fetch_assoc($sql);
    $proveedores = $count_proveedores["total"];

    $sql = mysqli_query($conection, "SELECT COUNT(*) total FROM marcas");
    $count_marcas = mysqli_fetch_assoc($sql);
    $marcas = $count_marcas["total"];

    $sql = mysqli_query($conection, "SELECT COUNT(*) total FROM ventas");
    $count_ventas = mysqli_fetch_assoc($sql);
    $ventas = $count_ventas["total"];

    /*
    $sql = mysqli_query($conection, "SELECT COUNT(*) total FROM cobranzas");
    $count_cobranzas = mysqli_fetch_assoc($sql);
    $cobranzas = $count_cobranzas["total"];
    */

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
    <title>Inicio</title>
</head>
<body style="background-color: rgb(238, 238, 238);">
    <!-- Menu  -->
    <?php include "../includes/nav.php"?>
    
    <br>
    <br>

    <div class="contenido">
        <h1 class="titulo_inicio">Bienvenido al sistema</h1>
        <!-- Opciones -->
        <div class="opciones_caja">
            <button class="abrir_caja" id="abrir_caja" >Abrir Caja</button>
            <button class="cerrar_caja" id="cerrar_caja">Cerrar caja</button>
        </div>

        <br>
        <br>

        <div class="datos">
            <div class="clientes">
                <p class="cantidad"><?php echo $clientes?></p>
                <div class="titulo">
                    <p>Clientes</p>
                </div>
            </div>

            <div class="productos">
                <p class="cantidad"><?php echo $productos?></p>
                <div class="titulo">
                    <p>Productos</p>
                </div>
            </div>

            <div class="proveedores">
                <p class="cantidad"><?php echo $proveedores?></p>
                <div class="titulo">
                    <p>Proveedores</p>
                </div>
            </div>

            <div class="marcas">
                <p class="cantidad"><?php echo $marcas?></p>
                <div class="titulo">
                    <p>Marcas</p>
                </div>
            </div>

            <div class="ventas">
                <p class="cantidad"><?php echo $ventas?></p>
                <div class="titulo">
                    <p>Ventas</p>
                </div>
            </div>

            <div class="cobranzas">
                <p class="cantidad">20</p>
                <div class="titulo">
                    <p>Cobranzas</p>
                </div>
            </div>
        </div>

    </div>

</body>
</html>