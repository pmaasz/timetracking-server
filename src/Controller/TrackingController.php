<?php
/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 07.07.22
 * Time: 20:08
 * License
 */

namespace Timetracking\Server\Controller;

class TrackingController
{
    public function startAction()
    {
        return [
            'message' => "successfully started"
        ];
    }

    public function stopAction()
    {
        return [
            'message' => "successfully stopped"
        ];
    }

    public function pauseAction()
    {
        return [
            'message' => "successfully paused"
        ];
    }

    public function resumeAction()
    {
        return [
            'message' => "successfully resumed"
        ];
    }
}