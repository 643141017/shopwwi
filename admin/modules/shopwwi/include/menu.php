<?php
/**
 * 菜单
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */
defined('ByShopWWI') or exit('Access Invalid!');
$_menu['shopwwi'] = array (
        'name' => '运维',
        'child' => array(
                 array(
                        'name' => '运维应用',
                        'child' => array(
								'link' => '友情连接',
								'shopwwi' => '运维控件',
								'goods' => '商品组件',
								'db' => '数据库管理',
								'store' => '店铺组件',
								'member'=>'会员组件',
                        )
                ),
                array(
                        'name' => '一元夺宝',
                        'child' => array(
								'setting' => '夺宝设置',
								'yydb'=>'夺宝列表',
								'yydb_class'=>'夺宝分类',
                        )
                ),
                array(
                        'name' => '运维跨境',
                        'child' => array(
                                'cb_manage' => '跨境设置',
                                'cb_index' => '跨境首页',
                                'cb_navigation' => '跨境分类',
                                'cb_tag' => '跨境店铺',
                                'cb_comment' => '跨境商品',
                                'cb_comment' => '跨境品牌'
                        )
                ),
                array(
                        'name' => '运维微信',
                        'child' => array(
                                'tzx_special' => $lang['nc_tzx_special_manage']
                        )
                ),
));