<?php
/**
 * 夺宝类别模型
 *
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */
defined('ByShopWWI') or exit('Access Invalid!');

class yydb_classModel extends Model {

    public function __construct(){
        parent::__construct('yydb_class');
    }

    /**
     * 取夺宝类别列表
     * @param unknown $condition
     * @param string $pagesize
     * @param string $order
     */
    public function getYydbClassList($condition = array(), $pagesize = '', $limit = '', $order = 'sc_sort asc,sc_id asc') {
        return $this->where($condition)->order($order)->page($pagesize)->limit($limit)->select();
    }

    /**
     * 取得单条信息
     * @param unknown $condition
     */
    public function getYydbClassInfo($condition = array()) {
        return $this->where($condition)->find();
    }

    /**
     * 删除类别
     * @param unknown $condition
     */
    public function delYydbClass($condition = array()) {
        return $this->where($condition)->delete();
    }

    /**
     * 增加夺宝分类
     * @param unknown $data
     * @return boolean
     */
    public function addYydbClass($data) {
        return $this->insert($data);
    }

    /**
     * 更新分类
     * @param unknown $data
     * @param unknown $condition
     */
    public function editYydbClass($data = array(),$condition = array()) {
        return $this->where($condition)->update($data);
    }
}
