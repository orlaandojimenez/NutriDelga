<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');


require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);


$application = new yii\web\Application($config);
//$application->run();
if(isset($_GET['hash'])):
  /*$data = array();
  $data['hash'] = Yii::$app->getSecurity()->generatePasswordHash($_GET['password']);*/
  $data = array();
  $data['hash'] = Yii::$app->getSecurity()->generatePasswordHash($_GET['hash']);
  echo json_encode($data);
  //exit(Yii::$app->getSecurity()->generatePasswordHash($_GET['hash']));
endif;

?>
