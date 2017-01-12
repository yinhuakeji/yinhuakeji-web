<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/22/16
 * Time: 9:52 PM
 */
namespace bootstrap;

class ConnectionFactory
{
    private $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public static function connection()
    {
        $config = require DIR . "/config/database.php";

        $instance = new static($config);

        if (!isset($instance->config['DB_CONNECTION'])) {
            throw new \ErrorException('A driver must be specified.');
        }

        switch ($instance->config['DB_CONNECTION']) {
            case 'mysql':
                return MySqlConnector::getInstance($config);
            case 'pgsql':
                return PostgresConnector::getInstance($config);
            default:
                return new \Exception("database not define");
        }
    }

}