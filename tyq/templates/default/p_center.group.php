<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="base-layout">
  <div class="mainbox">
  <div class="base-tab-menu">
      <ul class="base-tabs-nav">
        <?php if(!empty($output['member_menu'])){?>
        <?php foreach ($output['member_menu'] as $val){?>
        <li <?php if($val['menu_key'] == $output['menu_key']){?>class="selected"<?php }?>><a href="<?php echo $val['menu_url'];?>"><?php echo $val['menu_name'];?></a></li>
        <?php }?>
        <?php }?>
      </ul>
    </div>
  <div class="layout-l">
  <div class="search-group-list">
  <?php if(!empty($output['tyq_list'])){?>
    <ul>
    <?php foreach($output['tyq_list'] as $val){?>
      <li>
        <dl class="group-info">
          <dt class="group-name">
            <a href="<?php echo TYQ_SITE_URL;?>/index.php?app=group&c_id=<?php echo $val['tyq_id'];?>"><?php echo $val['tyq_name']?></a>
            <?php echo memberLevelHtml($output['cm_array'][$val['tyq_id']]);?>
          </dt>
          <dd class="group-pic"><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=group&c_id=<?php echo $val['tyq_id'];?>"><img src="<?php echo tyqLogo($val['tyq_id']);?>" /></a></dd>
          <dd class="group-time"><?php echo $lang['tyq_created_at'];?><em><?php echo @date('Y-m-d', $val['tyq_addtime'])?></em></dd>
          <dd class="group-total"><em><?php echo $val['tyq_mcount'];?></em><?php echo $lang['tyq_members'];?></dd>
          <dd class="group-intro"><?php echo $val['tyq_desc'];?></dd>
        </dl>
      </li>
      <?php }?>
    </ul>
    <?php }else{?>
    <div class="no-theme"><span> <i></i><?php echo $lang['p_center_not_jion_tyq'];?></span></div>
    <?php }?>
  </div></div>
</div>
  <?php include tyq_template('p_center.sidebar');?>
</div>