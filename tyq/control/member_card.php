<?php
/**
 * The AJAX call member information
 *
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */

class member_cardControl extends BaseTyqControl{
    public function mcard_infoWwi(){
        $uid    = intval($_GET['uid']);
        $member_list = Model()->table('tyq_member')->field('member_id,tyq_id,tyq_name,cm_level,cm_exp')->where(array('member_id'=>$uid,'cm_state'=>1))->select();
        if(empty($member_list)){
            echo 'false';exit;
        }
        echo json_encode($member_list);exit;
    }
}
