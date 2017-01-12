<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/21/16
 * Time: 10:49 AM
 */
namespace Controllers;

class Controller{

    public function redirect($uri)
    {
        $url = $uri;
        header('Location: '.$url);
    }

}