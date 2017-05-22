<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<ul class="tyq-theme-list">
  <?php if(!empty($output['theme_list']) && is_array($output['theme_list'])) {?>
  <?php foreach($output['theme_list'] as $key=>$value) {?>
  <li class="tyq-theme-item">
    <div class="tyq-theme-pic tzx-thumb"><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=theme&wwi=theme_detail&c_id=<?php echo $value['tyq_id'];?>&t_id=<?php echo $value['theme_id'];?>" target="_blank"><img src="<?php echo $value['affix'];?>" class="t-img" /></a></div>
    <div class="tyq-theme-name"><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=theme&wwi=theme_detail&c_id=<?php echo $value['tyq_id'];?>&t_id=<?php echo $value['theme_id'];?>" target="_blank"><?php echo $value['theme_name'];?></a></div>
    <div class="tyq-theme-tyq-name"><?php echo $lang['tyq_come_from'];?><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=group&c_id=<?php echo $value['tyq_id'];?>" target="_blank"><?php echo $value['tyq_name'];?></a></div>
  </li>
  <?php } ?>
  <?php } ?>
</ul>
