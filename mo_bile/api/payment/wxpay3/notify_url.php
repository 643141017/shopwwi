<?php
/**
 * 微信支付通知地址
 *
 * 
 * @copyright  Copyright (c) 2007-2015 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.com
 * @link       http://www.shopwwi.com
 * @since      File available since Release v1.1
 */
$_GET['app']	= 'payment';
$_GET['wwi']		= 'notify';
$_GET['payment_code'] = 'wxpay3';
require_once(dirname(__FILE__).'/../../../index.php');
