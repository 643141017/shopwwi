<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="ncc-receipt-info"><div class="ncc-receipt-info-title">
  <h3>选择服务商</h3>
  <a href="javascript:void(0)" nc_type="buy_edit" id="edit_servicer">[修改]</a></div>
  <div id="servicer_list" class="ncc-candidate-items">
    <ul>
      <li>未选服务商服务</li>
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
    var address_id=$("#address_id").val();
    disableOtherEdit('如需修改，请先选择服务商 ');
    if(address_id>0){
      $(this).hide();
      $(this).parent().parent().addClass('current_box');
      $('#servicer_list').load(SITEURL+'/index.php?app=buy&wwi=load_servicer&address_id='+address_id);
    }else{
       alert('请先选择收货地址');
    }
    
});
</script>