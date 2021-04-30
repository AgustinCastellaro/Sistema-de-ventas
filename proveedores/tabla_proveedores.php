<?php
    include "../database/database.php";

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
        
        <title>Lista proveedores</title>
    </head>
    <body style="background-color: rgb(238, 238, 238);">
        <!-- Menu -->
        <?php include "../includes/nav.php"?>
    
    <br>
    <div class="contenido">
        <!-- Opciones -->
        <div class="opciones_tabla">
            <h1 class="titulo">PROVEEDORES</h1>
            
            <!-- Busqueda -->
            <input type="text" name="buscarProveedor" id="buscarProveedor" class="form-control" placeholder="Buscar" tabindex="1">

            <button><a class="pdf" href="#">PDF</a></button>

            <button><a class="añadir_cliente" href="añadir_proveedor.php">Añadir Proveedor</a></button>
        </div>
        
        <!-- Tabla proveedores -->
        <div class="tabla table-responsive">
            <table class="table-hover">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Correo electronico</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th class="acciones">Acciones</th>
                    </tr>
                </thead>
            <?php
                $query = mysqli_query($conection, "SELECT p.idProveedor, p.NombrePv, p.Email, p.Dirección, p.CodigoDeArea, p.Telefono FROM proveedores p");

                $resultado = mysqli_num_rows($query);

                if($resultado > 0){
                    while($data = mysqli_fetch_array($query)){  
            ?>
                <tr>
                    <td scope="row"><?php echo $data["idProveedor"]; ?></td>
                    <td><?php echo $data["NombrePv"]; ?></td>
                    <td><?php echo $data["Email"]; ?></td>
                    <td><?php echo $data["Dirección"]; ?></td>
                    <td><?php echo $data["CodigoDeArea"]; ?> - <?php echo $data["Telefono"]; ?></td>
                    <td>
                        <a class="btn_editar" href="editar_proveedor.php ? idProveedor=<?php echo $data["idProveedor"]; ?>"><i class="far fa-edit"></i> Editar</a>
                        <a class="btn_eliminar" href="eliminar_proveedor.php ? idProveedor=<?php echo $data["idProveedor"]; ?>"><i class="far fa-trash-alt"></i> Eliminar</a>
                    </td>
                </tr> 
            <?php
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>