<?php
/**
 * 服务商等级模型
 *
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */
defined('ByShopWWI') or exit('Access Invalid!');

class supplier_store_gradeModel extends Model {

    public function __construct(){
        parent::__construct('supplier_store_grade');
    }

    /**
     * 列表
     *
     * @param array $condition 检索条件
     * @return array 数组结构的返回结果
     */
    public function getGradeList($condition = array()){
        $condition_str = $this->_condition($condition);
        $param = array();
        $param['table'] = 'supplier_store_grade';
        $param['where'] = $condition_str;
        $param['order'] = $condition['order']?$condition['order']:'ssg_id';
        $result = Db::select($param);
        return $result;
    }

    /**
     * 构造检索条件
     *
     * @param int $id 记录ID
     * @return string 字符串类型的返回结果
     */
    private function _condition($condition){
        $condition_str = '';

        if ($condition['like_ssg_name'] != ''){
            $condition_str .= " and ssg_name like '%". $condition['like_ssg_name'] ."%'";
        }
        if ($condition['no_ssg_id'] != ''){
            $condition_str .= " and ssg_id != '". intval($condition['no_ssg_id']) ."'";
        }
        if ($condition['ssg_name'] != ''){
            $condition_str .= " and ssg_name = '". $condition['ssg_name'] ."'";
        }
        if ($condition['ssg_id'] != ''){
            $condition_str .= " and supplier_store_grade.ssg_id = '". $condition['ssg_id'] ."'";
        }

        if(isset($condition['store_id'])) {
            $condition_str .= " and store.store_id = '{$condition['store_id']}' ";
        }
        return $condition_str;
    }


    /**
     * 取单个内容
     *
     * @param int $id 分类ID
     * @return array 数组类型的返回结果
     */
    public function getOneGrade($id){
        if (intval($id) > 0){
            $param = array();
            $param['table'] = 'supplier_store_grade';
            $param['field'] = 'ssg_id';
            $param['value'] = intval($id);
            $result = Db::getRow($param);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 新增
     *
     * @param array $param 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function add($param){
        if (empty($param)){
            return false;
        }
        if (is_array($param)){
            $tmp = array();
            foreach ($param as $k => $v){
                $tmp[$k] = $v;
            }
            $result = Db::insert('supplier_store_grade',$tmp);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 更新信息
     *
     * @param array $param 更新数据
     * @return bool 布尔类型的返回结果
     */
    public function updates($param){
        if (empty($param)){
            return false;
        }
        if (is_array($param)){
            $tmp = array();
            foreach ($param as $k => $v){
                $tmp[$k] = $v;
            }
            $where = " ssg_id = '{$param['ssg_id']}'";
            $result = Db::update('supplier_store_grade',$tmp,$where);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 删除分类
     *
     * @param int $id 记录ID
     * @return bool 布尔类型的返回结果
     */
    public function del($id){
        if (intval($id) > 0){
            $where = " ssg_id = '". intval($id) ."'";
            $result = Db::delete('supplier_store_grade',$where);
            return $result;
        }else {
            return false;
        }
    }

}