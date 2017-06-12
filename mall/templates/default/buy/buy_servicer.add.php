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
          <?php if(!empty($output['servicer_list'])){?>
          <?php foreach ($output['servicer_list'] as $key => $val) {?>
          <option value="<?php echo $val['ser_id'];?>"><?php echo $val['store_name'];?></option>
          <?php }}?>
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