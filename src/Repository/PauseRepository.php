<?php

namespace Timetracking\Server\Repository;

use Timetracking\Server\Model\Pause;
use Timetracking\Server\Service\Database;

/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 10.07.22
 * Time: 00:04
 * License
 */
class PauseRepository
{
    /**
     * @param Pause $pause
     *
     * @return mixed
     */
    public function create(Pause $pause)
    {
        return Database::getInstance()->insert("INSERT INTO pause SET pause_start = :pauseStart, pause_end = :pauseEnd, pause = :pause", [
            'pauseStart' => $pause->getPauseStart(),
            'pauseEnd' => $pause->getPauseEnd(),
            'pause' => $pause->getPause(),
        ]);
    }

    /**
     * @param Pause $workday
     *
     * @return mixed
     */
    public function update(Pause $pause)
    {
        return Database::getInstance()->insert("UPDATE pause SET pause_start = :pauseStart, pause_end = :pauseEnd, pause = :pause WHERE id = :id", [
            'pauseStart' => $pause->getPauseStart(),
            'pauseEnd' => $pause->getPauseEnd(),
            'pause' => $pause->getPause(),
            'id' => $pause->getId(),
        ]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return Database::getInstance()->query('DELETE FROM pause WHERE id = :id', [
            'id' => $id,
        ]);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function findOneById($id){
        $data = Database::getInstance()->query('SELECT * FROM pause WHERE id = :id LIMIT 1',
            [
                "id" => $id,
            ]);

        if(!$data || count($data) == 0) {
            return false;
        }

        return $this->arrayToObject($data[0]);
    }

    /**
     * @param Pause $pause
     *
     * @return mixed
     */
    public function persist(Pause $pause)
    {
        if($pause->getId() !== null)
        {
            return $this->update($pause);
        }

        return $this->create($pause);
    }

    /**
     * @param $data
     *
     * @return Pause
     */
    private function arrayToObject($data)
    {
        $object = new Pause();

        $object->setId((int)$data['id']);
        $object->setPauseStart((int)$data['pause_start']);
        $object->setPauseEnd((int)$data['pause_end']);
        $object->setPause((int)$data['pause']);

        return $object;
    }
}