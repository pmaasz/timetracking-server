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
    private $pauseStart = 0;

    /**
     * end of the pause
     *
     * @var int
     */
    private $pauseEnd = 0;

    /**
     * @var int
     */
    private $pause = 0;

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
}