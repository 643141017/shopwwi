<?php
/**
 * 菜单
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */
defined('ByShopWWI') or exit('Access Invalid!');
$_menu['tfx'] = array (
        'name' => '微商城',
        'child' => array(
                array(
                        'name' => $lang['nc_config'], 
                        'child' => array(
                                'manage' => $lang['nc_tfx_manage'],
                                'comment' => $lang['nc_tfx_comment_manage'],
                                'adv' => $lang['nc_tfx_adv_manage']
                        )
                ),
                array(
                        'name' => '随心看', 
                        'child' => array(
                                'goods' => $lang['nc_tfx_goods_manage'],
                                'goods_class' => $lang['nc_tfx_goods_class']
                        )
                ),
                array(
                        'name' => '个人秀', 
                        'child' => array(
                                'personal' => $lang['nc_tfx_personal_manage'],
                                'personal_class' => $lang['nc_tfx_personal_class']
                        )
                        
                ),
                array(
                        'name' => '店铺街',
                        'child' => array(
                                'store' => $lang['nc_tfx_store_manage']
                        )
                )
        )
);