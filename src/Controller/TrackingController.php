<?php
/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 07.07.22
 * Time: 20:08
 * License
 */

namespace Timetracking\Server\Controller;

use Timetracking\Server\Model\TimeEntry;
use Timetracking\Server\Repository\TimeEntryRepository;
use Timetracking\Server\Model\Pause;
use Timetracking\Server\Repository\PauseRepository;

class TrackingController
{
    /**
     * @var TimeEntryRepository
     */
    private $timeEntryRepository;

    /**
     * @var PauseRepository
     */
    private $pauseRepository;

    public function __construct(TimeEntryRepository $timeEntryRepository, PauseRepository $pauseRepository)
    {
        $this->timeEntryRepository = $timeEntryRepository;
        $this->pauseRepository = $pauseRepository;
    }

    public function startAction()
    {
        $timeEntry = new TimeEntry();
        $timeEntry->setStart(time());

        $this->timeEntryRepository->create($timeEntry);

        return [
            'message' => "successfully started",
            'startTime' => $timeEntry->getStart()
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
        $pause = new Pause();
        $pause->setPauseStart(time());

        $this->pauseRepository->create($pause);

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