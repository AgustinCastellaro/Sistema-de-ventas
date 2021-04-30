<?php

    include "../database/database.php";

    if(!empty($_POST)){
        $idCliente = $_POST['idCliente'];

        $query_eliminar = mysqli_query($conection, "DELETE FROM clientes WHERE idCliente = $idCliente");

        if($query_eliminar){
            header('Location: tabla_clientes.php');

        }else{
            echo "Error al eliminar al cliente";
        }
    }


    if(empty($_REQUEST['idCliente'])){
        header('Location: tabla_clientes.php');
    }else{
        $idCliente = $_REQUEST['idCliente'];

        $query = mysqli_query($conection, "SELECT c.Nombre, c.Apellido, c.Mail, c.CodigoDeArea, c.Telefono
                                            FROM clientes c 
                                            WHERE c.idCliente = $idCliente");

        $result = mysqli_num_rows($query);

        if($result > 0){
            while($data = mysqli_fetch_array($query)){
                $Nombre = $data['Nombre'];
                $Apellido = $data['Apellido'];
                $Mail = $data['Mail'];
                $CodigoDeArea = $data['CodigoDeArea'];
                $Telefono = $data['Telefono'];
            }
        }else{
            header('Location: tabla_clientes.php');
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
    
    <title>Eliminar cliente</title>
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
            <h1 class="titulo">ELIMINAR CLIENTE</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="tabla_clientes.php">Cancelar</a>
            </div>
            <input type="submit" value="Eliminar" class="boton_success">
        </div>
        
        <!-- Formulario -->
        <div class="formulario">

            <div class="mensaje">
                <p class="dato">¿SEGURO QUE QUIERE ELIMINAR AL CLIENTE</p>
                <p class="nombre"> <?php echo $Nombre; ?></p>
                <p class="dato">?</p>
            </div>

            <input type="hidden" name="idCliente" value="<?php echo $idCliente; ?>">
            <div class="input-group">
                <div class="Nombre">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="Nombre" id="Nombre" class="form-control" placeholder="Nombre" tabindex="2" value="<?php echo $Nombre; ?>" disabled>
                </div>
                <div class="Apellido">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="Apellido" id="Apellido" class="form-control" placeholder="Apellido" tabindex="1" value="<?php echo $Apellido; ?>" disabled>
                </div>
            </div>

            <label for="Email">Correo electronico:</label>
            <input type="text" name="Mail" id="Mail" class="form-control" placeholder="Correo electronico" tabindex="1" value="<?php echo $Mail; ?>" disabled>

            <div class="input-group">
                <div class="CodigoDeArea">
                    <label for="Codigo de area">Codigo de area:</label>
                    <input type="text" name="CodigoDeArea" id="CodigoDeArea" class="form-control" placeholder="Codigo de area" tabindex="1" value="<?php echo $CodigoDeArea; ?>" disabled>
                </div>
                <div class="Telefono">
                    <label for="Telefono">Telefono:</label>
                    <input type="text" name="Telefono" id="Telefono" class="form-control" placeholder="Telefono" tabindex="2" value="<?php echo $Telefono; ?>" disabled>
                </div>
            </div>

        </div>
        </form>
    </div>
</body>
</html>