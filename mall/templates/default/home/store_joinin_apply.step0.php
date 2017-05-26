<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<!-- 协议 -->

<div id="apply_agreement" class="apply-agreement">
  <div class="title"><h3>入驻协议</h3></div>
  <div class="apply-agreement-content"> <?php echo $output['agreement'];?> </div>
  <div class="apple-agreement">
    <input id="input_apply_agreement" name="input_apply_agreement" type="checkbox" checked />
    <label for="input_apply_agreement">我已阅读并同意以上协议</label>
  </div>
  
  <div class="bottom">
    <?php if($output['store_type']=='no'){?>
      <a  href="javascript:;" class="btn" onclick="storeType();">选择店铺类型</a>
    <?php } else{?>
      <?php if($output['store_type']=='0'){?>
      <a id="btn_apply_agreecbc_next" href="javascript:;" class="btn">个人入驻</a>
      <?php }?>
      <a style=" margin-left:15px;" id="btn_apply_agreement_next" href="javascript:;" class="btn">企业入驻</a>
    <?php }?>
  </div>

</div>
<script type="text/javascript" src="<?php echo MALL_RESOURCE_SITE_URL;?>/layer/layer.js" charset="utf-8"></script>
<script type="text/javascript">
function storeType(){
  layer.open({
    content: '请选择店铺类型'
    ,btn: ['零售商申请', '供应商申请', '服务商申请']
    ,yes: function(index, layero){
      window.location.href="<?php echo urlMall('store_joinin', 'store_type0');?>";;
    }
    ,btn2: function(index, layero){
      window.location.href="<?php echo urlMall('store_joinin', 'store_type1');?>";;
    }
    ,btn3: function(index, layero){
      window.location.href="<?php echo urlMall('store_joinin', 'store_type2');?>";;
    }
    ,cancel: function(){ 
      //右上角关闭回调
      //return false 开启该代码可禁止点击该按钮关闭
    }
  }); 
}
</script>

<script type="text/javascript">
$(document).ready(function(){
	$('#btn_apply_agreecbc_next').on('click', function() {
        if($('#input_apply_agreement').prop('checked')) {
            window.location.href = "index.php?app=store_joinincc&wwi=step1";
        } else {
            alert('请阅读并同意协议');
        }
    });
    $('#btn_apply_agreement_next').on('click', function() {
        if($('#input_apply_agreement').prop('checked')) {
            window.location.href = "index.php?app=store_joinin&wwi=step1";
        } else {
            alert('请阅读并同意协议');
        }
    });
});
</script>