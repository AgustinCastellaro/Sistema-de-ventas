<?php

include "../database/database.php";

    if(!empty($_POST)){
        $alert_guardar = '';
        if(empty($_POST['idProveedor']) || empty($_POST['NombrePv']) || empty($_POST['Email']) || empty($_POST['Direccion']) || empty($_POST['CodigoDeArea']) || empty($_POST['Telefono'])){
            echo "Todos los campos son obligatorios";
        }else{
            include "../database/database.php";

            $idProveedor    = $_POST['idProveedor'];
            $Nombre         = $_POST['NombrePv'];
            $Email          = $_POST['Email'];
            $Direccion      = $_POST['Direccion'];
            $CodigoDeArea   = $_POST['CodigoDeArea'];
            $Telefono       = $_POST['Telefono'];

            $query = mysqli_query($conection, "SELECT * FROM proveedores WHERE (idProveedor != '$idProveedor' AND Email = '$Email') ");

            $result = mysqli_fetch_array($query);

            if($result > 0){
                echo "El correo electronico ya existe";
            }else{
                if(empty($_POST['NombrePv'])){
                    $sql_update = mysqli_query($conection,"UPDATE proveedores 
                                                            SET Email = '$Email', Dirección = '$Direccion', CodigoDeArea = '$CodigoDeArea', Telefono = '$Telefono' 
                                                            WHERE idProveedor = $idProveedor ");
                }else{
                    $sql_update = mysqli_query($conection,"UPDATE proveedores 
                                                            SET NombrePv = '$Nombre', Email = '$Email', Dirección = '$Direccion', CodigoDeArea = '$CodigoDeArea', Telefono = '$Telefono' 
                                                            WHERE idProveedor = $idProveedor ");
                }

                if($sql_update){
                    echo "Proveedor actualizado correctamente";
                    header("Refresh:1; url=tabla_proveedores.php");
                }else{
                    echo "Error al actualizar el proveedor";
                }
            }
        }
    }

    //Mostrar datos
    if(empty($_GET['idProveedor'])){
        header('Location: tabla_proveedores.php');
    }
    $idProveedor = $_GET['idProveedor'];

    $sql = mysqli_query($conection, "SELECT p.idProveedor, p.NombrePv, p.Email, p.Dirección, p.CodigoDeArea, p.Telefono FROM proveedores p WHERE idProveedor = $idProveedor ");

    $result = mysqli_num_rows($sql);

    if($result == 0){
        header('Location: tabla_proveedores.php');
    }else{
        while($data = mysqli_fetch_array($sql)){
            $idProveedor    = $data['idProveedor'];
            $Nombre         = $data['NombrePv'];
            $Email          = $data['Email'];
            $Direccion      = $data['Dirección'];
            $CodigoDeArea   = $data['CodigoDeArea'];
            $Telefono       = $data['Telefono'];
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
    
    <title>Editar proveedor</title>
</head>
<body style="background-color: rgb(238, 238, 238);">
    <!-- Menu  -->
    <?php include "../includes/nav.php"?>
    
    <br>
    <br>
    <br>

    <div class="contenido">
        <!-- Opciones -->
        <form action="" method="POST">
        <div class="opciones">
            <h1 class="titulo">EDITAR PROVEEDOR</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="tabla_proveedores.php">Cancelar</a>
            </div>
            <input type="submit" value="Guardar" class="boton_success">
        </div>

        <!-- Formulario -->
        <div class="formulario">

            <input type="hidden" name="idProveedor" value="<?php echo $idProveedor; ?>">
            <div class="input-group">
                <div class="Nombre">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="NombrePv" id="NombrePv" class="form-control" placeholder="NombrePv" tabindex="2" value="<?php echo $Nombre; ?>">
                </div>
                <div class="Direccion">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="Direccion" id="Direccion" class="form-control" placeholder="Direccion" tabindex="1" value="<?php echo $Direccion; ?>">
                </div>
            </div>

            <label for="Email">Correo electronico:</label>
            <input type="text" name="Email" id="Email" class="form-control" placeholder="Correo electronico" tabindex="1" value="<?php echo $Email; ?>">

            <div class="input-group">
                <div class="CodigoDeArea">
                    <label for="Codigo de area">Codigo de area:</label>
                    <input type="text" name="CodigoDeArea" id="CodigoDeArea" class="form-control" placeholder="CodigoDeArea" tabindex="1" value="<?php echo $CodigoDeArea; ?>">
                </div>
                <div class="Telefono">
                    <label for="Telefono">Telefono:</label>
                    <input type="text" name="Telefono" id="Telefono" class="form-control" placeholder="Telefono" tabindex="2" value="<?php echo $Telefono; ?>">
                </div>
            </div>

        </div>
        </form>

    </div>
    
</body>
</html>