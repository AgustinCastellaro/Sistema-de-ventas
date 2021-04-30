<?php 
    if($_POST){
        require_once("../database/database.php");
        
        //Busqueda Incremental.
        if($_POST['action'] == 'busquedaProducto'){
            $searchData = $_POST['id'];
            $query_select = mysqli_query($conection, "SELECT p.idProducto, pv.NombrePv, m.Marca, p.DescCorta, p.PrecioVenta, p.StockActual 
                                                        FROM productos p 
                                                        INNER JOIN proveedores pv 
                                                        ON p.Proveedor = pv.idProveedor 
                                                        INNER JOIN marcas m 
                                                        ON p.MarcaP = m.idMarca 
                                                        WHERE idProducto        LIKE '%$searchData%' OR 
                                                                NombrePv        LIKE '%$searchData%' OR
                                                                Marca           LIKE '%$searchData%' OR
                                                                DescCorta       LIKE '%$searchData%' ");

            $num_rows = mysqli_num_rows($query_select);
            if($num_rows > 0){
                $htmlTable = '';
                while( $row = mysqli_fetch_assoc($query_select) ){                    
                    $htmlTable .=' <tr>
                                        <td scope="row">'.$row['idProducto'].'</td>
                                        <td>'.$row['NombrePv'].'</td>
                                        <td>'.$row['Marca'].'</td>
                                        <td>'.$row['DescCorta'].'</td>
                                        <td>'.$row['PrecioVenta'].'</td>
                                        <td>'.$row['StockActual'].'</td>
                                        <td>
                                            <a class="btn_editar" href="editar_producto.php ? idProducto='.$row['idProducto'].'"><i class="far fa-edit"></i> Editar</a>
                                            <a class="btn_eliminar" href="eliminar_producto.php ? idProducto='.$row['idProducto'].'"><i class="far fa-trash-alt"></i> Eliminar</a>
                                        </td>
                                    </tr> ';

                }
                echo json_encode($htmlTable,JSON_UNESCAPED_UNICODE);
            }else{
                echo "notData";
            }
            exit;

        }

    }

?>

                