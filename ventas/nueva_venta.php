<?php
    include "../database/database.php";

    /* Numero de venta */
    $sql = mysqli_query($conection, "SELECT v.idVenta FROM ventas v ");
    while($data = mysqli_fetch_array($sql)){
        $idVenta = $data['idVenta'] + 1;
    }

    /* Fecha de venta */
    date_default_timezone_set("America/Argentina/Cordoba");

    $fechaDia   =  date("d");
    $fechaMes   =  date("m");
    $fechaAño   =  date("Y");

    $MostrarFecha = $fechaDia."/".$fechaMes."/".$fechaAño;

    $date = date_create();
    $fechaActual = date_format($date, 'Y-m-d H:i:s');


    /* Grabar venta */
    if(isset($_POST['grabar_venta'])){
        if(!empty($_POST)){

            if(!empty($_POST['numero_venta']) || !empty($_POST['fecha_pc']) || !empty($_POST['Cliente']) 
                || !empty($_POST['condicion_Pago']) || !empty($_POST['forma_pago']) || !empty($_POST['Total'])){

                if($_POST['condicion_Pago'] == "Cuenta corriente"){
                    $_POST['forma_pago'] = "N/a";
                }

                $numero_venta       = $_POST['numero_venta'];
                $fechaActual;
                $idCliente          = $_POST['Cliente'];
                $condicion_Pago     = $_POST['condicion_Pago'];
                $forma_pago         = $_POST['forma_pago'];
                $Total              = $_POST['Total'];

                echo $fechaActual;

                if($idCliente == "Cliente Default"){
                    $Nombre = "Cliente";
                    $Apellido = "Default";
                }else{
                    //Selecciona el Nombre y Apellido del cliente.
                    $Select_N_A = mysqli_query($conection,"SELECT c.Nombre, c.Apellido 
                                                            FROM clientes c 
                                                            WHERE c.idCliente = '$idCliente' ");
    
                    $resultado_Select = mysqli_num_rows($Select_N_A);
                    
                    if($resultado_Select > 0){
                        while($data = mysqli_fetch_array($Select_N_A)){
                            $Nombre = $data["Nombre"];
                            $Apellido = $data["Apellido"];
                        }
    
                    }
                }


                //Verifica que no haya una venta con el mismo numero.
                $query = mysqli_query($conection,"SELECT idVenta FROM ventas
                                                    WHERE idVenta = '$numero_venta' ");
                                                    
                $resultado = mysqli_fetch_array($query);

                if($resultado > 0){
                    echo "Error ya hay una venta con el mismo numero";
                }else{
                    //Carga en la tabla ventas, los datos.
                    $query_insert = mysqli_query($conection,"INSERT INTO ventas(idVenta, Fecha, Importe, Cliente, Nombre, Apellido, CondicionPago, FormaDePago)
                                                            VALUES ('$numero_venta', '$fechaActual', '$Total', '$idCliente', '$Nombre', '$Apellido', '$condicion_Pago', '$forma_pago') ");


                    //Actualiza el Saldo del cliente, si el pago es Cuenta corriente.
                    if($_POST['condicion_Pago'] == "Cuenta corriente"){
                        $query_saldo = mysqli_query($conection,"UPDATE clientes 
                                                            SET Saldo = Saldo + '$Total' 
                                                            WHERE idCliente = $idCliente ");
                    }

                    if($query_insert){
                        echo "Venta realizada correctamente";
                        header("Refresh: 0.2; url=tabla_ventas.php");
                    }else{
                        echo "Error al realizar la venta";
                    }
                }

            }else{
                echo "Error";
            }

            print_r($_POST); //Quitar
        }
    }

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
        <title>Nueva venta</title>
    </head>

    <body style="background-color: rgb(238, 238, 238);">
    <!-- Menu -->  
    <div class="contenido_venta">
        <form action="" method="POST">
            <!-- Opciones -->
            <div class="opciones">
                <h1 class="titulo">NUEVA VENTA</h1>
                <!-- Botones -->
                <div class="boton">
                    <button class="boton_cancelar" id="boton_salir" tabindex="11">Salir</button>
                    <input type="submit" name="grabar_venta" id="grabar_venta" class="boton_success" value="Grabar Venta" tabindex="12">
                </div>
            </div>
            
            <!-- Modal Salir -->
            <div class="modal-fondo" id="modalFondoSalir">
                <div class="modal-salir" id="modal-salir">
                    <div class="m-top">
                        <h1>¿Seguro que quiere salir?</h1>
                    </div>
                    <div class="m-body">
                        <p>Todavia hay </p>
                        <p id="salir_value">0</p>
                        <p>item/s cargados para vender</p>
                    </div>
                    <div class="m-footer">
                        <button class="boton_cancelar" id="btn_cancelarSalirModal">Cancelar</button>
                        <input type="submit" value="Salir" class="boton_success" id="btn_salir">
                    </div>
                </div>
            </div>

            <!-- Modal Limite cantidad items -->
            <div class="modal-fondo-items" id="modalFondoLimite">
                <div class="modal-cantidad-items" id="modal-salir">
                    <div class="m-top">
                        <h1>Solamente se pueden cargar 15 Items</h1>
                    </div>
                    <div class="m-body">
                    </div>
                    <div class="m-footer">
                        <button class="boton_aceptar" id="btn_AceptarModal">Aceptar</button>
                    </div>
                </div>
            </div>

            <!-- Formulario de venta -->
            <div class="formulario_venta">
                <!-- Datos -->
                <div class="datos" id="datos">
                    <div class="Codigo">
                        <label for="Codigo">Código</label>
                        <input type="text" name="idVenta" class="idVenta" id="idVenta" placeholder="Código" tabindex="1">
                    </div>
                    <div class="Descripcion">
                        <label for="Descripción">Descripción</label>
                        <p id="descripcion">-</p>
                    </div>                        
                    <div class="Cantidad">
                        <label for="Cantidad">Cantidad</label>
                        <input type="text" name="Cantidad" id="Cantidad" placeholder="Cantidad" value="0" disabled tabindex="2">
                    </div>
                    <div class="PrecioUnitario">
                        <label for="PrecioUnitario">Precio Unitario</label>
                        <p id="precioUnitario">-</p>
                    </div>
                    <div class="Total">
                        <label for="Total">Total</label>
                        <p id="total">-</p>
                    </div>
                    <button type="submit" class="boton_success" id="cargarItem" tabindex="3">Cargar Item</button>
                </div>

                <!-- Tabla -->
                <div class="items">
                    <div class="tabla table-responsive">
                        <table class="table-hover" id="rowsItems">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="table" id="tabla">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- formulario de datos -->
                <div class="form_datos">

                    <div class="input-group">
                        <div class="CodigoyFecha">
                            <div class="Codigo">
                                <label for="Codigo">Número de Venta:</label>
                                <p name="num_venta" id="num_venta"><?php echo $idVenta?></p>
                                <input type="text" name="numero_venta" id="numero_venta" hidden>
                            </div>

                            <div class="Fecha">
                                <label for="Fecha">Fecha:</label>
                                <p name="fecha" id="fecha"><?php echo $MostrarFecha; ?></p>
                                <input type="text" name="fecha_pc" id="fecha_pc" hidden>
                            </div>
                        </div>
                        <br>
                        <div class="cliente">
                            <?php 
                                $query_venta = mysqli_query($conection, "SELECT idCliente, Nombre, Apellido FROM clientes ORDER BY Nombre ASC");

                                $result_venta = mysqli_num_rows($query_venta);
                            ?>
                            <select name="Cliente" id="Cliente" tabindex="4">
                            <option value="<?php echo 'Cliente Default'; ?>" selected><?php echo 'Cliente Default'; ?></option>
                            <option value=""></option>
                            <?php
                                if($result_venta > 0){
                                    while($Venta = mysqli_fetch_array($query_venta)){
                            ?>
                                <option value="<?php echo $Venta['idCliente'] ?>"><?php echo $Venta['Apellido'] ?> <?php echo $Venta['Nombre'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        <hr>
                        <div class="CondicionPago">
                            <label for="Pago">Condición de Pago:</label>
                            <div class="seleccion">
                                <div class="contado">
                                    <input type="radio" id="Contado" name="condicion_Pago" value="Contado" tabindex="5">
                                    <label for="Contado">Contado</label>
                                </div>

                                <div class="Cuenta_corriente">
                                    <input type="radio" id="Cuenta_corriente" name="condicion_Pago" value="Cuenta corriente" tabindex="6">
                                    <label for="Cuenta_corriente">Cuenta corriente</label>
                                </div>
                            </div>
                        </div>
                        <div class="FormaPago">
                            <label for="Pago">Forma de Pago:</label>
                            <div class="seleccion">
                                <div class="efectivo">
                                    <input type="radio" id="Efectivo" name="forma_pago" value="Efectivo" tabindex="7">
                                    <label for="Efectivo">Efectivo</label>
                                </div>

                                <div class="credito">
                                    <input type="radio" id="Credito" name="forma_pago" value="Credito" tabindex="8">
                                    <label for="Credito">Credito</label>
                                </div>

                                <div class="debito">
                                    <input type="radio" id="Debito" name="forma_pago" value="Debito" tabindex="9">
                                    <label for="Debito">Debito</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="pago">
                        <div class="subtotal">
                            <p class="titulo" id="totalF">Subtotal:</p>
                            <div class="numero">
                                <p class="valor" name="valorSubF" id="valorSubF">0</p>
                            </div>
                            <input type="text" name="Subtotal" id="Subtotal" hidden>
                        </div>
                        <div class="descuento">
                            <input type="text" name="descuento" id="descuento" placeholder="Aplicar descuento" tabindex="10">
                        </div>
                        <div class="total">
                            <p class="titulo" id="totalF">Total:</p>
                            <div class="numero">
                                <p class="valor" name="valorF" id="valorF">0</p>
                            </div>
                            <input type="text" name="Total" id="Total" hidden>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</body>
</html>