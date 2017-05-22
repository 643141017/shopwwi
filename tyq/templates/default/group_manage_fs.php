<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="base-layout">
  <div class="mainbox">
    <?php include tyq_template('group_manage_top');?>
    <table class="base-table-style">
      <thead>
        <tr>
          <th class="w30"></th>
          <th class="tl"><?php echo $lang['tyq_name'];?></th>
          <th class="w120"><?php echo $lang['nc_sort'];?></th>
          <th class="w120"><?php echo $lang['nc_status'];?></th>
          <th class="w150"><?php echo $lang['nc_handle'];?></th>
        </tr>
        <tr>
          <?php if(!empty($output['fs_list'])){?>
          <td class="tc"><input id="all" class="checkall" type="checkbox" /></td>
          <td colspan="3"><label for="all" class="handle-btn"><i class="ac0"></i><?php echo $lang['nc_check_all'];?></label>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=class_del&c_id=<?php echo $output['c_id'];?>" name="thc_id" confirm="<?php echo $lang['nc_ensure_del'];?>"><i class="ac5"></i><?php echo $lang['nc_delete'];?></a></td>
          <?php }?>
          <td colspan="20" class="tr"><a href="javascript:void(0);" nctype="add_fs" class="add-group-class-btn mr10"><?php echo $lang['ftyq_add'];?></a></td>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['fs_list'])){?>
        <?php foreach ($output['fs_list'] as $val){?>
        <tr>
          <td><input type="checkbox" class="checkitem" value="<?php echo $val['friendship_id'];?>" /></td>
          <td class="tl"><dl class="group-base">
              <dt class="group-name"><a href="<?php echo TYQ_SITE_URL;?>/index.php?app=group&c_id=<?php echo $val['friendship_id'];?>" target="_blank"><?php echo $val['friendship_name'];?></a></dt>
              <dd class="group-pic"> <img src="<?php echo tyqLogo($val['friendship_id']);?>"> </dd>
            </dl></td>
          <td><?php echo $val['friendship_sort'];?></td>
          <td><?php if($val['friendship_status'] == 1){echo $lang['nc_show'];}else{echo $lang['nc_hide'];}?></td>
          <td class="handle"><a href="javascript:void(0);" onclick="edit_fs(<?php echo $val['friendship_id'];?>)"><?php echo $lang['nc_edit'];?></a>&nbsp;|&nbsp;<a href="javascript:void(0);" onclick="del_fs(<?php echo $val['friendship_id'];?>)"><?php echo $lang['nc_delete'];?></a></td>
        </tr>
        <?php }?>
        <?php }else{?>
        <tr>
          <td colspan="20" class="noborder"><p class="no-record"><?php echo $lang['no_record'];?></p></td>
        </tr>
        <?php }?>
      </tbody>
      <?php if(!empty($output['fs_list'])){?>
      <tfoot>
        <tr>
          <th class="tc"><input id="all" class="checkall" type="checkbox" /></th>
          <th colspan="20"><label for="all" class="handle-btn"><i class="ac0"></i><?php echo $lang['nc_check_all'];?></label>
            <a href="javascript:void(0);" class="handle-btn" nctype="batchbutton" uri="<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=friendship_del&c_id=<?php echo $output['c_id'];?>" name="fs_id" confirm="<?php echo $lang['nc_ensure_del'];?>"><i class="ac5"></i><?php echo $lang['nc_delete'];?></a> </th>
        </tr>
      </tfoot>
      <?php }?>
    </table>
  </div>
  <div class="sidebar">
    <?php include tyq_template('group_manage_sidebar');?>
  </div>
</div>
<script src="<?php echo TYQ_RESOURCE_SITE_URL;?>/js/tyq_manage.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script> 
<script>
var c_id = <?php echo $output['c_id'];?>;
$(function(){
    // 添加分类
    $('a[nctype="add_fs"]').click(function(){
    	_uri = "<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=friendship_add&c_id="+c_id;
    	CUR_DIALOG = ajax_form('add_friendship', '<?php echo $lang['ftyq_add'];?>', _uri, 520);
	});
});
function edit_fs(id){
	_uri = "<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=friendship_edit&c_id="+c_id+"&fs_id="+id;
	CUR_DIALOG = ajax_form('edit_friendship', '<?php echo $lang['ftyq_edit']?>', _uri, 520);
}
function del_fs(id){
	showDialog('<?php echo $lang['nc_ensure_del'];?>', 'confirm', '', function(){
		_uri = "<?php echo TYQ_SITE_URL;?>/index.php?app=manage&wwi=friendship_del&c_id="+c_id+"&fs_id="+id;
		ajaxget(_uri);
	});
}
</script>