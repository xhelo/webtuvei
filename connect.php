<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "tuvei";
    $con = mysql_connect($host, $user, $pass);

    if(!$con){
    die ('Error de conexión: '.mysql_error() );
    }
    mysql_select_db($database, $con);
//conexion exitosa

?>