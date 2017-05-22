<?php
/**
 * 圈子管理
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
class tyq_manageControl extends SystemControl{
    public function __construct(){
        parent::__construct();
        Language::read('tyq');
    }

    public function indexWwi() {
        $this->tyq_listWwi();
    }
    /**
     * 圈子列表
     */
    public function tyq_listWwi(){
        Tpl::setDirquna('tyq');

Tpl::showpage('tyq.list');
    }

    /**
     * 输出XML数据
     */
    public function get_xmlWwi() {
        $model = Model();
        $condition = array();
        if ($_GET['type'] == 'verify') {
            $condition['tyq_status'] = 2;
        }
        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('tyq_id', 'tyq_name', 'tyq_img', 'tyq_masterid', 'tyq_mastername', 'tyq_status', 'tyq_addtime'
                , 'is_recommend', 'is_hot', 'tyq_mcount', 'tyq_thcount'
        );
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }
        $page = $_POST['rp'];
        $cirlce_list = $model->table('tyq')->where($condition)->order($order)->page($page)->select();

        // 圈主状态
        $status_array = $this->getTyqStatus();

        $data = array();
        $data['now_page'] = $model->shownowpage();
        $data['total_num'] = $model->gettotalnum();
        foreach ($cirlce_list as $value) {
            $param = array();
            $operation = "<a class='btn red' href=\"javascript:void(0);\" onclick=\"fg_del('".$value['tyq_id']."')\"><i class='fa fa-trash-o'></i>删除</a>";
            if ($value['tyq_status'] == '2') {
                $operation .= "<a class='btn orange' href='index.php?app=tyq_manage&wwi=tyq_edit&c_id=".$value['tyq_id']."' class='url'><i class='fa fa-pencil-square-o'></i>审核</a>";
            } else {
                $operation .= "<a class='btn blue' href='index.php?app=tyq_manage&wwi=tyq_edit&c_id=".$value['tyq_id']."' class='url'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            }
            $param['operation'] = $operation;
            $param['tyq_id'] = $value['tyq_id'];
            $param['tyq_name'] = $value['tyq_name'];
            $param['tyq_img'] = "<a href='javascript:void(0);' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=".tyqLogo($value['tyq_id']).">\")'><i class='fa fa-picture-o'></i></a>";
            $param['tyq_masterid'] = $value['tyq_masterid'];
            $param['tyq_mastername'] = $value['tyq_mastername'];
            $param['tyq_status'] = $status_array[$value['tyq_status']];
            $param['tyq_addtime'] = date('Y-m-d H:i:s', $value['tyq_addtime']);
            $param['is_recommend'] = $value['is_recommend'] == '1' ? '是' : '否';
            $param['is_hot'] = $value['is_hot'] == '1' ? '是' : '否';
            $param['tyq_mcount'] = $value['tyq_mcount'];
            $param['tyq_thcount'] = $value['tyq_thcount'];
            $data['list'][$value['tyq_id']] = $param;
        }
        echo Tpl::flexigridXML($data);exit();
    }

    /**
     * 圈子状态
     * @return multitype:string
     */
    private function getTyqStatus() {
        return array(
                '0' => '关闭',
                '1' => '开启',
                '2' => '审核中',
                '3' => '审核失败'
        );
    }

    /**
     * 圈子待审核列表
     */
    public function tyq_verifyWwi(){
        Tpl::setDirquna('tyq');

Tpl::showpage('tyq.verify');
    }
    /**
     * 圈子新增
     */
    public function tyq_addWwi(){
        $model = Model();
        // 保存
        if(chksubmit()){
            /**
             * 验证
             */
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                    array("input"=>$_POST["c_name"], "require"=>"true", "message"=>L('tyq_name_not_null')),
            );
            $error = $obj_validate->validate();
            if($error != ''){
                showMessage($error);
            }else{
                $insert = array();
                $insert['tyq_name']      = trim($_POST['c_name']);
                $insert['tyq_masterid']  = intval($_POST['masterid']);
                $insert['tyq_mastername']= trim($_POST['mastername']);
                $insert['tyq_desc']      = $_POST['c_desc'];
                $insert['tyq_tag']       = $_POST['c_tag'];
                $insert['tyq_notice']    = $_POST['c_notice'];
                $insert['tyq_status']    = intval($_POST['c_status']);
                $insert['is_recommend']     = intval($_POST['c_recommend']);
                $insert['class_id']         = intval($_POST['classid']);
                $insert['tyq_joinaudit'] = 0;
                $insert['tyq_addtime']   = time();
                $insert['new_verifycount']  = 0;
                $insert['new_informcount']  = 0;
                $insert['mapply_open']      = 0;
                $insert['mapply_ml']        = 0;
                $insert['new_mapplycount']  = 0;
                $tyqid = $model->table('tyq')->insert($insert);
                if($tyqid){
                    // 把圈主信息加入圈子会员表
                    $insert = array();
                    $insert['member_id']    = intval($_POST['masterid']);
                    $insert['tyq_id']    = $tyqid;
                    $insert['tyq_name']  = $_POST['c_name'];
                    $insert['member_name']  = $_POST['mastername'];
                    $insert['cm_applytime'] = $insert['cm_jointime'] = time();
                    $insert['cm_state']     = 1;
                    $insert['is_identity']  = 1;
                    $insert['cm_lastspeaktime'] = '';
                    $rs = $model->table('tyq_member')->insert($insert);
                    if($rs){
                        $update['tyq_mcount']    = 1;
                    }
                    if (!empty($_POST['c_img'])){
                        $update['tyq_img']   = $tyqid.'.jpg';
                        rename(BASE_UPLOAD_PATH.'/'.ATTACH_TYQ.'/group/'.$_POST['c_img'],BASE_UPLOAD_PATH.'/'.ATTACH_TYQ.'/group/'.$tyqid.'.jpg');
                    }
                    $model->table('tyq')->where(array('tyq_id'=>$tyqid))->update($update);
                    $this->log(L('nc_add_tyq').'['.$tyqid.']');
                    showMessage(L('nc_common_op_succ'));
                }else{
                    showMessage(L('nc_common_op_fail'));
                }
            }
        }
        // 圈子分类
        $class_list = $model->table('tyq_class')->where(array('class_status'=>1))->order('class_sort asc')->select();
        Tpl::output('class_list', $class_list);

        Tpl::setDirquna('tyq');

