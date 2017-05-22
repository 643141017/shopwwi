<?php
/**
 * 显示图片
 *
 *
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */



defined('ByShopWWI') or exit('Access Invalid!');

class show_picsControl extends SystemControl {

	public function __construct() {
        parent::__construct();
    }

	public function indexWwi(){

        $type = trim($_GET['type']);
        if(empty($_GET['pics'])) {
            $this->goto_index();
        }
        $pics = explode('|',trim($_GET['pics']));
        $pic_path = '';
        switch ($type) {
            case 'inform':
                $pic_path = UPLOAD_SITE_URL.'/mall/inform/';
                break;
            case 'complain':
                $pic_path = UPLOAD_SITE_URL.'/mall/complain/';
                break;
            default:
                $this->goto_index();
                break;
        }

        Tpl::output('pic_path',$pic_path);
		Tpl::output('pics',$pics);
		//输出页面
		Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
		Tpl::showpage('show_pics','blank_layout');
	}

    private function goto_index() {
	    @header("Location: index.php");
		exit;
    }
}
