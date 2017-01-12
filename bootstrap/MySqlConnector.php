<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/22/16
 * Time: 11:26 PM
 */
namespace bootstrap;

class MySqlConnector implements Connection
{

    private $pdo;
    private static $model = null;

    private function __construct(array $config)
    {
        $dsn = $config['DB_CONNECTION'] . ":host=" . $config['DB_HOST'] . ";dbname=" . $config['DB_DATABASE'];

        $pdo = new \PDO($dsn, $config['DB_USERNAME'], $config['DB_PASSWORD']);

        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->pdo = $pdo;
    }

    public static function getInstance($config)
    {
        if (empty(self::$model)) {
            self::$model = new MySqlConnector($config);
        }
        return self::$model;
    }

    public function exec($query)
    {
        return $this->pdo->exec($query);
    }

    public function query($sql, array $bindParameters = [])
    {
        $statement = $this->pdo->prepare($sql);
        if($statement->execute($bindParameters) !== false){
            return true;
        }else{
            return false;
        }
    }

    public function get($sql, array $bindParameters = [], $class)
    {
        $collection = [];
        $statement = $this->pdo->prepare($sql);
        if ($statement->execute($bindParameters) !== false) {
            while ($record = $statement->fetchObject($class)) {
                $collection[] = $record;
            }
            return $collection;
        } else {
            throw new \Exception("Database query error");
        }
    }

}