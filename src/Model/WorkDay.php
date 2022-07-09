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
    private $timeEntries;

    /**
     * @var Pause[]
     */
    private $pauses;

    /**
     * @return int
     */
    public function getId(): int
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
     * @return TimeEntry[]
     */
    public function getTimeEntries(): array
    {
        return $this->timeEntries;
    }

    /**
     * @param TimeEntry $timeEntry
     *
     * @return void
     */
    public function addTimeEntry(TimeEntry $timeEntry)
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
        $this->pauses[] = $pause;
    }

    /**
     * @param Pause[]|array $pauses
     */
    public function setPauses(array $pauses)
    {
        $this->pauses = $pauses;
    }
}