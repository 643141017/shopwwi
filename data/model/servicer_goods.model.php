<?php
/**
 * 服务商采购商品模型
 *
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */
defined('ByShopWWI') or exit('Access Invalid!');
class servicer_goodsModel extends Model{

    public function __construct(){
        parent::__construct('servicer_goods');
    }

    /**
     * 读取列表
     * @param array $condition
     *
     */
    public function getServicerGoodsList($condition, $page='', $order='', $field='*') {
        $result = $this->field($field)->where($condition)->page($page)->order($order)->select();
        return $result;
    }

    /**
     * 读取单条记录
     * @param array $condition
     *
     */
    public function getServicerGoodsInfo($condition) {
        $result = $this->where($condition)->find();
        return $result;
    }

    /*
     *  判断是否存在
     *  @param array $condition
     *
     */
    public function isServicerGoodsExist($condition) {
        $result = $this->getServicerGoodsInfo($condition);
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
    public function addServicerGoods($param){
        return $this->insert($param);
    }

    /*
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     */
    public function editServicerGoods($update, $condition){
        return $this->where($condition)->update($update);
    }

    /*
     * 删除
     * @param array $condition
     * @return bool
     */
    public function delServicerGoods($condition){
        return $this->where($condition)->delete();
    }

    /*
     * 将采购订单中的商品增加到服务商商品
     * @param int $order_id
     * @return void
     */
    public function addServicerGoodsByOrder($order_id){
        $order_info=Model('order')->getOrderInfo(array('order_id'=>$order_id));
        $servicer_info=Model('servicer')->getServicerInfo(array('ser_member_id'=>intval($order_info['buyer_id'])));
        $order_goods=Model('order')->getOrderGoodsList(array('order_id'=>intval($order_info['order_id'])));
        if(!empty($servicer_info) && !empty($order_goods)){
            $store_id=$servicer_info['ser_store_id'];
            foreach ($order_goods as $key => $val) {
                $goods_id=$val['goods_id'];
                $condition=array();
                $condition['store_id']=$store_id;
                $condition['goods_id']=$goods_id;
                $isExist=$this->isServicerGoodsExist($condition);
                if($isExist){
                    $update=array();
                    $update['goods_storage']=array('exp','goods_storage+'.$val['goods_num']);
                    $this->editServicerGoods($update,$condition);
                }else{
                    $insert=array();
                    $insert['store_id']=$store_id;
                    $insert['goods_id']=$goods_id;
                    $insert['goods_storage']=$val['goods_num'];
                    $this->addServicerGoods($insert);
                }
            }
        }
        
    }


    /*
     * 消费者选择服务商购买商品，减服务商的库存
     * @param int $order_id
     * @return void
     */
    public function reduceServicerGoodsByOrder($order_id){
        $order_info=Model('order')->getOrderInfo(array('order_id'=>$order_id));
        $servicer_info=Model('servicer')->getServicerInfo(array('ser_store_id'=>intval($order_info['store_id'])));
        $order_goods=Model('order')->getOrderGoodsList(array('order_id'=>intval($order_info['order_id'])));
        if(!empty($servicer_info) && !empty($order_goods)){
            $store_id=$servicer_info['ser_store_id'];
            foreach ($order_goods as $key => $val) {
                $goods_id=$val['goods_id'];
                $condition=array();
                $condition['store_id']=$store_id;
                $condition['goods_id']=$goods_id;
                $isExist=$this->isServicerGoodsExist($condition);
                if($isExist){
                    $update=array();
                    $update['goods_storage']=array('exp','goods_storage-'.$val['goods_num']);
                    $this->editServicerGoods($update,$condition);
                }else{
                    $insert=array();
                    $insert['store_id']=$store_id;
                    $insert['goods_id']=$goods_id;
                    $insert['goods_storage']=-$val['goods_num'];
                    $this->addServicerGoods($insert);
                }
            }
        }
        
    }
}
