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
class supplierModel extends Model{

    public function __construct(){
        parent::__construct('supplier');
    }

    /**
     * 读取列表
     * @param array $condition
     *
     */
    public function getSupplierList($condition, $page='', $order='', $field='*') {
        $result = $this->field($field)->where($condition)->page($page)->order($order)->select();
        return $result;
    }

    /**
     * 读取单条记录
     * @param array $condition
     *
     */
    public function getSupplierInfo($condition) {
        $result = $this->where($condition)->find();
        return $result;
    }

    /*
     *  判断是否存在
     *  @param array $condition
     *
     */
    public function isSupplierExist($condition) {
        $result = $this->getSupplierInfo($condition);
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
    public function addSupplier($param){
        return $this->insert($param);
    }

    /*
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     */
    public function editSupplier($update, $condition){
        return $this->where($condition)->update($update);
    }

    /*
     * 删除
     * @param array $condition
     * @return bool
     */
    public function delSupplier($condition){
        return $this->where($condition)->delete();
    }

    /**
     * 读取供应商等级
     * @param int $ser_id
     *
     */
    public function getSupplierAndGradeInfo($sup_id,$field='*') {
        $condition=array('sup_id'=>intval($sup_id));
        return $this->table('supplier,supplier_store_grade')->field($field)->join('inner')->on('supplier.ssg_id = supplier_store_grade.ssg_id')->where($condition)->find();
    }
    /**
     * 根据供应商ID获取产品的商城价和市场价
     *
     * @param int $ser_id 服务商ID
     * @param int $goods_id 商品ID
     * @return array
     */
    public function getGoodsPriceAndMarketPrice($sup_id,$g_costprice){
        $toggle=false;
        $g_price=$g_marketprice=0;
        $supplier_info=$this->getSupplierAndGradeInfo($sup_id);
        if($supplier_info){
           $g_price=$this->calPriceAndMarketprice($g_costprice,$supplier_info['ssg_mall_discount'],$supplier_info['ssg_mall_operator']);
           $g_marketprice=$this->calPriceAndMarketprice($g_costprice,$supplier_info['ssg_market_discount'],$supplier_info['ssg_market_operator']);
        }
        $data['g_price']=$g_price;
        $data['g_marketprice']=$g_marketprice;
        return $data;
    }

    public function calPriceAndMarketprice($g_costprice,$discount,$operator){
        $price=0;
        switch ($operator) {
            case 2:
                # 除
                $price=round($g_costprice/$discount,1);
                break;   
            case 3:
                # 加
                $price=round($g_costprice+$discount,1);
                break;  
            case 4:
                # 减
                $price=round($g_costprice-$discount,1);
                break;              
            default:
                # 乘
                $price=round($g_costprice*$discount,1);
                break;
        }
        return $price;
    }

    public function getSupplierStoreId($condition){
        $list=$this->getSupplierList($condition);
        $store_ids=array(0);
        foreach ($list as $key => $val) {
            $store_ids[]=$val['sup_store_id'];
        }
        return $store_ids;
    }
}
