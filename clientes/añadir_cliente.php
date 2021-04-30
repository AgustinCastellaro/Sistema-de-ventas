<?php

    if(!empty($_POST)){

        if(empty($_POST['Nombre']) || empty($_POST['Apellido']) || empty($_POST['Mail']) || empty($_POST['CodigoDeArea']) || empty($_POST['Telefono'])){
            echo "Debes rellenar todos los campos";
        }else{
            include "../database/database.php";

            $Nombre = $_POST['Nombre'];
            $Apellido = $_POST['Apellido'];
            $Mail = $_POST['Mail'];
            $CodigoDeArea = $_POST['CodigoDeArea'];
            $Telefono = $_POST['Telefono'];

            $query = mysqli_query($conection,"SELECT * FROM clientes
                                                WHERE Mail = '$Mail' ");
                                                
            $result = mysqli_fetch_array($query);

            if($result > 0){
                echo "El Correo electronico ya existe";
            }else{
                $query_insert = mysqli_query($conection,"INSERT INTO clientes(Nombre, Apellido, Mail, CodigoDeArea, Telefono, Saldo)
                                                        VALUES ('$Nombre', '$Apellido', '$Mail', '$CodigoDeArea', '$Telefono', '0') ");

                if($query_insert){
                    echo "Cliente creado correctamente";
                    header("Refresh:2; url=tabla_clientes.php");
                }else{
                    echo "Error al crear el cliente";
                }
            }

        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
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
    
    <title>Nuevo cliente</title>
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
            <h1 class="titulo">NUEVO CLIENTE</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="tabla_clientes.php">Cancelar</a>
            </div>
            <input type="submit" value="Añadir" class="boton_success">
        </div>
        
        <!-- Formulario -->
        <div class="formulario">

            <div class="input-group">
                <div class="Nombre">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="Nombre" id="Nombre" class="form-control" placeholder="Nombre" tabindex="1">
                </div>
                <div class="Apellido">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="Apellido" id="Apellido" class="form-control" placeholder="Apellido" tabindex="2">
                </div>
            </div>

            <label for="Email">Email</label>
            <input type="text" name="Mail" id="Mail" class="form-control" placeholder="Email" tabindex="1">

            <div class="input-group">
                <div class="Codigo de Area">
                    <label for="Codigo de Area">Codigo de Area</label>
                    <input type="text" name="CodigoDeArea" id="CodigoDeArea" class="form-control" placeholder="CodigoDeArea" tabindex="1">
                </div>
                <div class="Telefono">
                    <label for="Telefono">Telefono</label>
                    <input type="text" name="Telefono" id="Telefono" class="form-control" placeholder="Telefono" tabindex="2">
                </div>
            </div>
        </div>

        </form>
    </div>
</body>
</html>