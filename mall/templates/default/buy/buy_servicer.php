<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="ncc-receipt-info"><div class="ncc-receipt-info-title">
  <h3>选择服务商</h3>
  <a href="javascript:void(0)" nc_type="buy_edit" id="edit_servicer">[修改]</a></div>
  <div id="servicer_list" class="ncc-candidate-items">
    <ul>
      <li><?php echo $output['inv_info']['content'];?></li>
    </ul>
  </div>
</div>
<script type="text/javascript">
//隐藏发票列表
function hideServicerList(content) {
    $('#edit_servicer').show();
	$("#servicer_list").html('<ul><li>'+content+'</li></ul>');
	$('.current_box').removeClass('current_box');
	ableOtherEdit();
	//重新定位到顶部
	$("html, body").animate({ scrollTop: 0 }, 0);
}
//加载发票列表
$('#edit_servicer').on('click',function(){
    $(this).hide();
    disableOtherEdit('如需修改，请先保存服务商信息');
    $(this).parent().parent().addClass('current_box');
    $('#servicer_list').load(SITEURL+'/index.php?app=buy&wwi=load_servicer');
});
</script>