<?php

namespace Api\Websocket;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class SistemaChat implements MessageComponentInterface {
    protected $cliente;

    public function __construct()
    {
        //Iniciar o objeto que deve armazenar os clientes conectados
        $this->cliente = new \SplObjectStorage;
    }
    // Abrir conexão para o novo cliente
    public function onOpen(ConnectionInterface $conn)
    {
        //Adicionar cliente na lista
        $this->cliente->attach($conn);

        echo "Nova conexão: {$conn->resourceId} \n\n";
    }

    //Enviar mensagens para todos os usuarios conectados
    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Percorrer a lista de usuarios conectados

        foreach($this->cliente as $cliente) {
            //Não enviar a mensagem para o usuario que enviou a mensagem
            if($from !== $cliente) {
                //Enviar as msg para os usuarios
                $cliente->send($msg);
            }
            
        }
        echo "Usuario {$from->resourceId} enviou uma ms \n\n";
    }
    //Desconectar o cliente do WebSocket
    public function onClose(ConnectionInterface $conn)
    {
        //Fechar a conexao e retirar o cliente da lista
        $this->cliente->detach($conn);

        echo "Usuario {$conn->resourceId} desconectou. \n\n";
    }

    //Função que sera chamada caso ocorra algum erro no WebSocket
    public function onError(ConnectionInterface $conn, Exception $e)
    {
        //Fechar a conexao do cliente
        $conn->close();

        echo "Ocorreu um erro: {$e->getMessage()}\n\n";
    }
}