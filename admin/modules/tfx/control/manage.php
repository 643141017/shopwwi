<?php
/**
 * 微商城
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
class manageControl extends SystemControl{

    const TFX_CLASS_LIST = 'index.php?app=goods_class&wwi=goodsclass_list';
    const GOODS_FLAG = 1;
    const PERSONAL_FLAG = 2;
    const ALBUM_FLAG = 3;
    const STORE_FLAG = 4;

    public function __construct(){
        parent::__construct();
        Language::read('store');
        Language::read('tfx');
    }

    public function indexWwi() {
       $this->manageWwi();
    }

    /**
     * 微商城管理
     */
    public function manageWwi() {
        $model_setting = Model('setting');
        $setting_list = $model_setting->getListSetting();
        Tpl::output('setting',$setting_list);
        Tpl::setDirquna('tfx');
Tpl::showpage('tfx_manage');
    }

    /**
     * 微商城管理保存
     */
    public function manage_saveWwi() {
        $model_setting = Model('setting');
        $update_array = array();
        $update_array['tfx_isuse'] = intval($_POST['tfx_isuse']);
        $update_array['tfx_style'] = trim($_POST['tfx_style']);
        $update_array['tfx_personal_limit'] = intval($_POST['tfx_personal_limit']);
        $old_image = array();
        if(!empty($_FILES['tfx_logo']['name'])) {
            $upload = new UploadFile();
            $upload->set('default_dir',ATTACH_TFX);
            $result = $upload->upfile('tfx_logo');
            if(!$result) {
                showMessage($upload->error);
            }
            $update_array['tfx_logo'] = $upload->file_name;
            $old_image[] = BASE_UPLOAD_PATH.DS.ATTACH_TFX.DS.C('tfx_logo');
        }
        if(!empty($_FILES['tfx_header_pic']['name'])) {
            $upload = new UploadFile();
            $upload->set('default_dir',ATTACH_TFX);
            $result = $upload->upfile('tfx_header_pic');
            if(!$result) {
                showMessage($upload->error);
            }
            $update_array['tfx_header_pic'] = $upload->file_name;
            $old_image[] = BASE_UPLOAD_PATH.DS.ATTACH_TFX.DS.C('tfx_header_pic');
        }
        $update_array['tfx_seo_keywords'] = $_POST['tfx_seo_keywords'];
        $update_array['tfx_seo_description'] = $_POST['tfx_seo_description'];

        $result = $model_setting->updateSetting($update_array);
        if ($result === true){
            if(!empty($old_image)) {
                foreach ($old_image as $value) {
                    if(is_file($value)) {
                        unlink($value);
                    }
                }
            }
            showMessage(Language::get('nc_common_save_succ'));
        }else {
            showMessage(Language::get('nc_common_save_fail'));
        }
    }
}