Tpl::showpage('tyq.add');
    }
    /**
     * 圈子编辑
     */
    public function tyq_editWwi(){
        $model = Model();
        if(chksubmit()){
            /**
             * 验证
             */
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                    array("input"=>$_POST["c_name"], "require"=>"true", "message"=>L('tyq_name_not_null')),
            );
            $error = $obj_validate->validate();
            if($error != ''){
                showMessage($error);
            }else{
                $update = array();
                $update['tyq_name']      = trim($_POST['c_name']);
                $update['tyq_masterid']  = intval($_POST['masterid']);
                $update['tyq_mastername']= trim($_POST['mastername']);
                $update['tyq_desc']      = $_POST['c_desc'];
                $insert['tyq_tag']       = $_POST['c_tag'];
                $update['tyq_notice']    = $_POST['c_notice'];
                $update['tyq_status']    = intval($_POST['c_status']);
                $update['tyq_statusinfo']= $_POST['c_statusinfo'];
                $update['is_recommend']     = intval($_POST['c_recommend']);
                $update['is_hot']           = intval($_POST['is_hot']);
                $update['class_id']         = intval($_POST['classid']);
                $insert['tyq_img']       = $_POST['c_img'];
                $rs = $model->table('tyq')->where(array('tyq_id'=>intval($_POST['c_id'])))->update($update);
                if($rs){
                    // 更新圈子会员表 圈主信息。
                    $cminfo = $model->table('tyq_member')->where(array('member_id'=>intval($_POST['masterid']), 'tyq_id'=>intval($_POST['c_id'])))->find();
                    if(empty($cminfo)){
                        // 取消员圈主圈主身份
                        $model->table('tyq_member')->where(array('tyq_id'=>intval($_POST['c_id']), 'is_identity'=>1))->update(array('is_identity'=>3));
                        $model->table('tyq_theme')->where(array('tyq_id'=>intval($_POST['c_id']), 'is_identity'=>1))->update(array('is_identity'=>3));
                        // 把圈主信息加入圈子会员表
                        $insert = array();
                        $insert['member_id']    = intval($_POST['masterid']);
                        $insert['tyq_id']    = intval($_POST['c_id']);
                        $insert['tyq_name']  = $_POST['c_name'];
                        $insert['member_name']  = $_POST['mastername'];
                        $insert['cm_applytime'] = $insert['cm_jointime'] = time();
                        $insert['cm_state']     = 1;
                        $insert['is_identity']  = 1;
                        $insert['cm_lastspeaktime'] = '';
                        $model->table('tyq_member')->insert($insert);
                    }else{
                        if($cminfo['is_identity'] != 1){
                            // 取消员圈主圈主身份
                            $model->table('tyq_member')->where(array('tyq_id'=>intval($_POST['c_id']), 'is_identity'=>1))->update(array('is_identity'=>3));
                            $model->table('tyq_theme')->where(array('tyq_id'=>intval($_POST['c_id']), 'is_identity'=>1))->update(array('is_identity'=>3));
                            // 任命新圈主
                            $model->table('tyq_member')->where(array('member_id'=>intval($_POST['masterid']), 'tyq_id'=>intval($_POST['c_id'])))->update(array('is_identity'=>1));
                            $model->table('tyq_theme')->where(array('member_id'=>intval($_POST['masterid']), 'tyq_id'=>intval($_POST['c_id'])))->update(array('is_identity'=>1));
                        }
                    }
                    // 更新圈子成员信息
                    $count = $model->table('tyq_member')->where(array('tyq_id'=>intval($_POST['c_id'])))->count();
                    $model->table('tyq')->where(array('tyq_id'=>intval($_POST['c_id'])))->update(array('tyq_mcount'=>$count));

                    // 更新主题圈子名称字段
                    $model->table('tyq_theme')->where(array('tyq_id'=>intval($_POST['c_id'])))->update(array('tyq_name'=>$_POST['c_name']));
                    $model->table('tyq_member')->where(array('tyq_id'=>intval($_POST['c_id'])))->update(array('tyq_name'=>$_POST['c_name']));

                    $this->log(L('nc_edit_tyq').'['.intval($_POST['c_id']).']');
                    showMessage(L('nc_common_op_succ'), 'index.php?app=tyq_manage&wwi=tyq_list');
                }else{
                    showMessage(L('nc_common_op_fail'));
                }
            }
        }
        $id = intval($_GET['c_id']);
        if($id <= 0){
            showMessage(L('param_error'));
        }
        // 圈子详细
        $tyq_info = $model->table('tyq')->where(array('tyq_id'=>$id))->find();
        Tpl::output('tyq_info', $tyq_info);

        // 圈子分类
        $class_list = $model->table('tyq_class')->where(array('class_status'=>1))->order('class_sort asc')->select();
        Tpl::output('class_list', $class_list);

        Tpl::setDirquna('tyq');

