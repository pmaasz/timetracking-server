<?php

namespace Timetracking\Server\Model;

class TimeEntry
{
    /**
     * @var int
     */
    private $id;

    /**
     * begin of the work day
     *
     * @var int
     */
    private $start = 0;

    /**
     * end of the work day
     *
     * @var int
     */
    private $end = 0;

    /**
     * @var int
     */
    private $hours = 0;

    /**
     * @var int
     */
    private $workDay;

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
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * @param int $start
     */
    public function setStart(int $start)
    {
        $this->start = $start;
    }

    /**
     * @return int
     */
    public function getEnd(): int
    {
        return $this->end;
    }

    /**
     * @param int $end
     */
    public function setEnd(int $end)
    {
        $this->end = $end;
    }

    /**
     * @return int
     */
    public function getHours(): int
    {
        return $this->hours;
    }

    /**
     * @param int $hours
     */
    public function setHours(int $hours)
    {
        $this->hours = $hours;
    }

    /**
     * @return int
     */
    public function getWorkDay(): int
    {
        return $this->workDay;
    }

    /**
     * @param int $workDay
     */
    public function setWorkDay(int $workDay)
    {
        $this->workDay = $workDay;
    }
}