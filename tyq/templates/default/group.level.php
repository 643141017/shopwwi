<?php defined('ByShopWWI') or exit('Access Invalid!');?>
<?php if($output['tyq_info']['tyq_status'] == 1){?>
<link href="<?php echo TYQ_TEMPLATES_URL;?>/css/ubb.css" rel="stylesheet" type="text/css">
<div class="group warp-all">
  <?php require_once tyq_template('group.top');?>
  <div class="group-level-intro">
    <h3><?php echo $lang['level_h3_1'];?></h3>
    <table class="base-table-style">
      <thead>
        <tr>
          <th><?php echo $lang['level'];?></th>
          <th><?php echo $lang['level_rank'];?></th>
          <th><?php echo $lang['level_need_exp'];?></th>
          <th><?php echo $lang['level'];?></th>
          <th><?php echo $lang['level_rank'];?></th>
          <th><?php echo $lang['level_need_exp'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php for($i=1;$i<=8;$i++){?>
        <tr>
          <td height="40"><?php echo $i;?></td>
          <td><?php echo memberLevelHtml(array('cm_level'=>$i, 'cm_levelname'=>$output['ml_info']['ml_'.$i], 'tyq_id'=>$output['c_id']));?></td>
          <td style="border-right: solid 1px #E5ECEE"><?php echo $output['mld_array'][$i]['mld_exp'];?></td>
          <td><?php echo $i+8;?></td>
          <td><?php echo memberLevelHtml(array('cm_level'=>$i+8, 'cm_levelname'=>$output['ml_info']['ml_'.($i+8)], 'tyq_id'=>$output['c_id']));?></td>
          <td><?php echo $output['mld_array'][($i+8)]['mld_exp'];?></td>
        </tr>
        <?php }?>
      </tbody>
    </table>
    <h3><?php echo $lang['level_h3_2'];?></h3>
    <table class="base-table-style">
      <thead>
        <tr>
          <th><?php echo $lang['level_user_action'];?></th>
          <th><?php echo $Lang['level_exp_in_table'];?></th>
          <th><?php echo $lang['level_daily_exp_ceiling']?></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td height="40"><?php echo $lang['level_release_theme'];?></td>
          <td style="border-right: solid 1px #E5ECEE"><?php echo C('tyq_exprelease');?></td>
          <td rowspan="2"><?php echo C('tyq_expreleasemax');?></td>
        </tr>
        <tr>
          <td height="40"><?php echo $lang['level_reply_theme'];?></td>
          <td style="border-right: solid 1px #E5ECEE"><?php echo C('tyq_expreply');?></td>
        </tr>
        <tr>
          <td height="40"><?php echo $lang['level_replied_theme'];?></td>
          <td style="border-right: solid 1px #E5ECEE"><?php echo C('tyq_expreplied');?></td>
          <td><?php echo C('tyq_exprepliedmax');?></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="20"><p><?php echo $lang['level_needing_attention'];?></p></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/custom.min.js"></script> 
<?php }else if($output['tyq_info']['tyq_status'] == 2){?>
<div class="warp-all">
  <div class="tyq-status"><i class="icon02"></i>
    <h3><?php echo $lang['tyq_is_under_approval'];?></h3>
  </div>
</div>
<?php }else if($output['tyq_info']['tyq_status'] == 3){?>
<div class="warp-all">
  <div class="tyq-status"><i class="icon03"></i>
    <h3><?php echo $lang['tyq_approval_fail'];?></h3>
    <?php if($output['tyq_info']['tyq_statusinfo'] != ''){echo '<h5>'.$lang['tyq_reason'].$lang['nc_colon'].$output['tyq_info']['tyq_statusinfo'].'</h5>'; }?>
  </div>
</div>
<?php }else{?>
<div class="warp-all">
  <div class="tyq-status"><i class="icon01"></i>
    <h3><?php echo $lang['tyq_is_closed'];?></h3>
    <?php if($output['tyq_info']['tyq_statusinfo'] != ''){echo '<h5>'.$lang['tyq_reason'].$lang['nc_colon'].$output['tyq_info']['tyq_statusinfo'].'</h5>'; }?>
  </div>
</div>
<?php }?>
