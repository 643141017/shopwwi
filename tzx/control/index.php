<?php
/**
 * tzx首页
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');
class indexControl extends TZXHomeControl{

    public function __construct() {
        parent::__construct();
        Tpl::output('index_sign','index');
    }
    public function indexWwi(){
 //获取文章列表
        if(empty($_GET['type'])) {
            $page_number = 10;
            $template_name = 'article_list';
        } else {
            $page_number = 40;
            $template_name = 'article_list.modern';
        }
        $condition = array();
        if(!empty($_GET['class_id'])) {
            $condition['article_class_id'] = intval($_GET['class_id']);
        }
        $condition['article_state'] = self::ARTICLE_STATE_PUBLISHED;
        $model_article = Model('tzx_article');
        $article_list = $model_article->getList($condition, $page_number, 'article_sort asc, article_id desc');
        Tpl::output('show_page', $model_article->showpage(2));
        Tpl::output('article_list', $article_list);
        $this->get_article_sidebar();

        Tpl::showpage($template_name);
    }
	/**
     * 文章侧栏
     */
    private function get_article_sidebar() {

        $model_tag = Model('tzx_tag');
        $model_article = Model('tzx_article');

        //标签
        $tzx_tag_list = $model_tag->getList(TRUE, null, 'tag_sort asc', '', 10);
        $tzx_tag_list = array_under_reset($tzx_tag_list, 'tag_id');
        Tpl::output('tzx_tag_list', $tzx_tag_list);

        //推荐文章(图文)
        $condition = array();
        $condition['article_commend_image_flag'] = 1;
        $article_commend_image_list = $model_article->getList($condition, null, 'article_id desc', '*', 3);
        Tpl::output('article_commend_image_list', $article_commend_image_list);

        //推荐文章
        $this->get_article_comment();

    }
}
