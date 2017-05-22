<?php
/**
 * 网站设置
 *
 *
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */



defined('ByShopWWI') or exit('Access Invalid!');
class operationControl extends SystemControl{
    public function __construct(){
        parent::__construct();
        Language::read('setting');
    }

    public function indexWwi() {
        $this->settingWwi();
    }

    /**
     * 基本设置
     */
    public function settingWwi(){
        $model_setting = Model('setting');
        if (chksubmit()){
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(

            );
            $error = $obj_validate->validate();
            if ($error != ''){
                showMessage($error);
            }else {
                $update_array = array();
                $update_array['promotion_allow'] = $_POST['promotion_allow'];
                $update_array['groupbuy_allow'] = $_POST['groupbuy_allow'];
                $update_array['pointmall_isuse'] = $_POST['pointmall_isuse'];
                $update_array['voucher_allow'] = $_POST['voucher_allow'];
                $update_array['pointprod_isuse'] = $_POST['pointprod_isuse'];
                $update_array['redpacket_allow'] = $_POST['redpacket_allow'];
				$update_array['spike_allow'] = $_POST['spike_allow'];
                $result = $model_setting->updateSetting($update_array);
                if ($result === true){
                    $this->log(L('nc_edit,nc_operation,nc_operation_set'),1);
                    showMessage(L('nc_common_save_succ'));
                }else {
                    showMessage(L('nc_common_save_fail'));
                }
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
		Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
        Tpl::showpage('operation.setting');
    }
}
