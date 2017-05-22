<?php
/**
 * 队列
 *
 *
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */
$_SERVER['argv'][1] = $_GET['app'];
@$_SERVER['argv'][2] = $_GET['wwi'];

if (empty($_SERVER['argv'][1])) exit('Access Invalid!');

define('APP_ID','crontab');
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));
define('TRANS_MASTER',true);
require __DIR__ . '/../shopwwi.php';

if (PHP_SAPI == 'cli') {
     $_GET['app'] = $_SERVER['argv'][1];
     $_GET['wwi'] = empty($_SERVER['argv'][2]) ? 'index' : $_SERVER['argv'][2];
}
if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');
Base::run();
