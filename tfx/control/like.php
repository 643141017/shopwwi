<?php
/**
 * 微商城喜欢
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');
class likeControl extends TfxControl{

    public function __construct() {
        parent::__construct();
    }

    /**
     * 喜欢保存
     **/
    public function like_saveWwi() {

        $data = array();
        $data['result'] = 'true';
        $data['message'] = Language::get('tfx_like_success');
        $like_id = intval($_GET['like_id']);
        $like_type = self::get_channel_type($_GET['type']);
        if($like_id <= 0 || empty($like_type)) {
            $data['result'] = 'false';
            $data['message'] = Language::get('wrong_argument');
            self::echo_json($data);
        }

        if(!empty($_SESSION['member_id'])) {
            $param = array();
            $param['like_type'] = $like_type['type_id'];
            $param["like_object_id"] = $like_id;
            $param['like_member_id'] = $_SESSION['member_id'];
            $model_like = Model('micro_like');
            $is_exist = $model_like->isExist($param);
            if(!$is_exist) {
                $param['like_time'] = time();
                $result = $model_like->save($param);
                if($result) {

                    //喜欢计数加1
                    $model = Model();
                    $update = array();
                    $update['like_count'] = array('exp','like_count+1');
                    $condition = array();
                    $condition[$like_type['type_key']] = $like_id;
                    $model->table("micro_{$_GET['type']}")->where($condition)->update($update);

                    //返回信息
                    $data['result'] = 'true';
                } else {
                    $data['result'] = 'false';
                    $data['message'] = Language::get('nc_common_save_fail');
                }
            } else {
                $data['result'] = 'false';
                $data['message'] = Language::get('tfx_like_fail');
            }
        } else {
            $data['result'] = 'false';
            $data['message'] = Language::get('no_login');
        }
        self::echo_json($data);
    }

    /**
     * 喜欢删除
     **/
    public function like_dropWwi() {
        $data['result'] = 'false';
        $data['message'] = Language::get('nc_common_del_fail');
        $like_id = intval($_GET['like_id']);
        if($like_id > 0) {
            $model_like = Model('micro_like');
            $like_info = $model_like->getOne(array('like_id'=>$like_id));
            if($like_info['like_member_id'] == $_SESSION['member_id']) {
                $result = $model_like->drop(array('like_id'=>$like_id));
                if($result) {
                    $data['result'] = 'true';
                    $data['message'] = Language::get('nc_common_del_succ');
                }
            }
        }
        self::echo_json($data);
    }
}
