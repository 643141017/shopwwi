<?php defined('ByShopWWI') or exit('Access Invalid!');?>
	<div id="topHeader">
	<div class="breadcrumd">
  <?php if(!empty($output['breadcrumd'])){?>
    <?php foreach ($output['breadcrumd'] as $val){?>
    <?php if($val['link'] != ''){?>
    <a href="<?php echo $val['link'];?>"><?php echo $val['title'];?></a>
    <?php }else{echo $val['title'];}?>
    <?php }?>
  <?php }?></div>
  	<div class="tyq-search" id="tyqSearch">
      <form id="form_search" method="get" action="<?php echo TYQ_SITE_URL;?>/index.php" >
        <input type="hidden" name="app" value="search" />
        <div class="input-box"><i class="icon"></i>
          <input id="keyword" name="keyword" type="text" class="input-text" value="<?php echo isset($_GET['keyword'])?$_GET['keyword']:'';?>" maxlength="60" x-webkit-speech="" lang="zh-CN" onwebkitspeechchange="foo()" x-webkit-grammar="builtin:search" />
          <input id="btn_search" type="submit" class="input-btn" value="搜">
        </div>
        <div class="radio-box">
          <label>
            <input name="wwi" value="theme" type="radio" <?php if($output['search_sign']=='theme' || !isset($output['search_sign'])){?>checked="checked"<?php }?> />
            <h5>话题</h5></label>
          <label>
            <input name="wwi" value="group" type="radio" <?php if($output['search_sign']=='group'){?>checked="checked"<?php }?> />
            <h5>友圈</h5></label>
        </div>
      </form>
    
</div></div>
<div class="group-top">
  <dl class="tyq-info">
    <dt class="name">
      <h2><a href="<?php echo urlTyq('group','index',array('c_id'=>$output['c_id']));?>" class="group-name"><?php echo $output['tyq_info']['tyq_name'];?></a></h2>
      <?php switch ($output['identity']){
      	case 0:
      	case 5:
      		echo '<div class="button"><a href="javascript:void(0);" nctype="apply" class="btn"><i class="apply"></i>'.$lang['tyq_apply_to_join'].'</a></div>';
      		break;
      	case 1:
      		echo '<div class="button"><a href="'.urlTyq('manage','index',array('c_id'=>$output['tyq_info']['tyq_id'])).'" class="btn"><i class="manage"></i>'.$lang['manage_tyq'].'</a></div>';
      		if($output['tyq_info']['new_verifycount'] != 0)
      			echo '<div class="pending"><a href="'.urlTyq('manage','applying',array('c_id'=>$output['c_id'])).'">'.$lang['tyq_wait_verity_count'].'</a><sup>'.$output['tyq_info']['new_verifycount'].'</sup></div>';
      		if($output['tyq_info']['new_informcount'] != 0)
      			echo '<div class="pending"><a href="'.urlTyq('manage_inform','inform',array('c_id'=>$output['c_id'])).'">'.$lang['tyq_new_inform'].'</a><sup>'.$output['tyq_info']['new_informcount'].'</sup></div>';
      		if($output['tyq_info']['new_mapplycount'] != 0)
      			echo '<div class="pending"><a href="'.urlTyq('manage_mapply','index',array('c_id'=>$output['c_id'])).'">'.$lang['tyq_management_application'].'</a><sup>'.$output['tyq_info']['new_mapplycount'].'</sup></div>';
      		break;
      	case 2:
      		echo '<div class="button"><a href="'.urlTyq('manage','index',array('c_id'=>$output['tyq_info']['tyq_id'])).'" class="btn"><i class="manage"></i>'.$lang['manage_tyq'].'</a><a href="javascript:void(0);" nctype="quitGroup" class="btn"><i class="quit"></i>'.$lang['tyq_quit_group'].'</a></div>';
      		if($output['tyq_info']['new_verifycount'] != 0)
      			echo '<div class="pending"><a href="'.urlTyq('manage','applying',array('c_id'=>$output['c_id'])).'">'.$lang['tyq_wait_verity_count'].'</a><sup>'.$output['tyq_info']['new_verifycount'].'</sup></div>';
      		if($output['tyq_info']['new_informcount'] != 0)
      			echo '<div class="pending"><a href="'.urlTyq('manage_inform','inform',array('c_id'=>$output['c_id'])).'">'.$lang['tyq_new_inform'].'</a><sup>'.$output['tyq_info']['new_informcount'].'</sup></div>';
      		
      		break;
      	case 4:
      		echo '<div class="button"><a href="javascript:void(0);" class="btn">'.$lang['tyq_applying_wait_verify'].'</a></div>';
      		break;
      	case 3:
      	case 6:
      		echo '<div class="button"><a href="javascript:void(0);" nctype="quitGroup" class="btn"><i class="quit"></i>'.$lang['tyq_quit_group'].'</a></div>';
      		break;
      }?>
    </dt>
    <dd class="pic"><a href="<?php echo urlTyq('group','index',array('c_id'=>$output['c_id']));?>"><img src="<?php echo tyqLogo($output['tyq_info']['tyq_id']);?>"/></a></dd>
    <dd class="intro"><?php if($output['tyq_info']['tyq_desc'] != ''){ echo $output['tyq_info']['tyq_desc'];}else{ echo $lang['tyq_desc_null_default'];}?></dd>
    <dd class="manage">
      <span class="master">
        <?php echo $lang['tyq_manager'].$lang['nc_colon'];?><a target="_blank" href="	<?php echo urlmall('sns_tyq','theme',array('mid'=>$output['creator']['member_id']));?>" nctype="mcard" data-param="{'id':<?php echo $output['creator']['member_id'];?>}"><i></i><?php echo $output['creator']['member_name'];?></a>
      </span>
      <span class="moderator">
        <?php echo $lang['tyq_administrate'].$lang['nc_colon'];?>
        <?php if(!empty($output['manager_list'])){foreach($output['manager_list'] as $val){?>
        <a target="_blank" href="<?php echo urlmall('sns_tyq','theme',array('mid'=>$val['member_id']));?>"  nctype="mcard" data-param="{'id':<?php echo $val['member_id'];?>}"><i></i><?php echo $val['member_name'];?></a>
        <?php }}else{echo $lang['tyq_no_administrate'];}?>
        <?php if($output['tyq_info']['mapply_open'] == 1 && $output['identity'] == 3 && $output['cm_info']['cm_level'] >= $output['tyq_info']['mapply_ml']){?>
        <a href="javascript:void(0);" nctype="manageApply"><?php echo $lang['tyq_apply_to_be_a_management'];?></a>
        <?php }?>
      </span>
    </dd>
  </dl>
  <div class="tyq-create"><a href="javascript:void(0);" nctype="create_tyq"><i></i><?php echo $lang['tyq_create_my_new_tyq'];?></a></div>
  <div class="clear"></div>
</div>
<script type="text/javascript" src="<?php echo TYQ_RESOURCE_SITE_URL;?>/js/group.js" charset="utf-8"></script> 
<script>
var c_id = <?php echo $output['c_id'];?>;
var identity = <?php echo $output['identity'];?>;
</script>
