<?php
namespace Views;

class View{

    public static function view($view,$data = [])
    {
        extract($data);
        include VIEW_DIR.'/'.$view.'.php';
    }

}