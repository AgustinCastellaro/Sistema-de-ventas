<?php

    $host ='localhost';
    $user = 'root';
    $password = '';
    $db = 'database';

    $conection = @mysqli_connect($host, $user, $password, $db);

    if (!$conection){
        echo "Error al conectar";
    }
?>