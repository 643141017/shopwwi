<?php
/**
 * 菜单
 *
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 */
defined('ByShopWWI') or exit('Access Invalid!');
$_menu['system'] = array (
        'name' => '平台',
        'child' => array (
                array(
                        'name' => $lang['nc_config'],
                        'child' => array(
                                'setting' => $lang['nc_web_set'],
                                'upload' => $lang['nc_upload_set'],
                                'message' => '邮件设置',
                                'taobao_api' => '淘宝接口',
                                'admin' => '权限设置',
                                'admin_log' => $lang['nc_admin_log'],
                                'area' => '地区设置',
                                'cache' => $lang['nc_admin_clear_cache'],
								
                        )
                ),
                array(
                        'name' => $lang['nc_member'],
                        'child' => array(
                                
                                'account' => $lang['nc_web_account_syn']
                        )
                ),
                array(
                        'name' => $lang['nc_website'],
                        'child' => array(
                                'article_class' => $lang['nc_article_class'],
                                'article' => $lang['nc_article_manage'],
                                'document' => $lang['nc_document'],
                                'navigation' => $lang['nc_navigation'],
                                'adv' => $lang['nc_adv_manage'],
                                'rec_position' => $lang['nc_admin_res_position'],
                        )
                ),
        ) 
);
