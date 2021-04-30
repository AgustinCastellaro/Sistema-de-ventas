<?php 
    include "../database/database.php";

    if($_POST){
        require_once("../database/database.php");

        //Busqueda Incremental.
        if($_POST['action'] == 'busquedaVenta'){
            $searchData = $_POST['id'];
            $query_select = mysqli_query($conection, "SELECT * FROM ventas WHERE 
                                                        idVenta     LIKE '%$searchData%' OR 
                                                        Fecha       LIKE '%$searchData%' OR
                                                        Nombre       LIKE '%$searchData%' OR 
                                                        Apellido       LIKE '%$searchData%' ");

            $num_rows = mysqli_num_rows($query_select);
            if($num_rows > 0){
                //Imprime la tabla.
                $htmlTable = '';
                while( $row = mysqli_fetch_assoc($query_select) ){ 
                    $htmlTable .=' <tr>
                                        <td>'.$row['idVenta'].'</td>
                                        <td>'.$row['Fecha'].'</td>
                                        <td>'.$row['Importe'].'</td>
                                        <td>'.$row['Apellido'].', '.$row['Nombre'].'</td>
                                        <td>'.$row['CondicionPago'].'</td>
                                        <td>'.$row['FormaDePago'].'</td>
                                        <td>
                                            <a class="btn_editar" href="ver_venta.php ? idVenta='.$row['idVenta'].'"><i class="fas fa-eye"></i> Ver</a>
                                        </td>
                                    </tr> ';

                }
                echo json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
            }else{
                echo "notData";
            }
            exit;

        }

        //Filtrar venta.
        if($_POST['action'] == 'filtrarVenta'){
            $fechaDesdeValue = $_POST['fechaDesdeValue'];
            $fechaHastaValue = $_POST['fechaHastaValue'];
            
            $query_select = mysqli_query($conection, "SELECT * FROM ventas 
                                                        WHERE Fecha 
                                                        BETWEEN '$fechaDesdeValue 00:00:00' AND '$fechaHastaValue 23:59:59' ");

            $num_rows = mysqli_num_rows($query_select);
            if($num_rows > 0){
                //Imprime la tabla.
                $htmlTable = '';
                while( $row = mysqli_fetch_assoc($query_select) ){ 
                    $htmlTable .=' <tr>
                                        <td>'.$row['idVenta'].'</td>
                                        <td>'.$row['Fecha'].'</td>
                                        <td>'.$row['Importe'].'</td>
                                        <td>'.$row['Apellido'].', '.$row['Nombre'].'</td>
                                        <td>'.$row['CondicionPago'].'</td>
                                        <td>'.$row['FormaDePago'].'</td>
                                        <td>
                                            <a class="btn_editar" href="ver_venta.php ? idVenta='.$row['idVenta'].'"><i class="fas fa-eye"></i> Ver</a>
                                        </td>
                                    </tr> ';

                }
                echo json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
            }else{
                echo "no hay fecha de esa venta";
            }
            exit;

        }

        //Quitar filtro.
        if($_POST['action'] == 'quitarFiltro'){
            $query_select = mysqli_query($conection, "SELECT * FROM ventas ");

            $num_rows = mysqli_num_rows($query_select);
            if($num_rows > 0){
                //Imprime la tabla.
                $htmlTable = '';
                while( $row = mysqli_fetch_assoc($query_select) ){ 
                    $htmlTable .=' <tr>
                                        <td>'.$row['idVenta'].'</td>
                                        <td>'.$row['Fecha'].'</td>
                                        <td>'.$row['Importe'].'</td>
                                        <td>'.$row['Apellido'].', '.$row['Nombre'].'</td>
                                        <td>'.$row['CondicionPago'].'</td>
                                        <td>'.$row['FormaDePago'].'</td>
                                        <td>
                                            <a class="btn_editar" href="ver_venta.php ? idVenta='.$row['idVenta'].'"><i class="fas fa-eye"></i> Ver</a>
                                        </td>
                                    </tr> ';

                }
                echo json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
            }else{
                echo "notData";
            }
            exit;

        }
        
        //Buscar producto en nueva venta.
        if($_POST['action'] == 'infoProducto'){
            
            if(!empty($_POST['id'])){
                $arrayProducto = array();
                $intId = intval($_POST['id']);
                $query_select = mysqli_query($conection,"SELECT idProducto, DescCorta, PrecioVenta, StockActual 
                                                        FROM productos 
                                                        WHERE idProducto = $intId");
                $num_rows = mysqli_num_rows($query_select);

                if($num_rows > 0){
                    $arrayProducto = mysqli_fetch_assoc($query_select);
                    $json = json_encode($arrayProducto,JSON_UNESCAPED_UNICODE);
                    print_r($json);
                }else{
                    echo "notData";
                }
                exit;
            }

        }

        //Agregar el producto a tabla Items.
        if($_POST['action'] == 'agregar_Producto'){
            if(empty($_POST['idProducto']) || empty($_POST['cantidad'])){
                echo "Error no hay producto";
            }else{
                //Setea las variables.
                $idProducto = $_POST['idProducto'];
                $cantidad = $_POST['cantidad'];
                $num_venta = $_POST['num_venta'];

                //Busca y selecciona el producto de la tabla Productos.
                $query_prod = mysqli_query($conection, "SELECT p.DescCorta, p.PrecioVenta, p.StockActual 
                                                        FROM productos p 
                                                        WHERE idProducto = $idProducto ");
                $resultado_prod = mysqli_num_rows($query_prod);

                if($resultado_prod > 0){
                    while($data = mysqli_fetch_array($query_prod)){
                        $DescCorta      = $data['DescCorta'];
                        $PrecioVenta    = $data['PrecioVenta'];
                        $StockActual    = $data['StockActual'];
                    }
                    $PrecioTotal = $PrecioVenta * $cantidad;
                }

                //Busca si ya esta cargado el item en la tabla items.
                $buscar_item = mysqli_query($conection,"SELECT i.idProducto FROM items i
                                                        WHERE idProducto = $idProducto AND idVenta = $num_venta ");

                $resultado_busqueda = mysqli_fetch_assoc($buscar_item);

                if($resultado_busqueda > 0){
                    //Actualiza la cantidad y el precio total.
                    mysqli_query($conection,"UPDATE items 
                                                SET cantidad = (cantidad + $cantidad), PrecioTotal = (PrecioTotal + $PrecioTotal)  
                                                WHERE idProducto = $idProducto 
                                                AND idVenta = $num_venta ");
                }else{
                    //Inserta el item en la tabla items con los valores de las variables.
                    $query_insert_items = mysqli_query($conection,"INSERT INTO items(idVenta, idProducto, DescCorta, Cantidad, PrecioUnitario, PrecioTotal) 
                                                                    VALUES('$num_venta', '$idProducto', '$DescCorta', '$cantidad', '$PrecioVenta', '$PrecioTotal')");
                }

                //Actualiza el stock del producto elegido.
                $NuevoStock = $StockActual - $cantidad;
                mysqli_query($conection,"UPDATE productos 
                                        SET StockActual = '$NuevoStock' 
                                        WHERE idProducto = $idProducto ");

                
                //Selecciona y muestra tabla de items en nueva venta.
                $query_table = mysqli_query($conection, "SELECT i.idItem, i.idProducto, i.DescCorta, i.Cantidad, i.PrecioUnitario, i.PrecioTotal 
                                                            FROM items i 
                                                            WHERE idVenta = $num_venta ");
                $num_rows = mysqli_num_rows($query_table);

                //Armo la tabla.
                if($num_rows > 0){
                    $htmlTable = '';
                    while( $data = mysqli_fetch_assoc($query_table) ){
                        $htmlTable .=' <tr>
                                            <td scope="row">'.$data['idProducto'].'</td>
                                            <td>'.$data['DescCorta'].'</td>
                                            <td>'.$data['Cantidad'].'</td>
                                            <td>'.$data['PrecioUnitario'].'</td>
                                            <td>'.$data['PrecioTotal'].'</td>
                                            <td>
                                                <a class="btn_eliminar" id="eliminar_item" href="#" onclick="event.preventDefault(); eliminar_item('.$data['idItem'].', '.$data['idProducto'].', '.$data['Cantidad'].');"><i class="far fa-trash-alt"></i> Eliminar</a>
                                            </td>
                                        </tr> ';

                    }

                    echo json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "Error no hay producto";
                }
                exit;

            }

        }

        //Busca los items con el id de Venta (num_venta) para modal Salir.
        if($_POST['action'] == 'boton_salir'){
            if(empty($_POST['num_venta'])){
                echo "Error no hay items con ese id";
            }else{
                //Setea la variable num_venta.
                $num_venta = $_POST['num_venta'];

                //Busca y selecciona los items de la tabla items.
                $query_search_items = mysqli_query($conection, "SELECT i.idVenta 
                                                                FROM items i 
                                                                WHERE idVenta = $num_venta ");
                $resultado_items = mysqli_num_rows($query_search_items);

                //Si existe.
                if($resultado_items > 0){
                    echo $resultado_items;
                }else{
                    echo "Error no hay items con ese id";
                }
                exit;

            }

        }

        //Elimina los items con el id de venta (num_venta) para modal Salir.
        if($_POST['action'] == 'eliminar_items'){
            if(empty($_POST['num_venta'])){
                echo "Error no hay items con ese id";
            }else{
                //Setea la variable num_venta.
                $num_venta = $_POST['num_venta'];

                //Selecciona los items para reponer el stock de los productos.
                $reponer_stock = mysqli_query($conection,"UPDATE productos
                                                            INNER JOIN items 
                                                            ON productos.idProducto = items.idProducto 
                                                            SET productos.StockActual = productos.StockActual+items.Cantidad 
                                                            WHERE idVenta = $num_venta ");
                
                if($reponer_stock > 0){

                    //Elimina los items con el numero de venta asignado.
                    $query_eliminar_items = mysqli_query($conection, "DELETE FROM items WHERE idVenta = $num_venta ");

                    //Si existe.
                    if($query_eliminar_items > 0){
                        echo $query_eliminar_items;
                    }else{
                        echo "Error no hay items con ese id";
                    }
                    exit;
                }else{
                    echo "Error no hay items con ese id";
                }
                exit;

            }

        }

        //Elimina el item con el idProducto y id de venta (num_venta) de la tabla.
        if($_POST['action'] == 'eliminar_item_tabla'){
            if(empty($_POST['idItem']) || empty($_POST['idProducto'])){
                echo "Error no hay items con ese id";
            }else{
                //Setea la variable num_venta.
                $num_venta  = $_POST['num_venta'];
                $idItem     = $_POST['idItem'];
                $idProducto = $_POST['idProducto'];
                $cantidad   = $_POST['Cantidad'];

                //Selecciona el item para reponer el stock del producto.
                $reponer_stock = mysqli_query($conection,"UPDATE productos
                                                            INNER JOIN items 
                                                            ON productos.idProducto = $idProducto 
                                                            SET productos.StockActual = productos.StockActual+$cantidad 
                                                            WHERE idVenta = $num_venta ");
                
                if($reponer_stock > 0){

                    //Elimina el item con el numero de venta asignado.
                    $query_eliminar_items = mysqli_query($conection, "DELETE FROM items 
                                                                        WHERE idVenta = $num_venta 
                                                                        AND idItem = $idItem ");

                    if($query_eliminar_items > 0){
                        //Selecciona y muestra tabla de items en nueva venta.
                        $query_table = mysqli_query($conection, "SELECT i.idItem, i.idProducto, i.DescCorta, i.Cantidad, i.PrecioUnitario, i.PrecioTotal 
                                                                    FROM items i 
                                                                    WHERE idVenta = $num_venta ");
                        $num_rows = mysqli_num_rows($query_table);

                        //Armo la tabla.
                        if($num_rows > 0){
                            $htmlTable = '';
                            while( $data = mysqli_fetch_assoc($query_table) ){
                                $htmlTable .=' <tr>
                                                    <td scope="row">'.$data['idProducto'].'</td>
                                                    <td>'.$data['DescCorta'].'</td>
                                                    <td>'.$data['Cantidad'].'</td>
                                                    <td>'.$data['PrecioUnitario'].'</td>
                                                    <td>'.$data['PrecioTotal'].'</td>
                                                    <td>
                                                        <a class="btn_eliminar" id="eliminar_item" href="#" onclick="event.preventDefault(); eliminar_item('.$data['idItem'].', '.$data['idProducto'].', '.$data['Cantidad'].');"><i class="far fa-trash-alt"></i> Eliminar</a>
                                                    </td>
                                                </tr> ';

                            }

                            //Imprime la tabla.
                            $json = json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
                            print_r($json);
                        }
                        //Imprime tabla vacia, despues de eliminar el ultimo producto.
                        else if($num_rows == 0){
                                $htmlTable = '';
                                while( $data = mysqli_fetch_assoc($query_table) ){
                                    $htmlTable .='';
    
                                }
    
                                //Imprime la tabla.
                                $json = json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
                                print_r($json);
                        }
                        exit;
                    }else{
                        echo "Error no hay items con ese id";
                    }
                    exit;
                }else{
                    echo "Error no hay items con ese id";
                }
                exit;

            }

        }

        //Actualiza el valor total de la venta.
        if($_POST['action'] == 'total_venta'){
            //Setea la variable.
            $num_venta = $_POST['num_venta'];

            //Selecciona el Precio Total de los items con el numero de venta.
            $precio_final = mysqli_query($conection, "SELECT SUM(PrecioTotal) 
                                                        FROM Items 
                                                        WHERE idVenta = $num_venta ");

            $number = mysqli_fetch_array($precio_final);
            $total = $number[0];
            echo $total;

        }

        //Calcula la cantidad de items con el numero de venta.
        if($_POST['action'] == 'cantidad_items'){
            //Setea la variable.
            $num_venta = $_POST['num_venta'];

            //Busca la cantidad de items.
            $cantidad_items = mysqli_query($conection, "SELECT COUNT(*) total 
                                                        FROM items 
                                                        WHERE idVenta = $num_venta ");

            $count_items = mysqli_fetch_assoc($cantidad_items);
            $total = $count_items["total"];
            if($total < "15"){
                echo $total;
            }
            if($total >= "15"){
                echo "Error la cantidad es mayor a 15";
            }            
            exit;
        }

        //Busca si el item ya esta cargado en la tabla de items con el id de Venta.
        if($_POST['action'] == 'buscar_item'){
            if(empty($_POST['num_venta'])){
                echo "Error";
            }else{
                //Setea las variables.
                $num_venta  = $_POST['num_venta'];
                $idProducto = $_POST['idProducto'];

                //Busca el item en la tabla items.
                $query_search_item = mysqli_query($conection, "SELECT i.idProducto, i.Cantidad 
                                                                FROM items i 
                                                                WHERE idVenta = $num_venta
                                                                AND idProducto = $idProducto ");
                $resultado_item = mysqli_num_rows($query_search_item);

                //Si existe.
                if($resultado_item > 0){
                    echo $resultado_item;
                }else{
                    echo "Error";
                }
                exit;

            }
        }

    }

?>