Tpl::showpage('tyq.edit');
    }
    /**
     * 选择圈主
     */
    public function choose_masterWwi(){
        Tpl::output('search_url', (intval($_GET['c_id']) > 0) ? urlAdminTyq('tyq_manage', 'search_member', array('c_id' => intval($_GET['c_id']))) : urlAdminTyq('tyq_manage', 'search_member'));
        Tpl::setDirquna('tyq');
Tpl::showpage('tyq.choose_master', 'null_layout');
    }
    /**
     * 搜索会员
     */
    public function search_memberWwi(){
        $model = Model();
        $where = array();
        if($_GET['name'] != ''){
            $where['member_name'] = array('like', '%'.trim($_GET['name']).'%');
        }
        $member_list = $model->table('member')->field('member_id,member_name')->where($where)->select();
        $member_list = array_under_reset($member_list, 'member_id', 1);

        // 允许创建圈子验证
        $where = array();
        if(intval($_GET['c_id']) > 0){
            $where = array('tyq_id'=>array('neq',intval($_GET['c_id'])));
        }
        $count_array = $model->table('tyq')->field('tyq_masterid,count(*) as count')->where($where)->group('tyq_masterid')->select();
        if (!empty($count_array)){
            foreach ($count_array as $val){
                if(intval($val['count']) >= C('tyq_createsum')) unset($member_list[$val['tyq_masterid']]);
            }
        }

        // 允许加入圈子验证
        $where = array();
        if(intval($_GET['c_id']) > 0){
            $where = array('tyq_id');
        }
        $count_array = $model->table('tyq_member')->field('member_id,count(*) as count')->where($where)->group('member_id')->select();
        if(!empty($count_array)){
            foreach ($count_array as $val){
                if(intval($val['count']) >= C('tyq_joinsum')) unset($member_list[$val['member_id']]);
            }
        }

        $member_list = array_values($member_list);
        // 加入圈子数量验证
        if(strtoupper(CHARSET) == 'GBK'){
            $member_list = Language::getUTF8($member_list);
        }
        echo json_encode($member_list);die;
    }
    /**
     * 删除圈子
     */
    public function tyq_delWwi(){
        $id = intval($_GET['id']);
        if($id <= 0){
            exit(json_encode(array('state'=>false,'msg'=>L('param_error'))));
        }
        $model = Model();
        $tyq_info = $model->table('tyq')->where(array('tyq_id'=>$id))->find();
        if(!empty($tyq_info)) @unlink(BASE_UPLOAD_PATH.DS.ATTACH_TYQ.'/group/'.$tyq_info['tyq_id'].'.jpg');

        // 删除附件
        $affix_list = $model->table('tyq_affix')->where(array('tyq_id'=>$id))->select();
        if(!empty($affix_list)){
            foreach ($affix_list as $val){
                @unlink(themeImagePath($val['affix_filename']));
                @unlink(themeImagePath($val['affix_filethumb']));
            }
            $model->table('tyq_affix')->where(array('tyq_id'=>$id))->delete();
        }

        // 删除商品
        $model->table('tyq_thg')->where(array('tyq_id'=>$id))->delete();

        // 删除赞表相关
        $model->table('tyq_like')->where(array('tyq_id'=>$id))->delete();

        // 删除回复
        $model->table('tyq_threply')->where(array('tyq_id'=>$id))->delete();

        // 删除话题
        $model->table('tyq_theme')->where(array('tyq_id'=>$id))->delete();

        // 删除成员
        $model->table('tyq_member')->where(array('tyq_id'=>$id))->delete();

        // 删除圈子
        $model->table('tyq')->where(array('tyq_id'=>$id))->delete();

        $this->log(L('nc_del_tyq').'['.$id.']');
        exit(json_encode(array('state'=>true,'msg'=>L('nc_common_op_succ'))));
    }
    /**
     * 会员名称检测
     */
    public function check_memberWwi() {
        $model = Model();
        $member_info = Model('member')->table('member')->where(array('member_name'=>trim($_GET['name']), 'member_id'=>intval($_GET['id'])))->select();
        if(empty($member_info)){
            echo 'false';exit;
        }else{
            // 允许创建数量验证
            $where = array();
            $where['tyq_masterid']   = intval($_GET['id']);
            if(intval($_GET['c_id']) > 0){
                $where['tyq_id']     = array('neq', intval($_GET['c_id']));
            }
            $count = $model->table('tyq')->where($where)->count();
            if(intval($count) >= intval(C('tyq_createsum'))){
                echo 'false';exit;
            }

            // 允许加入圈子验证
            $where = array();
            $where['member_id'] = intval($_GET['id']);
            if(intval($_GET['c_id']) > 0){
                $where['tyq_id'] = array('neq', intval($_GET['c_id']));
            }
            $count = $model->table('tyq_member')->where($where)->count();
            if(intval($count) >= intval(C('tyq_joinsum'))){
                echo 'false';exit;
            }

            echo 'true';exit;
        }
    }
    /**
     * ajax操作
     */
    public function ajaxWwi(){
        switch ($_GET['branch']){
            case 'status':
                $this->log(L('nc_tyq_pass_cerify').'['.intval($_GET['id']).']');
            case 'recommend':
                $update = array(
                    $_GET['column']=>$_GET['value']
                );
                Model()->table('tyq')->where(array('tyq_id'=>intval($_GET['id'])))->update($update);
                echo 'true';
                break;
            case 'name':
                $where  = array(
                    'tyq_id'=>intval($_GET['id'])
                );
                $update = array(
                    $_GET['column']=>$_GET['value']
                );
                Model()->table('tyq')->where($where)->update($update);
                Model()->table('tyq_theme')->where($where)->update($update);
                echo 'true';
                break;

        }
    }
    /**
     * ajax验证圈子名称
     */
    public function check_tyq_nameWwi(){
        $name = $_GET['name'];
        if (strtoupper(CHARSET) == 'GBK'){
            $name = Language::getGBK($name);
        }
        $where = array();
        $where['tyq_name']   = $name;
        if(intval($_GET['id']) > 0){
            $where['tyq_id'] = array('neq', intval($_GET['id']));
        }
        $rs = Model()->table('tyq')->where($where)->find();
        if (!empty($rs)){
            echo 'false';
        }else{
            echo 'true';
        }
    }
}
