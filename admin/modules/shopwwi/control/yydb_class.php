<?php
/**
 * 夺宝分类管理
 *
 *
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */



defined('ByShopWWI') or exit('Access Invalid!');

class yydb_classControl extends SystemControl{
    public function __construct(){
        parent::__construct();
        Language::read('yydb_class');
    }

    public function indexWwi() {
        $this->yydb_classWwi();
    }

    /**
     * 夺宝分类
     */
    public function yydb_classWwi(){
        $lang   = Language::getLangContent();
        $model_class = Model('yydb_class');

        //删除
        if (chksubmit()){
            if (!empty($_POST['check_sc_id']) && is_array($_POST['check_sc_id']) ){
                $result = $model_class->delyydbClass(array('sc_id'=>array('in',$_POST['check_sc_id'])));
                if ($result) {
                    $this->log(L('nc_del,yydb_class').'[ID:'.implode(',',$_POST['check_sc_id']).']',1);
                    showMessage($lang['nc_common_del_succ']);
                }
            }
            showMessage($lang['nc_common_del_fail']);
        }

        $yydb_class_list = $model_class->getYydbClassList(array());
        Tpl::output('class_list',$yydb_class_list);
		Tpl::setDirquna('shopwwi');/*网 店 运 维shopwwi wwi.com*/
        Tpl::showpage('yydb_class.index');
    }

    /**
     * 商品分类添加
     */
    public function yydb_class_addWwi(){
        $lang   = Language::getLangContent();
        $model_class = Model('yydb_class');
        if (chksubmit()){
            //验证
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
            array("input"=>$_POST["sc_name"], "require"=>"true", "message"=>$lang['yydb_class_name_no_null']),
            );
            $error = $obj_validate->validate();
            if ($error != ''){
                showMessage($error);
            }else {
                $insert_array = array();
                $insert_array['sc_name'] = $_POST['sc_name'];
                $insert_array['sc_sort'] = intval($_POST['sc_sort']);
                $result = $model_class->addYydbClass($insert_array);
                if ($result){
                    $url = array(
                    array(
                    'url'=>'index.php?app=yydb_class&wwi=yydb_class_add',
                    'msg'=>继续,
                    ),
                    array(
                    'url'=>'index.php?app=yydb_class&wwi=yydb_class',
                    'msg'=>返回,
                    )
                    );
                    $this->log(L('nc_add,yydb_class').'['.$_POST['sc_name'].']',1);
                    showMessage($lang['nc_common_save_succ'],$url,'html','succ',1,5000);
                }else {
                    showMessage($lang['nc_common_save_fail']);
                }
            }
        }
		Tpl::setDirquna('shopwwi');/*网 店 运 维shopwwi wwi.com*/
        Tpl::showpage('yydb_class.add');
    }

    /**
     * 编辑
     */
    public function yydb_class_editWwi(){
        $lang   = Language::getLangContent();

        $model_class = Model('yydb_class');

        if (chksubmit()){
            //验证
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
            array("input"=>$_POST["sc_name"], "require"=>"true", "message"=>$lang['yydb_class_name_no_null']),
            );
            $error = $obj_validate->validate();
            if ($error != ''){
                showMessage($error);
            }else {
                $update_array = array();
                $update_array['sc_name'] = $_POST['sc_name'];
                $update_array['sc_sort'] = intval($_POST['sc_sort']);
                $result = $model_class->editYydbClass($update_array,array('sc_id'=>intval($_POST['sc_id'])));
                if ($result){
                    $this->log(L('nc_edit,yydb_class').'['.$_POST['sc_name'].']',1);
                    showMessage($lang['nc_common_save_succ'],'index.php?app=yydb_class&wwi=yydb_class');
                }else {
                    showMessage($lang['nc_common_save_fail']);
                }
            }
        }

        $class_array = $model_class->getYydbClassInfo(array('sc_id'=>intval($_GET['sc_id'])));
        if (empty($class_array)){
            showMessage($lang['illegal_parameter']);
        }

        Tpl::output('class_array',$class_array);
		Tpl::setDirquna('shopwwi');/*网 店 运 维shopwwi wwi.com*/
        Tpl::showpage('yydb_class.edit');
    }

    /**
     * 删除分类
     */
    public function yydb_class_delWwi(){
        $lang   = Language::getLangContent();
        $model_class = Model('yydb_class');
        if (intval($_GET['sc_id']) > 0){
            $array = array(intval($_GET['sc_id']));
            $result = $model_class->delYydbClass(array('sc_id'=>intval($_GET['sc_id'])));
            if ($result) {
                 $this->log(L('nc_del,yydb_class').'[ID:'.$_GET['sc_id'].']',1);
                 showMessage($lang['nc_common_del_succ'],getReferer());
            }
        }
        showMessage($lang['nc_common_del_fail'],'index.php?app=yydb_class&wwi=yydb_class');
    }

    /**
     * ajax操作
     */
    public function ajaxWwi(){
        $model_class = Model('yydb_class');
        $update_array = array();
        switch ($_GET['branch']){
            //分类：添加、修改操作中 检测类别名称是否有重复
            case 'sc_name':
                $condition = array();
                $condition['sc_name'] = $_GET['value'];
                $condition['sc_id'] = array('neq',intval($_GET['sc_id']));
                $class_list = $model_class->getYydbClassList($condition);
                if (empty($class_list)){
                    $update_array['sc_name'] = $_GET['value'];
                    $update = $model_class->editYydbClass($update_array,array('sc_id'=>intval($_GET['id'])));
                    $return = $update ? true : false;
                } else {
                    $return = false;
                }
                break;
            //分类： 排序 显示 设置
            case 'sc_sort':
                $model_class = Model('yydb_class');
                $update_array['sc_sort'] = intval($_GET['value']);
                $result = $model_class->editYydbClass($update_array,array('sc_id'=>intval($_GET['id'])));
                $return = $result ? true : false;
                break;
        }
        exit(json_encode(array('result'=>$return)));
    }
    
    /**
     * 验证分类名称
     */
    public function ajax_check_nameWwi(){
        $model_class = Model('yydb_class');
        $condition['sc_name'] = $_GET['sc_name'];
        $condition['sc_id'] = array('neq',intval($_GET['sc_id']));
        $class_list = $model_class->getYydbClassList($condition);
        $return = empty($class_list) ? 'true' : 'false';
        echo $return;
    }
}
