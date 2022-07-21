<?php
/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 19.07.22
 * Time: 17:52
 * License
 */

namespace Timetracking\Server\Service;

use Timetracking\Server\Model\Pause;
use Timetracking\Server\Model\WorkDay;

class TimeService
{
    /**
     * @param WorkDay $workday
     *
     * @return WorkDay
     */
    public function calculateTotalHours($workday)
    {
        $totalHours = 0;
        foreach ($workday->getTimeEntries() as $timeEntry) {
            $totalHours += $timeEntry->getHours();
        }

        $workday->setHoursTotal($totalHours);

        return $workday;
    }

    /**
     * @param WorkDay $workday
     *
     * @return WorkDay
     */
    public function calculateTotalPause($workday)
    {
        $totalPause = 0;
        foreach ($workday->getPauses() as $pause) {
            $totalPause += $pause->getPause();
        }

        $workday->setPauseTotal($totalPause);

        return $workday;
    }

    /**
     * @param Pause $pause
     *
     * @return Pause
     */
    public function calculatePause($pause)
    {
        $pause->setPause($pause->getPauseEnd() - $pause->getPauseStart());

        return $pause;
    }
}