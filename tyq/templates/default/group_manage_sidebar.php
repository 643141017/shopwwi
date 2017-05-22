<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="my-info">
  <div class="avatar"><img src="<?php echo getMemberAvatarForID($_SESSION['member_id']);?>" /><a href="<?php echo urlMember('member_information', 'avatar');?>" title="<?php echo $lang['nc_edit_avatar'];?>"><?php echo $lang['nc_edit_avatar'];?></a></div>
  <dl>
    <dt>
      <h2><a href="index.php?app=p_center" target="_blank"><?php echo $_SESSION['member_name'];?></a></h2>
    </dt>
    <dd><span><?php echo $lang['tyq_theme'].$lang['nc_colon'];?><em>(<b><?php echo $output['cm_info']['cm_thcount'];?></b>)</em></span><span><?php echo $lang['tyq_reply'].$lang['nc_colon'];?><em>(<b><?php echo $output['cm_info']['cm_comcount'];?></b>)</em></span></dd>
  </dl>
</div>
<div class="side-tab-nav">
  <ul class="tabs-nav">
    <li class="tabs-selected"><a href="javascript:void(0)"><?php echo $lang['my_tyq'];?></a></li>
    <li><a href="javascript:void(0)"><?php echo $lang['manage_tyq'];?></a></li>
  </ul>
  <div class="my-tyq-list tabs-panel">
    <?php if (!empty($output['tyq_array'])){?>
    <?php foreach ($output['tyq_array'] as $val){?>
    <dl <?php if($val['is_identity'] == 3){?>nctype="member"<?php }?>>
      <dt class="name"><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=group&c_id=<?php echo $val['tyq_id'];?>" title="<?php echo $val['tyq_name'];?>" ><?php echo $val['tyq_name'];?></a></dt>
      <dd class="pic"><span class="thumb size50"><i></i><a href="javascript:void(0);"><img src="<?php echo tyqLogo($val['tyq_id']);?>" /></a></span></dd>
      <dd class="createtime"><?php echo $lang['tyq_created_at'];?><em class="ml5"><?php echo @date('Y-m-d', $val['tyq_addtime']);?></em></dd>
      <dd class="number"><em><?php echo $val['tyq_mcount'];?></em><?php echo $lang['tyq_members'];?></dd>
    </dl>
    <?php }?>
    <?php }?>
  </div>
</div>
<script>
$(function() {
	$(".tabs-nav > li > a").click(function(e) {
		$(".tabs-nav > li > a").parent().removeClass('tabs-selected');
		var parent = $(this).parent();
		parent.addClass('tabs-selected');
		if($(".tabs-nav > li").eq(1).hasClass('tabs-selected')){
			$('[nctype="member"]').hide();
		}else{
			$('[nctype="member"]').show();
		}
	});
});
</script> 