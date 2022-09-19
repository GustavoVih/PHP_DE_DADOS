<?php

$servername = "localhost";  //Nome do nosso servdior
$username = "root"; //Nome do usuário
$password = ""; //Senha do usuário
$db_name = "aula01"; //Nome da tabeça

$connect = mysqli_connect($servername, $username, $password, $db_name);
mysqli_set_charset($connect, "utf8");

if(mysqli_connect_error()):
    echo "Erro na conexão: " .mysqli_connect_error();
endif;

?>