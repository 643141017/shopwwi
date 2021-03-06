<?php
/**
 * 会员中心——账户概览
 *
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');

class servicerControl extends BaseServicerControl{

    /**
     * 我的商城
     */
    public function homeWwi() {
        Tpl::showpage('member_home');
    }

    public function ajax_load_member_infoWwi() {

        $member_info = $this->member_info;
        $member_info['security_level'] = Model('member')->getMemberSecurityLevel($member_info);

        //代金券数量
        $member_info['voucher_count'] = Model('voucher')->getCurrentAvailableVoucherCount($_SESSION['member_id']);
        Tpl::output('home_member_info',$member_info);

        Tpl::showpage('member_home.member_info','null_layout');
    }

    public function ajax_load_order_infoWwi() {
        $model_order = Model('order');

        //交易提醒 - 显示数量
        $member_info['order_nopay_count'] = $model_order->getOrderCountByID('buyer',$_SESSION['member_id'],'NewCount');
        $member_info['order_noreceipt_count'] = $model_order->getOrderCountByID('buyer',$_SESSION['member_id'],'SendCount');
        $member_info['order_noeval_count'] = $model_order->getOrderCountByID('buyer',$_SESSION['member_id'],'EvalCount');
        Tpl::output('home_member_info',$member_info);

        //交易提醒 - 显示订单列表
        $condition = array();
        $condition['buyer_id'] = $_SESSION['member_id'];
        $condition['order_state'] = array('in',array(ORDER_STATE_NEW,ORDER_STATE_PAY,ORDER_STATE_SEND,ORDER_STATE_SUCCESS));
        $order_list = $model_order->getNormalOrderList($condition,'','*','order_id desc',3,array('order_goods'));

        foreach ($order_list as $order_id => $order) {
            //显示物流跟踪
            $order_list[$order_id]['if_deliver'] = $model_order->getOrderOperateState('deliver',$order);
            //显示评价
            $order_list[$order_id]['if_evaluation'] = $model_order->getOrderOperateState('evaluation',$order);
            //显示支付
            $order_list[$order_id]['if_payment'] = $model_order->getOrderOperateState('payment',$order);
            //显示收货
            $order_list[$order_id]['if_receive'] = $model_order->getOrderOperateState('receive',$order);
        }

        Tpl::output('order_list',$order_list);

        //取出购物车信息
        $model_cart = Model('cart');
        $cart_list  = $model_cart->listCart('db',array('buyer_id'=>$_SESSION['member_id']),3);
        Tpl::output('cart_list',$cart_list);
        Tpl::showpage('member_home.order_info','null_layout');
    }

    public function ajax_load_goods_infoWwi() {
        //商品收藏
        $favorites_model = Model('favorites');
        $favorites_list = $favorites_model->getGoodsFavoritesList(array('member_id'=>$_SESSION['member_id']), '*', 7);
        if (!empty($favorites_list) && is_array($favorites_list)){
            $favorites_id = array();//收藏的商品编号
            foreach ($favorites_list as $key=>$fav){
                $favorites_id[] = $fav['fav_id'];
            }
            $goods_model = Model('goods');
            $field = 'goods_id,goods_name,store_id,goods_image,goods_promotion_price';
            $goods_list = $goods_model->getGoodsList(array('goods_id' => array('in', $favorites_id)), $field);
            Tpl::output('favorites_list',$goods_list);
        }

        //店铺收藏
        $favorites_list = $favorites_model->getStoreFavoritesList(array('member_id'=>$_SESSION['member_id']), '*', 6);
        if (!empty($favorites_list) && is_array($favorites_list)){
            $favorites_id = array();//收藏的店铺编号
            foreach ($favorites_list as $key=>$fav){
                $favorites_id[] = $fav['fav_id'];
            }
            $store_model = Model('store');
            $store_list = $store_model->getStoreList(array('store_id'=>array('in', $favorites_id)));
            Tpl::output('favorites_store_list',$store_list);
        }

        $goods_count_new = array();
        if (!empty($favorites_id)) {
            foreach ($favorites_id as $v){
                $count = Model('goods')->getGoodsCommonOnlineCount(array('store_id' => $v));
                $goods_count_new[$v] = $count;
            }
        }
        Tpl::output('goods_count',$goods_count_new);
        Tpl::showpage('member_home.goods_info','null_layout');
    }

    public function ajax_load_sns_infoWwi() {
        //我的足迹
        $goods_list = Model('goods_browse')->getViewedGoodsList($_SESSION['member_id'],20);
        $viewed_goods = array();
        if(is_array($goods_list) && !empty($goods_list)) {
            foreach ($goods_list as $key => $val) {
                $goods_id = $val['goods_id'];
                $val['url'] = urlMall('goods', 'index', array('goods_id' => $goods_id));
                $val['goods_image'] = thumb($val, 240);
                $viewed_goods[$goods_id] = $val;
            }
        }
        Tpl::output('viewed_goods',$viewed_goods);

        //我的圈子
        $model = Model();
        $tyqmember_array = $model->table('tyq_member')->where(array('member_id'=>$_SESSION['member_id']))->select();
        if(!empty($tyqmember_array)) {
            $tyqmember_array = array_under_reset($tyqmember_array, 'tyq_id');
            $tyqid_array = array_keys($tyqmember_array);
            $tyq_list = $model->table('tyq')->where(array('tyq_id'=>array('in', $tyqid_array)))->limit(6)->select();
            Tpl::output('tyq_list', $tyq_list);
        }

        //好友动态
        $model_fd = Model('sns_friend');
        $fields = 'member.member_id,member.member_name,member.member_avatar';
        $follow_list = $model_fd->listFriend(array('limit'=>15,'friend_frommid'=>"{$_SESSION['member_id']}"),$fields,'','detail');
        $member_ids = array();$follow_list_new = array();
        if (is_array($follow_list)) {
            foreach ($follow_list as $v) {
                $follow_list_new[$v['member_id']] = $v;
                $member_ids[] = $v['member_id'];
            }
        }
        $tracelog_model = Model('sns_tracelog');
        //条件
        $condition = array();
        $condition['trace_memberid'] = array('in',$member_ids);
        $condition['trace_privacy'] = 0;
        $condition['trace_state'] = 0;
        $tracelist = Model()->table('sns_tracelog')->where($condition)->field('count(*) as ccount,trace_memberid')->group('trace_memberid')->limit(5)->select();
        $tracelist_new = array();$follow_list = array();
        if (!empty($tracelist)){
            foreach ($tracelist as $k=>$v){
                $tracelist_new[$v['trace_memberid']] = $v['ccount'];
                $follow_list[] = $follow_list_new[$v['trace_memberid']];
            }
        }
        Tpl::output('tracelist',$tracelist_new);
        Tpl::output('follow_list',$follow_list);
        Tpl::showpage('member_home.sns_info','null_layout');
    }
}
