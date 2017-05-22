<?php
/**
 * TZX分享
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');
class shareControl extends TZXControl{

    public function __construct() {
        parent::__construct();
    }

    /**
     * 分享保存
     **/
    public function share_saveWwi() {

        $data = array();
        $data['result'] = 'true';
        $share_id = intval($_POST['share_id']);
        $share_type = $_GET['type'];
        if($share_id <= 0 || empty($share_type) || mb_strlen($_POST['commend_message']) > 140) {
            showDialog(Language::get('wrong_argument'),'reload','fail','');
        }

        if(!empty($_SESSION['member_id'])) {
            $model = Model('tzx_'.$share_type);
            $model->modify(array($share_type.'_share_count'=>array('exp',$share_type.'_share_count+1')),array($share_type.'_id'=>$share_id));
            //分享内容
            if(isset($_POST['share_app_items'])) {
                $info['commend_message'] = $_POST['commend_message'];
                $info['share_title'] = $_POST['share_title'];
                $info['share_image'] = $_POST['share_image'];
                if(empty($info['commend_message'])) {
                    $info['commend_message'] = Language::get('share_text');
                }
                $info['url'] = TZX_SITE_URL.DS."index.php?app={$_GET['type']}&wwi={$_GET['type']}_detail&{$_GET['type']}_id=".$_POST['share_id'];
                self::share_app_publish($info);
            }
            showDialog(Language::get('nc_common_save_succ'),'','succ','');
        } else {
            showDialog(Language::get('no_login'),'reload','fail','');
        }
    }
}
