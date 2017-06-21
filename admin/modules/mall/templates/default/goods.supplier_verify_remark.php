<?php defined('ByShopWWI') or exit('Access Invalid!');?>
<script src="<?php echo ADMIN_RESOURCE_URL?>/js/admin.js" type="text/javascript"></script>
<form method="post" name="form1" id="form1" class="ncap-form-dialog" action="<?php echo urlAdminMall('goods', 'goods_supplier_verify');?>">
  <input type="hidden" name="form_submit" value="ok" />
  <input type="hidden" value="<?php echo $output['common_info']['goods_commonid'];?>" name="commonid">
  <div class="ncap-form-default">
    <dl class="row">
      <dt class="tit">发布该商品账号类型</dt>
      <dd class="opt">【工厂账号】<?php echo $output['common_info']['store_name'];?></dd>
    </dl>
    <dl class="row">
      <dt class="tit">
        <label>审核通过</label>
      </dt>
      <dd class="opt">
        <div class="onoff">
          <label for="rewrite_enabled"  class="cb-enable selected" title="<?php echo $lang['nc_yes'];?>"><?php echo $lang['nc_yes'];?></label>
          <label for="rewrite_disabled" class="cb-disable" title="<?php echo $lang['nc_no'];?>"><?php echo $lang['nc_no'];?></label>
          <input id="rewrite_enabled" name="verify_state" checked="checked" value="1" type="radio">
          <input id="rewrite_disabled" name="verify_state" value="0" type="radio">
        </div>
        <p class="notic"><?php echo $lang['open_rewrite_tips'];?></p>
      </dd>
    </dl>
    <dl class="row" nctype="reason" style="display: none">
      <dt class="tit">
        <label for="verify_reason">未通过理由</label>
      </dt>
      <dd class="opt">
        <textarea rows="6" class="tarea" cols="60" name="verify_reason" id="verify_reason"></textarea>
      </dd>
    </dl>

    <dl class="row">
      <dt class="tit">
        <label>批量设置市场价</label>
      </dt>
      <dd class="opt">
        出厂价乘以输入的数(结果保留整数部位)
        <input type="text" id="market_percent" size="10" onKeyUp="clearNoNum(this);">
        <a href="javascript:void(0);" class="ncap-btn ncap-btn-green" nctype="btn_batchsetmarket">批量设置</a>
      </dd>
    </dl>

    <dl class="row">
      <dt class="tit">
        <label>批量设置商城售价</label>
      </dt>
      <dd class="opt">
        出厂价乘以输入的数(结果保留整数部位)
        <input type="text" id="mall_percent" size="10" onKeyUp="clearNoNum(this);">
        <a href="javascript:void(0);" class="ncap-btn ncap-btn-green" nctype="btn_batchsetmall">批量设置</a>
      </dd>
    </dl>

    <div class="ncap-goods-sku" >
      <div class="title">
        <h4 style="width:10%;">SKU编号</h4>
        <h4 style="width:10%;">SKU图片</h4>
        <h4 style="width:30%;">商品名称</h4>
        <h4>市场价</h4>
        <h4>出厂价</h4>
        <h4>商城售价</h4>
        <h4 style="width:8%;">显示价</h4>
      </div>
      <div class="content">
        <ul>
          <?php $i=0;?>
          <?php foreach ($output['goods_list'] as $val) {?>
          <li> 
            <span style="width:10%;"><?php echo $val['goods_id'];?></span> 
            <span style="width:10%;">
              <img src="<?php echo $val['goods_image'];?>" onMouseOver="toolTip('<img src=<?php echo $val['goods_image'];?>>')" onMouseOut="toolTip()">
            </span> 
            <span style="width:30%;"><?php echo $val['goods_name'];?></span> 
            <span><input type="text" nctype="goods_marketprice" name="goods_marketprice[<?php echo $val['goods_id'];?>]" value="<?php echo $val['goods_marketprice']; ?>" size="10" data-price="<?php echo $val['goods_marketprice']; ?>"></span> 
            <span><?php echo $output['common_info']['goods_costprice'];?></span> 
            <span><input type="text" nctype="goods_price" name="goods_price[<?php echo $val['goods_id'];?>]" value="<?php echo $val['goods_price']?>" size="10" data-price="<?php echo $val['goods_price']?>"></span> 
            <?php if($i==0){?>
            <input type="hidden" name="goods_main_price_id" id="goods_main_price_id" value="<?php echo $val['goods_id'];?>">
            <?php }?>
            <span style="width:8%;"><input type="radio" name="goods_main_price" <?php if($i==0)echo 'checked';?> data-goods_id="<?php echo $val['goods_id'];?>"></span>
          </li>
          <?php $i++;}?>
        </ul>
      </div>
    </div>
    <div class="bot"><a href="javascript:void(0);" class="ncap-btn-big ncap-btn-green" nctype="btn_submit"><?php echo $lang['nc_submit'];?></a></div>
  </div>
</form>
<script>
$(function(){
    var goods_costprice ="<?php echo $output['common_info']['goods_costprice'];?>";

    $('a[nctype="btn_submit"]').click(function(){
        ajaxpost('form1', '', '', 'onerror');
    });
    $('input[name="goods_main_price"]').click(function(){
        $("#goods_main_price_id").val($(this).data('goods_id'));
    });

    $('input[name="verify_state"]').click(function(){
        if ($(this).val() == 1) {
            $('dl[nctype="reason"]').hide();
        } else {
            $('dl[nctype="reason"]').show();
        }
    });

    /*批量设置市场价格*/
    $('a[nctype="btn_batchsetmarket"]').click(function(){
      var market_percent=$("#market_percent").val();
      var remarket_price=parseFloat(goods_costprice)*parseFloat(market_percent);
      
        $('input[nctype="goods_marketprice"]').each(function(){
          if(!isNaN(remarket_price)){
            $(this).val(parseInt(remarket_price));
          }else{
            $(this).val($(this).data('price'));
          }
        })
    })

    /*批量设置商城价格*/
    $('a[nctype="btn_batchsetmall"]').click(function(){
      var mall_percent=$("#mall_percent").val();
      var remall_price=parseFloat(goods_costprice)*parseFloat(mall_percent);
      
        $('input[nctype="goods_price"]').each(function(){
          if(!isNaN(remall_price)){
            $(this).val(parseInt(remall_price));
          }else{
            $(this).val($(this).data('price'));
          }
        })
      
    })
    $('.content').perfectScrollbar();
});

function clearNoNum(obj)
{
  //先把非数字的都替换掉，除了数字和.
  obj.value = obj.value.replace(/[^\d.]/g,"");
  //必须保证第一个为数字而不是.
  obj.value = obj.value.replace(/^\./g,"");
  //保证只有出现一个.而没有多个.
  obj.value = obj.value.replace(/\.{2,}/g,".");
  //保证.只出现一次，而不能出现两次以上
  obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
}
</script>
