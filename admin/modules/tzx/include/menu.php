<?php
/**
 * 菜单
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */
defined('ByShopWWI') or exit('Access Invalid!');
$_menu['tzx'] = array (
        'name' => $lang['nc_tzx'],
        'child' => array(
                array(
                        'name' => $lang['nc_config'],
                        'child' => array(
                                'tzx_manage' => $lang['nc_tzx_manage'],
                                'tzx_index' => $lang['nc_tzx_index_manage'],
                                'tzx_navigation' => $lang['nc_tzx_navigation_manage'],
                                'tzx_tag' => $lang['nc_tzx_tag_manage'],
                                'tzx_comment' => $lang['nc_tzx_comment_manage']
                        )
                ),
                array(
                        'name' => '专题',
                        'child' => array(
                                'tzx_special' => $lang['nc_tzx_special_manage']
                        )
                ),
                array(
                        'name' => '文章',
                        'child' => array(
                                'tzx_article_class' => '文章分类',
                                'tzx_article' => '文章管理'
                        )
                ),
                array(
                        'name' => '画报',
                        'child' => array(
                                'tzx_picture_class' => '画报分类',
                                'tzx_picture' => '画报管理'
                        )
                )
));