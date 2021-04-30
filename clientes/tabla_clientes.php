<?php
    include "../database/database.php";

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
        <title>Lista clientes</title>
    </head>
    <body style="background-color: rgb(238, 238, 238);">
        <!-- Menu -->
        <?php include "../includes/nav.php"?>
    
    <br>
    <div class="contenido">
        <!-- Opciones -->
        <div class="opciones_tabla">
            <h1 class="titulo">CLIENTES</h1>
            
            <!-- Busqueda -->
            <input type="text" name="buscarCliente" id="buscarCliente" class="form-control" placeholder="Buscar" tabindex="1">

            <button><a class="pdf" href="#">PDF</a></button>

            <button><a class="añadir_cliente" href="añadir_cliente.php">Añadir Cliente</a></button>
        </div>
        
         <!-- Tabla clientes -->
         <div class="tabla table-responsive">
            <table class="table-hover">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre completo</th>
                        <th>Correo electronico</th>
                        <th>Telefono</th>
                        <th>Saldo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="rowsCliente">
                <?php
                    $query = mysqli_query($conection, "SELECT c.idCliente, c.Nombre, c.Apellido, c.Mail, c.CodigoDeArea, c.Telefono, c.Saldo FROM clientes c");

                    $resultado = mysqli_num_rows($query);

                    if($resultado > 0){
                        while($data = mysqli_fetch_array($query)){  
                ?>
                    <tr>
                        <td scope="row"><?php echo $data["idCliente"]; ?></td>
                        <td><?php echo $data["Apellido"]; ?>, <?php echo $data["Nombre"]; ?></td>
                        <td><?php echo $data["Mail"]; ?></td>
                        <td><?php echo $data["CodigoDeArea"]; ?> - <?php echo $data["Telefono"]; ?></td>
                        <td><?php echo $data["Saldo"]; ?></td>
                        <td>
                            <a class="btn_editar" href="editar_cliente.php ? idCliente=<?php echo $data["idCliente"]; ?>"><i class="far fa-edit"></i> Editar</a>
                            <a class="btn_eliminar" href="eliminar_cliente.php ? idCliente=<?php echo $data["idCliente"]; ?>"><i class="far fa-trash-alt"></i> Eliminar</a>
                        </td>
                    </tr> 
                <?php
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>