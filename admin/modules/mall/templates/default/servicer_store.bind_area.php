<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="page">
<div class="fixed-bar">
  <div class="item-title"><a class="back" href="index.php?app=servicer_store&wwi=store" title="返回<?php echo $lang['manage'];?>列表"><i class="fa fa-arrow-tyq-o-left"></i></a>
      <div class="subject">
      <h3>修改“<?php echo $output['store_info']['store_name'];?>”的服务区域</h3>
      <h5><?php echo $lang['nc_store_manage_subhead'];?></h5>
    </div>
  </div>
</div>
<!-- 操作说明 -->
<div class="explanation" id="explanation">
  <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
    <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
    <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
  <ul>
    <li>删除店铺的服务区域会造成服务商不会出现在前台选择中，请谨慎操作</li>
    <li>所有修改即时生效</li>
  </ul>
</div>
<table class="flex-table">
  <thead>
    <tr>
      <th width="24" align="center" class="sign"><i class="ico-check"></i></th>
      <th width="60" class="handle-s" align="center"><?php echo $lang['nc_handle'];?></th>
      <th width="150" align="center">地区1</th>
      <th width="150" align="center">地区2</th>
      <th width="150" align="center">地区3</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($output['store_bind_area_list']) && is_array($output['store_bind_area_list'])){ ?>
    <?php foreach($output['store_bind_area_list'] as $key => $value){ ?>
    <tr class="hover edit">
      <td class="sign"><i class="ico-check"></i></td>
      <td class="handle-s"><a class='btn red' nctype="btn_del_store_bind_area" href="javascript:;" data-bid="<?php echo $value['bid'];?>"><i class="fa fa-trash"></i>删除</a></td>
      <td><?php echo $value['area_1_name'];?></td>
      <td><?php echo $value['area_2_name'];?></td>
      <td><?php echo $value['area_3_name'];?></td>
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
<div class="ncap-form-default" >
  <div class="title">
    <h3>添加服务区域</h3>
  </div>
  <dl class="row">
    <dt class="tit"> 选择区域</dt>
    <dd class="opt" id="area">
   	<input id="service_area1" name="service_area1" type="hidden" value=""/>
    <span id="error_message" style="color:red;"></span></dd>
    <dd class="opt">
      <form id="add_form" action="<?php echo urlAdminMall('servicer_store', 'store_bind_area_add');?>" method="post">
        <input name="store_id" type="hidden" value="<?php echo $output['store_info']['store_id'];?>">
        <input id="servicer_area" name="servicer_area" type="hidden" value="">
      </form>
      <span class="err"></span>
      <p class="notic"></p>
    </dd>
  </dl>
  <div class="bot"><a id="btn_add_area" class="ncap-btn ncap-btn-green" href="JavaScript:void(0);" />确认</a></div>
</div>
<script type="text/javascript" src="<?php echo ADMIN_RESOURCE_URL;?>/js/jquery.edit.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script> 
<script type="text/javascript">
$(document).ready(function(){
	$('#service_area1').nc_region();

	$('.flex-table').flexigrid({
		height:'auto',// 高度自动
		usepager: false,// 不翻页
		striped:false,// 不使用斑马线
		resizable: false,// 不调节大小
		title: '店铺名称：<?php echo $output['store_info']['store_name'];?>',// 表格标题
		reload: false,// 不使用刷新
		columnControl: false// 不使用列控制
	});
	

    // 提交新添加的区域
    $('#btn_add_area').on('click', function() {
        $('#error_message').hide();
        $('#error_message1').hide();
        var area_id = '';
        var validation = false;
        $('#area').find('select').each(function() {
            if(parseInt($(this).val(), 10) > 0) {
                area_id += $(this).val() + ',';
                validation=true;
            }
        });
        if(!validation) {
            $('#error_message').text('请选择区域');
            $('#error_message').show();
            return false;
        }

        $('#servicer_area').val(area_id);
        $('#add_form').submit();
    });


    // 删除现有类目
    $('[nctype="btn_del_store_bind_area"]').on('click', function() {
        if(confirm('确认删除？')) {
            var bid = $(this).attr('data-bid');
            $this = $(this);
            $.post('<?php echo urlAdminMall('servicer_store', 'store_bind_area_del');?>', {bid: bid}, function(data) {
                 if(data.result) {
                     $this.parents('tr').hide();
                 } else {
                     showError(data.message);
                 }
            }, 'json');
        }
    });
});

</script> 
