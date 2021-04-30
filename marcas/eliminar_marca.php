<?php

    include "../database/database.php";

    if(!empty($_POST)){
        $idMarca = $_POST['idMarca'];

        $query_eliminar = mysqli_query($conection, "DELETE FROM marcas WHERE idMarca = $idMarca");

        if($query_eliminar){
            header("Location: tabla_marcas.php");
        }else{
            echo "Error al eliminar la marca";
        }
    }


    if(empty($_REQUEST['idMarca'])){
        header("Location: tabla_marcas.php");
    }else{
        $idMarca = $_REQUEST['idMarca'];

        $query = mysqli_query($conection, "SELECT m.Marca FROM marcas m WHERE idMarca = $idMarca");

        $result = mysqli_num_rows($query);

        if($result > 0){
            while($data = mysqli_fetch_array($query)){
                $Marca = $data['Marca'];
            }
        }else{
            header("Location: tabla_marcas.php");
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
    
    <title>Eliminar marca</title>
</head>
<body style="background-color: #E1E1E1;">
    <!-- Menu  -->
    <?php include "../includes/nav.php"?>
    
    <br>
    <br>
    <br>

    <div class="contenido">
        <!-- Opciones -->
        <form action="" method="POST">
        <div class="opciones">
            <h1 class="titulo">ELIMINAR MARCA</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="tabla_marcas.php">Cancelar</a>
            </div>
            <input type="submit" value="Eliminar" class="boton_success">
        </div>

            <div class="formulario">
                <div class="mensaje">
                    <p class="dato">¿SEGURO QUE QUIERE ELIMINAR LA MARCA</p>
                    <p class="nombre"> <?php echo $Marca; ?></p>
                    <p class="dato">?</p>
                </div>

                <input type="hidden" name="idMarca" value="<?php echo $idMarca; ?>">
                <div class="input">
                    <label for="Marca">Marca</label>
                    <input type="text" name="Marca" id="Marca" class="form-control" placeholder="Marca" tabindex="1" value="<?php echo $Marca;?>" disabled>
                </div>
            </div>
            
        </form>
    </div>
    
</body>
</html>