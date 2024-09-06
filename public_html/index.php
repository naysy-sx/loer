<?php
if ($_SERVER['REMOTE_ADDR'] != '178.71.215.22'){
    //exit;
}

//defined('YII_DEBUG') or define('YII_DEBUG', true);
//defined('YII_ENV') or define('YII_ENV', 'dev');

// echo "!@#";
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
define('YII_ENABLE_ERROR_HANDLER', false);
//define('YII_ENABLE_EXCEPTION_HANDLER', false);


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
