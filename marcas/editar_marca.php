<?php

include "../database/database.php";

    if(!empty($_POST)){
        if(empty($_POST['Marca'])){
            echo "Debes rellenar el campo";
        }else{
            include "../database/database.php";

            $idMarca = $_POST['idMarca'];
            $Marca = $_POST['Marca'];

            $query = mysqli_query($conection, "SELECT * FROM marcas WHERE (idMarca != '$idMarca' AND Marca = '$Marca') ");

            $result = mysqli_fetch_array($query);

            if($result > 0){
                echo "La marca ya existe";
            }else{
                if(empty($_POST['Marca'])){
                    $sql_update = mysqli_query($conection,"UPDATE marcas 
                                                            SET Marca = '$Marca' 
                                                            WHERE idMarca = $idMarca ");
                }else{
                    $sql_update = mysqli_query($conection,"UPDATE marcas 
                                                            SET Marca = '$Marca' 
                                                            WHERE idMarca = $idMarca ");
                }

                if($sql_update){
                    echo "Marca actualizada correctamente";
                    header("Refresh:1; url=tabla_marcas.php");
                }else{
                    echo "Error al actualizar la marca";
                }
            }
        }
    }

    //Mostrar datos
    if(empty($_GET['idMarca'])){
        header('Location: tabla_marcas.php');
    }
    $idMarca = $_GET['idMarca'];

    $sql = mysqli_query($conection, "SELECT m.idMarca, m.Marca FROM marcas m WHERE idMarca = $idMarca");

    $result = mysqli_num_rows($sql);

    if($result == 0){
        header('Location: tabla_marcas.php');
    }else{
        while($data = mysqli_fetch_array($sql)){
            $idMarca    = $data['idMarca'];
            $Marca      = $data['Marca'];
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
    
    <title>Editar marca</title>
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
            <h1 class="titulo">EDITAR MARCA</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="tabla_marcas.php">Cancelar</a>
            </div>
            <input type="submit" value="Guardar" class="boton_success">
        </div>

        <!-- Formulario -->
        <div class="formulario">
            <input type="hidden" name="idMarca" value="<?php echo $idMarca; ?>">
            <div class="input">
                <label for="Marca">Marca</label>
                <input type="text" name="Marca" id="Marca" class="form-control" placeholder="Marca" tabindex="1" value="<?php echo $Marca; ?>">
            </div>
        </div>

        </form>
    </div>
    
</body>
</html>