<?php 
    if($_POST){
        require_once("../database/database.php");
        
        //Busqueda Incremental.
        if($_POST['action'] == 'busquedaCliente'){
            $searchData = $_POST['id'];
            $query_select = mysqli_query($conection, "SELECT * FROM clientes WHERE 
                                                        idCliente   LIKE '%$searchData%' OR 
                                                        Nombre      LIKE '%$searchData%' OR
                                                        Apellido    LIKE '%$searchData%' OR
                                                        Mail        LIKE '%$searchData%' ");

            $num_rows = mysqli_num_rows($query_select);
            if($num_rows > 0){
                $htmlTable = '';
                while( $row = mysqli_fetch_assoc($query_select) ){                    
                    $htmlTable .=' <tr>
                                        <td scope="row">'.$row['idCliente'].'</td>
                                        <td>'.$row['Apellido'].', '.$row['Nombre'].'</td>
                                        <td>'.$row['Mail'].'</td>
                                        <td>'.$row['CodigoDeArea'].' - '.$row['Telefono'].'</td>
                                        <td>'.$row['Saldo'].'</td>
                                        <td>
                                            <a class="btn_editar" href="editar_cliente.php ? idCliente='.$row['idCliente'].'"><i class="far fa-edit"></i> Editar</a>
                                            <a class="btn_eliminar" href="eliminar_cliente.php ? idCliente='.$row['idCliente'].'"><i class="far fa-trash-alt"></i> Eliminar</a>
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

                