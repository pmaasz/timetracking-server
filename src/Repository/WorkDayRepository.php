<?php
/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 10.07.22
 * Time: 00:36
 * License
 */

namespace Timetracking\Server\Repository;

use Timetracking\Server\Model\WorkDay;
use Timetracking\Server\Service\Database;

class WorkDayRepository
{
    /**
     * @param WorkDay $workday
     *
     * @return mixed
     */
    public function create(WorkDay $workday)
    {
        return Database::getInstance()->insert("INSERT INTO workday SET pauses = :pauses, time_entries = :timeEntries,  pause_total = :pauseTotal, hours_total = :hoursTotal", [
            'pauses' => implode(',', $workday->getPauses()),
            'timeEntries' => implode(',', $workday->getTimeEntries()),
            'pauseTotal' => $workday->getPauseTotal(),
            'hoursTotal' => $workday->getHoursTotal(),
        ]);
    }

    /**
     * @param WorkDay $workday
     *
     * @return mixed
     */
    public function update(WorkDay $workday)
    {
        return Database::getInstance()->insert("UPDATE workday SET pauses = :pauses, time_entries = :timeEntries, pause_total = :pauseTotal, hours_total = :hoursTotal WHERE id = :id", [
            'pauses' => implode(',', $workday->getPauses()),
            'timeEntries' => implode(',', $workday->getTimeEntries()),
            'pauseTotal' => $workday->getPauseTotal(),
            'hoursTotal' => $workday->getHoursTotal(),
            'id' => $workday->getId(),
        ]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return Database::getInstance()->query('DELETE FROM workday WHERE id = :id', [
            'id' => $id,
        ]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function findOneById($id){
       $data = Database::getInstance()->query('SELECT * FROM workday WHERE id = :id LIMIT 1',
       [
           "id" => $id,
       ]);

        if(!$data || count($data) == 0) {
            return false;
        }

       return $this->arrayToObject($data[0]);
    }

    /**
     * @return mixed
     */
    public function findLatestWorkDay() {
        $data = Database::getInstance()->query('SELECT * FROM workday ORDER BY id DESC LIMIT 1');

        if(!$data || count($data) == 0) {
            return false;
        }

        return $this->arrayToObject($data);
    }

    /**
     * @param WorkDay $workday
     *
     * @return mixed
     */
    public function persist(WorkDay $workday)
    {
        if($workday->getId() !== null)
        {
            return $this->update($workday);
        }

        return $this->create($workday);
    }

    /**
     * @param $data
     *
     * @return WorkDay
     */
    private function arrayToObject($data)
    {
        $object = new WorkDay();

        $object->setId(intval($data['id']));
        $object->setPauses(explode(',', $data['pauses']));
        $object->setTimeEntries(explode(',', $data['time_entries']));
        $object->setPauseTotal(intval($data['pause_total']));
        $object->setHoursTotal(intval($data['hours_total']));

        return $object;
    }
}