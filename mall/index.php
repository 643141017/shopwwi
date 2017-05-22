<?php
/**
 * 商城板块初始化文件
 *
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */
define('APP_ID','mall');
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));

require __DIR__ . '/../shopwwi.php';


define('APP_SITE_URL',MALL_SITE_URL);
define('TPL_NAME',TPL_MALL_NAME);
define('MALL_RESOURCE_SITE_URL',MALL_SITE_URL.DS.'resource');
define('MALL_TEMPLATES_URL',MALL_SITE_URL.'/templates/'.TPL_NAME);
define('BASE_TPL_PATH',BASE_PATH.'/templates/'.TPL_NAME);
if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');
Base::run();
