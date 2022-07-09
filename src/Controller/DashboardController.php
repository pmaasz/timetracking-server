<?php

namespace Timetracking\Server\Controller;

class DashboardController
{
    public function indexAction()
    {
        return [
            'message' => "Dashboard"
        ];
    }
}