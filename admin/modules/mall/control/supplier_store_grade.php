<?php
/**
 * 供应商等级管理
 *
 *
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */



defined('ByShopWWI') or exit('Access Invalid!');

class supplier_store_gradeControl extends SystemControl{
    public $grade_operator=array(
            1=>'*',
            2=>'/',
            3=>'+',
            4=>'-',
        );
    public function __construct(){
        parent::__construct();
        Language::read('supplier_store_grade,store');
    }

    public function indexWwi() {
        $this->store_gradeWwi();
    }

    /**
     * 店铺等级
     */
    public function store_gradeWwi(){
        /**
         * 读取语言包
         */
        $lang   = Language::getLangContent();

        $model_grade = Model('supplier_store_grade');
        /**
         * 删除
         */
        if (chksubmit()){
            if (!empty($_POST['check_ssg_id'])){
                if (is_array($_POST['check_ssg_id'])){
                    $model_store = Model('store');
                    foreach ($_POST['check_ssg_id'] as $k => $v){
                        /**
                         * 该店铺等级下的所有店铺会自动改为默认等级
                         */
                        $v = intval($v);
                        //判断是否默认等级，默认等级不能删除
                        if ($v == 1){
                            showMessage($lang['default_supplier_store_grade_no_del'],'index.php?app=supplier_store_grade&wwi=store_grade');
                        }
                        //判断该等级下是否存在店铺，存在的话不能删除
                        if ($this->isable_delGrade($v)){
                            $model_grade->del($v);
                        }
                    }
                }
                dkcache('supplier_store_grade');
                $this->log(L('nc_del,supplier_store_grade').'[ID:'.implode(',',$_POST['check_ssg_id']).']',1);
                showMessage($lang['nc_common_del_succ']);
            }else {
                showMessage($lang['nc_common_del_fail']);
            }
        }
        $condition['like_ssg_name'] = trim($_POST['like_ssg_name']);

        $grade_list = $model_grade->getGradeList($condition);

        Tpl::output('like_ssg_name',trim($_POST['like_ssg_name']));
        Tpl::output('grade_list',$grade_list);
        Tpl::output('grade_operator',$this->grade_operator);
		Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
        Tpl::showpage('supplier_store_grade.index');
    }

