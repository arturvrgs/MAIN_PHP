<?php
    $banco = mysqli_connect("localhost", "root", "", "php_main");

    if(!$banco) {
        echo "Não foi possivel conectar com o banco de dados.<br>Causa: ".mysqli_connect_error();
    } 
?>