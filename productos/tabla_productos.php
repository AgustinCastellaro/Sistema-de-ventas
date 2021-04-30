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
        <script src="../includes/js/jquery-3.5.1.min.js" type="text/javascript"></script>
        <script src="../includes/js/funciones.js" type="text/javascript"></script>
        <!-- Titulo -->        
        <title>Lista productos</title>
    </head>
    <body style="background-color: rgb(238, 238, 238);">
        <!-- Menu -->
        <?php include "../includes/nav.php"?>
    
    <br>
    <div class="contenido">
        <!-- Opciones -->
        <div class="opciones_tabla">
            <h1 class="titulo">PRODUCTOS</h1>
            
            <!-- Busqueda -->
            <input type="text" name="buscarProducto" id="buscarProducto" placeholder="Buscar">

            <button><a class="pdf" href="#">PDF</a></button>

            <button><a class="añadir_cliente" href="añadir_producto.php">Añadir Producto</a></button>
        </div>
        
        <!-- Tabla productos -->
        <div class="tabla table-responsive">
            <table class="table-hover">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Proveedor</th>
                        <th>Marca</th>
                        <th>Descripción corta</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th class="acciones">Acciones</th>
                    </tr>
                </thead>
                <tbody id="rowsProducto">
                <?php
                    $query = mysqli_query($conection, "SELECT p.idProducto, pv.NombrePv, m.Marca, p.DescCorta, p.PrecioVenta, p.StockActual 
                                                        FROM productos p 
                                                        INNER JOIN proveedores pv 
                                                        ON p.Proveedor = pv.idProveedor
                                                        INNER JOIN marcas m
                                                        ON p.MarcaP = m.idMarca
                                                        ORDER BY p.idProducto ");

                    $resultado = mysqli_num_rows($query);

                    if($resultado > 0){
                        while($data = mysqli_fetch_array($query)){  
                ?>
                    <tr>
                        <td scope="row"><?php echo $data["idProducto"]; ?></td>
                        <td><?php echo $data["NombrePv"]; ?></td>
                        <td><?php echo $data["Marca"]; ?></td>
                        <td><?php echo $data["DescCorta"]; ?></td>
                        <td><?php echo $data["PrecioVenta"]; ?></td>
                        <td id="stock"><?php echo $data["StockActual"]; ?></td>
                        <td>
                            <a class="btn_editar" href="editar_producto.php ? idProducto=<?php echo $data["idProducto"]; ?>"><i class="far fa-edit"></i> Editar</a>
                            <a class="btn_eliminar" href="eliminar_producto.php ? idProducto=<?php echo $data["idProducto"]; ?>"><i class="far fa-trash-alt"></i> Eliminar</a>
                        </td>
                    </tr> 
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>