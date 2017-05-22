<?php
/**
 * 商家店铺商品分类
 *
 *
 *
 * @copyright  Copyright (c) 2007-2015 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.com
 * @link       http://www.shopwwi.com
 * @since      File available since Release v1.1
 */



defined('ByShopWWI') or exit('Access Invalid!');
class seller_store_goods_classControl extends mobileSellerControl{

    public function __construct() {
        parent::__construct();
    }

    public function indexWwi() {
        $this->class_listWwi();
    }

    /**
     * 返回商家店铺商品分类列表
     */
    public function class_listWwi() {
        $store_goods_class = Model('store_goods_class')->getStoreGoodsClassPlainList($this->store_info['store_id']);
        output_data(array('class_list' => $store_goods_class));
    }
}
