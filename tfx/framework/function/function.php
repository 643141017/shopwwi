<?php
/**
 * 微商城公共方法
 *
 * 公共方法
 * * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi
 */
defined('ByShopWWI') or exit('Access Invalid!');

function getTfxImageSize($image_url, $max_width = 238) {
    $local_file_path = str_replace(UPLOAD_SITE_URL, BASE_ROOT_PATH.DS.DIR_UPLOAD, $image_url);
    if(file_exists($local_file_path)) {
        list($width, $height) = getimagesize($local_file_path);
    } else {
        list($width, $height) = getimagesize($image_url);
    }
    if($width > $max_width) {
        $height = $height * $max_width/ $width;
        $width=$max_width;
    }
    return array(
        'width' => $width,
        'height' => $height
    );
}

function getRefUrl() {
    return urlencode('http://'.$_SERVER['HTTP_HOST'].request_uri());
}
