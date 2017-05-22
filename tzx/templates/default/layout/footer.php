<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="clear">&nbsp;</div>
<!-- 代码开始 -->
<?php if($_GET['wwi'] != 'special_detail'){?>
<div id="tbox">
    <?php if($_SESSION['is_login'] == '1'){?>
    <a id="publishArticle" href="<?php echo TZX_SITE_URL;?>/index.php?app=publish&wwi=publish_article" target="_blank" title="<?php echo $lang['tzx_article_commit'];?>">&nbsp;</a>
    <a id="publishPicture" href="<?php echo TZX_SITE_URL;?>/index.php?app=publish&wwi=publish_picture" target="_blank" title="<?php echo $lang['tzx_picture_commit'];?>">&nbsp;</a>
    <?php } ?>
    <a id="gotop" href="JavaScript:void(0);" title="<?php echo $lang['tzx_go_top'];?>" style="display:none;">&nbsp;</a> </div>
<?php } ?>
<!-- 代码结束 -->
<div class="wwi-footer"><div id="cti"><ul class="wrapper"><?php if ($output['contract_list']) {?><?php foreach($output['contract_list'] as $k=>$v){?><?php if($v['cti_descurl']){ ?><li><a href="<?php echo $v['cti_descurl'];?>" target="_blank"><span class="icon"> <img style="width: 60px;" src="<?php echo $v['cti_icon_url_60']; ?>" /> </span> <span class="name"> <?php echo $v['cti_name']; ?> </span></a></li><?php }else{ ?><li> <span class="icon"> <img style="width: 60px;" src="<?php echo $v['cti_icon_url_60']; ?>" /> </span> <span class="name"> <?php echo $v['cti_name']; ?> </span> </li><?php }}}?><li class="rf">客服电话：<em class="red"><?php echo $output['setting_config']['shopwwi_phone']; ?></em>  <em class="rgb9"><?php echo $output['setting_config']['shopwwi_time']; ?></em></li></ul></div><div id="faq"><div class="wrapper"><?php if(is_array($output['article_lists']) && !empty($output['article_lists'])){ ?><ul><?php foreach ($output['article_lists'] as $k=> $article_class){ ?><?php if(!empty($article_class)){ ?><li><dl class="s<?php echo ''.$k+1;?>"><dt><?php if(is_array($article_class['class'])) echo $article_class['class']['ac_name'];?></dt><?php if(is_array($article_class['list']) && !empty($article_class['list'])){ ?><?php foreach ($article_class['list'] as $article){ ?><dd><a href="<?php if($article['article_url'] != '')echo $article['article_url'];else echo urlMember('article', 'show',array('article_id'=> $article['article_id']));?>" title="<?php echo $article['article_title']; ?>"> <?php echo $article['article_title'];?> </a></dd><?php }}?></dl></li><?php }}?><li class="cooperation"><dl><dt>商家合作</dt><dd><p>错过天猫？别再错过我们！</p><p>运维商城开启全新旅程！</p><a href="<?php echo urlMall('show_joinin', 'index');?>" class="btn" target="_blank"><span>关于入驻</span>&gt;</a></dd></dl></li></ul><?php }?></div></div><div id="footer"><div class="wrapper"><div class="screen clearfix"><div class="fl right-flag"><a href="http://www.shopwwi.com" target="_blank" rel="nofollow"><img src="<?php echo MALL_SITE_URL;?>/img/credit-flag3.png"></a><a href="http://www.shopwwi.com/" target="_blank" rel="nofollow"><img src="<?php echo MALL_SITE_URL;?>/img/isc2.png"></a></div><div class="fl about-us"><p><a href="<?php echo MALL_SITE_URL;?>">返回首页</a><?php if(!empty($output['nav_list']) && is_array($output['nav_list'])){?><?php foreach($output['nav_list'] as $nav){?><?php if($nav['nav_location'] == '2'){?><span>|</span> <a  <?php if($nav['nav_new_open']){?>target="_blank" <?php }?>href="<?php switch($nav['nav_type']){case '0':echo $nav['nav_url'];break; case '1':echo urlMall('search', 'index', array('cate_id'=>$nav['item_id']));break; case '2':echo urlMember('article', 'article',array('ac_id'=>$nav['item_id']));break; case '3':echo urlMall('activity', 'index',array('activity_id'=>$nav['item_id']));break;}?>"><?php echo $nav['nav_title'];?></a><?php }}}?><span>|</span><a href="<?php echo urlmall('link');?>">友情链接</a></p><p>CopyRight © 2007-2016 网店运维交流中心 <a href="http://www.miibeian.gov.cn/" target="_blank" mxf="sqde" style="color:#666"><?php echo $output['setting_config']['icp_number']; ?></a> NewPower Co. 版权所有 客户服务中心(7×24):QQ8988354 Q群：111731672</p><p><?php echo html_entity_decode($output['setting_config']['statistics_code'],ENT_QUOTES); ?></p></div></div>
<?php if (C('debug') == 1){?>
<div id="think_page_trace" class="trace">
  <fieldset id="querybox">
    <legend><?php echo $lang['nc_debug_trace_title'];?></legend>
    <div> <?php print_r(Tpl::showTrace());?> </div>
  </fieldset>
</div>
<?php }?>
<?php if($_GET['wwi'] != 'special_detail'){?>
<script language="javascript">
//返回顶部
backTop=function (btnId){
	var btn=document.getElementById(btnId);
	var d=document.documentElement;
	window.onscroll=set;
	btn.onclick=function (){
		btn.style.display="none";
		window.onscroll=null;
		this.timer=setInterval(function(){
		    scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			scrollTop-=Math.ceil(scrollTop*0.1);
			if(scrollTop==0) clearInterval(btn.timer,window.onscroll=set);
			if (document.documentElement.scrollTop > 0) document.documentElement.scrollTop=scrollTop;
			if (document.body.scrollTop > 0) document.body.scrollTop=scrollTop;
		},10);
	};
	function set(){
	    scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
	    btn.style.display=scrollTop?'block':"none";
	}
};
backTop('gotop');
</script>
<?php } ?>

</body></html>
