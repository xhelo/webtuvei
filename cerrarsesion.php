<?php
  session_start();
  unset($_SESSION["user"]); 
  unset($_SESSION["usuario"]);
  unset($_SESSION["tipo"]);
  //unset($_SESSION["nombre_cliente"]);
  session_destroy();
  header("Location: ./inicio.html");
  exit;
?>