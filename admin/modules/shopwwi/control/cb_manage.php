<?php
/**
 * tzx管理
 *
 *
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */

//use Shopwwi\Tpl;

defined('ByShopWWI') or exit('Access Invalid!');
class cb_manageControl extends SystemControl{

    public function __construct(){
        parent::__construct();
        Language::read('cb');
    }

    public function indexWwi() {
        $this->cb_manageWwi();
    }

    /**
     * tzx设置
     */
    public function cb_manageWwi() {
        $model_setting = Model('setting');
        $setting_list = $model_setting->getListSetting();
        Tpl::output('setting',$setting_list);
        Tpl::setDirquna('shopwwi');
Tpl::showpage('cb_manage');
    }

    /**
     * tzx设置保存
     */
    public function cb_manage_saveWwi() {
        $model_setting = Model('setting');
        $update_array = array();
        $update_array['cb_isuse'] = intval($_POST['cb_isuse']);
        if(!empty($_FILES['cb_logo']['name'])) {
            $upload = new UploadFile();
            $upload->set('default_dir',ATTACH_CB);
            $result = $upload->upfile('cb_logo');
            if(!$result) {
                showMessage($upload->error);
            }
            $update_array['cb_logo'] = $upload->file_name;
            $old_image = BASE_UPLOAD_PATH.DS.ATTACH_CB.DS.C('tfx_logo');
            if(is_file($old_image)) {
                unlink($old_image);
            }
        }

        $update_array['cb_seo_title'] = $_POST['cb_seo_title'];
        $update_array['cb_seo_key'] = $_POST['cb_seo_keywords'];
        $update_array['cb_seo_dis'] = $_POST['cb_seo_description'];

        $result = $model_setting->updateSetting($update_array);
        if ($result === true){
            $this->log(Language::get('cb_log_manage_save'), 0);
            showMessage(Language::get('nc_common_save_succ'));
        }else {
            $this->log(Language::get('cb_log_manage_save'), 0);
            showMessage(Language::get('nc_common_save_fail'));
        }
    }


}
