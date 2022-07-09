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
    private $start;

    /**
     * end of the work day
     *
     * @var int
     */
    private $end;

    /**
     * these are the hours before and after the pause but without work time constrains
     *
     * @var int
     */
    private $hours;



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
}