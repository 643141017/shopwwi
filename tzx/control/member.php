<?php
/**
 * APP会员
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');

class memberControl{

    public function __construct(){
        require_once(BASE_PATH.'/framework/function/client.php');
    }

    public function infoWwi(){
        if (!empty($_GET['uid'])){
            $member_info = nc_member_info($_GET['uid'],'uid');
        }elseif(!empty($_GET['user_name'])){
            $member_info = nc_member_info($_GET['user_name'],'user_name');
        }
        return $member_info;
    }
}
