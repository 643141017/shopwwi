<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<ul>
  <li class="receive_add servicer_item">
    <input value="0" nc_type="servicer" id="add_servicer" type="radio" name="servicer">
    <label for="add_servicer">选择服务商服务</label>
  </li>
  <div id="add_servicer_box"><!-- 存放服务商选择表单 --></div>
</ul>
<div class="hr16"> 
    <a id="hide_servicer_list" class="ncbtn ncbtn-grapefruit" href="javascript:void(0);"><?php echo $lang['cart_step1_addnewserviceress_submit'];?></a>
    <a id="cancel_servicer" class="ncbtn ml10" href="javascript:void(0);">退出选择</a>
</div>
<script type="text/javascript">
function delservicer(id){
    $('#servicer_list').load(SITEURL+'/index.php?app=buy&wwi=load_servicer&id='+id);
}
$(function(){
    function addservicer() {
        $('#add_servicer_box').load(SITEURL+'/index.php?app=buy&wwi=add_servicer');
    }
    $('input[nc_type="servicer"]').on('click',function(){
        $('.serviceress_item').removeClass('ncc-selected-item');
        $('#add_servicer_box').load(SITEURL+'/index.php?app=buy&wwi=add_servicer');
        
    });
    $('#hide_servicer_list').on('click',function(){
        submitAddServicer();
    });
    if ($('input[nc_type="servicer"]').size() == 1){
        $('#add_servicer').attr('checked',true);
        addservicer();
    };

    $('#cancel_servicer').on('click',function(){
        $('#ser_id').val('');
        hideServicerList('未选服务商服务');
    });
});
</script>