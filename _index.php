<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Europe/Athens');
//require_once('/home/dmtrs/tools/fb.php');
// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii6/framework/yii.php';

$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();
