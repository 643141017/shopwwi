<?php
/**
 * 商家运费模板
 *
 *
 *
 * @copyright  Copyright (c) 2007-2015 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.com
 * @link       http://www.shopwwi.com
 * @since      File available since Release v1.1
 */



defined('ByShopWWI') or exit('Access Invalid!');
class seller_transportControl extends mobileSellerControl{

    public function __construct() {
        parent::__construct();
    }

    public function indexWwi() {
        $this->transport_listWwi();
    }

    /**
     * 返回商家店铺商品分类列表
     */
    public function transport_listWwi() {
        $model_transport = Model('transport');
        $transport_list = $model_transport->getTransportList(array('store_id'=>$this->store_info['store_id']));
        output_data(array('transport_list' => $transport_list));
    }
}
