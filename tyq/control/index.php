<?php
/**
 * 圈子首页
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');

class indexControl extends BaseTyqControl{
    public function __construct(){
        Language::read('tyq');
        parent::__construct();
    }
    /**
     * 首页
     */
    public function indexWwi(){
        $model = Model();
		if($_GET['type']==5){
			$where['has_goods'] = 1;
			$order='is_stick desc,theme_id desc';
		}else if($_GET['type']==4){
			$order='is_stick desc,theme_commentcount desc';
			
		}else if($_GET['type']==3){
			$where['is_digest'] = 1;
			$order='is_stick desc,theme_commentcount desc';
		}else if($_GET['type']==2){
			$order='is_stick desc,theme_id desc';
		}else{
			$order='is_stick desc,lastspeak_time desc';
		}

        // 推荐圈子      
        $tyq_list = $model->table('tyq')->where(array('tyq_status'=>1, 'is_recommend'=>1))->order('tyq_id desc')->limit(10)->select();
        if(!empty($tyq_list)){
            $tyq_list = array_under_reset($tyq_list, 'tyq_id');$tyqid_array = array_keys($tyq_list);
            Tpl::output('tyq_list', $tyq_list);

            $now = strtotime(date('Y-m-d',time()));
            // 今天发表的主题
            $nowthemecount_array = $model->table('tyq_theme')->field('count(tyq_id) as count,tyq_id')->group('tyq_id')->where(array('theme_addtime'=>array('gt', $now), 'tyq_id'=>array('in', $tyqid_array), 'is_closed'=>0))->select();
            if(!empty($nowthemecount_array)){
                $nowthemecount_array = array_under_reset($nowthemecount_array, 'tyq_id');
                Tpl::output('nowthemecount_array', $nowthemecount_array);
            }
        }

        //首页话题列表
        $tyqs_list = $model->table('tyq_theme')->where($where)->order($order)->limit(20)->select();
		$tyqs_list = array_under_reset($tyqs_list, 'theme_id');
        Tpl::output('tyqs_list', $tyqs_list);
        // 附件列表
        if(!empty($tyqs_list)){
            $themeid_array = array_keys($tyqs_list);
            $affix_lists = $model->table('tyq_affix')->where(array('affix_type'=>1,'theme_id'=>array('in', $themeid_array)))->select();
            $affix_lists = array_under_reset($affix_lists, 'theme_id', 2);
            Tpl::output('affix_lists', $affix_lists);
        }

        // 圈子分类
        $class_list = $model->table('tyq_class')->where(array('class_status'=>1, 'is_recommend'=>1))->order('class_sort asc')->select();
        Tpl::output('class_list', $class_list);


        // 推荐话题
        $theme_list = $model->table('tyq_theme')->where(array('has_affix'=>1, 'is_closed'=>0, 'is_recommend'=>1))->limit(8)->select();
        if(!empty($theme_list)){
            $theme_list = array_under_reset($theme_list, 'theme_id'); $themeid_array = array_keys($theme_list);
            // 附件
            $affix_list = $model->table('tyq_affix')->field('theme_id, min(affix_filethumb) affix_filethumb')->where(array('theme_id'=>array('in', $themeid_array), 'affix_type'=>1))->group('theme_id')->select();
            if(!empty($affix_list)) $affix_list = array_under_reset($affix_list, 'theme_id');
            foreach ($theme_list as $key=>$val){
                if(isset($affix_list[$val['theme_id']])) $theme_list[$key]['affix'] = themeImageUrl($affix_list[$val['theme_id']]['affix_filethumb']);
            }

            Tpl::output('theme_list', $theme_list);
        }

        // 商品话题
        $gtheme_list = $model->table('tyq_theme')->where(array('has_goods'=>1, 'is_closed'=>0))->order('theme_id desc')->limit(6)->select();
        if(!empty($gtheme_list)){
            $gtheme_list = array_under_reset($gtheme_list, 'theme_id'); $themeid_array = array_keys($gtheme_list);

            // 圈子商品
            $thg_list = $model->table('tyq_thg')->where(array('theme_id'=>array('in', $themeid_array), 'reply_id'=>0))->select();
            $thg_list = tidyThemeGoods($thg_list, 'theme_id', 2);
            Tpl::output('thg_list', $thg_list);

            Tpl::output('gtheme_list', $gtheme_list);
        }

        // 优秀成员
        $member_list = $model->table('tyq_member')->where(array('is_recommend'=>1))->limit(5)->select();
       if(!empty($member_list)){
                $where = '';
                foreach ($member_list as $val){
                    $where .= '( tyq_member.member_id = '.$val['member_id'].' and tyq_member.tyq_id = '.$val['tyq_id'].') or ';
                }
                $where = rtrim($where, 'or ');
                $more_membertheme = $model->field('min(tyq_member.member_id) member_id,min(tyq_member.member_name) member_name,min(tyq_theme.tyq_id) tyq_id,min(tyq_theme.theme_id) theme_id,min(tyq_theme.theme_name) theme_name')->table('tyq_member,tyq_theme')->join('inner')->on('tyq_member.member_id = tyq_theme.member_id and tyq_member.tyq_id = tyq_theme.tyq_id')
                ->where($where)->group('tyq_member.member_id,tyq_member.tyq_id')->select();
                Tpl::output('more_membertheme', $more_membertheme);
        }
	   
	   	//推荐商品
		$goodsids=C(shopwwi_index_goods);
		$goods_list = Model('goods')->getGoodsIDList($goodsids);
		Tpl::output('goods_list',$goods_list);

        // 最新话题/热门话题/人气回复
        $this->themeTop();
		
		        /**
         * 文章
         */
        $this->article();

        // 首页幻灯
        $loginpic = unserialize(C('tyq_loginpic'));
        Tpl::output('loginpic', $loginpic);

        $this->tyqSEO();
        Tpl::showpage('index');
    }
    /**
     * 创建圈子
     */
    public function add_groupWwi(){
        if($_SESSION['is_login'] != 1){
            @header("location: " . urlLogin('login', 'index', array('ref_url' => getRefUrl())));
        }
        if(!intval(C('tyq_iscreate'))){
            showMessage(L('tyq_grooup_not_create'), '', '', 'error');
        }
        $model = Model();
        // 在验证
        // 允许创建圈子验证
        $where = array();
        $where['tyq_masterid'] = $_SESSION['member_id'];
        $create_count = $model->table('tyq')->where($where)->count();
        if(intval($create_count) >= C('tyq_createsum')) showDialog(L('tyq_create_max_error'));

        // 允许加入圈子验证
        $where = array();
        $where['member_id'] = $_SESSION['member_id'];
        $join_count = $model->table('tyq_member')->where($where)->count();
        if(intval($join_count) >= C('tyq_joinsum')) showDialog(L('tyq_join_max_error'));

        if(chksubmit()){
            /**
             * 验证
             */
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                    array("input"=>$_POST["c_name"], "require"=>"true", "message"=>L('tyq_name_not_null'))
            );
            $error = $obj_validate->validate();
            if($error != ''){
                showDialog($error);
            }else{
                $insert = array();
                $insert['tyq_name']          = $_POST['c_name'];
                $insert['tyq_masterid']      = $_SESSION['member_id'];
                $insert['tyq_mastername']    = $_SESSION['member_name'];
                $insert['tyq_desc']          = $_POST['c_desc'];
                $insert['tyq_tag']           = $_POST['c_tag'];
                $insert['tyq_pursuereason']  = $_POST['c_pursuereason'];
                $insert['tyq_status']        = 2;
                $insert['is_recommend']         = 0;
                $insert['class_id']             = intval($_POST['class_id']);
                $insert['tyq_joinaudit']     = 0;
                $insert['tyq_addtime']       = time();
                $insert['tyq_mcount']        = 1;
                $result = $model->table('tyq')->insert($insert);
                if($result){
                    // Membership level information
                    $data = rkcache('tyq_level', true);

                    // 把圈主信息加入圈子会员表
                    $insert = array();
                    $insert['member_id']    = $_SESSION['member_id'];
                    $insert['tyq_id']    = $result;
                    $insert['tyq_name']  = $_POST['c_name'];
                    $insert['member_name']  = $_SESSION['member_name'];
                    $insert['cm_applytime'] = $insert['cm_jointime'] = time();
                    $insert['cm_state']     = 1;
                    $insert['cm_level']     = $data[1]['mld_id'];
                    $insert['cm_levelname'] = $data[1]['mld_name'];
                    $insert['cm_exp']       = 1;
                    $insert['cm_nextexp']   = $data[2]['mld_exp'];
                    $insert['is_identity']  = 1;
                    $insert['cm_lastspeaktime'] = '';
                    $model->table('tyq_member')->insert($insert);

                    showDialog(L('nc_common_op_succ'),'index.php?app=group&c_id='.$result, 'succ');
                }else{
                    showDialog(L('nc_common_op_fail'));
                }
            }
        }
        Tpl::output('create_count', $create_count);
        Tpl::output('join_count', $join_count);

        // 圈子分类
        $class_list = $model->table('tyq_class')->where(array('class_status'=>1))->order('class_sort asc')->select();
        Tpl::output('class_list', $class_list);

        $this->tyqSEO(L('tyq_create'));
        Tpl::showpage('group_add');
    }
    /**
     * 我加入的圈子
     */
    public function myjoinedtyqWwi(){
        $model = Model('tyq_member');

        $cm_list = $model->getTyqMemberList(array('member_id'=>$_SESSION['member_id'], 'tyq_id' => array('neq', 0)),'tyq_id,tyq_name,is_identity', 0, 'is_identity asc');
        if (empty($cm_list)) {
            echo false;die;
        }
        if (strtoupper(CHARSET) == 'GBK'){
            $cm_list = Language::getUTF8($cm_list);
        }
        echo json_encode($cm_list);
    }
    /**
     * 圈子名称验证
     */
    public function check_tyq_nameWwi(){
        $name = $_GET['name'];
        if (strtoupper(CHARSET) == 'GBK'){
            $name = Language::getGBK($name);
        }
        $rs = Model()->table('tyq')->where(array('tyq_name'=>$name))->find();
        if (!empty($rs)){
            echo 'false';
        }else{
            echo 'true';
        }
    }
}
