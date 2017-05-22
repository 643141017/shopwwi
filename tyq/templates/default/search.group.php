<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="search-page">
  <div class="layout-l">
    <div class="search-title">
      <h3><?php echo $lang['tyq_to_search'];?>"<em><?php echo $output['count'];?></em>"<?php echo $lang['tyq_item'];?><?php if($_GET['keyword'] != ''){?><?php echo $lang['tyq_yu'];?>"<em><?php echo $_GET['keyword'];?></em>"<?php echo $lang['tyq_relevant'];?><?php }elseif($_GET['class_name'] != ''){?><?php echo $lang['tyq_yu'];?>"<em><?php echo $_GET['class_name'];?></em>"<?php echo $lang['tyq_class_relavant']; }?><?php echo $lang['tyq_result'];?></h3>
    </div>
  <div class="search-group-list">
  <?php if(!empty($output['tyq_list'])){?>
    <ul>
    <?php foreach($output['tyq_list'] as $val){?>
      <li>
        <dl class="group-info">
          <dt class="group-name"><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=group&c_id=<?php echo $val['tyq_id'];?>"><?php echo $val['tyq_name']?></a></dt>
          <dd class="group-pic"><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=group&c_id=<?php echo $val['tyq_id'];?>"><img src="<?php echo tyqLogo($val['tyq_id']);?>" /></a></dd>
          <dd class="group-time"><?php echo $lang['tyq_created_at'];?><em><?php echo @date('Y-m-d', $val['tyq_addtime'])?></em></dd>
          <dd class="group-total"><em><?php echo $val['tyq_mcount'];?></em><?php echo $lang['tyq_members'];?></dd>
          <dd class="group-intro"><?php echo $val['tyq_desc'];?></dd>
        </dl>
      </li>
      <?php }?>
    </ul>
    <div class="pagination"><?php echo $output['show_page'];?></div>
    <?php }else{?>
    <div class="no-theme">
      <i></i>
      <span><?php echo $lang['tyq_result_null'].L('nc_comma,tyq_go');?><a href="<?php echo TYQ_SITE_URL;?>"><?php echo L('tyq_home_page_around');?></a></span>
      <br>
      <span><?php echo $lang['tyq_search_null_msg'];?><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=index&wwi=add_group&kw=<?php echo $_GET['keyword'];?>"><?php echo $lang['tyq_instantly_create'];?></a></span>
    </div>
    <div></div>
    <?php }?>
  </div></div>
  <div class="layout-r">
    <?php require_once tyq_template('index.themetop');?>
  </div>
</div>