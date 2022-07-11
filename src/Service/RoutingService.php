<?php
/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 11.07.22
 * Time: 16:50
 * License
 */

namespace Timetracking\Server\Service;

class RoutingService
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

    /**
     * @param $httpPath
     *
     * @return string[]
     */
    public static function handleRouting($httpPath) {
        printf("%s\n", $httpPath);

        foreach(self::ROUTES as $name => $routeParams) {
            if($routeParams['path'] === $httpPath) {
                return $routeParams;
            }
        }

        return self::ROUTES['index'];
    }
}