    /**
     * 新增等级
     */
    public function store_grade_addWwi(){
        $lang   = Language::getLangContent();

        $model_grade = Model('supplier_store_grade');
        if (chksubmit()){

            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input"=>$_POST["ssg_name"], "require"=>"true", "message"=>$lang['supplier_store_grade_name_no_null']),
            );
            $error = $obj_validate->validate();

            if ($error != ''){
                showMessage($error);
            }else {
                //验证等级名称
                if (!$this->checkGradeName(array('ssg_name'=>trim($_POST['ssg_name'])))){
                    showMessage($lang['now_supplier_store_grade_name_is_there']);
                }

                $insert_array = array();
                $insert_array['ssg_name'] = trim($_POST['ssg_name']);
                $insert_array['ssg_market_operator'] = intval($_POST['ssg_market_operator']);
                $insert_array['ssg_market_discount'] = abs(floatval($_POST['ssg_market_discount']));
                $insert_array['ssg_mall_operator'] = intval($_POST['ssg_mall_operator']);
                $insert_array['ssg_mall_discount'] = abs(floatval($_POST['ssg_mall_discount']));

                $result = $model_grade->add($insert_array);
                if ($result){
                    dkcache('supplier_store_grade');
                    $this->log(L('nc_add,supplier_store_grade').'['.$_POST['ssg_name'].']',1);
                    showMessage($lang['nc_common_save_succ'],'index.php?app=supplier_store_grade&wwi=store_grade');
                }else {
                    showMessage($lang['nc_common_save_fail']);
                }
            }
        }
		Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
        Tpl::showpage('supplier_store_grade.add');
    }

    /**
     * 等级编辑
     */
    public function store_grade_editWwi(){
        $lang   = Language::getLangContent();

        $model_grade = Model('supplier_store_grade');
        if (chksubmit()){
            if (!$_POST['ssg_id']){
                showMessage($lang['grade_parameter_error'],'index.php?app=supplier_store_grade&wwi=store_grade');
            }
            /**
             * 验证
             */
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input"=>$_POST["ssg_name"], "require"=>"true", "message"=>$lang['supplier_store_grade_name_no_null']),
            );
            $error = $obj_validate->validate();
            if ($error != ''){
                showMessage($error);
            }else {
                //验证等级名称
                if (!$this->checkGradeName(array('ssg_name'=>trim($_POST['ssg_name']),'ssg_id'=>intval($_POST['ssg_id'])))){
                    showMessage($lang['now_supplier_store_grade_name_is_there'],'index.php?app=supplier_store_grade&wwi=store_grade_edit&ssg_id='.intval($_POST['ssg_id']));
                }

                $update_array = array();
                $update_array['ssg_name'] = trim($_POST['ssg_name']);
                $update_array['ssg_market_operator'] = intval($_POST['ssg_market_operator']);
                $update_array['ssg_market_discount'] = abs(floatval($_POST['ssg_market_discount']));
                $update_array['ssg_mall_operator'] = intval($_POST['ssg_mall_operator']);
                $update_array['ssg_mall_discount'] = abs(floatval($_POST['ssg_mall_discount']));

                $result = $model_grade->where(array('ssg_id'=>intval($_POST['ssg_id'])))->update($update_array);

                if ($result){
                    dkcache('supplier_store_grade');
                    $this->log(L('nc_edit,supplier_store_grade').'['.$_POST['ssg_name'].']',1);
                    showMessage($lang['nc_common_save_succ']);
                }else {
                    showMessage($lang['nc_common_save_fail']);
                }
            }
        }

        $grade_array = $model_grade->getOneGrade(intval($_GET['ssg_id']));
        if (empty($grade_array)){
            showMessage($lang['illegal_parameter']);
        }
        Tpl::output('grade_array',$grade_array);
		Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
        Tpl::showpage('supplier_store_grade.edit');
    }

    /**
     * 删除等级
     */
    public function store_grade_delWwi(){
        /**
         * 读取语言包
         */
        $lang   = Language::getLangContent();
        $model_grade = Model('supplier_store_grade');
        if (intval($_GET['ssg_id']) > 0){
            //判断是否默认等级，默认等级不能删除
            if ($_GET['ssg_id'] == 1){
                //showMessage('默认等级不能删除 ','index.php?app=store_grade&wwi=store_grade');
                showMessage($lang['default_supplier_store_grade_no_del'],'index.php?app=supplier_store_grade&wwi=store_grade');
            }
            //判断该等级下是否存在店铺，存在的话不能删除
            if (!$this->isable_delGrade(intval($_GET['ssg_id']))){
                showMessage($lang['del_gradehavestore'],'index.php?app=supplier_store_grade&wwi=store_grade');
            }
            /**
             * 删除分类
             */
            $model_grade->del(intval($_GET['ssg_id']));
            dkcache('supplier_store_grade');
            $this->log(L('nc_del,supplier_store_grade').'[ID:'.intval($_GET['ssg_id']).']',1);
            showMessage($lang['nc_common_del_succ'],'index.php?app=supplier_store_grade&wwi=store_grade');
        }else {
            showMessage($lang['nc_common_del_fail'],'index.php?app=supplier_store_grade&wwi=store_grade');
        }
    }

    /**
     * 判断店铺等级是否能删除
     */
    public function isable_delGrade($ssg_id){
        //判断该等级下是否存在店铺，存在的话不能删除
        $model_store = Model('store');
        $store_list = $model_store->getStoreList(array('store_type_grade'=>$ssg_id));
        if (count($store_list) > 0){
            return false;
        }
        return true;
    }


    /**
     * ajax操作
     */
    public function ajaxWwi(){
        switch ($_GET['branch']){
            /**
             * 店铺等级：验证是否有重复的名称
             */
            case 'check_grade_name':
                if ($this->checkGradeName($_GET)){
                    echo 'true'; exit;
                }else{
                    echo 'false'; exit;
                }
                break;
        }
    }

    /**
     * 查询供应商等级名称是否存在
     */
    private function checkGradeName($param){
        $model_grade = Model('supplier_store_grade');
        $condition['ssg_name'] = $param['ssg_name'];
        $condition['no_ssg_id'] = $param['ssg_id'];
        $list = $model_grade->getGradeList($condition);
        if (empty($list)){
            return true;
        }else {
            return false;
        }
    }
}