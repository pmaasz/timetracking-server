<?php

namespace Timetracking\Server\Model;
/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 10.07.22
 * Time: 00:01
 * License
 */
class Pause
{
    /**
     * @var int
     */
    private $id;

    /**
     * begin of the pause
     *
     * @var int
     */
    private $pauseStart;

    /**
     * end of the pause
     *
     * @var int
     */
    private $pauseEnd;

    /**
     * this is the real pause the user has taken
     *
     * @var int
     */
    private $pause;

    /**
     * this is the pause the user gets subtracted of his hours
     *
     * @var int
     */
    private $pauseTotal;

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
    public function getPauseStart(): int
    {
        return $this->pauseStart;
    }

    /**
     * @param int $pauseStart
     */
    public function setPauseStart(int $pauseStart)
    {
        $this->pauseStart = $pauseStart;
    }

    /**
     * @return int
     */
    public function getPauseEnd(): int
    {
        return $this->pauseEnd;
    }

    /**
     * @param int $pauseEnd
     */
    public function setPauseEnd(int $pauseEnd)
    {
        $this->pauseEnd = $pauseEnd;
    }

    /**
     * @return int
     */
    public function getPause(): int
    {
        return $this->pause;
    }

    /**
     * @param int $pause
     */
    public function setPause(int $pause)
    {
        $this->pause = $pause;
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
}