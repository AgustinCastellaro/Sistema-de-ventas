<?php

    include "../database/database.php";

    if(!empty($_POST)){
        $idProveedor = $_POST['idProveedor'];

        $query_eliminar = mysqli_query($conection, "DELETE FROM proveedores WHERE idProveedor = $idProveedor");

        if($query_eliminar){
            header("Location: tabla_proveedores.php");
        }else{
            echo "Error al eliminar al proveedor";
        }
    }


    if(empty($_REQUEST['idProveedor'])){
        header("Location: tabla_proveedores.php");
    }else{
        $idProveedor = $_REQUEST['idProveedor'];

        $query = mysqli_query($conection, "SELECT p.NombrePv, p.Email, p.Dirección, p.CodigoDeArea, p.Telefono
                                            FROM proveedores p 
                                            WHERE p.idProveedor = $idProveedor");

        $result = mysqli_num_rows($query);

        if($result > 0){
            while($data = mysqli_fetch_array($query)){
                $Nombre         = $data['NombrePv'];
                $Email          = $data['Email'];
                $Dirección      = $data['Dirección'];
                $CodigoDeArea   = $data['CodigoDeArea'];
                $Telefono       = $data['Telefono'];
            }
        }else{
            header("Location: tabla_proveedores.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../includes/css/style.css">
    <script src="https://kit.fontawesome.com/2711e27f29.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
    <title>Eliminar proveedor</title>
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
            <h1 class="titulo">ELIMINAR PROVEEDOR</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="tabla_proveedores.php">Cancelar</a>
            </div>
            <input type="submit" value="Eliminar" class="boton_success">
        </div>

            <div class="formulario">

                <div class="mensaje">
                    <p class="dato">¿SEGURO QUE QUIERE ELIMINAR EL PROVEEDOR</p>
                    <p class="nombre"> <?php echo $Nombre; ?></p>
                    <p class="dato">?</p>
                </div>

                <input type="hidden" name="idProveedor" value="<?php echo $idProveedor; ?>">
                <div class="input-group">
                    <div class="Apellido">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="NombrePv" id="NombrePv" class="form-control" placeholder="Nombre" tabindex="2" value="<?php echo $Nombre?>" disabled>
                    </div>
                    <div class="Nombre">
                        <label for="Dirección">Dirección:</label>
                        <input type="text" name="Dirección" id="Dirección" class="form-control" placeholder="Dirección" tabindex="1" value="<?php echo $Dirección?>" disabled>
                    </div>
                </div>

                <label for="Email">Correo electronico:</label>
                <input type="text" name="Email" id="Email" class="form-control" placeholder="Correo electronico" tabindex="1" value="<?php echo $Email?>" disabled>

                <div class="input-group">
                    <div class="Apellido">
                        <label for="Codigo de area">Codigo de area:</label>
                            <input type="text" name="CodigoDeArea" id="CodigoDeArea" class="form-control" placeholder="Codigo de area" tabindex="1" value="<?php echo $CodigoDeArea?>" disabled>
                    </div>
                    <div class="Nombre">
                        <label for="Telefono">Telefono:</label>
                        <input type="text" name="Telefono" id="Telefono" class="form-control" placeholder="Telefono" tabindex="2" value="<?php echo $Telefono?>" disabled>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
    
</body>
</html>