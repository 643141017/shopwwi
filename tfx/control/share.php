<?php
/**
 * 微商城分享
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');
class shareControl extends TfxControl{

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
        $share_type = self::get_channel_type($_GET['type']);
        if($share_id <= 0 || empty($share_type) || mb_strlen($_POST['commend_message']) > 140) {
            showDialog(Language::get('wrong_argument'),'reload','fail','');
        }

        if(!empty($_SESSION['member_id'])) {
            $model = Model("micro_{$_GET['type']}");
            //分享内容
            if(isset($_POST['share_app_items'])) {
                $condition = array();
                $condition[$share_type['type_key']] = $_POST['share_id'];
                if($_GET['type'] == 'store') {
                    $info = $model->getOneWithStoreInfo($condition);
                } else {
                    $info = $model->getOne($condition);
                }
                $info['commend_message'] = $_POST['commend_message'];
                if(empty($info['commend_message'])) {
                    $info['commend_message'] = Language::get('tfx_share_default_message');
                }
                $info['type'] = $_GET['type'];
                $info['url'] = TFX_SITE_URL.DS."index.php?app={$_GET['type']}&wwi=detail&{$_GET['type']}_id=".$_POST['share_id'];
                self::share_app_publish('share',$info);
            }
            showDialog(Language::get('nc_common_save_succ'),'','succ','');
        } else {
            showDialog(Language::get('no_login'),'reload','fail','');
        }
    }
}
