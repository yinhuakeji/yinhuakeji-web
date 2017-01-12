<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/20/16
 * Time: 11:01 PM
 */
class Loader{
    static function autoload($class)
    {
        require DIR.'/'.str_replace('\\','/',$class).'.php';
    }
}