<?php
/**
 * tzx专题
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');
class specialControl extends TZXHomeControl{

    public function __construct() {
        parent::__construct();
        Tpl::output('index_sign','special');
    }

    public function indexWwi() {
        $this->special_listWwi();
    }

    /**
     * 专题列表
     */
    public function special_listWwi() {
        $conition = array();
        $conition['special_state'] = 2;
        $model_special = Model('tzx_special');
        $special_list = $model_special->getTZXList($conition, 10, 'special_id desc');
        Tpl::output('show_page', $model_special->showpage(2));
        Tpl::output('special_list', $special_list);
        Tpl::showpage('special_list');
    }

    /**
     * 专题详细页
     */
    public function special_detailWwi() {
        $special_file = getTZXSpecialHtml($_GET['special_id']);
        if($special_file) {
            Tpl::output('special_file', $special_file);
            Tpl::output('index_sign', 'special');
            Tpl::showpage('special_detail');
        } else {
            showMessage('专题不存在', '', '', 'error');
        }
    }
}
