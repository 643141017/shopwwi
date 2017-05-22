<?php
/**
 * 店铺卖家注销
 *
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');

class seller_logoutControl extends BaseSellerControl {

    public function __construct() {
        parent::__construct();
    }

    public function indexWwi() {
        $this->logoutWwi();
    }

    public function logoutWwi() {
        $this->recordSellerLog('注销成功');
        // 清除店铺消息数量缓存
        setNcCookie('storemsgnewnum'.$_SESSION['seller_id'],0,-3600);
        session_destroy();
        redirect('index.php?app=seller_login');
    }

}
