<?php

/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 21.07.22
 * Time: 18:29
 * License
 */

use PHPUnit\Framework\TestCase;
use Timetracking\Server\Repository\TimeEntryRepository;
use Timetracking\Server\Repository\PauseRepository;
use Timetracking\Server\Repository\WorkDayRepository;
use Timetracking\Server\Controller\TrackingController;
use React\Http\Message\ServerRequest;

class TrackingControllerTest extends TestCase
{
    private TimeEntryRepository $timeEntryRepository;
    private PauseRepository $pauseRepository;
    private WorkDayRepository $workDayRepository;

    protected function setUp(): void
    {
        $this->timeEntryRepository = $this->createMock(TimeEntryRepository::class);
        $this->pauseRepository = $this->createMock(PauseRepository::class);
        $this->workDayRepository = $this->createMock(WorkDayRepository::class);
    }

    //test start action of TrackingController
    public function testStartAction()
    {
        $trackingController = new TrackingController($this->timeEntryRepository, $this->pauseRepository, $this->workDayRepository);
        $request = new ServerRequest( "POST", "/start");

        $response = $trackingController->startAction($request);
        $this->assertNotEmpty($response);
    }
}