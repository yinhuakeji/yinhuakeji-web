<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/23/16
 * Time: 12:22 AM
 */
namespace bootstrap;

interface Connection
{
    public function exec($query);

    public function query($sql,array $bindParameters);

    public function get($sql, array $bindParameters, $class);
}