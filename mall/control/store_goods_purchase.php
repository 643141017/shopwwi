
<?php
/**
 * 商品管理
 *
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit ('Access Invalid!');
class store_goods_purchaseControl extends BaseSellerControl {
    public function __construct() {
        parent::__construct ();
        Language::read ('member_store_goods_index');
    }
    public function indexWwi() {
        $this->goods_purchaseWwi();
    }

    public function goods_purchaseWwi(){
        $model_goods = Model('goods');
        $where = array();
        $store_id=$_SESSION['store_id'];
        $where['servicer_goods.store_id'] = $store_id;
        if (trim($_GET['keyword']) != '') {
            switch ($_GET['search_type']) {
                case 0:
                    $where['goods_name'] = array('like', '%' . trim($_GET['keyword']) . '%');
                    break;
            }
        }
        $model_servicer=Model('servicer');
        $goods_list = $model_goods->getGoodsPurchaseList($where);
        foreach ($goods_list as $key => $val) {
            list($toggle,$purchase_price)=$model_servicer->getGoodsPurchasePrice(intval($_SESSION['ser_id']),$val['goods_id']);
            if($toggle) $goods_list[$key]['goods_price']=$purchase_price;
        }

        Tpl::output('goods_list', $goods_list);
        Tpl::showpage('store_goods_list.purchase');
    }
}