<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/21/16
 * Time: 12:06 AM
 */
namespace Views;

class View{

    public static function view($view,$data = [])
    {
        extract($data);
        include VIEW_DIR.'/'.$view.'.php';
    }

}