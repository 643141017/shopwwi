<?php
/**
 * 店铺管理界面
 *
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */



defined('ByShopWWI') or exit('Access Invalid!');

class servicer_storeControl extends SystemControl{
    const EXPORT_SIZE = 1000;
    const STORE_TYPE  = 1;//服务商

    private $_links = array(
        array('url'=>'app=servicer_store&wwi=store','text'=>'管理'),
        array('url'=>'app=servicer_store&wwi=store_joinin','text'=>'开店申请'),
        array('url'=>'app=servicer_store&wwi=reopen_list','text'=>'续签申请'),
        array('url'=>'app=servicer_store&wwi=store_bind_area_applay_list','text'=>'服务区域申请'),
        array('url'=>'app=servicer_store&wwi=bill_cycle','text'=>'结算周期设置')
    );

    public function __construct(){
        parent::__construct();
        Language::read('store,store_grade');
    }

    public function indexWwi() {
        $this->storeWwi();
    }

    /**
     * 店铺
     */
    public function storeWwi(){
        //店铺等级
        $model_grade = Model('store_grade');
        $grade_list = $model_grade->getGradeList(array());
        Tpl::output('grade_list', $grade_list);

        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->_links,'store'));
        Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/

        Tpl::showpage('servicer_store.index');
    }

    /**
     * 店铺结算周期
     */
    public function bill_cycleWwi(){

        Tpl::output('top_link',$this->sublink($this->_links,'bill_cycle'));
        Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/

        Tpl::showpage('servicer_store.bill_cycle');
    }

    /**
     * 输出XML数据
     */
    public function get_xmlWwi() {
        $model_store = Model('store');
        // 设置页码参数名称
        $condition = array();
        $condition['store_type']  = self::STORE_TYPE;
        $condition['is_own_mall'] = 0;
        if ($_GET['store_name'] != '') {
            $condition['store_name'] = array('like', '%' . $_GET['store_name'] . '%');
        }
        if ($_GET['member_name'] != '') {
            $condition['member_name'] = array('like', '%' . $_GET['member_name'] . '%');
        }
        if ($_GET['seller_name'] != '') {
            $condition['seller_name'] = array('like', '%' . $_GET['seller_name'] . '%');
        }
        if ($_GET['grade_id'] != '') {
            $condition['grade_id'] = $_GET['grade_id'];
        }
        if ($_GET['store_state'] != '') {
            $condition['store_state'] = $_GET['store_state'];
        }
        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('store_id','store_name','member_name','seller_name','store_time','store_end_time','store_state','grade_id','sc_id');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
                $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }

        $page = $_POST['rp'];

        //店铺列表
        $store_list = $model_store->getStoreList($condition, $page, $order);

        //店铺等级
        $model_grade = Model('store_grade');
        $grade_list = $model_grade->getGradeList(array());
        $grade_array = array();
        if (!empty($grade_list)){
            foreach ($grade_list as $v){
                $grade_array[$v['sg_id']] = $v['sg_name'];
            }
        }

        //店铺分类
        $model_store_class = Model('store_class');
        $class_list = $model_store_class->getStoreClassList(array(),'',false);
        $class_array = array();
        if (!empty($class_list)) {
            foreach ($class_list as $v) {
                $class_array[$v['sc_id']] = $v['sc_name'];
            }
        }

        $data = array();
        $data['now_page'] = $model_store->shownowpage();
        $data['total_num'] = $model_store->gettotalnum();
        foreach ($store_list as $value) {
            $param = array();
            $store_state = $this->getStoreState($value);
            $operation = "<a class='btn green' href='index.php?app=servicer_store&wwi=store_joinin_detail&member_id=".$value['member_id']."'><i class='fa fa-list-alt'></i>查看</a><span class='btn'><em><i class='fa fa-cog'></i>" . L('nc_set') . " <i class='arrow'></i></em><ul><li><a href='index.php?app=servicer_store&wwi=store_edit&store_id=" . $value['store_id'] . "'>编辑店铺信息</a></li><li><a href='index.php?app=servicer_store&wwi=store_bind_area&store_id=" . $value['store_id'] . "'>修改服务区域</a></li>";
            if (str_cut($store_state, 6) == 'expire'  && cookie('remindRenewal'.$value['store_id']) == null) {
                $operation .= "<li><a class='expire' href=". urlAdminMall('store', 'remind_renewal', array('store_id'=>$value['store_id'])). ">提醒商家续费</a></li>";
            }
            $operation .= "</ul></span>";
            $param['operation'] = $operation;
            $param['store_id'] = $value['store_id'];
            $store_name = "<a class='" . $store_state . "' href='". urlMall('show_store', 'index', array('store_id' => $value['store_id'])) ."' target='blank'>";
            if ($store_state == 'expired') {
                $store_name .= "<i class='fa fa-clock-o' title='该店铺已过期，可从编辑菜单提醒续费'></i>";
            } else if ($store_state == 'expire') {
                $store_name .= "<i class='fa fa-bell-o' title='该店铺即将到期，可从编辑菜单提醒续费'></i>";
            }
            $store_name .= $value['store_name'] . "<i class='fa fa-external-link ' title='新窗口打开'></i></a>";
            $param['store_name'] = $store_name;
            $param['member_id'] = $value['member_name'];
            $param['seller_name'] = $value['seller_name'];
            $param['store_avatar'] = "<a href='javascript:void(0);' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=".getStoreLogo($value['store_avatar']).">\")'><i class='fa fa-picture-o'></i></a>";
            $param['store_label'] = "<a href='javascript:void(0);' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=".getStoreLogo($value['store_label'], 'store_logo').">\")'><i class='fa fa-picture-o'></i></a>";
            $param['grade_id'] = $grade_array[$value['grade_id']];
            $param['store_time'] = date('Y-m-d', $value['store_time']);
            $param['store_end_time'] = $value['store_end_time']?date('Y-m-d', $value['store_end_time']):L('no_limit');
            $param['store_state'] = $value['store_state']?L('open'):L('close');
            $param['sc_id'] = $class_array[$value['sc_id']];
            $param['area_info'] = $value['area_info'];
            $param['store_address'] = $value['store_address'];
            $param['store_qq'] = $value['store_qq'];
            $param['store_ww'] = $value['store_ww'];
            $param['store_phone'] = $value['store_phone'];
            $data['list'][$value['store_id']] = $param;
        }
        echo Tpl::flexigridXML($data);exit();
    }

    /**
     * 输出XML数据
     */
    public function get_bill_cycle_xmlWwi() {
        $model_store = Model('store');
        $condition = array();
        $condition['store_type']=self::STORE_TYPE;
        if ($_GET['store_name'] != '') {
            $condition['store_name'] = array('like', '%' . $_GET['store_name'] . '%');
        }
        if ($_GET['member_name'] != '') {
            $condition['member_name'] = array('like', '%' . $_GET['member_name'] . '%');
        }
        if ($_GET['seller_name'] != '') {
            $condition['seller_name'] = array('like', '%' . $_GET['seller_name'] . '%');
        }
        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('store_id','store_name','member_name','seller_name','store_time','store_end_time','store_state','grade_id','sc_id');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }

        $page = $_POST['rp'];
    
        //店铺列表
        $store_list = $model_store->getStoreList($condition, $page, $order);
    
        //店铺分类
        $model_store_class = Model('store_class');
        $class_list = $model_store_class->getStoreClassList(array(),'',false);
        $class_array = array();
        if (!empty($class_list)) {
            foreach ($class_list as $v) {
                $class_array[$v['sc_id']] = $v['sc_name'];
            }
        }

        //店铺结算周期
        $store_id_list = array();
        foreach ($store_list as $store_info) {
            $store_id_list[] = $store_info['store_id'];
        }
        $store_ext_list = Model('store_extend')->getStoreExendList(array('store_id'=>array('in',$store_id_list)));
        $store_bill_cycle = array();
        if ($store_ext_list) {
            foreach($store_ext_list as $v) {
                $store_bill_cycle[$v['store_id']] = $v['bill_cycle'] ? $v['bill_cycle'] : '';
            }
        }

        $data = array();
        $data['now_page'] = $model_store->shownowpage();
        $data['total_num'] = $model_store->gettotalnum();
        foreach ($store_list as $value) {
            $param = array();
            $store_state = $this->getStoreState($value);
            $operation = "<a class='btn blue' href='index.php?app=servicer_store&wwi=bill_cycyle_edit&store_id=".$value['store_id']."'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            $operation .= "</ul></span>";
            $param['operation'] = $operation;
            $param['store_id'] = $value['store_id'];
            $store_name = "<a class='" . $store_state . "' href='". urlMall('show_store', 'index', array('store_id' => $value['store_id'])) ."' target='blank'>";

            $store_name .= $value['store_name'] . "<i class='fa fa-external-link ' title='新窗口打开'></i></a>";
            $param['store_name'] = $store_name;
            $param['seller_name'] = $value['seller_name'];
            $param['bill_cycle'] = $store_bill_cycle[$value['store_id']];
            $param['sc_id'] = $class_array[$value['sc_id']];
            $param['store_phone'] = $value['store_phone'];
            $data['list'][$value['store_id']] = $param;
        }
        echo Tpl::flexigridXML($data);exit();
    }
    

    /**
     * csv导出
     */
    public function export_csvWwi() {
        $model_store = Model('store');
        $condition = array();
        $condition['store_type']  = self::STORE_TYPE;
        $limit = false;
        if ($_GET['id'] != '') {
            $id_array = explode(',', $_GET['id']);
            $condition['store_id'] = array('in', $id_array);
        }
        if ($_GET['store_name'] != '') {
            $condition['store_name'] = array('like', '%' . $_GET['store_name'] . '%');
        }
        if ($_GET['member_name'] != '') {
            $condition['member_name'] = array('like', '%' . $_GET['member_name'] . '%');
        }
        if ($_GET['seller_name'] != '') {
            $condition['seller_name'] = array('like', '%' . $_GET['seller_name'] . '%');
        }
        if ($_GET['grade_id'] != '') {
            $condition['grade_id'] = $_GET['grade_id'];
        }
        if ($_GET['store_state'] != '') {
            $condition['store_state'] = $_GET['store_state'];
        }
        if ($_REQUEST['query'] != '') {
            $condition[$_REQUEST['qtype']] = array('like', '%' . $_REQUEST['query'] . '%');
        }
        $order = '';
        $param = array('store_id','store_name','member_name','seller_name','store_time','store_end_time','store_state','grade_id','sc_id');
        if (in_array($_REQUEST['sortname'], $param) && in_array($_REQUEST['sortorder'], array('asc', 'desc'))) {
            $order = $_REQUEST['sortname'] . ' ' . $_REQUEST['sortorder'];
        }
        if (!is_numeric($_GET['curpage'])){
            $count = $model_store->getStoreCount($condition);
            if ($count > self::EXPORT_SIZE ){   //显示下载链接
                $array = array();
                $page = ceil($count/self::EXPORT_SIZE);
                for ($i=1;$i<=$page;$i++){
                    $limit1 = ($i-1)*self::EXPORT_SIZE + 1;
                    $limit2 = $i*self::EXPORT_SIZE > $count ? $count : $i*self::EXPORT_SIZE;
                    $array[$i] = $limit1.' ~ '.$limit2 ;
                }
                Tpl::output('list',$array);
                Tpl::output('murl','index.php?app=servicer_store&wwi=index');
                Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
                Tpl::showpage('export.excel');
                exit();
            }
        } else {
            $limit1 = ($_GET['curpage']-1) * self::EXPORT_SIZE;
            $limit2 = self::EXPORT_SIZE;
            $limit = $limit1 .','. $limit2;
        }

        $store_list = $model_store->getStoreList($condition, null, 'store_id desc', '*', $limit);
        $this->createCsv($store_list);
    }
    /**
     * 生成csv文件
     */
    private function createCsv($store_list) {
        //店铺等级
        $model_grade = Model('store_grade');
        $grade_list = $model_grade->getGradeList(array());
        $grade_array = array();
        if (!empty($grade_list)){
            foreach ($grade_list as $v){
                $grade_array[$v['sg_id']] = $v['sg_name'];
            }
        }

        //店铺分类
        $model_store_class = Model('store_class');
        $class_list = $model_store_class->getStoreClassList(array(),'',false);
        $class_array = array();
        if (!empty($class_list)) {
            foreach ($class_list as $v) {
                $class_array[$v['sc_id']] = $v['sc_name'];
            }
        }

        $data = array();
        foreach ($store_list as $value) {
            $param = array();
            $param['store_id'] = $value['store_id'];
            $param['store_name'] = $value['store_name'];
            $param['member_name'] = $value['member_name'];
            $param['seller_name'] = $value['seller_name'];
            $param['store_avatar'] = getStoreLogo($value['store_avatar']);
            $param['store_label'] = getStoreLogo($value['store_label'], 'store_logo');
            $param['grade_id'] = $grade_array[$value['grade_id']];
            $param['store_time'] = date('Y-m-d', $value['store_time']);
            $param['store_end_time'] = $value['store_end_time']?date('Y-m-d', $value['store_end_time']):L('no_limit');
            $param['store_state'] = $value['store_state']?L('open'):L('close');
            $param['sc_id'] = $class_array[$value['sc_id']];
            $param['area_info'] = $value['area_info'];
            $param['store_address'] = $value['store_address'];
            $param['store_qq'] = $value['store_qq'];
            $param['store_ww'] = $value['store_ww'];
            $param['store_phone'] = $value['store_phone'];
            $data[$value['store_id']] = $param;
        }

        $header = array(
                'store_id' => '店铺ID',
                'store_name' => '店铺名称',
                'member_name' => '店主账号',
                'seller_name' => '商家账号',
                'store_avatar' => '店铺头像',
                'store_label' => '店铺LOGO',
                'grade_id' => '店铺等级',
                'store_time' => '开店时间',
                'store_end_time' => '到期时间',
                'store_state' => '当前状态',
                'sc_id' => '店铺分类',
                'area_info' => '所在地区',
                'store_address' => '详细地址',
                'store_qq' => 'QQ',
                'store_ww' => '旺旺',
                'store_phone' => '商家电话'
        );
        array_unshift($data, $header);
        $csv = new Csv();
        $export_data = $csv->charset($data,CHARSET,'gbk');
        $csv->filename = $csv->charset('servicer_store_list',CHARSET).$_GET['curpage'] . '-'.date('Y-m-d');
        $csv->export($data);    
    }

    /**
     * 获得店铺状态
     *  open\正常
     *  close\关闭
     *  expire\即将到期
     *  expired\过期
     */
    private function getStoreState($store_info) {
        $result = 'open';
        if (intval($store_info['store_state']) === 1) {
            $store_end_time = intval($store_info['store_end_time']);
            if ($store_end_time > 0) {
                if ($store_end_time < TIMESTAMP) {
                    $result = 'expired';
                } elseif (($store_end_time - 864000) < TIMESTAMP) {
                    //距离到期10天
                    $result = 'expire';
                }
            }
        } else {
            $result = 'close';
        }
        return $result;
    }

    /**
     * 店铺编辑
     */
    public function store_editWwi(){
        $lang = Language::getLangContent();

        $model_store = Model('store');
        //保存
        if (chksubmit()){
            //取店铺等级的审核
            $model_grade = Model('store_grade');
            $grade_array = $model_grade->getOneGrade(intval($_POST['grade_id']));
            if (empty($grade_array)){
                showMessage($lang['please_input_store_level']);
            }
            //结束时间
            $time   = '';
            if(trim($_POST['end_time']) != ''){
                $time = strtotime($_POST['end_time']);
            }
            $update_array = array();
            $update_array['store_name'] = trim($_POST['store_name']);
            $update_array['sc_id'] = intval($_POST['sc_id']);
            $update_array['grade_id'] = intval($_POST['grade_id']);
            $update_array['store_end_time'] = $time;
            $update_array['store_state'] = intval($_POST['store_state']);
            if ($update_array['store_state'] == 0){
                //根据店铺状态修改该店铺所有商品状态
                $model_goods = Model('goods');
                $model_goods->editProducesOffline(array('store_id' => $_POST['store_id']));
                $update_array['store_close_info'] = trim($_POST['store_close_info']);
                $update_array['store_recommend'] = 0;
            }else {
                //店铺开启后商品不在自动上架，需要手动操作
                $update_array['store_close_info'] = '';
                $update_array['store_recommend'] = intval($_POST['store_recommend']);
            }
            $result = $model_store->editStore($update_array, array('store_id' => $_POST['store_id']));

            //更新服务商等级
            $update_array=array();
            $update_array['ssg_id']=intval($_POST['ssg_id']);
            $toggle=Model('servicer')->editServicer($update_array,array('ser_store_id' =>$_POST['store_id']));

            if ($result&&$toggle){
                $url = array(
                array(
                'url'=>'index.php?app=servicer_store&wwi=store',
                'msg'=>$lang['back_store_list'],
                ),
                array(
                'url'=>'index.php?app=servicer_store&wwi=store_edit&store_id='.intval($_POST['store_id']),
                'msg'=>$lang['countinue_add_store'],
                ),
                );
                $this->log(L('nc_edit,store').'['.$_POST['store_name'].']',1);
                showMessage($lang['nc_common_save_succ'],$url);
            }else {
                $this->log(L('nc_edit,store').'['.$_POST['store_name'].']',1);
                showMessage($lang['nc_common_save_fail']);
            }
        }
        //取店铺信息
        $store_array = $model_store->getStoreInfoByID($_GET['store_id']);
        if (empty($store_array)){
            showMessage($lang['store_no_exist']);
        }
        //整理店铺内容
        $store_array['store_end_time'] = $store_array['store_end_time']?date('Y-m-d',$store_array['store_end_time']):'';
        //店铺分类
        $model_store_class = Model('store_class');
        $parent_list = $model_store_class->getStoreClassList(array(),'',false);
        //店铺等级
        $model_grade = Model('store_grade');
        $grade_list = $model_grade->getGradeList();

        $servicer_grade_list=Model('servicer_store_grade')->getGradeList();
        $servicer_info=Model('servicer')->getServicerInfo(array('ser_member_id'=>$store_array['member_id']));
        $servicer_grade=$servicer_info['ssg_id']?$servicer_info['ssg_id']:1;
        Tpl::output('grade_list',$grade_list);
        Tpl::output('servicer_grade_list',$servicer_grade_list);
        Tpl::output('servicer_grade',$servicer_grade);
        Tpl::output('class_list',$parent_list);
        Tpl::output('store_array',$store_array);

        $joinin_detail = Model('store_joinin')->getOne(array('member_id'=>$store_array['member_id']));
        Tpl::output('joinin_detail', $joinin_detail);
        Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
        Tpl::showpage('servicer_store.edit');
    }

    /**
     * 店铺结算周期编辑
     */
    public function bill_cycyle_editWwi(){
        $lang = Language::getLangContent();

        $model_store = Model('store');
        $model_store_ext = Model('store_extend');
        //保存
        if (chksubmit()){
            $result = $model_store_ext->editStoreExtend(array('bill_cycle'=>intval($_POST['bill_cycle'])), array('store_id' => $_POST['store_id']));
            if ($result){
                $this->log('设置店铺结算周期['.$_POST['store_name'].']',1);
                showMessage($lang['nc_common_save_succ'],'index.php?app=servicer_store&wwi=bill_cycle');
            }else {
                $this->log('设置店铺结算周期['.$_POST['store_name'].']',1);
                showMessage($lang['nc_common_save_fail'],'index.php?app=servicer_store&wwi=bill_cycle');
            }
        }

        //取店铺信息
        $store_array = $model_store->getStoreInfoByID($_GET['store_id']);
        if (empty($store_array)){
            showMessage($lang['store_no_exist']);
        }
        $store_ext = $model_store_ext->getStoreExtendInfo(array('store_id'=>$_GET['store_id']));
        if ($store_ext['bill_cycle']) {
            $store_array['bill_cycle'] = $store_ext['bill_cycle'];
        }

        Tpl::output('store_array',$store_array);
        Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
        Tpl::showpage('servicer_store.bill_cycle_edit');
    }

    /**
     * 编辑保存注册信息
     */
    public function edit_save_joininWwi() {
        if (chksubmit()) {
            $member_id = $_POST['member_id'];
            if ($member_id <= 0) {
                showMessage(L('param_error'));
            }
            $param = array();
            $param['company_name'] = $_POST['company_name'];
            $param['company_province_id'] = intval($_POST['province_id']);
            $param['company_address'] = $_POST['company_address'];
            $param['company_address_detail'] = $_POST['company_address_detail'];
            $param['company_phone'] = $_POST['company_phone'];
            $param['company_employee_count'] = intval($_POST['company_employee_count']);
            $param['company_registered_capital'] = intval($_POST['company_registered_capital']);
            $param['contacts_name'] = $_POST['contacts_name'];
            $param['contacts_phone'] = $_POST['contacts_phone'];
            $param['contacts_email'] = $_POST['contacts_email'];
            $param['business_licence_number'] = $_POST['business_licence_number'];
            $param['business_licence_address'] = $_POST['business_licence_address'];
            $param['business_licence_start'] = $_POST['business_licence_start'];
            $param['business_licence_end'] = $_POST['business_licence_end'];
            $param['business_sphere'] = $_POST['business_sphere'];
            if ($_FILES['business_licence_number_elc']['name'] != '') {
                $param['business_licence_number_elc'] = $this->upload_image('business_licence_number_elc');
            }
            $param['organization_code'] = $_POST['organization_code'];
            if ($_FILES['organization_code_electronic']['name'] != '') {
                $param['organization_code_electronic'] = $this->upload_image('organization_code_electronic');
            }
            if ($_FILES['general_taxpayer']['name'] != '') {
                $param['general_taxpayer'] = $this->upload_image('general_taxpayer');
            }
            $param['bank_account_name'] = $_POST['bank_account_name'];
            $param['bank_account_number'] = $_POST['bank_account_number'];
            $param['bank_name'] = $_POST['bank_name'];
            $param['bank_code'] = $_POST['bank_code'];
            $param['bank_address'] = $_POST['bank_address'];
            if ($_FILES['bank_licence_electronic']['name'] != '') {
                $param['bank_licence_electronic'] = $this->upload_image('bank_licence_electronic');
            }
            $param['settlement_bank_account_name'] = $_POST['settlement_bank_account_name'];
            $param['settlement_bank_account_number'] = $_POST['settlement_bank_account_number'];
            $param['settlement_bank_name'] = $_POST['settlement_bank_name'];
            $param['settlement_bank_code'] = $_POST['settlement_bank_code'];
            $param['settlement_bank_address'] = $_POST['settlement_bank_address'];
            $param['tax_registration_certificate'] = $_POST['tax_registration_certificate'];
            $param['taxpayer_id'] = $_POST['taxpayer_id'];
            if ($_FILES['tax_registration_certif_elc']['name'] != '') {
                $param['tax_registration_certif_elc'] = $this->upload_image('tax_registration_certif_elc');
            }
            $result = Model('store_joinin')->editStoreJoinin(array('member_id' => $member_id), $param);
            if ($result) {
                showMessage(L('nc_common_op_succ'), 'index.php?app=servicer_store&wwi=store');
            } else {
                showMessage(L('nc_common_op_fail'));
            }
        }
    }

    private function upload_image($file) {
        $pic_name = '';
        $upload = new UploadFile();
        $uploaddir = ATTACH_PATH.DS.'store_joinin'.DS;
        $upload->set('default_dir',$uploaddir);
        $upload->set('allow_type',array('jpg','jpeg','gif','png'));
        if (!empty($_FILES[$file]['name'])){
            $result = $upload->upfile($file);
            if ($result){
                $pic_name = $upload->file_name;
                $upload->file_name = '';
            }
        }
        return $pic_name;
    }

    /**
     * 店铺服务区域
     */
    public function store_bind_areaWwi() {
        $store_id = intval($_GET['store_id']);
        $model_store = Model('store');
        $model_store_bind_area = Model('store_bind_area');
        $model_area = Model('area');

        $area_list = $model_area->getTopLevelAreas(0);

        Tpl::output('area_list',$area_list);

        $store_info = $model_store->getStoreInfoByID($store_id);

        if(empty($store_info)) {
            showMessage(L('param_error'),'','','error');
        }
        Tpl::output('store_info', $store_info);

        $store_bind_area_list = $model_store_bind_area->getStoreBindAreaList(array('store_bind_area.store_id'=>$store_id,'store_bind_area.state'=>1), null);
        
        $area = Model('area')->getAreaListAll();

        for($i = 0, $j = count($store_bind_area_list); $i < $j; $i++) {
            $store_bind_area_list[$i]['area_1_name'] = $area[$store_bind_area_list[$i]['area_1']];
            $store_bind_area_list[$i]['area_2_name'] = $area[$store_bind_area_list[$i]['area_2']];
            $store_bind_area_list[$i]['area_3_name'] = $area[$store_bind_area_list[$i]['area_3']];
        }
        Tpl::output('store_bind_area_list', $store_bind_area_list);
        Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/

        Tpl::showpage('servicer_store.bind_area');
    }

    /**
     * 添加服务区域
     */
    public function store_bind_area_addWwi() {

        $store_id = intval($_POST['store_id']);

        list($area_1, $area_2, $area_3) = explode(',', $_POST['servicer_area']);

        $model_store_bind_area = Model('store_bind_area');

        $param = array();
        $param['store_id'] = $store_id;
        $param['area_1'] = $area_1;
        $param['state'] = 1;
        if(!empty($area_2)) {
            $param['area_2'] = $area_2;
        }
        if(!empty($area_3)) {
            $param['area_3'] = $area_3;
        }

        // 检查类目是否已经存在
        $store_bind_area_info = $model_store_bind_area->getStoreBindAreaInfo($param);
        if(!empty($store_bind_area_info)) {
            showMessage('该区域已经存在','','','error');
        }

        $result = $model_store_bind_area->addStoreBindArea($param);

        if($result) {
            $this->log('添加服务商服务区域，编号:'.$result.',店铺编号:'.$store_id);
            showMessage(L('nc_common_save_succ'), '');
        } else {
            showMessage(L('nc_common_save_fail'), '');
        }
    }

    /**
     * 删除服务区域
     */
    public function store_bind_area_delWwi() {
        $bid = intval($_POST['bid']);

        $data = array();
        $data['result'] = true;

        $model_store_bind_area = Model('store_bind_area');

        $store_bind_area_info = $model_store_bind_area->getStoreBindAreaInfo(array('bid' => $bid));
        if(empty($store_bind_area_info)) {
            $data['result'] = false;
            $data['message'] = '服务区域删除失败';
            echo json_encode($data);die;
        }


        $result = $model_store_bind_area->delStoreBindArea(array('bid'=>$bid));

        if(!$result) {
            $data['result'] = false;
            $data['message'] = '服务区域删除失败';
        }
        $this->log('删除服务商服务区域，编号:'.$bid.',店铺编号:'.$store_bind_area_info['store_id']);
        echo json_encode($data);die;
    }

    public function store_bind_class_updateWwi() {
        $data['result'] = false;
        $data['message'] = '操作无效';
        echo json_encode($data);die;
    }

    public function shopwwi_addWwi()
    {
        if (chksubmit())
        {
            $memberName = $_POST['member_name'];
            $memberPasswd = (string) $_POST['member_passwd'];

            if (strlen($memberName) < 3 || strlen($memberName) > 15
                || strlen($_POST['seller_name']) < 3 || strlen($_POST['seller_name']) > 15)
                showMessage('账号名称必须是3~15位', '', 'html', 'error');

            if (strlen($memberPasswd) < 6)
                showMessage('登录密码不能短于6位', '', 'html', 'error');

            if (!$this->checkMemberName($memberName))
                showMessage('店主账号已被占用', '', 'html', 'error');

            if (!$this->checkSellerName($_POST['seller_name']))
                showMessage('店主卖家账号名称已被其它店铺占用', '', 'html', 'error');

            try
            {
                $memberId = model('member')->addMember(array(
                    'member_name' => $memberName,
                    'member_passwd' => $memberPasswd,
                    'member_email' => '',
                ));
            }
            catch (Exception $ex)
            {
                showMessage('店主账号新增失败', '', 'html', 'error');
            }

            $storeModel = model('store');

            $saveArray = array();
            $saveArray['store_name'] = $_POST['store_name'];
            $saveArray['member_id'] = $memberId;
            $saveArray['member_name'] = $memberName;
            $saveArray['seller_name'] = $_POST['seller_name'];
            $saveArray['bind_all_gc'] = 1;
            $saveArray['store_state'] = 1;
            $saveArray['store_time'] = time();
            $saveArray['is_own_mall'] = 0;
            $saveArray['store_type'] = self::STORE_TYPE;

            $storeId = $storeModel->addStore($saveArray);

            model('seller')->addSeller(array(
                'seller_name' => $_POST['seller_name'],
                'member_id' => $memberId,
                'store_id' => $storeId,
                'seller_group_id' => 0,
                'is_admin' => 1,
            ));
            model('store_joinin')->save(array(
                'seller_name' => $_POST['seller_name'],
                'store_name'  => $_POST['store_name'],
                'member_name' => $memberName,
                'member_id' => $memberId,
                'joinin_state' => 40,
                'company_province_id' => 0,
                'sc_bail' => 0,
                'joinin_year' => 1,
                'store_type' => self::STORE_TYPE,
            ));

            // 添加相册默认
            $album_model = Model('album');
            $album_arr = array();
            $album_arr['aclass_name'] = '默认相册';
            $album_arr['store_id'] = $storeId;
            $album_arr['aclass_des'] = '';
            $album_arr['aclass_sort'] = '255';
            $album_arr['aclass_cover'] = '';
            $album_arr['upload_time'] = time();
            $album_arr['is_default'] = '1';
            $album_model->addClass($album_arr);

            //插入店铺扩展表
            $model = Model();
            $model->table('store_extend')->insert(array('store_id'=>$storeId));

            // 删除自营店id缓存
            Model('store')->dropCachedOwnMallIds();

            $this->log("新增外驻店铺: {$saveArray['store_name']}");
            showMessage('操作成功','index.php?app=servicer_store&wwi=store');
            return;
        }
        Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/

        Tpl::showpage('servicer_store.add');
    }
     public function check_seller_nameWwi()
    {
        echo json_encode($this->checkSellerName($_GET['seller_name'], $_GET['id']));
        exit;
    }

    private function checkSellerName($sellerName, $storeId = 0)
    {
        // 判断store_joinin是否存在记录
        $count = (int) Model('store_joinin')->getStoreJoininCount(array(
            'seller_name' => $sellerName,
        ));
        if ($count > 0)
            return false;

        $seller = Model('seller')->getSellerInfo(array(
            'seller_name' => $sellerName,
        ));

        if (empty($seller))
            return true;

        if (!$storeId)
            return false;

        if ($storeId == $seller['store_id'] && $seller['seller_group_id'] == 0 && $seller['is_admin'] == 1)
            return true;

        return false;
    }

    public function check_member_nameWwi()
    {
        echo json_encode($this->checkMemberName($_GET['member_name']));
        exit;
    }

    private function checkMemberName($memberName)
    {
        // 判断store_joinin是否存在记录
        $count = (int) Model('store_joinin')->getStoreJoininCount(array(
            'member_name' => $memberName,
        ));
        if ($count > 0)
            return false;

        return ! Model('member')->getMemberCount(array(
            'member_name' => $memberName,
        ));
    }
    /**
     * 店铺 待审核列表
     */
    public function store_joininWwi(){

        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->_links,'store_joinin'));
        Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/

        Tpl::showpage('servicer_store_joinin');
    }

    /**
     * 输出XML数据
     */
    public function get_joinin_xmlWwi() {
        $model_store_joinin = Model('store_joinin');
        // 设置页码参数名称
        $condition = array();
        $condition['store_type'] = self::STORE_TYPE;
        $condition['joinin_state'] = array('gt',0);
        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('member_id', 'member_name', 'sg_id', 'paying_amount', 'joinin_state', 'joinin_year', 'contacts_name', 'contacts_phone'
                ,'contacts_email', 'company_name', 'company_province_id', 'company_phone', 'company_employee_count', 'company_registered_capital'
        );
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }

        $page = $_POST['rp'];

        //店铺列表
        $store_list = $model_store_joinin->getList($condition, $page, $order);

        // 开店状态
        $joinin_state_array = $this->get_store_joinin_state();

        $data = array();
        $data['now_page'] = $model_store_joinin->shownowpage();
        $data['total_num'] = $model_store_joinin->gettotalnum();
        foreach ($store_list as $value) {
            $param = array();
            if(in_array(intval($value['joinin_state']), array(STORE_JOIN_STATE_NEW, STORE_JOIN_STATE_PAY))) {
                $operation = "<a class='btn orange' href=\"index.php?app=servicer_store&wwi=store_joinin_detail&member_id=". $value['member_id'] ."\"><i class=\"fa fa-check-tyq\"></i>审核</a>";
            } else {
                $operation = "<a class='btn green' href=\"index.php?app=servicer_store&wwi=store_joinin_detail&member_id=". $value['member_id'] ."\"><i class=\"fa fa-list-alt\"></i>查看</a>";
            }
            $param['operation'] = $operation;
            $param['member_id'] = $value['member_id'];
            $param['member_name'] = $value['member_name'];
            $param['sg_id'] = $value['sg_name'];
            $param['paying_amount'] = ncPriceFormat($value['paying_amount']);
            $param['joinin_state'] = $joinin_state_array[$value['joinin_state']];
            $param['joinin_year'] = $value['joinin_year'];
            $param['contacts_name'] = $value['contacts_name'];
            $param['contacts_phone'] = $value['contacts_phone'];
            $param['contacts_email'] = $value['contacts_email'];
            $param['company_name'] = $value['company_name'];
            $param['company_province_id'] = $value['company_address'] . ' ' . $value['company_address_detail'];
            $param['company_phone'] = $value['company_phone'];
            $param['company_employee_count'] = $value['company_employee_count'];
            $param['company_registered_capital'] = $value['company_registered_capital'];
            $data['list'][$value['member_id']] = $param;
        }
        echo Tpl::flexigridXML($data);exit();
    }

    /**
     * 经营类目申请列表
     */
    public function store_bind_area_applay_listWwi(){
        Tpl::output('top_link',$this->sublink($this->_links,'store_bind_area_applay_list'));
        Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
        Tpl::showpage('servicer_store.bind_area_applay_list');
    }

    /**
     * 输出XML数据
     */
    public function get_bind_area_applay_xmlWwi() {
        $model_store_bind_area = Model('store_bind_area');
        // 设置页码参数名称
        $condition = array();
        $condition['store_type'] = self::STORE_TYPE;
        $condition['state'] = array('in', array('0', '1'));
        if ($_GET['state'] != '') {
            $condition['state'] = $_GET['state'];
        }
        if ($_GET['store_id'] != '') {
            $condition['store_id'] = array('like', '%' . $_GET['store_id'] . '%');
        }

        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('bid', 'store_id', 'area_1', 'area_2', 'area_3', 'state');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }

        $page = $_POST['rp'];

        //店铺列表
        $store_bind_area_list = $model_store_bind_area->getStoreBindAreaList($condition, $page, $order);
        
        $storeid_array = array();
        foreach ($store_bind_area_list as $value) {
            $storeid_array[] = $value['store_id'];
        }
        $store_list = Model('store')->getStoreList(array('store_id'=>array('in', $storeid_array)));
        $store_array = array();
        foreach ($store_list as $value) {
            $store_array[$value['store_id']]['store_name'] = $value['store_name'];
            $store_array[$value['store_id']]['seller_name'] = $value['seller_name'];
        }

        //地区
        $area = Model('area')->getAreaListAll();

        // 申请类目状态
        $apply_state = $this->getAreaApplyState();

        $data = array();
        $data['now_page'] = $model_store_bind_area->shownowpage();
        $data['total_num'] = $model_store_bind_area->gettotalnum();

        foreach ($store_bind_area_list as $value) {
            $param = array();
            if($value['state'] == '0') {
                $operation = "<a class='btn orange' href=\"javascript:if(confirm('确认审核吗？'))window.location = 'index.php?app=servicer_store&wwi=store_bind_area_applay_check&bid=".$value['bid']."&store_id=".$value['store_id']."'\"><i class=\"fa fa-check-tyq\"></i>审核</a>";
            } else {
                $operation = "<a class='btn red' href=\"javascript:if(confirm('".($value['state'] == '1' ? '该类目已经审核通过，删除它可能影响到商家的使用，' : null)."确认删除吗？'))window.location = 'index.php?app=servicer_store&wwi=store_bind_area_applay_del&bid=".$value['bid']."&store_id=".$value['store_id']."'\"><i class=\"fa fa-trash-o\"></i>删除</a>";
            }
            $param['operation'] = $operation;
            $param['store_id'] = $value['store_id'];
            $param['store_name'] = $store_array[$value['store_id']]['store_name'];
            $param['seller_name'] = $store_array[$value['store_id']]['seller_name'];
            $param['state'] = $apply_state[$value['state']];
            $param['area'] = $area[$value['area_1']] . '(ID:' . $value['area_1'] . ')';
            if ($value['area_2'] > 0) {
                $param['area'] .= '   > ' . $area[$value['area_2']]. '(ID:' . $value['area_2'] . ')';
            }
            if ($value['area_3'] > 0) {
                $param['area'] .= '   > ' . $area[$value['area_3']]. '(ID:' . $value['area_3'] . ')';
            }
            $data['list'][$value['bid']] = $param;
        }
        echo Tpl::flexigridXML($data);exit();
    }

    private function getAreaApplyState() {
        return array('0' => '审核中', '1' => '已审核');
    }


    /**
     * 审核服务区域申请
     */
    public function store_bind_area_applay_checkWwi() {
        $model_store_bind_area = Model('store_bind_area');
        $condition = array();
        $condition['bid'] = intval($_GET['bid']);
        $condition['state'] = 0;
        $update = $model_store_bind_area->editStoreBindArea(array('state'=>1),$condition);
        if ($update) {
            $this->log('审核新服务区域申请，店铺ID：'.$_GET['store_id'],1);
            showMessage('审核成功',getReferer());
        } else {
            showMessage('审核失败',getReferer(),'html','error');
        }
    }

    /**
     * 删除经营类目申请
     */
    public function store_bind_area_applay_delWwi() {
        $model_store_bind_area = Model('store_bind_area');
        $condition = array();
        $condition['bid'] = intval($_GET['bid']);
        $del = $model_store_bind_area->delStoreBindArea($condition);
        if ($del) {
            $this->log('删除服务区域，店铺ID：'.$_GET['store_id'],1);
            showMessage('删除成功',getReferer());
        } else {
            showMessage('删除失败',getReferer(),'html','error');
        }
    }

    private function get_store_joinin_state() {
        $joinin_state_array = array(
            STORE_JOIN_STATE_NEW => '新申请',
            STORE_JOIN_STATE_PAY => '已付款',
            STORE_JOIN_STATE_VERIFY_SUCCESS => '待付款',
            STORE_JOIN_STATE_VERIFY_FAIL => '审核失败',
            STORE_JOIN_STATE_PAY_FAIL => '付款审核失败',
            STORE_JOIN_STATE_FINAL => '开店成功',
        );
        return $joinin_state_array;
    }

    /**
     * 店铺续签申请列表
     */
    public function reopen_listWwi(){
        Tpl::output('top_link',$this->sublink($this->_links,'reopen_list'));
        Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
        Tpl::showpage('servicer_store_reopen.list');
    }

    /**
     * 输出XML数据
     */
    public function get_reopen_xmlWwi() {
        $model_store_reopen = Model('store_reopen');
        // 设置页码参数名称
        $condition = array();
        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('re_id', 're_grade_id', 're_grade_price', 're_year', 're_pay_amount', 're_store_id', 're_store_name', 're_state'
                , 're_create_time', 're_start_time', 're_end_time', 're_pay_cert', 're_pay_cert_explain');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }

        $page = $_POST['rp'];

        //店铺列表
        $reopen_list = $model_store_reopen->getStoreReopenList($condition, $page, $order);

        // 续签状态
        $reopen_state_array = $this->getReopenState();

        $data = array();
        $data['now_page'] = $model_store_reopen->shownowpage();
        $data['total_num'] = $model_store_reopen->gettotalnum();
        foreach ($reopen_list as $value) {
            $param = array();
            $operation = '';
            if($value['re_state'] == 1) {
                $operation .= "<a class='btn orange' href=\"javascript:void(0);\" onclick=\"reopen_check('" . $value['re_id'] . "')\"><i class=\"fa fa-check-tyq-o\"></i>审核</a>";
            }
            if ($value['re_state'] != 2) {
                $operation .= "<a class='btn green' href=\"javascript:void(0);\" onclick=\"reopen_del('" . $value['re_id'] . "', '" . $value['re_store_id'] . "')\"><i class=\"fa fa-list-alt\"></i>删除</a>";
            }
            if ($value['re_state'] == 2) {
                $operation .= "<span>--</span>";
            }
            $param['operation'] = $operation;
            $param['re_id'] = $value['re_id'];
            $param['re_grade_id'] = $value['re_grade_name'];
            $param['re_grade_price'] = ncPriceFormat($value['re_grade_price']);
            $param['re_year'] = $value['re_year'];
            $param['re_pay_amount'] = ncPriceFormat($value['re_pay_amount']);
            $param['re_store_id'] = $value['re_store_id'];
            $param['re_store_name'] = $value['re_store_name'];
            $param['re_state'] = $reopen_state_array[$value['re_state']];
            $param['re_create_time'] = date('Y-m-d', $value['re_create_time']);
            $param['re_pay_cert'] = "<a href='".getStoreJoininImageUrl($value['re_pay_cert'])."' target=\"blank\" class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=".getStoreJoininImageUrl($value['re_pay_cert']).">\")'><i class='fa fa-picture-o'></i></a>";
            $param['re_pay_cert_explain'] = $value['re_pay_cert_explain'];
            $param['re_start_time'] = $value['re_start_time'] != '' ? date('Y-m-d', $value['re_start_time']) : '';
            $param['re_end_time'] = $value['re_end_time'] != '' ? date('Y-m-d', $value['re_end_time']) : '';
            $data['list'][$value['re_id']] = $param;
        }
        echo Tpl::flexigridXML($data);exit();
    }

    private function getReopenState() {
        return array('0' => '待付款', '1' => '待审核', '2' => '通过审核');
    }

    /**
     * 审核店铺续签申请
     */
    public function reopen_checkWwi() {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $model_store_reopen = Model('store_reopen');
            $condition = array();
            $condition['re_id'] = $id;
            $condition['re_state'] = 1;
            //取当前申请信息
            $reopen_info = $model_store_reopen->getStoreReopenInfo($condition);

            //取目前店铺有效截止日期
            $store_info = Model('store')->getStoreInfoByID($reopen_info['re_store_id']);
            $data = array();
            $data['re_start_time'] = strtotime(date('Y-m-d 0:0:0',$store_info['store_end_time']))+24*3600;
            $data['re_end_time'] = strtotime(date('Y-m-d 23:59:59', $data['re_start_time'])." +".intval($reopen_info['re_year'])." year");
            $data['re_state'] = 2;
            $update = $model_store_reopen->editStoreReopen($data,$condition);
            if ($update) {
                //更新店铺有效期
                Model('store')->editStore(array('store_end_time'=>$data['re_end_time']),array('store_id'=>$reopen_info['re_store_id']));
                $msg = '审核通过店铺续签申请，店铺ID：'.$reopen_info['re_store_id'].'，续签时间段：'.date('Y-m-d',$data['re_start_time']).' - '.date('Y-m-d',$data['re_end_time']);
                $this->log($msg,1);
                exit(json_encode(array('state'=>true,'msg'=>'审核成功')));
            } else {
                exit(json_encode(array('state'=>false,'msg'=>'审核失败')));
            }
        } else {
            exit(json_encode(array('state'=>false,'msg'=>'审核失败')));
        }
    }

    /**
     * 删除店铺续签申请
     */
    public function reopen_delWwi() {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $model_store_reopen = Model('store_reopen');
            $condition = array();
            $condition['re_id'] = $id;
            $condition['re_state'] = array('in',array(0,1));

            //取当前申请信息
            $reopen_info = $model_store_reopen->getStoreReopenInfo($condition);
            $cert_file = BASE_UPLOAD_PATH.DS.ATTACH_STORE_JOININ.DS.$reopen_info['re_pay_cert'];
            $del = $model_store_reopen->delStoreReopen($condition);
            if ($del) {
                if (is_file($cert_file)) {
                    @unlink($cert_file);
                }
                $this->log('删除店铺续签目申请，店铺ID：'.$_GET['store_id'],1);
                exit(json_encode(array('state'=>true,'msg'=>'审核成功')));
            } else {
                exit(json_encode(array('state'=>false,'msg'=>'审核失败')));
            }
        } else {
            exit(json_encode(array('state'=>false,'msg'=>'删除失败')));
        }
    }

    /**
     * 审核详细页
     */
    public function store_joinin_detailWwi(){
        $model_store_joinin = Model('store_joinin');
        $joinin_detail = $model_store_joinin->getOne(array('member_id'=>$_GET['member_id']));
        $joinin_detail_title = '查看';
        if(in_array(intval($joinin_detail['joinin_state']), array(STORE_JOIN_STATE_NEW, STORE_JOIN_STATE_PAY))) {
            $joinin_detail_title = '审核';
        }
        if (!empty($joinin_detail['sg_info'])) {
            $store_grade_info = Model('store_grade')->getOneGrade($joinin_detail['sg_id']);
            $joinin_detail['sg_price'] = $store_grade_info['sg_price'];
        } else {
            $joinin_detail['sg_info'] = @unserialize($joinin_detail['sg_info']);
            if (is_array($joinin_detail['sg_info'])) {
                $joinin_detail['sg_price'] = $joinin_detail['sg_info']['sg_price'];
            }
        }
        //获取服务商(审核完成才存在)
        $servicer_info=Model('servicer')->getServicerInfo(array('ser_member_id'=>$joinin_detail['member_id']));
        $servicer_grade=$servicer_info['ssg_id']?$servicer_info['ssg_id']:1;
        //最后一次审核需要分配等级
        $servicer_grade_list=Model('servicer_store_grade')->getGradeList();
        Tpl::output('joinin_detail_title', $joinin_detail_title);
        Tpl::output('joinin_detail', $joinin_detail);
        Tpl::output('servicer_grade_list', $servicer_grade_list);
        Tpl::output('servicer_grade', $servicer_grade);
        Tpl::setDirquna('mall');/*网 店 运 维mall wwi.com*/
        Tpl::showpage('servicer_store_joinin.detail');
    }

    /**
     * 审核
     */
    public function store_joinin_verifyWwi() {
        $model_store_joinin = Model('store_joinin');
        $joinin_detail = $model_store_joinin->getOne(array('member_id'=>$_POST['member_id']));

        switch (intval($joinin_detail['joinin_state'])) {
            case STORE_JOIN_STATE_NEW:
                $this->store_joinin_verify_pass($joinin_detail);
                break;
            case STORE_JOIN_STATE_PAY:
                $this->store_joinin_verify_open($joinin_detail);
                break;
            default:
                showMessage('参数错误','');
                break;
        }
    }

    private function store_joinin_verify_pass($joinin_detail) {
        $param = array();
        $param['joinin_state'] = $_POST['verify_type'] === 'pass' ? STORE_JOIN_STATE_VERIFY_SUCCESS : STORE_JOIN_STATE_VERIFY_FAIL;
        $param['joinin_message'] = $_POST['joinin_message'];
        $param['paying_amount'] = abs(floatval($_POST['paying_amount']));
        $param['store_class_commis_rates'] = implode(',', $_POST['commis_rate']);
        $model_store_joinin = Model('store_joinin');
        $model_store_joinin->modify($param, array('member_id'=>$_POST['member_id']));
        if ($param['paying_amount'] > 0) {
            showMessage('店铺入驻申请审核完成','index.php?app=servicer_store&wwi=store_joinin');
        } else {
            //如果开店支付费用为零，则审核通过后直接开通，无需再上传付款凭证
            $this->store_joinin_verify_open($joinin_detail);
        }
    }

    private function store_joinin_verify_open($joinin_detail) {
        $model_store_joinin = Model('store_joinin');
        $model_store    = Model('store');
        $model_seller = Model('seller');

        //验证商家用户名是否已经存在
        if($model_seller->isSellerExist(array('seller_name' => $joinin_detail['seller_name']))) {
            showMessage('商家用户名已存在','');
        }

        $param = array();
        $param['joinin_state'] = $_POST['verify_type'] === 'pass' ? STORE_JOIN_STATE_FINAL : STORE_JOIN_STATE_PAY_FAIL;
        $param['joinin_message'] = $_POST['joinin_message'];
        $model_store_joinin->modify($param, array('member_id'=>$_POST['member_id']));
        if($_POST['verify_type'] === 'pass') {
            //开店
            $mall_array     = array();
            $mall_array['member_id']    = $joinin_detail['member_id'];
            $mall_array['member_name']  = $joinin_detail['member_name'];
            $mall_array['seller_name'] = $joinin_detail['seller_name'];
            $mall_array['grade_id']     = $joinin_detail['sg_id'];
            $mall_array['store_name']   = $joinin_detail['store_name'];
            $mall_array['sc_id']        = $joinin_detail['sc_id'];
            $mall_array['store_company_name'] = $joinin_detail['company_name'];
            $mall_array['province_id']  = $joinin_detail['company_province_id'];
            $mall_array['area_info']    = $joinin_detail['company_address'];
            $mall_array['store_address']= $joinin_detail['company_address_detail'];
            $mall_array['store_zip']    = '';
            $mall_array['store_zy']     = '';
            $mall_array['store_state']  = 1;
            $mall_array['store_time']   = time();
            $mall_array['store_end_time'] = strtotime(date('Y-m-d 23:59:59', strtotime('+1 day'))." +".intval($joinin_detail['joinin_year'])." year");
            $mall_array['store_type']   = $joinin_detail['store_type'];
            $store_id = $model_store->addStore($mall_array);

            if($store_id) {
                //写入商家账号
                $seller_array = array();
                $seller_array['seller_name'] = $joinin_detail['seller_name'];
                $seller_array['member_id'] = $joinin_detail['member_id'];
                $seller_array['seller_group_id'] = 0;
                $seller_array['store_id'] = $store_id;
                $seller_array['is_admin'] = 1;
                $state = $model_seller->addSeller($seller_array);
            }

            if($state) {

                //写入服务商表
                $servicer_array = array();
                $servicer_array['ser_store_id'] = $store_id;
                $servicer_array['ser_member_id']= $joinin_detail['member_id'];
                $servicer_array['ssg_id'] = intval($_POST['ssg_id']);
                Model('servicer')->addServicer($servicer_array);
                
                // 添加相册默认
                $album_model = Model('album');
                $album_arr = array();
                $album_arr['aclass_name'] = Language::get('store_save_defaultalbumclass_name');
                $album_arr['store_id'] = $store_id;
                $album_arr['aclass_des'] = '';
                $album_arr['aclass_sort'] = '255';
                $album_arr['aclass_cover'] = '';
                $album_arr['upload_time'] = time();
                $album_arr['is_default'] = '1';
                $album_model->addClass($album_arr);

                $model = Model();
                //插入店铺扩展表
                $model->table('store_extend')->insert(array('store_id'=>$store_id));
                $msg = Language::get('store_save_create_success');

                //插入店铺服务区域
                $store_bind_area_array = array();
                $store_bind_area = unserialize($joinin_detail['service_area_ids']);
                for($i=0, $length=count($store_bind_area); $i<$length; $i++) {
                    list($area1, $area2, $area3) = explode(',', $store_bind_area[$i]);
                    $store_bind_area_array[] = array(
                        'store_id' => $store_id,
                        'area_1' => $area1,
                        'area_2' => $area2,
                        'area_3' => $area3,
                        'state' => 1
                    );
                }
                $model_store_bind_area = Model('store_bind_area');
                $model_store_bind_area->addStoreBindAreaAll($store_bind_area_array);
                showMessage('店铺开店成功','index.php?app=servicer_store&wwi=store_joinin');
            } else {
                showMessage('店铺开店失败','index.php?app=servicer_store&wwi=store_joinin');
            }
        } else {
            showMessage('店铺开店拒绝','index.php?app=servicer_store&wwi=store_joinin');
        }
    }

    /**
     * 提醒续费
     */
    public function remind_renewalWwi() {
        $store_id = intval($_GET['store_id']);
        $store_info = Model('store')->getStoreInfoByID($store_id);
        if (!empty($store_info) && $store_info['store_end_time'] < (TIMESTAMP + 864000) && cookie('remindRenewal'.$store_id) == null) {
            // 发送商家消息
            $param = array();
            $param['code'] = 'store_expire';
            $param['store_id'] = intval($_GET['store_id']);
            $param['param'] = array();
            QueueClient::push('sendStoreMsg', $param);

            setNcCookie('remindRenewal'.$store_id, 1, 86400 * 10);  // 十天
            showMessage('消息发送成功');
        }
            showMessage('消息发送失败');
    }

    /**
     * 验证店铺名称是否存在
     */
    public function ckeck_store_nameWwi() {
        /**
         * 实例化商家模型
         */
        $where = array();
        $where['store_name'] = $_GET['store_name'];
        $where['store_id'] = array('neq', $_GET['store_id']);
        $store_info = Model('store')->getStoreInfo($where);
        if(!empty($store_info['store_name'])) {
            echo 'false';
        } else {
            echo 'true';
        }
    }
}
