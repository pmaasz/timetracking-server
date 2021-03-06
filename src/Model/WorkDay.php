<?php
/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 10.07.22
 * Time: 00:30
 * License
 */

namespace Timetracking\Server\Model;

class WorkDay
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var TimeEntry[]
     */
    private $timeEntries = [];

    /**
     * @var Pause[]
     */
    private $pauses = [];

    /**
     * @var int
     */
    private $pauseTotal = 0;

    /**
     * @var int
     */
    private $hoursTotal = 0;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getTimeEntries(): array
    {
        return $this->timeEntries;
    }

    /**
     * @param int $timeEntry
     *
     * @return void
     */
    public function addTimeEntry($timeEntry)
    {
        $this->timeEntries[] = $timeEntry;
    }

    /**
     * @param TimeEntry[]|array $timeEntries
     */
    public function setTimeEntries(array $timeEntries)
    {
        $this->timeEntries = $timeEntries;
    }

    /**
     * @return Pause[]
     */
    public function getPauses(): array
    {
        return $this->pauses;
    }

    /**
     * @param Pause $pause
     *
     * @return void
     */
    public function addPause(Pause $pause)
    {
        $this->pauses[] = $pause->getId();
    }

    /**
     * @param Pause[]|array $pauses
     */
    public function setPauses(array $pauses)
    {
        $this->pauses = $pauses;
    }

    /**
     * @return int
     */
    public function getPauseTotal(): int
    {
        return $this->pauseTotal;
    }

    /**
     * @param int $pauseTotal
     */
    public function setPauseTotal(int $pauseTotal)
    {
        $this->pauseTotal = $pauseTotal;
    }

    /**
     * @return int
     */
    public function getHoursTotal(): int
    {
        return $this->hoursTotal;
    }

    /**
     * @param int $hoursTotal
     */
    public function setHoursTotal(int $hoursTotal)
    {
        $this->hoursTotal = $hoursTotal;
    }
}