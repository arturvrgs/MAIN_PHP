<?php
    include("conexao.php");
    
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $telefone = $_POST["telefone"];
    $curso = $_POST["curso"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $foto = $_POST["foto"];
    
    //verificação sem foto

    if($foto == '' || null) {
        $foto = "https://i.pinimg.com/736x/04/49/60/044960ceb389aa1c32ca024ee774e12a.jpg";
    } 
    
    $sql = mysqli_query($banco, "insert into usuario values(null, '$nome', '$sobrenome', '$telefone', '$curso', '$email', '$senha', '$foto');");
    if ($sql) {

        header("location:../index.html");
        echo "Contato cadastrado com sucesso";
    } else {
        echo "Não foi possivel cadastrar.<br>Causa:".mysqli_error($banco);
    }

    mysqli_close(($banco));
?>