<?php defined('ByShopWWI') or exit('Access Invalid!');?>
<div class="ncc-form-default">
  <form method="POST" id="servicer_form" action="index.php">
    <input type="hidden" value="buy" name="app">
    <input type="hidden" value="add_servicer" name="wwi">
    <input type="hidden" name="form_submit" value="ok"/>
    <dl>
      <dt><i class="required">*</i>可选服务商</dt>
      <dd>
        <select id="servicer_id" name="servicer_id">
          <option value="">选择服务商</option>
          <option value="酒">酒</option>
          <option value="食品">食品</option>
          <option value="饮料">饮料</option>
        </select>
      </dd>
    </dl>
  </form>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#servicer_form').validate({
        rules : {
            servicer_id : {
                required : true
            }
        },
        messages : {
            servicer_id : {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_input_servicer'];?>'
            },
        }
    });
});
function submitAddServicer(){
    if($('#servicer_form').valid()){
    	$("#ser_id").val($("#servicer_id").val());
        content=$("#servicer_id :selected").text();
        hideServicerList(content);
    }else{
        return false;
    }
}
</script>