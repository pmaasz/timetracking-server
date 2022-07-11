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
}