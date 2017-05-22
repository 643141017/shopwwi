<?php defined('ByShopWWI') or exit('Access Invalid!');?>
<ul class="tyq-reply-themelist">
    <?php if(!empty($output['reply_themelist']) && is_array($output['reply_themelist'])) {?>
    <?php foreach($output['reply_themelist'] as $key=>$value) {?>
    <li class="tyq-theme-item">
    <span class="tyq-theme-thclass_name"><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=group&c_id=<?php echo $value['tyq_id'];?>&thc_id=<?php echo $value['thclass_id'];?>" target="_blank">[<?php echo empty($value['thclass_name'])?$lang['nc_default']:$value['thclass_name'];?>]</a></span>
    <span class="tyq-theme-name"><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=theme&wwi=theme_detail&c_id=<?php echo $value['tyq_id'];?>&t_id=<?php echo $value['theme_id'];?>" target="_blank"><?php echo $value['theme_name'];?></a></span>
    </li>
    <?php } ?>
    <?php } ?>
</ul>
