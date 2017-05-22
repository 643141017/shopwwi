<?php
/**
 * 微商城店铺街
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');
class storeControl extends TfxControl{

    public function __construct() {
        parent::__construct();
        Tpl::output('index_sign','store');
    }

    public function indexWwi(){
        $this->store_listWwi();
    }

    /**
     * 店铺列表
     */
    public function store_listWwi() {
        $model_store = Model('store');
        $model_tfx_store = Model('micro_store');
        $condition = array();
        $store_list = $model_tfx_store->getListWithStoreInfo($condition,30,'tfx_sort asc');
        Tpl::output('list',$store_list);
        Tpl::output('show_page',$model_store->showpage(2));
        //广告位
        self::get_tfx_adv('store_list');
        Tpl::output('html_title',Language::get('nc_tfx_store').'-'.Language::get('nc_tfx').'-'.C('site_name'));
        Tpl::showpage('store_list');
    }

    /**
     * 店铺详细页
     */
    public function detailWwi() {
        $store_id = intval($_GET['store_id']);
        if($store_id <= 0) {
            header('location: '.TFX_SITE_URL);die;
        }
        $model_store = Model('store');
        $model_goods = Model('goods');
        $model_tfx_store = Model('micro_store');

        $store_info = $model_tfx_store->getOneWithStoreInfo(array('tfx_store_id'=>$store_id));
        if(empty($store_info)) {
            header('location: '.TFX_SITE_URL);
        }

        //点击数加1
        $update = array();
        $update['click_count'] = array('exp','click_count+1');
        $model_tfx_store->modify($update,array('tfx_store_id'=>$store_id));

        Tpl::output('detail',$store_info);

        $condition = array();
        $condition['store_id'] = $store_info['mall_store_id'];
        $goods_list = $model_goods->getGoodsListByColorDistinct($condition, 'goods_id,store_id,goods_name,goods_image,goods_price,goods_salenum', 'goods_id asc', 39);
        Tpl::output('comment_type','store');
        Tpl::output('comment_id',$store_id);
        Tpl::output('list',$goods_list);
        Tpl::output('show_page',$model_goods->showpage());
        //获得分享app列表
        self::get_share_app_list();
        Tpl::output('html_title',$store_info['store_name'].'-'.Language::get('nc_tfx_store').'-'.Language::get('nc_tfx').'-'.C('site_name'));
        Tpl::showpage('store_detail');
    }

}
