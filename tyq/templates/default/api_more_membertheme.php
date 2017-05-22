<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<ul class="tyq-more-membertheme">
  <?php if(!empty($output['more_membertheme']) && is_array($output['more_membertheme'])) {?>
  <?php foreach($output['more_membertheme'] as $key=>$value) {?>
  <li class="tyq-member-item">
    <div class="tyq-member-avatar"> <a target="_blank" href="<?php echo MALL_SITE_URL;?>/index.php?app=sns_tyq&mid=<?php echo $value['member_id'];?>" target="_blank"> <img src="<?php echo getMemberAvatarForID($value['member_id']);?>" /> </a> </div>
    <div class="tyq-member-name"> <a target="_blank" href="<?php echo MALL_SITE_URL;?>/index.php?app=sns_tyq&mid=<?php echo $value['member_id'];?>" target="_blank"> <?php echo $value['member_name'];?> </a> </div>
    <div class="tyq-member-theme"> <a href="<?php echo TYQ_SITE_URL;?>/index.php?app=theme&wwi=theme_detail&c_id=<?php echo $value['tyq_id'];?>&t_id=<?php echo $value['theme_id'];?>" target="_blank"> <?php echo $value['theme_name'];?> </a> </div>
  </li>
  <?php } ?>
  <?php } ?>
</ul>
