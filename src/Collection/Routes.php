<?php

namespace Timetracking\Server\Collection;

class Routes
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