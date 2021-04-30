<?php
    include "../database/database.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://kit.fontawesome.com/2711e27f29.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
        <title>Lista proveedores</title>
    </head>
    <body style="background-color: #E1E1E1;">
        <!-- Menu -->
        <?php include "../includes/nav.php"?>
    
    <br>
    <br>
    <div class="container">
        <?php
            $busqueda = $_REQUEST['busqueda'];
            if(empty($busqueda)){
                header("Location: lista_proveedores.php");
            }
        ?>
        <!-- Menu proveedores -->
        <h1 class="listaC_titulo"><i class="fas fa-truck"></i>  Proveedores</h1>
        <button><a class="btn_nuevoC" href="nuevo_proveedor.php">Nuevo proveedor</button>
        <form class="example" action="buscar_proveedor.php" method="POST" action="" onSubmit="return validarForm(this)">
            <input type="text" placeholder="Buscar proveedor" name="busqueda" value="">
            <input type="submit" value="Buscar" name="buscar">
        </form>
        <button class="btn_ordenar">Ordenar por</button>
        <a href="" class="pdf"><i class="far fa-file-pdf"></i></a>
        
        <!-- Tabla proveedores -->
        <?php
            if(!empty($_POST['buscar'])){
                ?>
                <!-- el resultado de la búsqueda lo encapsularemos en un tabla -->
                <table class="table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="row">id</th>
                            <th>Nombre</th>
                            <th>Correo electronico</th>
                            <th>Dirección</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <?php
                    //obtenemos la información introducida anteriormente desde nuestro buscador PHP
                    $buscar = $_POST["busqueda"];
                    $consulta_mysql= mysqli_query($conection, "SELECT * FROM proveedores 
                                                                WHERE idProveedor   like '%$buscar%' or 
                                                                NombrePv            like '%$buscar%' or 
                                                                Email               like '%$buscar%' or 
                                                                Dirección           like '%$buscar%' or 
                                                                CodigoDeArea        like '%$buscar%' or 
                                                                Telefono            like '%$buscar%' ");

                    while($registro = mysqli_fetch_assoc($consulta_mysql)){
                        ?>
                        <tr class="table-bordered">
                            <td><?php echo $registro['idProveedor'];?></td>
                            <td><?php echo $registro['NombrePv'];?></td>
                            <td><?php echo $registro["Email"];?></td>
                            <td><?php echo $registro["Dirección"];?></td>
                            <td><?php echo $registro["CodigoDeArea"];?> - <?php echo $registro["Telefono"];?></td>
                            <td>
                                <a class="btn_editarC" href="editar_proveedor.php ? idProveedor=<?php echo $data["idProveedor"]; ?>"><i class="far fa-edit"></i> Editar</a>
                                |
                                <a class="btn_eliminarC" href="eliminar_proveedor.php ? idProveedor=<?php echo $data["idProveedor"]; ?>"><i class="far fa-trash-alt"></i> Eliminar</a>
                            </td>
                        </tr>
                        <?php 
                    }
                ?>
                </table>
                <?php
            }
        ?>
    </div>
    <footer>
    <?php include "../includes/footer.php"?>
    </footer>
</body>
</html>