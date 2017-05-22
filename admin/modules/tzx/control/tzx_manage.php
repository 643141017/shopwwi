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
class tzx_manageControl extends SystemControl{

    public function __construct(){
        parent::__construct();
        Language::read('tzx');
    }

    public function indexWwi() {
        $this->tzx_manageWwi();
    }

    /**
     * tzx设置
     */
    public function tzx_manageWwi() {
        $model_setting = Model('setting');
        $setting_list = $model_setting->getListSetting();
        Tpl::output('setting',$setting_list);
        Tpl::setDirquna('tzx');
Tpl::showpage('tzx_manage');
    }

    /**
     * tzx设置保存
     */
    public function tzx_manage_saveWwi() {
        $model_setting = Model('setting');
        $update_array = array();
        $update_array['tzx_isuse'] = intval($_POST['tzx_isuse']);
        if(!empty($_FILES['tzx_logo']['name'])) {
            $upload = new UploadFile();
            $upload->set('default_dir',ATTACH_TZX);
            $result = $upload->upfile('tzx_logo');
            if(!$result) {
                showMessage($upload->error);
            }
            $update_array['tzx_logo'] = $upload->file_name;
            $old_image = BASE_UPLOAD_PATH.DS.ATTACH_TZX.DS.C('tfx_logo');
            if(is_file($old_image)) {
                unlink($old_image);
            }
        }
        $update_array['tzx_submit_verify_flag'] = intval($_POST['tzx_submit_verify_flag']);
        $update_array['tzx_comment_flag'] = intval($_POST['tzx_comment_flag']);
        $update_array['tzx_attitude_flag'] = intval($_POST['tzx_attitude_flag']);
        $update_array['tzx_seo_title'] = $_POST['tzx_seo_title'];
        $update_array['tzx_seo_keywords'] = $_POST['tzx_seo_keywords'];
        $update_array['tzx_seo_description'] = $_POST['tzx_seo_description'];

        $result = $model_setting->updateSetting($update_array);
        if ($result === true){
            $this->log(Language::get('tzx_log_manage_save'), 0);
            showMessage(Language::get('nc_common_save_succ'));
        }else {
            $this->log(Language::get('tzx_log_manage_save'), 0);
            showMessage(Language::get('nc_common_save_fail'));
        }
    }


}
