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

    /** @todo wire services to controller (DI) */
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
        $latestWorkday = $this->workDayRepository->findLatestWorkday();
        if($latestWorkday) {
            $latestTimeEntry = $this->timeEntryRepository->findLatestTimeEntryByWorkday($latestWorkday);
            if($latestTimeEntry && ($latestTimeEntry->getEnd() - time()) < (11*60*60)) {
                return [
                    'status' => 'error',
                    'message' => 'You have to wait 11 hours between workdays'
                ];
            }
        }

        $timeEntry = new TimeEntry();
        $timeEntry->setStart(time());
        $timeEntry = $this->timeEntryRepository->persist($timeEntry);
        $timeEntry = $this->timeEntryRepository->findOneById($timeEntry);

        $workday = new WorkDay();
        $workday->setTimeEntries([$timeEntry->getId()]);
        $workday = $this->workDayRepository->persist($workday);

        $timeEntry->setWorkday($workday);
        $this->timeEntryRepository->persist($timeEntry);

        return [
            'message' => "successfully started",
            'startTime' => $timeEntry->getStart(),
            'currentWorkday' => $workday,
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

        $currentTimeEntry = $this->timeEntryRepository->findOneById($_POST['currentTimeEntry']);
        $currentTimeEntry->setEnd(time());
        $this->timeEntryRepository->persist($currentTimeEntry);

        $currentWorkDay = $this->workDayRepository->findOneById($_POST['currentWorkday']);
        $currentWorkDay->setPauses([$pause]);
        $currentWorkDay = $this->workDayRepository->persist($currentWorkDay);

        return [
            'message' => "successfully paused",
            "currentPause" => $pause,
            "currentWorkDay" => $currentWorkDay,
        ];
    }

    /**
     * @return array
     */
    public function resumeAction()
    {
        $currentPause = $this->pauseRepository->findOneById($_POST['currentPause']);
        $currentPause->setPauseEnd(time());
        $this->pauseRepository->persist($currentPause);

        $timeEntry = new TimeEntry();
        $timeEntry->setStart(time());
        $timeEntry = $this->timeEntryRepository->persist($timeEntry);

        $currentWorkDay = $this->workDayRepository->findOneById($_POST['currentWorkday']);
        $currentWorkDay->addTimeEntry($timeEntry);
        $currentWorkDay = $this->workDayRepository->persist($currentWorkDay);

        return [
            'message' => "successfully resumed",
            "currentTimeEntry" => $timeEntry,
            "currentWorkday" => $currentWorkDay,
        ];
    }

    /**
     * @return array
     */
    public function stopAction()
    {
        $currentTimeEntry = $this->timeEntryRepository->findOneById($_POST['currentTimeEntry']);
        $currentTimeEntry->setEnd(time());
        $this->timeEntryRepository->persist($currentTimeEntry);

        $currentWorkDay = $this->workDayRepository->findOneById($_POST['currentWorkday']);
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

        //@todo fix values
        if($hoursTotal >= 6 && $pauseTotal < 30) {
            $pauseTotal = 30;
        }
        //@todo fix values
        if($hoursTotal >= 9 && $pauseTotal < 45) {
            $pauseTotal = 45;
        }

        $hoursTotal = $hoursTotal - $pauseTotal;

        $currentWorkDay->setHoursTotal($hoursTotal);
        $currentWorkDay = $this->workDayRepository->persist($currentWorkDay);

        return [
            'message' => "successfully stopped",
            "currentWorkday" => $currentWorkDay->getId(),
        ];
    }
}