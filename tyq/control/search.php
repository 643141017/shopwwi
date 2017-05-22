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

class searchControl extends BaseTyqControl{
    public function __construct(){
        parent::__construct();
        Language::read('tyq');
        $this->themeTop();
    }
    /**
     * 话题搜索
     */
    public function themeWwi(){
        $model = Model();
        $where = array();
        if($_GET['keyword'] != ''){
            $where['theme_name'] = array('like', '%'.$_GET['keyword'].'%');
        }
        $count = $model->table('tyq_theme')->where($where)->count();
        $theme_list = $model->table('tyq_theme')->where($where)->page(10,$count)->order('theme_addtime desc')->select();
        Tpl::output('count', $count);
        Tpl::output('show_page', $model->showpage('2'));
        Tpl::output('theme_list', $theme_list);
        Tpl::output('search_sign', 'theme');

        $this->tyqSEO(L('search_theme'));
        Tpl::showpage('search.theme');
    }
    /**
     * 圈子搜索
     */
    public function groupWwi(){
        $model = Model();
        $where = array();
        $where['tyq_status'] = 1;
        if($_GET['keyword'] != ''){
            $where['tyq_name|tyq_tag'] = array('like', '%'.$_GET['keyword'].'%');
        }
        if(intval($_GET['class_id']) > 0){
            $where['class_id'] = intval($_GET['class_id']);
        }
        $count = $model->table('tyq')->where($where)->count();
        $tyq_list = $model->table('tyq')->where($where)->page(10,$count)->select();
        Tpl::output('count', $count);
        Tpl::output('tyq_list', $tyq_list);
        Tpl::output('show_page', $model->showpage('2'));
        Tpl::output('search_sign', 'group');

        $this->tyqSEO(L('search_tyq'));
        Tpl::showpage('search.group');
    }
}
