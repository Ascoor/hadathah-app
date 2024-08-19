<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\WebSocket\WebSocketHandler;

class WebSocketServer extends Command
{
    protected $signature = 'websocket:serve';

    public function handle()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketHandler()
                )
            ),
            8080
        );

        $this->info('WebSocket server started on port 8080');
        $server->run();
    }
}
