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
        $data = Database::getInstance()->insert("INSERT INTO workday SET pauses = :pauses, time_entries = :timeEntries, pauseTotal = :pauseTotal, hoursTotal = :hoursTotal", [
            'pauses' => implode(',', $workday->getPauses()),
            'timeEntries' => implode(',', $workday->getTimeEntries()),
            'pauseTotal' => $workday->getPauseTotal(),
            'hoursTotal' => $workday->getHoursTotal(),
        ]);

        return $this->arrayToObject($data);
    }

    /**
     * @param WorkDay $workday
     *
     * @return mixed
     */
    public function update(WorkDay $workday)
    {
        $data = Database::getInstance()->insert("UPDATE workday SET pauses = :pauses, time_entries = :timeEntries, pauseTotal = :pauseTotal, hoursTotal = :hoursTotal WHERE id = :id", [
            'pauses' => implode(',', $workday->getPauses()),
            'timeEntries' => implode(',', $workday->getTimeEntries()),
            'pauseTotal' => $workday->getPauseTotal(),
            'hoursTotal' => $workday->getHoursTotal(),
            'id' => $workday->getId(),
        ]);

        return $this->arrayToObject($data);
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
    public function findById($id){
       $data = Database::getInstance()->query('SELECT * FROM workday WHERE id = :id LIMIT 1',
       [
           "id" => $id,
       ]);

       return $this->arrayToObject($data);
    }

    /**
     * @return WorkDay
     */
    public function findLatestWorkDay() {
        $data = Database::getInstance()->query('SELECT * FROM workday ORDER BY id DESC LIMIT 1');

        return $this->arrayToObject($data);
    }

    /**
     * @param WorkDay $workday
     *
     * @return Workday
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

        $object->setId($data['id']);
        $object->setPauses(explode(',', $data['pauses']));
        $object->setTimeEntries(explode(',', $data['time_entries']));
        $object->setPauseTotal($data['pauseTotal']);
        $object->setHoursTotal($data['hoursTotal']);

        return $object;
    }
}