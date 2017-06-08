<?php
/**
 * 卖家账号模型
 *
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */
defined('ByShopWWI') or exit('Access Invalid!');
class servicerModel extends Model{

    public function __construct(){
        parent::__construct('servicer');
    }

    /**
     * 读取列表
     * @param array $condition
     *
     */
    public function getServicerList($condition, $page='', $order='', $field='*') {
        $result = $this->field($field)->where($condition)->page($page)->order($order)->select();
        return $result;
    }

    /**
     * 读取单条记录
     * @param array $condition
     *
     */
    public function getServicerInfo($condition) {
        $result = $this->where($condition)->find();
        return $result;
    }

    /*
     *  判断是否存在
     *  @param array $condition
     *
     */
    public function isServicerExist($condition) {
        $result = $this->getServicerInfo($condition);
        if(empty($result)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
     * 增加
     * @param array $param
     * @return bool
     */
    public function addServicer($param){
        return $this->insert($param);
    }

    /*
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     */
    public function editServicer($update, $condition){
        return $this->where($condition)->update($update);
    }

    /*
     * 删除
     * @param array $condition
     * @return bool
     */
    public function delServicer($condition){
        return $this->where($condition)->delete();
    }

    /**
     * 读取服务商等级
     * @param int $ser_id
     *
     */
    public function getServicerAndGradeInfo($ser_id,$field='*') {
        $condition=array('ser_id'=>intval($ser_id));
        return $this->table('servicer,servicer_store_grade')->field($field)->join('inner')->on('servicer.ssg_id = servicer_store_grade.ssg_id')->where($condition)->find();
    }

    /**
     * 根据服务商ID获取产品的采购价
     *
     * @param int $ser_id 服务商ID
     * @param int $goods_id 商品ID
     * @return array
     */
    public function getGoodsPurchasePrice($ser_id,$goods_id){
        $toggle=false;
        $purchase_price=0;
        $servicer_info=$this->getServicerAndGradeInfo($ser_id);

        $goods_info=Model('goods')->getGoodsOnlineInfoAndPromotionById($goods_id);
        $store_info=Model('store')->getStoreOnlineInfoByID($goods_info['store_id']);
        if($servicer_info && $store_info['store_type']==2){
            $goods_costprice=Model('goods')->getGoodsCommonCostpriceById($goods_info['goods_commonid']);
            $toggle=true;
            switch ((int)$servicer_info['ssg_purchase_operator']) {
                case 2:
                    # 除
                    $purchase_price=round($goods_costprice/$servicer_info['ssg_purchase_discount'],1);
                    break;   
                case 3:
                    # 加
                    $purchase_price=round($goods_costprice+$servicer_info['ssg_purchase_discount'],1);
                    break;  
                case 4:
                    # 减
                    $purchase_price=round($goods_costprice-$servicer_info['ssg_purchase_discount'],1);
                    break;              
                default:
                    # 乘
                    $purchase_price=round($goods_costprice*$servicer_info['ssg_purchase_discount'],1);
                    break;
            }
        }
        return array($toggle,$purchase_price);
    }
}
