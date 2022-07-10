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
use Timetracking\Server\Model\WorkDay;
use Timetracking\Server\Repository\TimeEntryRepository;
use Timetracking\Server\Model\Pause;
use Timetracking\Server\Repository\PauseRepository;
use Timetracking\Server\Repository\WorkDayRepository;

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

    /**
     * @var WorkDayRepository
     */
    private $workDayRepository;

    /** @todo wire services to controller */
    public function __construct(TimeEntryRepository $timeEntryRepository, PauseRepository $pauseRepository, WorkDayRepository $workDayRepository)
    {
        $this->timeEntryRepository = $timeEntryRepository;
        $this->pauseRepository = $pauseRepository;
        $this->workDayRepository = $workDayRepository;
    }

    /**
     * @return array
     */
    public function startAction()
    {
        //@todo 11h between workdays

        $timeEntry = new TimeEntry();
        $timeEntry->setStart(time());

        $timeEntry = $this->timeEntryRepository->persist($timeEntry);

        $workday = new WorkDay();
        $workday->setTimeEntries([$timeEntry->getId()]);

        $workday = $this->workDayRepository->persist($workday);

        return [
            'message' => "successfully started",
            'startTime' => $timeEntry->getStart(),
            'currentWorkday' => $workday->getId(),
            'currentTimeEntry' => $timeEntry->getId(),
        ];
    }

    /**
     * @return array
     */
    public function pauseAction()
    {
        $pause = new Pause();
        $pause->setPauseStart(time());
        $pause = $this->pauseRepository->persist($pause);

        $currentTimeEntry = $this->timeEntryRepository->findById($_POST['currentTimeEntry']);
        $currentTimeEntry->setEnd(time());
        $this->timeEntryRepository->persist($currentTimeEntry);

        $currentWorkDay = $this->workDayRepository->findById($_POST['currentWorkday']);
        $currentWorkDay->setPauses([$pause->getId()]);

        return [
            'message' => "successfully paused",
            "currentPause" => $pause->getId(),
            "currentWorkDay" => $currentWorkDay->getId(),
        ];
    }

    /**
     * @return array
     */
    public function resumeAction()
    {
        $currentPause = $this->pauseRepository->findById($_POST['currentPause']);
        $currentPause->setPauseEnd(time());
        $this->pauseRepository->persist($currentPause);

        $timeEntry = new TimeEntry();
        $timeEntry->setStart(time());
        $timeEntry = $this->timeEntryRepository->persist($timeEntry);

        $currentWorkDay = $this->workDayRepository->findById($_POST['currentWorkday']);
        $currentWorkDay->addTimeEntry($timeEntry->getId());

        return [
            'message' => "successfully resumed",
            "currentTimeEntry" => $timeEntry->getId(),
            "currentWorkday" => $currentWorkDay->getId(),
        ];
    }

    /**
     * @return array
     */
    public function stopAction()
    {
        $currentTimeEntry = $this->timeEntryRepository->findById($_POST['currentTimeEntry']);
        $currentTimeEntry->setEnd(time());

        $currentWorkDay = $this->workDayRepository->findById($_POST['currentWorkday']);
        $timeEntries = $currentWorkDay->getTimeEntries();
        $pauses = $currentWorkDay->getPauses();

        $hoursTotal = 0;
        foreach($timeEntries as $timeEntry)
        {
            $hoursTotal += $timeEntry->getHours();
        }

        $pauseTotal = 0;
        foreach($pauses as $pause)
        {
            $pauseTotal += $pause->getPause();
        }

        //@todo implement working agreement with 6h break, 9h break, upper limit of 10h per day

        return [
            'message' => "successfully stopped",
            "currentTimeEntry" => $currentTimeEntry->getId(),
            "currentWorkday" => $currentWorkDay->getId(),
        ];
    }
}