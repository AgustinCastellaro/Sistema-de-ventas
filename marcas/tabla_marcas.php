<?php
    include "../database/database.php";

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
        
        <title>Lista marcas</title>
    </head>
    <body style="background-color: rgb(238, 238, 238);">
        <!-- Menu -->
        <?php include "../includes/nav.php"?>
    
    <br>
    <div class="contenido_marca">
        <!-- Opciones -->
        <div class="opciones_tabla">
            <h1 class="titulo">MARCAS</h1>
            
            <!-- Busqueda -->
            <input type="text" name="BuscarMarca" id="BuscarMarca" placeholder="Buscar">

            <button><a class="pdf" href="#">PDF</a></button>

            <button><a class="añadir_cliente" href="añadir_marca.php">Añadir Marca</a></button>
        </div>
        
        <!-- Tabla marcas -->
        <div class="tabla table-responsive">
            <table class="table-hover">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Marca</th>
                        <th class="acciones">Acciones</th>
                    </tr>
                </thead>
            <?php
                $query = mysqli_query($conection, "SELECT m.idMarca ,m.Marca FROM marcas m");

                $resultado = mysqli_num_rows($query);

                if($resultado > 0){
                    while($data = mysqli_fetch_array($query)){  
            ?>
                <tr>
                    <td><?php echo $data["idMarca"]; ?></td>
                    <td><?php echo $data["Marca"]; ?></td>
                    <td>
                        <a class="btn_editar" href="editar_marca.php ? idMarca=<?php echo $data["idMarca"]; ?>"><i class="far fa-edit"></i> Editar</a>
                        <a class="btn_eliminar" href="eliminar_marca.php ? idMarca=<?php echo $data["idMarca"]; ?>"><i class="far fa-trash-alt"></i> Eliminar</a>
                    </td>
                </tr> 
            <?php
                    }
                }else{
                    ?>
                    <style>
                        thead{
                            opacity: 0;
                        }
                        p.not_elements{
                            margin: 20px 0px 0px 0px;
                            color: #535353;
                            font-size: 15px;
                            font-weight: bold;
                            text-align: center;
                        }
                    </style>
                    <p class="not_elements">No hay elementos en la tabla</p>
                    <?php
                }
            ?>
        </table>
    </div>
</body>
</html>