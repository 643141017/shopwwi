<?php
/**
 * 前台品牌分类
 *
 *
 *
 *
 * @copyright  Copyright (c) 2007-2015 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.com
 * @link       http://www.shopwwi.com
 * @since      File available since Release v1.1
 */



defined('ByShopWWI') or exit('Access Invalid!');
class documentControl extends mobileHomeControl {
    public function __construct() {
        parent::__construct();
    }

    public function agreementWwi() {
        $doc = Model('document')->getOneByCode('agreement');
        output_data($doc);
    }
}
