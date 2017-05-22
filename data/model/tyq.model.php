<?php
/**
 * 圈子模型
 *
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */
defined('ByShopWWI') or exit('Access Invalid!');

class tyqModel extends Model {
    public function __construct(){
        parent::__construct('tyq');
    }

    /**
     * 获取圈子数量
     * @param array $condition
     * @return int
     */
    public function getTyqCount($condition) {
        return $this->where($condition)->count();
    }

    /**
     * 未审核的圈子数量
     * @param array $condition
     * @return int
     */
    public function getTyqUnverifiedCount($condition = array()) {
        $condition['tyq_status'] = 2;
        return $this->getTyqCount($condition);
    }
}
