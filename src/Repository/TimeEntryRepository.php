<?php

namespace Timetracking\Server\Repository;

use Timetracking\Server\Model\WorkDay;
use Timetracking\Server\Service\Database;
use Timetracking\Server\Model\TimeEntry;

/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 10.07.22
 * Time: 00:02
 * License
 */
class TimeEntryRepository
{
    /**
     * @param TimeEntry $timeEntry
     *
     * @return mixed
     */
    public function create(TimeEntry $timeEntry)
    {
        return Database::getInstance()->insert("INSERT INTO time_entry SET start = :start, end = :end, hours = :hours", [
            "start" => $timeEntry->getStart(),
            "end" => $timeEntry->getEnd(),
            "hours" => $timeEntry->getHours(),
        ]);
    }

    /**
     * @param TimeEntry $timeEntry
     *
     * @return mixed
     */
    public function update(TimeEntry $timeEntry)
    {
        return Database::getInstance()->insert("UPDATE time_entry SET start = :start, end = :end, hours = :hours WHERE id = :id", [
            "start" => $timeEntry->getStart(),
            "end" => $timeEntry->getEnd(),
            "hours" => $timeEntry->getHours(),
            'id' => $timeEntry->getId(),
        ]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return Database::getInstance()->query('DELETE FROM time_entry WHERE id = :id', [
            'id' => $id,
        ]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function findOneById($id){
        $data = Database::getInstance()->query('SELECT * FROM time_entry WHERE id = :id LIMIT 1',
            [
                "id" => $id,
            ]);

        if(!$data) {
            return $data;
        }

        return $this->arrayToObject($data);
    }

    /**
     * @param WorkDay $workday
     *
     * @return TimeEntry
     */
    public function findLatestTimeEntryByWorkday($workday)
    {
        $data = Database::getInstance()->query("SELECT * FROM time_entry 
            INNER JOIN workday ON time_entry.workday_id = workday.id 
            WHERE workday_id = :workdayId LIMIT 1",
        [
            'workdayId' => $workday->getId(),
        ]);

        if(!$data) {
            return $data;
        }

        return $this->arrayToObject($data);
    }

    /**
     * @param TimeEntry $timeEntry
     *
     * @return mixed
     */
    public function persist(TimeEntry $timeEntry)
    {
        if($timeEntry->getId() !== null)
        {
            return $this->update($timeEntry);
        }

        return $this->create($timeEntry);
    }

    /**
     * @param $data
     *
     * @return TimeEntry
     */
    private function arrayToObject($data)
    {
        $object = new TimeEntry();

        $object->setId($data['id']);
        $object->setStart($data['start']);
        $object->setEnd($data['end']);
        $object->setHours($data['hours']);

        return $object;
    }
}