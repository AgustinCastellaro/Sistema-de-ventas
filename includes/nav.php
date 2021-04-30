<?php
    session_start();
    if(empty($_SESSION['active'])){
        header("Location: ../inicio/index.php");
    }
?>

<nav class="nav-1">
    <div class="center">
        <div class="dropdown">
            <button type="button" class="dropdown-button" id="dropdown-button"><i class="fas fa-caret-down"></i></button>

            <div class="dropdown-menu" id="dropdown-menu">
                <button class="dropdown-item" type="button"><a href="/sistema ventas/configuracion/configuracion.php ? idUsuario=<?php echo $_SESSION["idUsuario"]; ?>"><i class="fas fa-cog"></i> Configuración</a></button>
                <button class="dropdown-item" type="button"><a href="/sistema ventas/includes/salir.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></button>
            </div>

            <img src="/sistema ventas/img/usuarios/<?php echo $_SESSION['Imagen'];?>" class="img_perfil" alt="">
            
            <p><?php echo $_SESSION['Usuario'];?></p>
        </div>   

        <button class="CajaAbierta" id="CajaAbierta">Caja abierta</button>

        <h1>Sistema Ventas</h1>
    </div>
</nav>

<nav class="nav-2">
    <div class="center">
        <ul>
            <li><a href="/sistema ventas/inicio/index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="/sistema ventas/clientes/tabla_clientes.php"><i class="fas fa-user"></i> Clientes</a></li>
            <li><a href="/sistema ventas/productos/tabla_productos.php"><i class="fas fa-archive"></i> Productos</a></li>
            <li><a href="/sistema ventas/proveedores/tabla_proveedores.php"><i class="fas fa-user-tie"></i> Proveedores</a></li>
            <li><a href="/sistema ventas/marcas/tabla_marcas.php"><i class="fas fa-tag"></i> Marcas</a></li>
            <li class="dropdown"><a href="/sistema ventas/ventas/tabla_ventas.php"><i class="fas fa-coins"></i> Ventas</a></li>
            <?php 
                if($_SESSION['Rol'] == '1'){
            ?>
                <li><a href="/sistema ventas/usuarios/tabla_usuarios.php"><i class="fas fa-users"></i> Usuarios</a>
            <?php
                }
            ?>
        </ul>
    </div>
</nav>