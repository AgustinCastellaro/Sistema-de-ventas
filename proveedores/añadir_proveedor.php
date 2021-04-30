<?php

    if(!empty($_POST)){

        if(empty($_POST['NombrePv']) || empty($_POST['Email']) || empty($_POST['Dirección']) || empty($_POST['CodigoDeArea']) || empty($_POST['Telefono'])){
            echo "Debes rellenar todos los campos";
        }else{
            include "../database/database.php";

            $Nombre = $_POST['NombrePv'];
            $Email = $_POST['Email'];
            $Dirección = $_POST['Dirección'];
            $CodigoDeArea = $_POST['CodigoDeArea'];
            $Telefono = $_POST['Telefono'];

            $query = mysqli_query($conection,"SELECT * FROM proveedores
                                                WHERE Email = '$Email'");
                                                
            $result = mysqli_fetch_array($query);

            if($result > 0){
                $alert_error ='<p class="msg_error">El Correo electronico ya existe</p>';
            }else{
                $query_insert = mysqli_query($conection,"INSERT INTO proveedores(NombrePv, Email, Dirección, CodigoDeArea, Telefono)
                                                        VALUES ('$Nombre', '$Email', '$Dirección', '$CodigoDeArea', '$Telefono')");

                if($query_insert){
                    echo "Proveedor creado correctamente";
                    header("Refresh:2; url=tabla_proveedores.php");
                }else{
                    echo "Error al crear el Proveedor";
                }
            }

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
    
    <title>Nuevo proveedor</title>
</head>
<body style="background-color: rgb(238, 238, 238);">
    <!-- Menu  -->
    <?php include "../includes/nav.php"?>
    
    <br>
    <br>
    <br>
    <div class="contenido">
    <form action="" method="POST">
        <!-- Opciones -->
        <div class="opciones">
            <h1 class="titulo">NUEVO PROVEEDOR</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="tabla_proveedores.php">Cancelar</a>
            </div>
            <input type="submit" value="Añadir" class="boton_success">
        </div>
                
        <div class="formulario">
            <input type="hidden" name="idProveedor" value="<?php echo $idProveedor; ?>">
            <div class="input-group">
                <div class="Apellido">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="NombrePv" id="NombrePv" class="form-control" placeholder="Nombre" tabindex="2">
                </div>
                <div class="Nombre">
                    <label for="Dirección">Dirección:</label>
                    <input type="text" name="Dirección" id="Dirección" class="form-control" placeholder="Dirección" tabindex="1">
                </div>
            </div>

            <label for="Email">Correo electronico:</label>
            <input type="text" name="Email" id="Email" class="form-control" placeholder="Correo electronico" tabindex="1">

            <div class="input-group">
                <div class="Apellido">
                    <label for="Codigo de area">Codigo de area:</label>
                        <input type="text" name="CodigoDeArea" id="CodigoDeArea" class="form-control" placeholder="Codigo de area" tabindex="1">
                </div>
                <div class="Nombre">
                    <label for="Telefono">Telefono:</label>
                    <input type="text" name="Telefono" id="Telefono" class="form-control" placeholder="Telefono" tabindex="2">
                </div>
            </div>
            
        </div>

        </form>
    </div>

</body>
</html>