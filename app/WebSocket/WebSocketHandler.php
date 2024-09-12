<?php

namespace App\WebSocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketHandler implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // عندما يتم فتح اتصال جديد
        $this->clients->attach($conn);
        echo "New connection: ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // عندما يتم تلقي رسالة جديدة من عميل معين
        echo "New message from connection {$from->resourceId}: {$msg}\n";

        // إرسال الرسالة إلى جميع العملاء
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // إرسال الرسالة إلى جميع العملاء ما عدا العميل الذي أرسلها
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // عندما يتم إغلاق الاتصال
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // عند حدوث خطأ
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
