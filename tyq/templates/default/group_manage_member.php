<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="base-layout">
  <div class="mainbox">
    <?php include tyq_template('group_manage_top');?>
    <table class="base-table-style">
      <thead>
        <tr>
          <th class="w30"></th>
          <th class="tl"><?php echo $lang['tyq_member'];?></th>
          <th class="w70"><?php echo $lang['tyq_theme'];?></th>
          <th class="w70"><?php echo $lang['tyq_reply'];?></th>
          <th class="w100"><?php echo $lang['tyq_add_time'];?></th>
          <th class="w100"><?php echo $lang['tyq_last_speak'];?></th>
          <th class="w70"><?php echo $lang['tyq_nospeak'];?></th>
          <th class="w120"><?php echo $lang['nc_handle'];?></th>
        </tr>
        <tr>
          <?php if(!empty($output['cm_list'])){?>
          <td class="tc"><input id="all" class="checkall" type="checkbox" /></td>
          <td colspan="5" class="batches"><label for="all" class="handle-btn"><i class="ac0"></i><?php echo $lang['nc_check_all'];?></label>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setmanage&type=yes&c_id=<?php echo $output['c_id'];?>" name="cm_id" confirm="<?php echo $lang['tyq_manage_confirm_one'].C('tyq_managesum').$lang['tyq_manage_confirm_two'];?>" title="<?php echo $lang['tyq_manage_title'];?>"><i class="ac1"></i><?php echo $lang['tyq_manage'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setmanage&type=no&c_id=<?php echo $output['c_id'];?>" name="cm_id" title="<?php echo $lang['tyq_manage_cancel'];?>"><i class="ac2"></i><?php echo $lang['tyq_manage_cancel'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setting&sign=speak&type=no&c_id=<?php echo $output['c_id'];?>" name="cm_id" title="<?php echo $lang['tyq_nospeak'];?>"><i class="ac4"></i><?php echo $lang['tyq_nospeak'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setting&sign=speak&type=yes&c_id=<?php echo $output['c_id'];?>" name="cm_id" title="<?php echo $lang['tyq_nospeak_cancel'];?>"><i class="ac3"></i><?php echo $lang['tyq_nospeak_cancel'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setting&sign=star&type=yes&c_id=<?php echo $output['c_id'];?>" name="cm_id" title="<?php echo $lang['tyq_star_title'];?>"><i class="ac8"></i><?php echo $lang['tyq_star'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setting&sign=star&type=no&c_id=<?php echo $output['c_id'];?>" name="cm_id" title="<?php echo $lang['tyq_star_cancel'];?>"><i class="ac9"></i><?php echo $lang['tyq_star_cancel'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=delmember&c_id=<?php echo $output['c_id'];?>" name="cm_id" confirm="<?php echo $lang['nc_ensure_del'];?>" title="<?php echo $lang['nc_delete'];?>"><i class="ac5"></i><?php echo $lang['nc_delete'];?></a></td>
          <?php }?>
          <td colspan="20"><form method="get" class="manage-search-member">
              <input type="hidden" name="app" value="group_manage" />
              <input type="hidden" name="wwi" value="member_manage" />
              <input type="hidden" name="c_id" value="<?php echo $output['c_id']?>" />
              <input name="mname" type="text" class="s-txt" placeholder="<?php echo $lang['nc_insert_username'];?>" value="<?php echo $_GET['mname'];?>" maxlength="20" />
              <input type="submit" class="s-btn" title="<?php echo $lang['nc_find'];?>" value="&nbsp;"/>
            </form></td>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['cm_list'])){?>
        <?php foreach ($output['cm_list'] as $val){?>
        <tr>
          <td><input class="checkitem" type="checkbox" value="<?php echo $val['member_id'];?>"></td>
          <td><dl class="member-base"><dt class="member-name"><a href="<?php echo MALL_SITE_URL;?>/index.php?app=member_snshome&mid=<?php echo $val['member_id'];?>" target="_blank"><?php echo $val['member_name'];?></a><?php echo memberIdentity($val['is_identity']);?></dt><dd class="member-avatar-s"><img src="<?php echo getMemberAvatarForID($val['member_id']);?>" /><?php if($val['is_star']){echo '<dd class="member-star" title="'.$lang['tyq_stat_member'].'"></dd>';}?></dd>
          </dl></td>
          <td><?php echo $val['cm_thcount'];?></td>
          <td><?php echo $val['cm_comcount'];?></td>
          <td class="time"><?php echo @date('Y-m-d', $val['cm_jointime']);?></td>
          <td class="time"><?php if(empty($val['cm_lastspeaktime'])){echo '--';}else{echo @date('Y-m-d', $val['cm_lastspeaktime']);}?></td>
          <td><?php if($val['is_allowspeak'] == 1){echo $lang['nc_allow'];}else{echo $lang['nc_ban'];}?></td>
          <td class="handle"><?php if($val['is_identity'] == 1){?>
            --
            <?php }else{?>
            <?php if($val['is_allowspeak'] == 1){?>
            <a href="javascript:void(0);" onclick="settingmember('speak','no',<?php echo $val['member_id'];?>);"><?php echo $lang['tyq_nospeak'];?></a>
            <?php }else{?>
            <a href="javascript:void(0);" onclick="settingmember('speak','yes',<?php echo $val['member_id'];?>);"><?php echo $lang['tyq_nospeak_cancel'];?></a>
            <?php }?>
            |&nbsp;<a href="javascript:void(0)" onclick="delmember(<?php echo $val['member_id'];?>);"><?php echo $lang['nc_delete'];?></a>
            <?php }?></td>
        </tr>
        <?php }?>
        <?php }else{?>
        <tr>
          <td colspan="20" class="noborder"><p class="no-record"><?php echo $lang['no_record'];?></p></td>
        </tr>
        <?php }?>
      </tbody>
      <?php if(!empty($output['cm_list'])){?>
      <tfoot>
        <tr>
          <th class="tc"><input id="all" class="checkall" type="checkbox" /></th>
          <th colspan="20" class="batches"><label for="all" class="handle-btn"><i class="ac0"></i><?php echo $lang['nc_check_all'];?></label>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setmanage&type=yes&c_id=<?php echo $output['c_id'];?>" name="cm_id" confirm="<?php echo $lang['tyq_manage_confirm_one'].C('tyq_managesum').$lang['tyq_manage_confirm_two'];?>" title="<?php echo $lang['tyq_manage_title'];?>"><i class="ac1"></i><?php echo $lang['tyq_manage'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setmanage&type=no&c_id=<?php echo $output['c_id'];?>" name="cm_id" title="<?php echo $lang['tyq_manage_cancel'];?>"><i class="ac2"></i><?php echo $lang['tyq_manage_cancel'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setting&sign=speak&type=no&c_id=<?php echo $output['c_id'];?>" name="cm_id" title="<?php echo $lang['tyq_nospeak']?>"><i class="ac4"></i><?php echo $lang['tyq_nospeak'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setting&sign=speak&type=yes&c_id=<?php echo $output['c_id'];?>" name="cm_id" title="<?php echo $lang['tyq_nospeak_cancel'];?>"><i class="ac3"></i><?php echo $lang['tyq_nospeak_cancel'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setting&sign=star&type=yes&c_id=<?php echo $output['c_id'];?>" name="cm_id" title="<?php echo $lang['tyq_star_title'];?>"><i class="ac8"></i><?php echo $lang['tyq_star'];?></a>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setting&sign=star&type=no&c_id=<?php echo $output['c_id'];?>" name="cm_id" title="<?php echo $lang['tyq_star_cancel'];?>"><i class="ac9"></i><?php echo $lang['tyq_star_cancel'];?></a>
            <a href="javascript:void(0);" class="handle-btn" onclick="delBatchMember();" title="<?php echo $lang['nc_delete'];?>"><i class="ac5"></i><?php echo $lang['nc_delete'];?></a></th>
        </tr>
        <tr><td colspan="20"><div class="pagination"><?php echo $output['show_page'];?></div></td></tr>
      </tfoot>
      <?php }?>
    </table>
  </div>
  <div class="sidebar">
    <?php include tyq_template('group_manage_sidebar');?>
  </div>
</div>
<script src="<?php echo TYQ_RESOURCE_SITE_URL;?>/js/tyq_manage.js"></script> 
<script>
function settingmember(sign, type, id){
	_uri = "<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=setting&sign="+sign+"&type="+type+"&c_id=<?php echo $output['c_id'];?>&cm_id="+id;
	ajaxget(_uri);
}

function delmember(id){
	_uri = "<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=delmember&c_id=<?php echo $output['c_id'];?>&cm_id="+id;
	ajax_form("delmember", '提示信息', _uri, 360);
}

function delBatchMember() {
	/* 获取选中的项 */
    var items = '';
    $('.checkitem:checked').each(function(){
        items += this.value + ',';
    });
    if (items == '') {
        return false;
    }
    items = items.substr(0, (items.length - 1));
    delmember(items);
}
</script>