<?php
/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 10.07.22
 * Time: 00:40
 * License
 */

namespace Timetracking\Server\Service;

class Database
{
    use Singleton;

    /**
     * @var \PDO
     */
    private $connection;

    /**
     * connects to Database
     */
    private function connect()
    {
        $config = ConfigService::getInstance()->get('database');
        $this->connection = new \PDO($this->getDSN($config), $config['user'], $config['password']);
    }

    /**
     * @param $query
     * @param array $parameters
     *
     * @return bool
     */
    public function insert($query, array $parameters = array())
    {
        $statement = $this->connection->prepare($query);

        foreach($parameters as $key => $value)
        {
            $statement->bindValue(':'.$key, $value);
        }

        return $statement->execute();
    }

    /**
     * @param $query
     * @param array $parameters
     *
     * @return array
     */
    public function query($query, array $parameters = array())
    {
        $statement = $this->connection->prepare($query);

        foreach($parameters as $key => $value)
        {
            $statement->bindValue(':'.$key, $value);
        }

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Database constructor.
     */
    protected function __construct()
    {
        $this->connect();
    }

    /**
     * @param $config
     *
     * @return string
     */
    private function getDSN($config)
    {
        return sprintf("%s:host=%s;dbname=%s", $config['driver'], $config['host'], $config['dbname']);
    }
}