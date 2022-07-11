<?php

namespace Timetracking\Server;

use Timetracking\Server\Repository\PauseRepository;
use Timetracking\Server\Repository\TimeEntryRepository;
use Timetracking\Server\Repository\WorkDayRepository;
use Timetracking\Server\Service\RoutingService;

/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 09.07.22
 * Time: 22:52
 * License
 */
class Kernel
{
    public function handleRequest($request)
    {
        $route = RoutingService::handleRouting($request->getUri()->getPath());

        $timeEntryRepository = new TimeEntryRepository();
        $pauseRepository = new PauseRepository();
        $workDayRepository = new WorkDayRepository();
        //@todo wire services to controller (DI)
        $controllerClass = '\\Timetracking\\Server\\Controller\\'.$route['controller'];
        $controller = new $controllerClass($timeEntryRepository, $pauseRepository, $workDayRepository);
        $action = $route['action'];
        $content = $controller->$action($request);

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
}