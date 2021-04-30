<?php

include "../database/database.php";

    if(!empty($_POST)){
        if(empty($_POST['idProducto']) || empty($_POST['Proveedor']) || empty($_POST['Marca']) || empty($_POST['DescCorta']) || 
            empty($_POST['DescLarga']) || empty($_POST['PrecioVenta']) || empty($_POST['PrecioCompra']) || empty($_POST['StockMinimo']) || 
            empty($_POST['StockInicial']) || empty($_POST['StockActual']) || empty($_POST['FechaUltimaCompra']) || empty($_POST['img_actual'])){
            echo "Todos los campos son obligatorios";
        }else{
            include "../database/database.php";

            $idProducto             = $_POST['idProducto'];
            $Proveedor              = $_POST['Proveedor'];
            $Marca                  = $_POST['Marca'];
            $DescCorta              = $_POST['DescCorta'];
            $DescLarga              = $_POST['DescLarga'];
            $PrecioVenta            = $_POST['PrecioVenta'];
            $PrecioCompra           = $_POST['PrecioCompra'];
            $StockMinimo            = $_POST['StockMinimo'];
            $StockInicial           = $_POST['StockInicial'];
            $StockActual            = $_POST['StockActual'];
            $FechaUltimaCompra      = $_POST['FechaUltimaCompra'];
            $img_producto           = $_POST['img_actual'];

            //Imagen
            $name_img               = $_FILES['Imagen']["name"];
            $type                   = $_FILES['Imagen']["type"];
            $url_tmp                = $_FILES['Imagen']["tmp_name"];
            
            if($name_img != ''){
                $destino        = '../img/productos/';
                $img_producto   = $name_img;
                $src            = $destino.$img_producto;
            }

            $query = mysqli_query($conection,"SELECT * FROM productos
                                                WHERE (idProducto != '$idProducto' AND DescCorta = '$DescCorta') ");

            $result = mysqli_fetch_array($query);

            if($result > 0){
                echo "El producto ya existe";
            }else{
                $sql_update = mysqli_query($conection,"UPDATE productos 
                                                        SET idProducto      = '$idProducto', 
                                                        Proveedor           = '$Proveedor', 
                                                        MarcaP              = '$Marca', 
                                                        DescCorta           = '$DescCorta', 
                                                        DescLarga           = '$DescLarga', 
                                                        PrecioVenta         = '$PrecioVenta', 
                                                        PrecioCompra        = '$PrecioCompra', 
                                                        StockMinimo         = '$StockMinimo', 
                                                        StockInicial        = '$StockInicial', 
                                                        StockActual         = '$StockActual', 
                                                        FechaUltimaCompra   = '$FechaUltimaCompra', 
                                                        Imagen              = '$img_producto' 
                                                        
                                                        WHERE idProducto    = $idProducto ");

                if($sql_update){

                    if( $name_img != '' && ($_POST['img_actual'] != 'default_box.jpg') ){
                        unlink( '../img/productos/'.$_POST['img_actual'] );
                    }
                    if($name_img != ''){
                        move_uploaded_file($url_tmp, $src);
                    }
                    echo "Producto actualizado correctamente";
                    header("Refresh:1; url=tabla_productos.php");
                }else{
                    echo "Error al actualizar el producto";
                }
            }
        }
    }

    //Mostrar datos
    if(empty($_GET['idProducto'])){
        header('Location: lista_productos.php');
    }
    $idProducto = $_GET['idProducto'];

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

    if($result == 0){
        header('Location: tabla_productos.php');
    }else{
        $NombreMarca = '';
        $NombreProveedor = '';
        while($data = mysqli_fetch_array($sql)){

            //Proveedor variables.
            $idProveedor            = $data['Proveedor'];   //Id de Proveedor.
            $NombrePv               = $data['NombrePv'];    //Nombre de Proveedor.
            //Marca variables.
            $idMarca                = $data['MarcaP'];      //Id de Marca.
            $NombreMa               = $data['Marca'];       //Nombre de Marca.

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

            $NombreMarca = '<option value="'.$idMarca.'" select>'.$NombreMa.'</option>';
            $NombreProveedor = '<option value="'.$idProveedor.'" select>'.$NombrePv.'</option>';
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
    
    <title>Editar producto</title>
</head>
<body style="background-color: rgb(238, 238, 238);">
    <!-- Menu  -->
    <?php include "../includes/nav.php"?>
    
    <br>
    <div class="contenido_producto">
        <form action="" method="POST" class="form-producto" enctype="multipart/form-data">
        <input type="hidden" name="img_actual" id="img_actual" value="<?php echo $Imagen;?>">
            <!-- Opciones -->
            <div class="opciones">
                <h1 class="titulo">EDITAR PRODUCTO</h1>
                <!-- Botones -->
                <div class="boton">
                    <a class="boton_cancelar" href="tabla_productos.php">Cancelar</a>
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

            <!-- Formulario -->
            <div class="formulario_producto">

                <div class="principal">                    
                    <div class="primero">
                        <div class="codigo">
                            <label for="codigo">Codigo</label>
                            <input type="text" name="idProducto" id="idProducto" class="form-control" placeholder="Codigo" tabindex="1" value="<?php echo $idProducto; ?>">
                        </div>
                        <div class="desc_corta">
                            <label for="descripcion_corta">Descripción Corta</label>
                            <input type="text" name="DescCorta" id="DescCorta" class="form-control" placeholder="Descripción Corta" tabindex="1" value="<?php echo $DescCorta; ?>">
                        </div>
                    </div>

                    <div class="img">
                        <img src="../img/productos/<?php echo $Imagen; ?>" alt="" name="Imagen" id="Imagen">
                        <input type="file" onchange="readURL(this);" name="Imagen" id="Imagen" title="">
                    </div>

                    <div class="segundo">
                        <div class="desc_larga">
                            <label for="descripción_larga">Descripción Larga</label>
                            <input type="text" name="DescLarga" id="DescLarga" class="form-control" placeholder="Descripción Larga" tabindex="1" value="<?php echo $DescLarga; ?>">
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
                        <select name="Marca" id="Marca" class="notItemOne">
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
                        <select name="Proveedor" id="Proveedor" class="notItemOne">
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
                        <input type="date" name="FechaUltimaCompra" id="FechaUltimaCompra" class="form-control" placeholder="Fecha ultima compra" tabindex="1" value="<?php echo $FechaUltimaCompra; ?>">
                    </div>
                </div>

                <div class="input-group">
                    <div class="Precio_venta">
                        <label for="precio venta">Precio Venta</label>
                        <input type="text" name="PrecioVenta" id="PrecioVenta" class="form-control" placeholder="Precio Venta" tabindex="1" value="<?php echo $PrecioVenta; ?>">
                    </div>
                    <div class="Precio_compra">
                        <label for="precio compra">Precio Compra</label>
                        <input type="text" name="PrecioCompra" id="PrecioCompra" class="form-control" placeholder="Precio Compra" tabindex="2" value="<?php echo $PrecioCompra; ?>">
                    </div>
                </div>

                <div class="input-group">
                    <div class="stock_minimo">
                        <label for="stock_minimo">Stock Minimo</label>
                        <input type="text" name="StockMinimo" id="StockMinimo" class="form-control" placeholder="Stock Minimo" tabindex="1" value="<?php echo $StockMinimo; ?>">
                    </div>
                    <div class="stock_actual">
                        <label for="stock_actual">Stock Actual</label>
                        <input type="text" name="StockActual" id="StockActual" class="form-control" placeholder="Stock Actual" tabindex="2" value="<?php echo $StockActual; ?>">
                    </div>
                    <div class="stock_inicial">
                        <label for="stock_inicial">Stock Inicial</label>
                        <input type="text" name="StockInicial" id="StockInicial" class="form-control" placeholder="Stock Inicial" tabindex="2" value="<?php echo $StockInicial; ?>">
                    </div>
                </div>

            </div>
                
        </form>
    </div>
</body>
</html>
