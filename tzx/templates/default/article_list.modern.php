<?php defined('ByShopWWI') or exit('Access Invalid!');?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".image_lazy_load").nc_lazyload();
    });
</script>
<div class="warp-all">
<div class="sitenav-bar">
        <div class="sitenav"><?php echo $lang['current_location'];?><?php echo $lang['nc_colon'];?> <a href="<?php echo TZX_SITE_URL;?>"><?php echo $lang['tzx_site_name'];?></a> > <a href="<?php echo TZX_SITE_URL.DS.'index.php?app=article&wwi=article_list';?>"><?php echo $lang['tzx_article'];?></a><?php echo empty($_GET['class_id'])?'':' > '.$output['article_class_list'][$_GET['class_id']]['class_name'];?></div>
  <div class="browse-list-modern"><a href="index.php?app=article&wwi=article_list&class_id=<?php echo $_GET['class_id'];?>" title="<?php echo $lang['tzx_classical'];?>">&nbsp;</a><span title="<?php echo $lang['tzx_modern'];?>"><?php echo $lang['tzx_modern'];?></span></span></div>
</div>
<div class="article-list-modern">
  <?php if(!empty($output['article_list']) && is_array($output['article_list'])) {?>
  <div class="modern-box">
    <?php $list_length = count($output['article_list']); ?>
    <?php for ($j = 0; $j < 4; $j++) { ?>
    <div class="modern-list">
      <?php if($j === 3) { ?>
      <div class="modern-list-tag block-style-two">
        <div class="title">
          <h3><?php echo $lang['tzx_article_tag'];?></h3>
        </div>
        <div class="content">
          <div class="tag-cloud">
            <?php if(!empty($output['tzx_tag_list']) && is_array($output['tzx_tag_list'])) {?>
            <?php foreach($output['tzx_tag_list'] as $key=>$value) {?>
            <a href="<?php echo TZX_SITE_URL.DS.'index.php?app=article&wwi=article_tag_search&tag_id='.$value['tag_id'];?>"><?php echo $value['tag_name'];?></a>
            <?php } ?>
            <?php } ?>
          </div>
        </div>
        </div>
        <?php } ?>
        <?php for ($i = $j; $i < $list_length; $i+=4) { ?>
        <?php $article_url = getTZXArticleUrl($output['article_list'][$i]['article_id']);?>
        <div class="modern-list-item">
          <div class="article-cover">
            <?php if(!empty($output['article_list'][$i]['article_image'])) { ?>
            <a href="<?php echo $article_url;?>" target="_blank"> <img class="image_lazy_load" data-src="<?php echo getTZXArticleImageUrl($output['article_list'][$i]['article_attachment_path'], $output['article_list'][$i]['article_image'], 'list');?>" src="<?php echo getLoadingImage();?>" alt="" /> </a>
            <?php } ?>
            <h3 class="article-title"><?php echo $output['article_list'][$i]['article_title'];?> </h3>
          </div>
          <div class="article-sub"><span class="date"><?php echo date('Y-m-d',$output['article_list'][$i]['article_publish_time']);?></span><span class="PV" title="<?php echo $lang['tzx_text_view_count'];?>"><i></i><?php echo $output['article_list'][$i]['article_click'];?></span></div>
          <div class="article-preface"><?php echo $output['article_list'][$i]['article_abstract'];?><a href="<?php echo $article_url;?>" target="_blank"><?php echo $lang['tzx_read_more'];?></a></div>
          <div class="article-tag"><?php echo $lang['tzx_keyword'];?><?php echo $lang['nc_colon'];?>
            <?php if(!empty($output['article_list'][$i]['article_keyword'])) { ?>
            <?php $article_keyword_array = explode(',', $output['article_list'][$i]['article_keyword']);?>
            <?php foreach ($article_keyword_array as $value) {?>
            <a href="<?php echo TZX_SITE_URL.DS;?>index.php?app=article&wwi=article_search&keyword=<?php echo rawurlencode($value);?>" target="_blank"><?php echo $value;?></a>
            <?php } ?>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
    <div class="pagination"> <?php echo $output['show_page'];?> </div>
    <?php } else { ?>
    <div class="no-content-b"><i class="article"></i><?php echo $lang['no_record'];?></div>
    <?php } ?>
  </div>
</div>
