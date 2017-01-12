<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/22/16
 * Time: 11:26 PM
 */
namespace bootstrap;

class PostgresConnector implements Connection
{
    private static $model = null;
    private $pdo;
    private $query;

    private function __construct(array $config)
    {
        $dsn = $config['DB_CONNECTION'] . ":host=" . $config['DB_HOST'] .";port=".$config['DB_PORT'].";dbname=" . $config['DB_DATABASE'].";user=".$config['DB_USERNAME'].";password=".$config['DB_PASSWORD'];

        $pdo = new \PDO($dsn);

        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->pdo = $pdo;
    }

    public static function getInstance($config)
    {
        if (!self::$model) {
            self::$model = new PostgresConnector($config);
        }
        return self::$model;
    }

    public function exec($query)
    {
        return $this->pdo->exec($query);
    }

    public function query($sql)
    {
        $this->query = $this->pdo->prepare($sql);
        return $this->query->execute();
    }

    public function get($sql, $class)
    {
        $collection = [];
        $query = $this->pdo->prepare($sql);
        $query->execute();
        while ($record = $query->fetchObject($class)) {
            $collection[] = $record;
        }
        return $collection;
    }
}