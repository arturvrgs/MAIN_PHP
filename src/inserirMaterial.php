<?php
    include("conexao.php");
    session_start();
    $titulo = $_POST["titulo"];
    $desc = $_POST["desc"];
    $arquivo = $_POST["arquivo"];
    $nome = $_SESSION["nome_usuario"].' '.$_SESSION["sobrenome_usuario"];
    
    $sql = mysqli_query($banco, "insert into materiais values('$titulo', '$desc', NOW(), '$arquivo', '$nome');");
    if ($sql) {
        header("location:../materiais.php");
        echo "Material cadastrado com sucesso";
    } else {
        echo "Não foi possivel cadastrar.<br>Causa:".mysqli_error($banco);
    }

    mysqli_close(($banco));
    
?>