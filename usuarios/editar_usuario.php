<?php

include "../database/database.php";

    if(!empty($_POST)){
        print_r($_POST);
        $alert_guardar = '';
        if(empty($_POST['idUsuario']) || empty($_POST['Usuario']) || empty($_POST['Email']) || empty($_POST['Contraseña']) || empty($_POST['ConfirmarContraseña']) || empty($_POST['Rol']) || empty($_POST['Telefono']) || empty($_POST['CodigoDeArea'])){
            echo "Debes rellenar todos los campos";
        }else{
            include "../database/database.php";

            $idUsuario = $_POST['idUsuario'];
            $Usuario = $_POST['Usuario'];
            $Email = $_POST['Email'];
            $Contraseña = $_POST['Contraseña'];
            $ConfirmarContraseña = $_POST['ConfirmarContraseña'];
            $Rol = $_POST['Rol'];
            $Telefono = $_POST['Telefono'];
            $CodigoDeArea = $_POST['CodigoDeArea'];


            if($Contraseña == $ConfirmarContraseña){

                $query = mysqli_query($conection, "SELECT * FROM usuarios WHERE (idUsuario != '$idUsuario' AND Email = '$Email') ");
    
                $result = mysqli_fetch_array($query);
    
                if($result > 0){
                    echo "El correo electronico ya existe";
                }else{
                    if(empty($_POST['Usuario'])){
                        $sql_update = mysqli_query($conection,"UPDATE usuarios 
                                                                SET Apellido = '$Apellido', Email = '$Email', Contraseña = '$Contraseña', Rol = '$Rol', Telefono = '$Telefono', CodigoDeArea = '$CodigoDeArea'
                                                                WHERE idUsuario = $idUsuario ");
                    }else{
                        $sql_update = mysqli_query($conection,"UPDATE usuarios 
                                                                SET Usuario = '$Usuario', Email = '$Email', Contraseña = '$Contraseña', Rol = '$Rol', Telefono = '$Telefono', CodigoDeArea = '$CodigoDeArea' 
                                                                WHERE idUsuario = $idUsuario ");
                    }
    
                    if($sql_update){
                        echo "Usuario actualizado correctamente";
                        header("Refresh:2; url=tabla_usuarios.php");
                    }else{
                        echo "Error al actualizar el usuario";
                    }
                }
            }else{
                echo "Contraseñas distintas";
            }            

        }
    }

    //Mostrar datos
    if(empty($_GET['idUsuario'])){
        header('Location: tabla_usuarios.php');
    }
    $idUsuario = $_GET['idUsuario'];

    $sql = mysqli_query($conection, "SELECT u.idUsuario, u.Usuario, u.Email, u.Contraseña, u.Telefono, u.CodigoDeArea, (u.Rol) as idRol, (r.Rol) as Rol 
                                        FROM usuarios u 
                                        INNER JOIN roles r on u.Rol = r.idRol 
                                        WHERE idUsuario = $idUsuario ");

    $result = mysqli_num_rows($sql);

    if($result == 0){
        header('Location: tabla_usuarios.php');
    }else{
        $option = '';
        while($data = mysqli_fetch_array($sql)){
            $idUsuario          = $data['idUsuario'];
            $Usuario            = $data['Usuario'];
            $Email              = $data['Email'];
            $Contraseña         = $data['Contraseña'];
            $Telefono           = $data['Telefono'];
            $CodigoDeArea       = $data['CodigoDeArea'];
            $idRol              = $data['idRol'];
            $Rol                = $data['Rol'];

            if($idRol == 1){
                $option = '<option value="'.$idRol.'" select>'.$Rol.'</option>';
            }else if($idRol == 2){
                $option = '<option value="'.$idRol.'" select>'.$Rol.'</option>';
            }
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
    
    <title>Editar usuario</title>
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
            <h1 class="titulo">EDITAR USUARIO</h1>
            <!-- Botones -->
            <div class="boton">
                <a class="boton_cancelar" href="tabla_usuarios.php">Cancelar</a>
            </div>
            <input type="submit" value="Guardar" class="boton_success">
        </div>
        
        <!-- Formulario -->
        <div class="formulario">
                <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
                <div class="input-group">
                    <div class="Apellido">
                        <label for="nombre">Usuario</label>
                        <input type="text" name="Usuario" id="Usuario" class="form-control" placeholder="Usuario" tabindex="2" value="<?php echo $Usuario; ?>">
                    </div>
                    <div class="Rol">
                        <label for="Rol">Rol</label>
                        <?php 
                            $query_rol = mysqli_query($conection,"SELECT * FROM roles");
                            $resultado_rol = mysqli_num_rows($query_rol);

                            if($_SESSION['idUsuario'] == $idUsuario){
                        ?>
                                <select name="Rol" id="Rol" class="notItemOne">
                            <?php 
                            }else{
                            ?>
                                <select name="Rol" id="Rol" class="notItemOne">
                            <?php
                            }
                                echo $option;
                                if($resultado_rol > 0){
                                    while($Rol = mysqli_fetch_array($query_rol)){
                            ?>
                                    <option value="<?php echo $Rol["idRol"]; ?>"><?php echo $Rol["Rol"] ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <label for="Email">Correo electronico</label>
                <input type="text" name="Email" id="Email" class="form-control" placeholder="Correo electronico" tabindex="1" value="<?php echo $Email; ?>">   

                <div class="input-group">
                    <div class="Apellido">
                        <label for="CodigoDeArea">CodigoDeArea</label>
                        <input type="text" name="CodigoDeArea" id="CodigoDeArea" class="form-control" placeholder="Codigo de area" tabindex="1" value="<?php echo $CodigoDeArea; ?>">
                    </div>
                    <div class="Nombre">
                        <label for="Telefono">Telefono</label>
                        <input type="text" name="Telefono" id="Telefono" class="form-control" placeholder="Telefono" tabindex="1" value="<?php echo $Telefono; ?>">
                    </div>
                </div>

                <div class="input-group">
                    <div class="Apellido">
                        <label for="Contraseña">Contraseña</label>
                        <input type="text" name="Contraseña" id="Contraseña" class="form-control" placeholder="Contraseña" tabindex="1" value="<?php echo $Contraseña; ?>">
                    </div>
                    <div class="Nombre">
                        <label for="Contraseña">Confirmar Contraseña</label>
                        <input type="text" name="ConfirmarContraseña" id="ConfirmarContraseña" class="form-control" placeholder="Confirmar Contraseña" tabindex="1" value="<?php echo $Contraseña; ?>">
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</body>
</html>