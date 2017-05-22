<?php
/**
 * 商城板块初始化文件
 *
 * 商城板块初始化文件，引用框架初始化文件
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672 欢迎加入MALL WWI.COM
 */
define('APP_ID','tfx');
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));

require __DIR__ . '/../shopwwi.php';

define('APP_SITE_URL', TFX_SITE_URL);
define('TFX_IMG_URL',UPLOAD_SITE_URL.DS.ATTACH_TFX);
define('TPL_NAME',TPL_TFX_NAME);
define('TFX_RESOURCE_SITE_URL',TFX_SITE_URL.'/resource');
define('TFX_TEMPLATES_URL',TFX_SITE_URL.'/templates/'.TPL_NAME);
define('TFX_BASE_TPL_PATH',dirname(__FILE__).'/templates/'.TPL_NAME);

//define('TFX_SEO_KEYWORD',$config['seo_keywords']);
//define('TFX_SEO_DESCRIPTION',$config['seo_description']);

define('TFX_SEO_KEYWORD',C('seo_keywords'));
define('TFX_SEO_DESCRIPTION',C('seo_description'));

//微商城框架扩展
require(BASE_PATH.'/framework/function/function.php');

if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');
Base::run();
