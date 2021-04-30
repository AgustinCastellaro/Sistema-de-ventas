<?php
    include "../database/database.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
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
        <title>Lista usuarios</title>
    </head>
    <body style="background-color: rgb(238, 238, 238);">
        <!-- Menu -->
        <?php include "../includes/nav.php"?>
    
    <br>
    <div class="contenido">
        <!-- Opciones -->
        <div class="opciones_tabla">
            <h1 class="titulo">USUARIOS</h1>
            
            <!-- Busqueda -->
            <form class="example" action="buscar_usuario.php" method="POST" action="" onSubmit="return validarForm(this)">
                    <input type="text" placeholder="Buscar" name="busqueda" value="">
            </form>

            <button><a class="pdf" href="#">PDF</a></button>

            <?php
            if($_SESSION['Rol'] == '1'){ ?>
                <button><a class="añadir_cliente" href="añadir_usuario.php">Añadir Usuario</a></button>
            <?php }
            ?>
        </div>
        
         <!-- Tabla usuarios -->
         <div class="tabla table-responsive">
            <table class="table-hover">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Usuario</th>
                    <th>Correo electronico</th>
                    <th>Rol</th>
                    <?php
                    if($_SESSION['Rol'] == '1'){ ?>
                        <th class="acciones">Acciones</th>
                    <?php }
                    ?>
                </tr>
            </thead>
            <?php
                $query = mysqli_query($conection, "SELECT u.idUsuario, u.Usuario, u.Email, r.Rol 
                                                    FROM usuarios u 
                                                    INNER JOIN roles r 
                                                    ON u.rol = r.idRol");

                $resultado = mysqli_num_rows($query);

                if($resultado > 0){
                    while($data = mysqli_fetch_array($query)){  
            ?>
                <tr>
                    <td><?php echo $data["idUsuario"]?></td>
                    <td><?php echo $data["Usuario"]?></td>
                    <td><?php echo $data["Email"]?></td>
                    <td><?php echo $data["Rol"]?></td>
                    <?php
                    if($_SESSION['Rol'] == '1'){ ?>
                            <td>
                                <a class="btn_editar" href="editar_usuario.php ? idUsuario=<?php echo $data["idUsuario"]; ?>"><i class="far fa-edit"></i> Editar</a>
                                <?php
                                if($_SESSION['idUsuario'] != $data["idUsuario"]){ ?>
                                    <a class="btn_eliminar" href="eliminar_usuario.php ? idUsuario=<?php echo $data["idUsuario"]; ?>"><i class="far fa-trash-alt"></i> Eliminar</a>
                                <?php }
                                ?>
                            </td>
                        <?php }
                        ?>
                    </tr> 
                <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>