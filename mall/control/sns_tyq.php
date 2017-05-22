<?php
/**
 * 图片空间操作
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');
class sns_tyqControl extends BaseSNSControl {
    public function __construct() {
        parent::__construct();
        /**
         * 读取语言包
         */
        Language::read('sns_tyq,member_sns,sns_home');
        Tpl::output('menu_sign', 'tyq');

        $this->get_visitor();   // 获取访客
        define('TYQ_TEMPLATES_URL', TYQ_SITE_URL.'/templates/'.TPL_NAME);

        $where = array();
        $where['name']  = !empty($this->master_info['member_truename'])?$this->master_info['member_truename']:$this->master_info['member_name'];
        Model('seo')->type('sns')->param($where)->show();

        $this->sns_messageboard();
    }
    /**
     * index 默认为话题
     */
    public function indexWwi(){
        $this->themeWwi();
    }
    /**
     * 话题
     */
    public function themeWwi(){
        $model = Model();
        $theme_list = $model->table('tyq_theme')->where(array('member_id'=>$this->master_id))->page(10)->order('theme_id desc')->select();
        Tpl::output('showpage', $model->showpage('2'));
        Tpl::output('theme_list', $theme_list);
        if(!empty($theme_list)){
            $theme_list = array_under_reset($theme_list, 'theme_id');
            $themeid_array = array(); $tyqid_array = array();
            foreach ($theme_list as $val){
                $themeid_array[]    = $val['theme_id'];
                $tyqid_array[]   = $val['tyq_id'];
            }
            $themeid_array = array_unique($themeid_array);
            $tyqid_array = array_unique($tyqid_array);
            // 附件
            $affix_list = $model->table('tyq_affix')->where(array('affix_type'=>1, 'member_id'=>$this->master_id, 'theme_id'=>array('in', $themeid_array)))->select();
            $affix_list = array_under_reset($affix_list, 'theme_id', 2);
            Tpl::output('affix_list', $affix_list);
        }

        $this->profile_menu('theme');
        Tpl::showpage('sns_tyqtheme');
    }
    /**
     * 圈子
     */
    public function tyqWwi(){
        $model = Model();
        $cm_list = $model->table('tyq_member')->where(array('member_id'=>$this->master_id))->order('cm_jointime desc')->select();
        if(!empty($cm_list)){
            $cm_list = array_under_reset($cm_list, 'tyq_id'); $tyqid_array = array_keys($cm_list);
            $tyq_list = $model->table('tyq')->where(array('tyq_id'=>array('in', $tyqid_array)))->select();
            Tpl::output('tyq_list', $tyq_list);
        }
        $this->profile_menu('tyq');
        Tpl::showpage('sns_tyq');
    }
    /**
     * 用户中心右边，小导航
     *
     * @param string    $menu_type  导航类型
     * @param string    $menu_key   当前导航的menu_key
     * @return
     */
    private function profile_menu($menu_key=''){
        $menu_array = array();

        $theme_menuname = $this->relation==3?L('sns_my_theme'):L('sns_TA_theme');
        $tyq_menuname = $this->relation==3?L('sns_my_group'):L('sns_TA_group');
        $menu_array = array(
            1=>array('menu_key'=>'theme','menu_name'=>$theme_menuname,'menu_url'=>'index.php?app=sns_tyq&wwi=theme&mid='.$this->master_id),
            2=>array('menu_key'=>'tyq','menu_name'=>$tyq_menuname,'menu_url'=>'index.php?app=sns_tyq&wwi=tyq&mid='.$this->master_id),
        );

        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
}
