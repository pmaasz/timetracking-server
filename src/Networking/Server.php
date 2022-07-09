<?php

srand(\Timetracking\Server\Service\RandomService::getSeed() + time());

//load configuration
\Timetracking\Server\Service\ConfigService::getInstance()->load(__DIR__ . '/../../config/config.json');

// http sse formatted broadcast stream
$broadcastStream = new \React\Stream\ThroughStream(function ($data) {
    return $data;
});

$sseHelper = new \Timetracking\Server\Networking\SSEHelper();
$http = new React\Http\HttpServer(function (Psr\Http\Message\ServerRequestInterface $request) use($sseHelper, $broadcastStream) {
    try {
        if ($sseHelper->isSSEConnectionRequest($request)) {
            return $sseHelper->handleIncomingConnection($request, $broadcastStream);
        }

        $kernel = new \Timetracking\Server\Kernel();

        return $kernel->handleRequest($request);
    } catch (\Throwable $e) {
        print_r($e->getMessage());
        print_r($e->getTraceAsString());

        return new React\Http\Message\Response(
            React\Http\Message\Response::STATUS_INTERNAL_SERVER_ERROR,
            [],
            $e->getMessage()
        );
    }
});

//@todo implement configurable host and port
$config = \Timetracking\Server\Service\ConfigService::getInstance()->get('server');
$socket = new React\Socket\SocketServer($config['host']. ':' . $config['port']);

echo "Listening on {$socket->getAddress()}\n";

$http->listen($socket);