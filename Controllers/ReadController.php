<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/20/16
 * Time: 10:15 PM
 */
namespace Controllers;

use Models\File;
use Views\View;

class ReadController extends Controller
{

    public function __construct()
    {
        if(!$_GET['id']){
            die('非法访问');
        }
    }

    public function show()
    {
        $file = File::find($_GET['id']);
        $file->inc('read_count');
        if($file->type == 'pdf'){
            return View::view('show',compact('file'));
        }

        $downloadFile = PUBLIC_DIR . $file->src;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($downloadFile) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($downloadFile));
        readfile($downloadFile);
        $this->redirect('/');

        return exit;
    }

    public function inc()
    {
        if (isset($_GET['time'], $_GET['id'])) {
            $file = File::find($_GET['id']);
            $file->inc('read_time', $_GET['time']);
            return true;
        }
        return false;
    }
}