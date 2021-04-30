<?php

    include "../database/database.php";

    if(!empty($_POST)){
        $idProducto = $_POST['idProducto'];

        $query_eliminar = mysqli_query($conection, "DELETE FROM productos WHERE idProducto = $idProducto");

        if($query_eliminar){
            header("Location: tabla_productos.php");
        }else{
            echo "Error al eliminar el producto";
        }
    }


    if(empty($_REQUEST['idProducto'])){
        header("Location: tabla_productos.php");
    }else{
        $idProducto = $_REQUEST['idProducto'];

        $sql = mysqli_query($conection, "SELECT p.idProducto, p.Proveedor, pv.NombrePv, m.Marca, p.MarcaP, 
                                            p.DescCorta, p.DescLarga, p.PrecioVenta, p.PrecioCompra, p.StockMinimo, 
                                            p.StockInicial, p.StockActual, p.FechaUltimaCompra, p.Imagen 
                                        FROM productos p 
                                        INNER JOIN proveedores pv 
                                        ON p.Proveedor = pv.idProveedor 
                                        INNER JOIN marcas m 
                                        ON p.MarcaP = m.idMarca 
                                        AND idProducto = $idProducto ");

        $result = mysqli_num_rows($sql);

        if($result > 0){
            while($data = mysqli_fetch_array($sql)){

                //Proveedor variable.
                $Proveedor              = $data['Proveedor'];    //Nombre de Proveedor.
                //Marca variable.
                $Marca                  = $data['Marca'];       //Nombre de Marca.

                $idProducto             = $data['idProducto'];
                $DescCorta              = $data['DescCorta'];
                $DescLarga              = $data['DescLarga'];
                $PrecioVenta            = $data['PrecioVenta'];
                $PrecioCompra           = $data['PrecioCompra'];
                $StockMinimo            = $data['StockMinimo'];
                $StockInicial           = $data['StockInicial'];
                $StockActual            = $data['StockActual'];
                $FechaUltimaCompra      = $data['FechaUltimaCompra'];
                $Imagen                 = $data['Imagen'];
            }
        }else{
            header('Location: tabla_productos.php');
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
    
    <title>Eliminar producto</title>
</head>
<body style="background-color: rgb(238, 238, 238);">
    <!-- Menu  -->
    <?php include "../includes/nav.php"?>
    
    <br>
    <div class="contenido_producto">
        <form action="" method="POST" class="form-producto"  enctype="multipart/form-data">
            <!-- Opciones -->
            <div class="opciones">
                <h1 class="titulo">ELIMINAR PRODUCTO</h1>
                <!-- Botones -->
                <div class="boton">
                    <a class="boton_cancelar" href="tabla_productos.php">Cancelar</a>
                </div>
                <input type="submit" value="Eliminar" class="boton_success">
            </div>

            <div class="eliminar_cliente">
                <h4 class="eliminar_cliente">¿Seguro que quiere eliminar el producto</h4>
                <input type="hidden" name="idProducto" value="<?php echo $idProducto; ?>">
                
                <div class="formulario_producto">

                    <div class="principal">                    
                        <div class="primero">
                            <div class="codigo">
                                <label for="codigo">Codigo</label>
                                <input type="text" name="idProducto" id="idProducto" class="form-control" placeholder="Codigo" tabindex="1" value="<?php echo $idProducto; ?>" disabled>
                            </div>
                            <div class="desc_corta">
                                <label for="descripcion_corta">Descripción Corta</label>
                                <input type="text" name="DescCorta" id="DescCorta" class="form-control" placeholder="Descripción Corta" tabindex="1" value="<?php echo $DescCorta; ?>" disabled>
                            </div>
                        </div>

                        <div class="img">
                            <img src="../img/productos/<?php echo $Imagen; ?>" alt="" name="Imagen" id="Imagen" disabled>
                        </div>

                        <div class="segundo">
                            <div class="desc_larga">
                                <label for="descripción_larga">Descripción Larga</label>
                                <input type="text" name="DescLarga" id="DescLarga" class="form-control" placeholder="Descripción Larga" tabindex="1" value="<?php echo $DescLarga; ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="marca">
                            <label for="marca">Marca</label>
                            <?php 
                                $query_marca = mysqli_query($conection, "SELECT * FROM marcas ORDER BY Marca ASC");
                                $result_marca = mysqli_num_rows($query_marca);
                            ?>
                            <select name="Marca" id="Marca" class="notItemOne" disabled>
                            <?php
                                echo $NombreMarca;
                                if($result_marca > 0){
                                    while($Marca = mysqli_fetch_array($query_marca)){
                            ?>
                                <option value="<?php echo $Marca['idMarca']; ?>"><?php echo $Marca['Marca'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        <div class="proveedor">
                            <label for="Proveedor">Proveedor</label>
                            <?php 
                                $query_proveedor = mysqli_query($conection, "SELECT idProveedor, NombrePv FROM proveedores ORDER BY NombrePv ASC");
                                $result_proveedor = mysqli_num_rows($query_proveedor);
                            ?>
                            <select name="Proveedor" id="Proveedor" class="notItemOne" disabled>
                            <?php
                                echo $NombreProveedor;
                                if($result_proveedor > 0){
                                    while($Proveedor = mysqli_fetch_array($query_proveedor)){
                            ?>
                                <option value="<?php echo $Proveedor['idProveedor']; ?>"><?php echo $Proveedor['NombrePv'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        <div class="fechaUltCompra">
                            <label for="FechaUltimaCompra">Fecha ultima compra</label>
                            <input type="date" name="FechaUltimaCompra" id="FechaUltimaCompra" class="form-control" placeholder="Fecha ultima compra" tabindex="1" value="<?php echo $FechaUltimaCompra; ?>" disabled>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="Precio_venta">
                            <label for="precio venta">Precio Venta</label>
                            <input type="text" name="PrecioVenta" id="PrecioVenta" class="form-control" placeholder="Precio Venta" tabindex="1" value="<?php echo $PrecioVenta; ?>" disabled>
                        </div>
                        <div class="Precio_compra">
                            <label for="precio compra">Precio Compra</label>
                            <input type="text" name="PrecioCompra" id="PrecioCompra" class="form-control" placeholder="Precio Compra" tabindex="2" value="<?php echo $PrecioCompra; ?>" disabled>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="stock_minimo">
                            <label for="stock_minimo">Stock Minimo</label>
                            <input type="text" name="StockMinimo" id="StockMinimo" class="form-control" placeholder="Stock Minimo" tabindex="1" value="<?php echo $StockMinimo; ?>" disabled>
                        </div>
                        <div class="stock_actual">
                            <label for="stock_actual">Stock Actual</label>
                            <input type="text" name="StockActual" id="StockActual" class="form-control" placeholder="Stock Actual" tabindex="2" value="<?php echo $StockActual; ?>" disabled>
                        </div>
                        <div class="stock_inicial">
                            <label for="stock_inicial">Stock Inicial</label>
                            <input type="text" name="StockInicial" id="StockInicial" class="form-control" placeholder="Stock Inicial" tabindex="2" value="<?php echo $StockInicial; ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>                
                
        </form>
    </div>
    
</body>
</html>