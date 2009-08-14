<?php

// change the following paths if necessary
switch( $_SERVER["SERVER_NAME"] )
{
    case 'storedbyu.imre.local':
                    $yii=dirname(__FILE__).'/../../yii/framework/yii.php';
                    break;
    default:
                    $yii=dirname(__FILE__).'/../yii/framework/yii.php';
}

$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();
