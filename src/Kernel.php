<?php

namespace Timetracking\Server;

/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 09.07.22
 * Time: 22:52
 * License
 */
class Kernel
{
    const ROUTES = [
        'index' => [
            'path' => '/',
            'controller' => 'DashboardController',
            'action' => 'indexAction'
        ],
        'start' => [
            'path' => '/start',
            'controller' => 'TrackingController',
            'action' => 'startAction'
        ],
        'stop' => [
            'path' => '/stop',
            'controller' => 'TrackingController',
            'action' => 'stopAction'
        ],
        'pause' => [
            'path' => '/pause',
            'controller' => 'TrackingController',
            'action' => 'pauseAction'
        ],
        'resume' => [
            'path' => '/resume',
            'controller' => 'TrackingController',
            'action' => 'resumeAction'
        ]
    ];

    public function handleRequest($request)
    {
        $route = $this->handleRouting($request->getUri()->getPath());
        $controllerClass = '\\Timetracking\\Server\\Controller\\'.$route['controller'];
        $controller = new $controllerClass;
        $action = $route['action'];
        $content = $controller->$action();

        if(!is_array($content)) {
            trigger_error('Controller action must return an array', E_USER_ERROR);
        }

        return new \React\Http\Message\Response(
            \React\Http\Message\Response::STATUS_OK,
            [
                'Content-Type' => 'text/html; charset=utf-8'
            ],
            json_encode($content),
        );
    }

    private static function handleRouting($httpPath) {
        printf("%s\n", $httpPath);

        foreach(self::ROUTES as $name => $routeParams) {
            if($routeParams['path'] === $httpPath) {
                return $routeParams;
            }
        }

        return self::ROUTES['index'];
    }
}