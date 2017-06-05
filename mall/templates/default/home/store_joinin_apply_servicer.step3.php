<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<!-- 店铺信息 -->

<div id="apply_store_info" class="apply-store-info">
  <div class="alert">
    <h4>注意事项：</h4>
    店铺经营类目为商城商品分类，请根据实际运营情况添加一个或多个经营类目。</div>
  <form id="form_store_info" action="index.php?app=store_joinin&wwi=step4" method="post" >
    <table border="0" cellpadding="0" cellspacing="0" class="all">
      <thead>
        <tr>
          <th colspan="20">店铺经营信息</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="w150"><i>*</i>商家账号：</th>
          <td><input id="seller_name" name="seller_name" type="text" class="w200"/>
            <span></span>
            <p class="emphasis">此账号为日后登录并管理商家中心时使用，注册后不可修改，请牢记。</p></td>
        </tr>
        <tr>
          <th class="w150"><i>*</i>店铺名称：</th>
          <td><input name="store_name" type="text" class="w200"/>
            <span></span>
            <p class="emphasis">店铺名称注册后不可修改，请认真填写。</p></td>
        </tr>
        <tr>
          <th><i>*</i>店铺等级：</th>
          <td><select name="sg_id" id="sg_id">
              <option value="">请选择</option>
              <?php if(!empty($output['grade_list']) && is_array($output['grade_list'])){ ?>
              <?php foreach($output['grade_list'] as $k => $v){ ?>
              <?php $goods_limit = empty($v['sg_goods_limit'])?'不限':$v['sg_goods_limit'];?>
              <?php $explain = '商品数：'.$goods_limit.' 模板数：'.$v['sg_template_number'].' 收费标准：'.$v['sg_price'].' 元/年 附加功能：'.$v['function_str'];?>
              <option value="<?php echo $v['sg_id'];?>"><?php echo $v['sg_name'];?> (<?php echo $explain;?>)</option>
              <?php } ?>
              <?php } ?>
            </select>
            <span></span>
        </td>
        </tr>
        <tr>
          <th><i>*</i>开店时长：</th>
          <td><select name="joinin_year" id="joinin_year">
              <option value="1">1 年</option>
              <option value="2">2 年</option>
            </select></td>
        </tr>
        <tr>
          <th><i>*</i>店铺分类：</th>
          <td><select name="sc_id" id="sc_id">
              <option value="">请选择</option>
              <?php if(!empty($output['store_class']) && is_array($output['store_class'])){ ?>
              <?php foreach($output['store_class'] as $k => $v){ ?>
              <option value="<?php echo $v['sc_id'];?>"><?php echo $v['sc_name'];?> (保证金：<?php echo $v['sc_bail'];?> 元)</option>
              <?php } ?>
              <?php } ?>
            </select>
            <span></span>
            <p class="emphasis">请根据您所经营的内容认真选择店铺分类，注册后商家不可自行修改。</p></td>
        </tr>
        <tr>
          <th><i>*</i>服务区域：</th>
          <td><a href="###" id="btn_select_area" class="btn">+选择添加区域</a>
            <div id="garea" style="display:none;">
              <input id="service_area1" name="service_area1" type="hidden" value=""/>
              <input id="btn_add_service_area" type="button" value="确认" />
              <input id="btn_cancel_service_area" type="button" value="取消" />
            </div>
            <input type="hidden" value="" name="service_area" id="service_area">
            <span></span></td>
        </tr>
        <tr>
          <td colspan="2"><table border="0" cellpadding="0" cellspacing="0" id="table_area" class="type">
              <thead>
                <tr>
                  <th class="w120 tc">一级地区</th>
                  <th class="w120 tc">二级二区</th>
                  <th class="tc">三级地区</th>
                  <th class="w50 tc">操作</th>
                </tr>
              </thead>
            </table></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="20">&nbsp;</td>
        </tr>
      </tfoot>
    </table>
  </form>
  <div class="bottom"><a id="btn_apply_store_next" href="javascript:;" class="btn">提交申请</a>
  </div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script> 
<script type="text/javascript">
$(document).ready(function(){

  $('#service_area1').nc_region();

    jQuery.validator.addMethod("seller_name_exist", function(value, element, params) { 
        var result = true;
        $.ajax({  
            type:"GET",  
            url:'<?php echo urlMall('store_joinin', 'check_seller_name_exist');?>',  
            async:false,  
            data:{seller_name: $('#seller_name').val()},  
            success: function(data){  
                if(data == 'true') {
                    $.validator.messages.seller_name_exist = "卖家账号已存在";
                    result = false;
                }
            }  
        });  
        return result;
    }, '');

    $('#form_store_info').validate({
        errorPlacement: function(error, element){
            element.nextAll('span').first().after(error);
        },
        rules : {
            seller_name: {
                required: true,
                maxlength: 50,
                seller_name_exist: true
            },
            store_name: {
                required: true,
                maxlength: 50,
                remote : '<?php echo urlMall('store_joinin', 'checkname');?>'
            },
            sg_id: {
                required: true
            },
            sc_id: {
                required: true
            },
            service_area: {
                required: true,
                min: 1
            }
        },
        messages : {
            seller_name: {
                required: '请填写卖家用户名',
                maxlength: jQuery.validator.format("最多{0}个字")
            },
            store_name: {
                required: '请填写店铺名称',
                maxlength: jQuery.validator.format("最多{0}个字"),
                remote : '店铺名称已存在'
            },
            sg_id: {
                required: '请选择店铺等级'
            },
            sc_id: {
                required: '请选择店铺分类'
            },
            service_area: {
                required: '请选择服务区域',
                min: '请选择服务区域'
            }
        }
    });

    $('#btn_select_area').on('click', function() {
        $('#garea').show();
        $('#btn_select_area').hide();
        $('#garea select').val(0).nextAll("select").remove();
    });

    $('#btn_add_service_area').on('click', function() {
        var tr_area = '<tr class="service_area-item">';
        var area_id = '';
        var area_name = '';
        var area_count = 0;
        var validation = false;
        var i = 1;
        $('#garea').find('select').each(function() {
            if(parseInt($(this).val(), 10) > 0) {
                var name = $(this).find('option:selected').text();
                tr_area += '<td>';
                tr_area += name;
                tr_area += '</td>';
                area_id += $(this).val() + ',';
                area_name += name + ',';
                area_count++;
                validation=true;
            } 
            i++;
        });
        if(validation) {
            for(; area_count < 3; area_count++) {
                tr_area += '<td></td>';
            }
            tr_area += '<td><a nctype="btn_drop_area" href="javascript:;">删除</a></td>';
            tr_area += '<input name="service_area_ids[]" type="hidden" value="' + area_id + '" />';
            tr_area += '<input name="service_area_names[]" type="hidden" value="' + area_name + '" />';
            tr_area += '</tr>';
            $('#table_area').append(tr_area);
            $('#garea').hide();
            $('#btn_select_area').show();
            select_store_area_count();
        }
    });

    $('#table_area').on('click', '[nctype="btn_drop_area"]', function() {
        $(this).parent('td').parent('tr').remove();
        select_store_area_count();
    });

    // 统计已经选择的经营类目
    function select_store_area_count() {
        var store_area_count = $('#table_area').find('.service_area-item').length;
        $('#service_area').val(store_area_count);
    }

    $('#btn_cancel_service_area').on('click', function() {
        $('#garea').hide();
        $('#btn_select_area').show();
    });

    $('#btn_apply_store_next').on('click', function() {
        $('#form_store_info').submit();
    });
});
</script> 
