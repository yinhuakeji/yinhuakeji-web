<?php
/**
 * Created by PhpStorm.
 * User: yinhuakeji
 * Date: 11/21/16
 * Time: 12:13 AM
 */
namespace Controllers;

use Models\Msg;

class IndexController extends Controller
{
    public function index()
    {
        return \Views\View::view('index');
    }

    public function gallery()
    {
        return \Views\View::view('gallery');
    }

    public function show()
    {
        return var_dump(Msg::find(1)->content);
    }
}
