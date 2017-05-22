<?php
/**
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672 欢迎加入MALL WWI.COM
 */
define('APP_ID','chain');
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));

require __DIR__ . '/../shopwwi.php';

define('APP_SITE_URL', CHAIN_SITE_URL);
define('CHAIN_TEMPLATES_URL', CHAIN_SITE_URL.'/templates/'.TPL_CHAIN_NAME);
define('BASE_CHAIN_TEMPLATES_URL', dirname(__FILE__).'/templates/'.TPL_CHAIN_NAME);
define('CHAIN_RESOURCE_SITE_URL',CHAIN_SITE_URL.'/resource');
define('TPL_NAME', TPL_CHAIN_NAME);
define('MALL_TEMPLATES_URL',MALL_SITE_URL.'/templates/'.TPL_NAME);
if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');
Base::run();
