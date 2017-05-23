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
          <label for="ssg_discount"><?php echo $lang['supplier_store_grade_discount'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['grade_array']['ssg_discount'];?>" id="ssg_discount" name="ssg_discount" class="input-txt">
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
            ssg_discount : {
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
            ssg_discount : {
                required  : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['supplier_store_grade_discount_no_null'];?>',
                number : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['supplier_store_grade_standard_no_null'];?>',
                min : '<i class="fa fa-exclamation-tyq"></i><?php echo $lang['supplier_store_grade_standard_no_null'];?>'
            },
        }
    });
});
</script> 
