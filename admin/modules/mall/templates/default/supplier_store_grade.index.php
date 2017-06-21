<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['supplier_store_grade'];?></h3>
        <h5><?php echo $lang['supplier_store_grade_subhead'];?></h5>
      </div>
      <ul class="tab-base nc-row">
        <li><a href="index.php?app=store_grade&wwi=index"><span>店铺等级</span></a></li>
        <li><a href="index.php?app=servicer_store_grade&wwi=index"><span>服务商等级</span></a></li>
        <li><a class="current"><span>供应商等级</span></a></li>
      </ul>
    </div>
  </div>
  <div class="flex-table-search">
    <form method="post" name="formSearch">
      <div class="sDiv">
        <input type="text" value="<?php echo $output['like_ssg_name'];?>" name="like_ssg_name" id="like_ssg_name"  class="qsbox" placeholder="<?php echo $lang['supplier_store_grade_name'];?>...">
        <a href="javascript:document.formSearch.submit();" class="btn"><?php echo $lang['nc_search'];?></a></div>
    </form>
  </div>
  </form>
  <form id="form_grade" method='post' name="">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="flex-table">
      <thead>
        <tr>
          <th width="24" align="center" class="sign"><i class="ico-check"></i></th>
          <th width="150" class="handle" align="center"><?php echo $lang['nc_handle'];?></th>
          <th width="120" align="center"><?php echo $lang['supplier_store_grade_id'];?></th>
          <th width="120" align="center"><?php echo $lang['supplier_store_grade_name'];?></th>
          <th width="120" align="center"><?php echo $lang['supplier_store_grade_market'];?></th>
          <th width="120" align="center"><?php echo $lang['supplier_store_grade_mall'];?></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['grade_list']) && is_array($output['grade_list'])){ ?>
        <?php foreach($output['grade_list'] as $k => $v){ ?>
        <tr>
          <td class="sign"><i class="ico-check"></i></td>
          <td class="handle"><?php if($v['ssg_id'] == '1'){ ?>
            <a class="btn" href="javascript:void(0);" title="<?php echo $lang['default_supplier_store_grade_no_del'];?>"><i class="fa fa-unlock-alt"></i>默认</a>
            <?php }else { ?>
            <a class="btn red" href="javascript:if(confirm('<?php echo $lang['problem_del'];?>'))window.location = 'index.php?app=supplier_store_grade&wwi=store_grade_del&ssg_id=<?php echo $v['ssg_id'];?>';"><i class="fa fa-trash-o"></i><?php echo $lang['nc_del'];?></a>
            <?php } ?>
            <span class="btn"><em><i class="fa fa-cog"></i><?php echo $lang['nc_set'];?><i class="arrow"></i></em>
            <ul>
              <li><a href="index.php?app=supplier_store_grade&wwi=store_grade_edit&ssg_id=<?php echo $v['ssg_id'];?>">编辑选项</a></li>
            </ul>
            </span></td>
          <td><?php echo $v['ssg_id'];?></td>
          <td><?php echo $v['ssg_name'];?></td>
         <td><?php echo $lang['factory_price'].$output['grade_operator'][$v['ssg_market_operator']].$v['ssg_market_discount'];?></td>
         <td><?php echo $lang['factory_price'].$output['grade_operator'][$v['ssg_mall_operator']].$v['ssg_mall_discount'];?></td>
          <td></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no-data">
          <td colspan="100" class="no-data"><i class="fa fa-lightbulb-o"></i><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>
</div>
<script>
$(function(){
    $('.flex-table').flexigrid({
        height:'auto',// 高度自动
        usepager: false,// 不翻页
        striped:false,// 不使用斑马线
        resizable: false,// 不调节大小
        title: '供应商等级列表',// 表格标题
        reload: false,// 不使用刷新
        columnControl: false,// 不使用列控制
        buttons : [
                   {display: '<i class="fa fa-plus"></i>新增数据', name : 'add', bclass : 'add', onpress : fg_operation }
               ]
        });
});

    function fg_operation(name, grid) {
        if (name == 'add') {
            window.location.href = 'index.php?app=supplier_store_grade&wwi=store_grade_add';
        }
    }
</script> 