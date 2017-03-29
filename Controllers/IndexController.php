<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/21/16
 * Time: 12:13 AM
 */
namespace Controllers;

use Models\File;

class IndexController extends Controller
{
    public function index()
    {
        return \Views\View::view('index');
    }

    public function show()
    {
        return Msg::find(1);
    }
}
