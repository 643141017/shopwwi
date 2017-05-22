<?php
/**
 * 控制台
 *
 *
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */



defined('ByShopWWI') or exit('Access Invalid!');

class aboutusControl extends SystemControl{
    public function __construct(){
        parent::__construct();
        Language::read('dashboard');
    }

    public function indexWwi() {
        $this->aboutusWwi();
    }

    /**
     * 关于我们
     */
    public function aboutusWwi(){
        $version = C('version');
        $v_date = substr($version,0,4).".".substr($version,4,2);
        $s_date = substr(C('setup_date'),0,10);
        Tpl::output('v_date',$v_date);
        Tpl::output('s_date',$s_date);
        Tpl::showpage('aboutus', 'null_layout');
    }

}
