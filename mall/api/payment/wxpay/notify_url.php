<?php
/**
 * 接收微信支付异步通知回调地址
 *
 * 
 * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */
error_reporting(7);
$_GET['app']	= 'payment';
$_GET['wwi']		= 'wxpay_notify';
require_once(dirname(__FILE__).'/../../../index.php');
