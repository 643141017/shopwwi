<?php
/**
 * 服务商服务区域
 *
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */
defined('ByShopWWI') or exit('Access Invalid!');
class store_bind_areaModel extends Model{

    public function __construct(){
        parent::__construct('store_bind_area');
    }

    /**
     * 读取列表
     * @param array $condition
     *
     */
    public function getStoreBindAreaList($condition,$page='',$order='',$field='*', $limit = ''){
        $on = 'store_bind_area.store_id=store.store_id';
        $result = $this->table('store_bind_area,store')->field($field)->join('left')->on($on)->where($condition)->page($page)->order($order)->limit($limit)->select();
        return $result;
    }

    /**
     * 读取单条记录
     * @param array $condition
     *
     */
    public function getStoreBindAreaInfo($condition){
        $result = $this->where($condition)->find();
        return $result;
    }

    /*
     * 增加
     * @param array $param
     * @return bool
     */
    public function addStoreBindArea($param){
        return $this->insert($param);
    }

    /*
     * 增加
     * @param array $param
     * @return bool
     */
    public function addStoreBindAreaAll($param){
        return $this->insertAll($param);
    }

    /*
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     */
    public function editStoreBindArea($update, $condition){
        return $this->where($condition)->update($update);
    }

    /*
     * 删除
     * @param array $condition
     * @return bool
     */
    public function delStoreBindArea($condition){
        return $this->where($condition)->delete();
    }

    /**
     * 总数量
     * @param unknown $condition
     */
    public function getStoreBindAreaCount($condition = array()) {
        return $this->where($condition)->count();
    }

}
