<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/20/16
 * Time: 10:37 PM
 */
namespace Models;

use bootstrap\ConnectionFactory;

class Model
{
    private $sql;

    private $connection;

    private $table;

    public function __construct()
    {
        $this->connection = ConnectionFactory::connection();

        $this->table = strtolower(explode('\\', get_called_class())[1] . 's');
    }

    public function builder($sqlBuild)
    {
        $this->sql = 'select * from ' . $this->table . ' ' . $sqlBuild;
        return $this;
    }

    public function select($sql, array $bindParameters = [])
    {
        $collection = $this->connection->get($sql, $bindParameters, get_called_class());
        if (count($collection) == 1) {
            return $collection[0];
        }
        return $collection;
    }

    public function update($sql, array $bindParameters = [])
    {
        return $this->connection->query('update ' . $this->table . ' set ' . $sql, $bindParameters);
    }

    public static function all()
    {
        $instance = new static;
        return $instance->select('select * from ' . $instance->table);
    }

    public static function find($id)
    {
        $instance = new static;
        return $instance->select('select * from ' . $instance->table . ' where id=:id', ['id' => $id]);
    }

    public static function where($column, $value)
    {
        $instance = new static;
        return $instance->builder('where ' . $column . '="' . $value . '"');
    }

    public function andWhere($column, $value)
    {
        return $this->builder('and where ' . $column . '=' . $value);
    }

    public function get()
    {
        return $this->select($this->sql);
    }

    public function inc($column, $num = 1)
    {
        $count = $this->$column;
        $count = $count + $num;
        $sql = "$column=:count where id=:id";
        return $this->update($sql, ['id' => $this->id, 'count' => $count]);
    }

    public function __call($method, $parameters)
    {
        $instance = new static;
        return call_user_func([$instance, $method], $parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        $instance = new static;
        return call_user_func([$instance, $method], $parameters);
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}

