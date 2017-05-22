<?php
/**
 * 商城板块初始化文件
 *
 * 商城板块初始化文件，引用框架初始化文件
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */
define('APP_ID','tzx');
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));
require __DIR__ . '/../shopwwi.php';

if (!@include(BASE_PATH.'/config/config.ini.php')){
	@header("Location: install/index.php");die;
}

define('APP_SITE_URL', TZX_SITE_URL);
define('TPL_NAME',TPL_TZX_NAME);
define('BASE_TPL_PATH',BASE_PATH.'/templates/'.TPL_NAME);

define('TZX_RESOURCE_SITE_URL',TZX_SITE_URL.'/resource');
define('TZX_TEMPLATES_URL',TZX_SITE_URL.'/templates/'.TPL_NAME);
define('MALL_TEMPLATES_URL',MALL_SITE_URL.'/templates/'.TPL_NAME);
define('TZX_BASE_TPL_PATH',dirname(__FILE__).'/templates/'.TPL_NAME);
define('TZX_SEO_KEYWORD',$config['seo_keywords']);
define('TZX_SEO_DESCRIPTION',$config['seo_description']);
//tzx框架扩展
require(BASE_PATH.'/framework/function/function.php');
if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');

Base::run();
