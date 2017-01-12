<?php
/**
 * Created by PhpStorm.
 * User: hejunwei
 * Date: 11/20/16
 * Time: 10:14 PM
 */
namespace Controllers;

use Models\File;

class DownloadController extends Controller
{

    public function index()
    {
        $file = File::find($_GET['id']);
        $file->inc('download');

        $downloadFile = PUBLIC_DIR . $file->src;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($downloadFile) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($downloadFile));
        readfile($downloadFile);

    }
}