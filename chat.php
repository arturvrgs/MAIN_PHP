<?php 
    session_start();
    $nome = $_SESSION["nome_usuario"].' '.$_SESSION["sobrenome_usuario"];
    $foto = $_SESSION["foto_usuario"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col justify-center h-screen items-center w-screen">
    <!-- Receber as mensagens do chat enviado pelo JS -->
    <div class="h-screen border border-gray-800 w-2/6 flex flex-col justify-between p-2">
        <span class="" id="mensagem-chat"></span>
        <div class="flex items-center justify-center mb-5">
            <input class="border border-gray-800 py-3 w-full" type="text" name="mensagem" id="mensagem" placeholder="Digite a mensagem">
            <input class="bg-red-600 py-3 w-1/4 text-center text-white hover:bg-red-700 cursor-pointer rounded-SM" type="button" value="Enviar" onclick="enviar()">
        </div>
    </div>
    <script>
       const mensagemChat = document.getElementById("mensagem-chat")

       const ws = new WebSocket('ws://localhost:8080');

       ws.onopen = (e) => {
            console.log('Conectado!');
       }

       ws.onmessage = (mensagemRecebida) => {
           let resultado = JSON.parse(mensagemRecebida.data);
           mensagemChat.insertAdjacentHTML('beforeend', `<p class='bg-red-800 p-5 text-white'>${resultado.mensagem}</p> <br>`)
       }

       const enviar = () => {
            let mensagem = document.getElementById("mensagem")

            let dados = {
                mensagem: mensagem.value
            }

            ws.send(JSON.stringify(dados))
     
            mensagemChat.insertAdjacentHTML('beforeend', `<p class='bg-red-400 p-5 text-white'>${mensagem.value}</p> <br>`)

            mensagem.value = ''
       }
    </script>
</body>
</html>