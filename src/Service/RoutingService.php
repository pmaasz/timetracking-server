<?php
/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 11.07.22
 * Time: 16:50
 * License
 */

namespace Timetracking\Server\Service;

use Timetracking\Server\Collection\Routes;

class RoutingService
{
    /**
     * @param $httpPath
     *
     * @return string[]
     */
    public static function handleRouting($httpPath) {
        printf("%s\n", $httpPath);

        foreach(Routes::ROUTES as $name => $routeParams) {
            if($routeParams['path'] === $httpPath) {
                return $routeParams;
            }
        }

        return Routes::ROUTES['index'];
    }
}