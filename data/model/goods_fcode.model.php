<?php
/**
 * 商品F码模型
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */
defined('ByShopWWI') or exit('Access Invalid!');
class goods_fcodeModel extends Model {
    public function __construct(){
        parent::__construct('goods_fcode');
    }
    /**
     * 插入数据
     *
     * @param unknown $insert
     * @return boolean
     */
    public function addGoodsFCodeAll($insert) {
        return $this->insertAll($insert);
    }
    /**
     * 取得F码列表
     *
     * @param array $condition
     * @param string $order
     */
    public function getGoodsFCodeList($condition, $order = 'fc_state asc,fc_id asc') {
        return $this->where($condition)->order($order)->select();
    }

    /**
     * 删除F码
     */
    public function delGoodsFCode($condition) {
        return $this->where($condition)->delete();
    }

    /**
     * 取得F码
     */
    public function getGoodsFCode($condition) {
        return $this->where($condition)->find();
    }

    /**
     * 更新F码
     */
    public function editGoodsFCode($data, $condition) {
        return $this->where($condition)->update($data);
    }
}
