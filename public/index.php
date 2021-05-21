<?php
/**
 * Created by PhpStorm.
 * User: yinhuakeji
 * Date: 11/20/16
 * Time: 12:49 PM
 */

ini_set('display_errors', 1);

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

define('DIR', dirname(__DIR__));
define('PUBLIC_DIR', __DIR__);
define('CONTROLLER_DIR', DIR . '/Controller');
define('MODEL_DIR', DIR . '/Models');
define('VIEW_DIR', DIR . '/Views');

require_once DIR . "/autoload.php";

spl_autoload_register("Loader::autoload");

require_once '../routes.php';