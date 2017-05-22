<?php
/**
 * 菜单
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */
defined('ByShopWWI') or exit('Access Invalid!');
$_menu['tyq'] = array (
        'name' => $lang['nc_tyq'],
        'child' => array (
                array (
                        'name' => $lang['nc_config'],
                        'child' => array(
                                'tyq_setting' => $lang['nc_tyq_setting'],
                                'tyq_adv' => '首页幻灯'
                        )
                ),
                array (
                        'name' => '成员',
                        'child' => array(
                                'tyq_member' => $lang['nc_tyq_membermanage'],
                                'tyq_memberlevel' => '成员头衔'
                        )
                ),
                array (
                        'name' => '圈子',
                        'child' => array(
                                'tyq_manage' => $lang['nc_tyq_manage'],
                                'tyq_class' => $lang['nc_tyq_classmanage'],
                                'tyq_theme' => $lang['nc_tyq_thememanage'],
                                'tyq_inform' => '举报管理'
                        )
                )
        ) 
);