<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?app=supplier_store_grade&wwi=store_grade" title="返回列表"><i class="fa fa-arrow-tyq-o-left"></i></a>
      <div class="subject">
        <h3><?php echo $lang['supplier_store_grade'];?> - 编辑“<?php echo $output['grade_array']['ssg_name'];?>”选项</h3>
        <h5><?php echo $lang['supplier_store_grade_subhead'];?></h5>
      </div>
    </div>
  </div>
  <form id="grade_form" method="post">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="ssg_id" value="<?php echo $output['grade_array']['ssg_id'];?>" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="ssg_name"><em>*</em><?php echo $lang['supplier_store_grade_name'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['grade_array']['ssg_name'];?>" id="ssg_name" name="ssg_name" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="ssg_market_operator"><em>*</em><?php echo $lang['supplier_store_grade_market_operator'];?></label>
        </dt>
        <dd class="opt">
          <select name="ssg_market_operator">
             <option value="1" <?php if ($output['grade_array']['ssg_market_operator']==1) echo "selected"?>><?php echo $lang['supplier_store_grade_operator_cheng'];?></option>
             <option value="2" <?php if ($output['grade_array']['ssg_market_operator']==2) echo "selected"?>><?php echo $lang['supplier_store_grade_operator_chu'];?></option>
             <option value="3" <?php if ($output['grade_array']['ssg_market_operator']==3) echo "selected"?>><?php echo $lang['supplier_store_grade_operator_jia'];?></option>
             <option value="4" <?php if ($output['grade_array']['ssg_market_operator']==4) echo "selected"?>><?php echo $lang['supplier_store_grade_operator_jian'];?></option>
           </select>
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="ssg_market_discount"><?php echo $lang['supplier_store_grade_market_discount'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['grade_array']['ssg_market_discount'];?>" id="ssg_market_discount" name="ssg_market_discount" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="ssg_mall_operator"><em>*</em><?php echo $lang['supplier_store_grade_mall_operator'];?></label>
        </dt>
        <dd class="opt">
          <select name="ssg_mall_operator">
             <option value="1" <?php if ($output['grade_array']['ssg_mall_operator']==1) echo "selected"?>><?php echo $lang['supplier_store_grade_operator_cheng'];?></option>
             <option value="2" <?php if ($output['grade_array']['ssg_mall_operator']==2) echo "selected"?>><?php echo $lang['supplier_store_grade_operator_chu'];?></option>
             <option value="3" <?php if ($output['grade_array']['ssg_mall_operator']==3) echo "selected"?>><?php echo $lang['supplier_store_grade_operator_jia'];?></option>
             <option value="4" <?php if ($output['grade_array']['ssg_mall_operator']==4) echo "selected"?>><?php echo $lang['supplier_store_grade_operator_jian'];?></option>
           </select>
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>

      <dl class="row">
        <dt class="tit">
          <label for="ssg_mall_discount"><em>*</em><?php echo $lang['supplier_store_grade_mall_discount'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['grade_array']['ssg_mall_discount'];?>" id="ssg_mall_discount" name="ssg_mall_discount" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#grade_form").valid()){
     $("#grade_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#grade_form').validate({
        errorPlacement: function(error, element){
			var error_td = element.parent('dd').children('span.err');
            error_td.append(error);
        },

        rules : {
            ssg_name : {
                required : true,
                remote   : {
                url :'index.php?app=supplier_store_grade&wwi=ajax&branch=check_grade_name',
                type:'get',
                data:{
                        ssg_name : function(){
                        	return $('#ssg_name').val();
                        },
                        ssg_id  : '<?php echo $output['grade_array']['ssg_id'];?>'
                    }
                }
            },
            ssg_market_discount : {
                required  : true,
                number : true,
                min : 0
            },
            ssg_mall_discount : {
                required  : true,
                number : true,
                min : 0
            },
        },
        messages : {
            ssg_name : {
                required : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['supplier_store_grade_name_no_null'];?>',
                remote   : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['now_supplier_store_grade_name_is_there'];?>'
            },
            ssg_market_discount : {
                required  : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['supplier_store_grade_discount_no_null'];?>',
                number : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['supplier_store_grade_standard_no_null'];?>',
                min : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['supplier_store_grade_standard_no_null'];?>'
            },
            ssg_mall_discount : {
                required  : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['supplier_store_grade_discount_no_null'];?>',
                number : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['supplier_store_grade_standard_no_null'];?>',
                min : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['supplier_store_grade_standard_no_null'];?>'
            },
        }
    });
});
</script> 
