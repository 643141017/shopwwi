<?php
/**
 * 圈子分类管理
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
class tyq_settingControl extends SystemControl{
    public function __construct(){
        parent::__construct();
        Language::read('tyq');
    }
    /**
     * 圈子设置
     */
    public function indexWwi(){
        $model_setting = Model('setting');
        if(chksubmit()){
            $update = array();
            $update['tyq_isuse']     = intval($_POST['c_isuse']);
            $update['tyq_name']      = $_POST['c_name'];
            $update['tyq_createsum'] = intval($_POST['c_createsum']);
            $update['tyq_joinsum']   = intval($_POST['c_joinsum']);
            $update['tyq_managesum'] = intval($_POST['c_managesum']);
            $update['tyq_iscreate']  = intval($_POST['c_iscreate']);
            $update['tyq_istalk']    = intval($_POST['c_istalk']);
            $update['tyq_wordfilter']    = $_POST['c_wordfilter'];
            if (!empty($_FILES['c_logo']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_TYQ);
                $result = $upload->upfile('c_logo');
                if ($result){
                    $update['tyq_logo'] = $upload->file_name;
                }else {
                    showMessage($upload->error,'','','error');
                }
            }
            $list_setting = $model_setting->getListSetting();
            $result = $model_setting->updateSetting($update);
            if($result){
                if($list_setting['tyq_logo'] != '' && isset($update['tyq_logo'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_TYQ.DS.$list_setting['tyq_logo']);
                }
                if(intval($_POST['c_isuse']) == 1){
                    $this->log(L('nc_tyq_open'));
                }else{
                    $this->log(L('nc_tyq_close'));
                }
                showMessage(L('nc_common_op_succ'));
            }else{
                showMessage(L('nc_common_op_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
        Tpl::setDirquna('tyq');
Tpl::showpage('tyq_setting.index');
    }
    /**
     * SEO 设置
     */
    public function seoWwi(){
        $model_setting = Model('setting');
        if (chksubmit()){
            $update = array();
            $update['tyq_seotitle']  = $_POST['c_seotitle'];
            $update['tyq_seokeywords']   = $_POST['c_seokeywords'];
            $update['tyq_seodescription']= $_POST['c_seodescription'];
            $result = $model_setting->updateSetting($update);
            if($result){
                showMessage(L('nc_common_op_succ'));
            }else{
                showMessage(L('nc_common_op_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
        Tpl::setDirquna('tyq');
Tpl::showpage('tyq_setting.seo');
    }
    /**
     * SEC 设置
     */
    public function secWwi(){
        $model_setting = Model('setting');
        if (chksubmit()){
            $update = array();
            $update['tyq_intervaltime']      = intval($_POST['c_intervaltime']);
            $update['tyq_contentleast']      = intval($_POST['c_contentleast']);
            $result = $model_setting->updateSetting($update);
            if($result){
                showMessage(L('nc_common_op_succ'));
            }else{
                showMessage(L('nc_common_op_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
        Tpl::setDirquna('tyq');
Tpl::showpage('tyq_setting.sec');
    }
    /**
     * 成员等级
     */
    public function expWwi(){
        $model_setting = Model('setting');
        if(chksubmit()){
            $update = array();
            $update['tyq_exprelease']    = intval($_POST['c_exprelease']);
            $update['tyq_expreply']      = intval($_POST['c_expreply']);
            $update['tyq_expreleasemax'] = intval($_POST['c_expreleasemax']);
            $update['tyq_expreplied']    = intval($_POST['c_expreplied']);
            $update['tyq_exprepliedmax'] = intval($_POST['c_exprepliedmax']);
            $result = $model_setting->updateSetting($update);
            if ($result){
                showMessage(L('nc_common_op_succ'));
            }else {
                showMessage(L('nc_common_op_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
        Tpl::setDirquna('tyq');
Tpl::showpage('tyq_setting.exp');
    }
    /**
     * 圈子首页广告
     */
    public function adv_manageWwi(){
        $model_setting = Model('setting');
        if (chksubmit()){
            $input = array();
            //上传图片
            $upload = new UploadFile();
            $upload->set('default_dir',ATTACH_TYQ);
            $upload->set('thumb_ext',   '');
            $upload->set('file_name','1.jpg');
            $upload->set('ifremove',false);
            if (!empty($_FILES['adv_pic1']['name'])){
                $result = $upload->upfile('adv_pic1');
                if (!$result){
                    showMessage($upload->error,'','','error');
                }else{
                    $input[1]['pic'] = $upload->file_name;
                    $input[1]['url'] = $_POST['adv_url1'];
                }
            }elseif ($_POST['old_adv_pic1'] != ''){
                $input[1]['pic'] = $_POST['old_adv_pic1'];
                $input[1]['url'] = $_POST['adv_url1'];
            }

            $upload->set('default_dir',ATTACH_TYQ);
            $upload->set('thumb_ext',   '');
            $upload->set('file_name','2.jpg');
            $upload->set('ifremove',false);
            if (!empty($_FILES['adv_pic2']['name'])){
                $result = $upload->upfile('adv_pic2');
                if (!$result){
                    showMessage($upload->error,'','','error');
                }else{
                    $input[2]['pic'] = $upload->file_name;
                    $input[2]['url'] = $_POST['adv_url2'];
                }
            }elseif ($_POST['old_adv_pic2'] != ''){
                $input[2]['pic'] = $_POST['old_adv_pic2'];
                $input[2]['url'] = $_POST['adv_url2'];
            }

            $upload->set('default_dir',ATTACH_TYQ);
            $upload->set('thumb_ext', '');
            $upload->set('file_name', '3.jpg');
            $upload->set('ifremove', false);
            if (!empty($_FILES['adv_pic3']['name'])){
                $result = $upload->upfile('adv_pic3');
                if (!$result){
                    showMessage($upload->error,'','','error');
                }else{
                    $input[3]['pic'] = $upload->file_name;
                    $input[3]['url'] = $_POST['adv_url3'];
                }
            }elseif ($_POST['old_adv_pic3'] != ''){
                $input[3]['pic'] = $_POST['old_adv_pic3'];
                $input[3]['url'] = $_POST['adv_url3'];
            }

            $upload->set('default_dir',ATTACH_TYQ);
            $upload->set('thumb_ext',   '');
            $upload->set('file_name','4.jpg');
            $upload->set('ifremove',false);
            if (!empty($_FILES['adv_pic4']['name'])){
                $result = $upload->upfile('adv_pic4');
                if (!$result){
                    showMessage($upload->error,'','','error');
                }else{
                    $input[4]['pic'] = $upload->file_name;
                    $input[4]['url'] = $_POST['adv_url4'];
                }
            }elseif ($_POST['old_adv_pic4'] != ''){
                $input[4]['pic'] = $_POST['old_adv_pic4'];
                $input[4]['url'] = $_POST['adv_url4'];
            }

            $update_array = array();
            if (count($input) > 0){
                $update_array['tyq_loginpic'] = serialize($input);
            }

            $result = $model_setting->updateSetting($update_array);
            if ($result === true){
                $this->log(L('nc_edit,loginSettings'),1);
                showMessage(L('nc_common_save_succ'));
            }else {
                $this->log(L('nc_edit,loginSettings'),0);
                showMessage(L('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        if ($list_setting['tyq_loginpic'] != ''){
            $list = unserialize($list_setting['tyq_loginpic']);
        }
        Tpl::output('list', $list);
        Tpl::setDirquna('tyq');
Tpl::showpage('tyq_setting.adv');
    }

    /**
     * 添加超级管理
     */
    public function superaddWwi() {
        if (chksubmit()) {
            if (intval($_POST['member_id']) <= 0) {
                showMessage(L('nc_common_op_fail'));
            }
            $insert = array();
            $insert['member_id'] = intval($_POST['member_id']);
            $insert['member_name'] = $_POST['member_name'];
            $result = Model('tyq_member')->addSuper($insert);
            if ($result) {
                showMessage(L('nc_common_op_succ'), urlAdminTyq('tyq_setting', 'super_list'));
            } else {
                showMessage(L('nc_common_op_fail'));
            }
        }
        Tpl::setDirquna('tyq');
Tpl::showpage('tyq_setting.super_add');
    }

    /**
     * 超级管理列表
     */
    public function super_listWwi() {
        $model_tyqmember = Model('tyq_member');
        if (chksubmit()) {
            $id_array = $_POST['del_id'];
            if (empty($id_array)) {
                showMessage(L('miss_argument'));
            }
            foreach ($id_array as $val) {
                if (!is_numeric($val)) {
                    showMessage(L('param_error'));
                }
            }
            $result = $model_tyqmember->delSuper(array('member_id' => array('in', $id_array)));
            if ($result) {
                showMessage(L('nc_common_del_succ'));
            } else {
                showMessage(L('nc_common_del_fail'));
            }
        }
        $cm_list = $model_tyqmember->getSuperList(array());
        Tpl::output('cm_list', $cm_list);
        Tpl::setDirquna('tyq');
Tpl::showpage('tyq_setting.super_list');
    }

    /**
     * 选择超管
     */
    public function choose_superWwi(){
        Tpl::output('search_url', urlAdminTyq('tyq_setting', 'member_search'));
        Tpl::setDirquna('tyq');
Tpl::showpage('tyq.choose_master', 'null_layout');
    }

    /**
     * 删除超级管理员
     */
    public function del_superWwi() {
        $member_id = intval($_GET['member_id']);
        if ($member_id < 0) {
            showMessage(L('param_error'));
        }

        $result = Model('tyq_member')->delSuper(array('member_id' => $member_id));
        if ($result) {
            showMessage(L('nc_common_del_succ'));
        } else {
            showMessage(L('nc_common_del_fail'));
        }
    }

    /**
     * 搜索会员
     */
    public function member_searchWwi() {
        $cm_list = Model('tyq_member')->getSuperList(array(), 'member_id');

        $where = array();
        if (!empty($_GET['name'])) {
            $where['member_name'] = array('like', '%' . trim($_GET['name']) . '%');
        }
        if (!empty($cm_list)) {
            $cm_list = array_under_reset($cm_list, member_id);
            $memberid_array = array_keys($cm_list);
            $where['member_id'] = array('not in', $memberid_array);
        }
        $member_list = Model('member')->getMemberList($where, 'member_id,member_name');
        echo json_encode($member_list);die;
    }
}
