<?php
    include "../database/database.php"; 

    date_default_timezone_set("America/Argentina/Cordoba");

    $fechaDia =  date("d");
    $fechaMes =  date("m");
    $fechaAño =  date("Y");
    
    $fechaHora = date("H");
    $fechaMinutos = date("i");
    $fechaSegundos = date("s");


    $fechaActual = $fechaDia."/".$fechaMes."/".$fechaAño;
    $horaActual = $fechaHora.":".$fechaMinutos;

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
        <title>Lista ventas</title>
    </head>
    <body style="background-color: rgb(238, 238, 238);">
        <!-- Menu -->
        <?php include "../includes/nav.php"?>
    
    <br>
    <div class="contenido">
        <!-- Opciones -->
        <div class="opciones_tabla">
            <h1 class="titulo">VENTAS</h1>
            
            <!-- Busqueda -->
            <input type="text" name="buscarVenta" id="buscarVenta" class="form-control" placeholder="Buscar" tabindex="1">
            <div class="filtrar">
                <button class="quitarFiltro" id="quitarFiltro"><i class="fas fa-times"></i></button>
                <button class="btn_filtrar" name="filtrar"  id="filtrarVenta">Filtrar</button>
            </div>
            <button><a class="pdf" href="#">PDF</a></button>
            <button><a class="añadir_cliente" href="nueva_venta.php" id="nuevaVenta">Nueva Venta</a></button>
        </div>


        <!-- Modal Filtrar -->
        <div class="modal-fondo" id="modalFondoFiltrar">
            <div class="modal-filtrar" id="modal-filtrar">
                <div class="m-top">
                    <h1>Filtrar</h1>
                </div>
                <div class="m-body">
                    <div class="opciones">
                        <div class="desde">
                            <label for="desde">Desde</label>
                            <input type="date" name="fechaDesde" id="fechaDesde">
                        </div>
                        <div class="hasta">
                            <label for="hasta">Hasta</label>
                            <input type="date" name="fechaHasta" id="fechaHasta">
                        </div>
                    </div>
                    <div class="mensaje" id="mensajeModalFiltrar">
                        <p id="errorModal">Seleccione una fecha correcta</p>
                    </div>
                </div>
                <div class="m-footer">
                    <button class="boton_cancelar" id="cancelarFiltrarModal">Cancelar</button>
                    <input type="submit" value="Filtrar" class="boton_success" id="btn_filtrar">
                </div>
            </div>
        </div>

        
        <!-- Tabla ventas -->
        <div class="tabla table-responsive">
            <table class="table-hover">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Importe</th>
                        <th>Cliente</th>
                        <th>Condición de pago</th>
                        <th>Forma de pago</th>

                    </tr>
                </thead>
                <tbody id="rowsVenta">
                <?php
                    $query = mysqli_query($conection, "SELECT v.idVenta, v.Fecha, v.Importe, v.Nombre, v.Apellido, v.CondicionPago, v.FormaDePago 
                                                        FROM ventas v ");

                    $resultado = mysqli_num_rows($query);

                    if($resultado > 0){
                        while($data = mysqli_fetch_array($query)){  
                ?>
                    <tr>
                        <td><?php echo $data["idVenta"]; ?></td>
                        <td><?php echo $data["Fecha"]; ?></td>
                        <td><?php echo $data["Importe"]; ?></td>
                        <td><?php
                            if($data["Apellido"] == "Default" && $data["Nombre"] == "Cliente"){
                                echo "Cliente Default";
                            }else{
                                echo $data["Apellido"]; ?>, <?php echo $data["Nombre"]; 
                            }
                            ?>
                        </td>
                        <td><?php echo $data["CondicionPago"]; ?></td>
                        <td><?php echo $data["FormaDePago"]; ?></td>
                        <td>
                            <a class="btn_editar" href="ver_venta.php ? idVenta=<?php echo $data["idVenta"]; ?>"><i class="fas fa-eye"></i> Ver</a>
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
