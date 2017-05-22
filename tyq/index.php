<?php
/**
 * 圈子板块初始化文件
 *
 * 圈子板块初始化文件，引用框架初始化文件
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */
define('APP_ID','tyq');
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));

require __DIR__ . '/../shopwwi.php';

define('APP_SITE_URL', TYQ_SITE_URL);
define('TPL_NAME', TPL_TYQ_NAME);
define('TYQ_TEMPLATES_URL', TYQ_SITE_URL.'/templates/'.TPL_NAME);
define('MALL_TEMPLATES_URL',MALL_SITE_URL.'/templates/'.TPL_NAME);
define('TYQ_RESOURCE_SITE_URL',TYQ_SITE_URL.'/resource');
require(BASE_PATH.'/framework/function/function.php');

require(BASE_PATH.'/control/control.php');
Base::run();
