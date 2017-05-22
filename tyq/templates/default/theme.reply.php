<?php defined('ByShopWWI') or exit('Access Invalid!');?>
<link href="<?php echo TYQ_TEMPLATES_URL;?>/css/ubb.css" rel="stylesheet" type="text/css">
<div class="community-wrap">
	 <div class="community-main zoom" style="display: table;">
  <div class="theme-editor">
    <form method="post" id="reply_form1" action="<?php echo TYQ_SITE_URL;?>/index.php?app=theme&wwi=save_reply&type=adv&c_id=<?php echo $output['c_id'];?>&t_id=<?php echo $output['t_id'];?>">
    	<p class="wrap edtTit">RE:
              <?php if(!empty($output['answer'])){echo $lang['tyq_reply'].'&nbsp;'.$output['answer']['reply_id'].'&nbsp;'.$lang['tyq_floor'].'&nbsp;'.$output['answer']['member_name'].'&nbsp;'.$lang['tyq_of_reply'];}else{echo $output['theme_info']['theme_name'];}?>
 </p>
      <input type="hidden" name="form_submit" value="ok" />
      <?php if(!empty($output['answer'])){?>
      <input type="hidden" name="answer_id" value="<?php echo $output['answer']['reply_id'];?>" />
      <?php }?>
      <div class="quick-thread">
        <div class="quick-thread-box">
          <?php echo showMiniEditor('replycontent', '', 'all', $output['affix_list'], 'goods', array());?>
          <div class="bottom"> <a class="submit-btn" nctype="reply_submit" href="Javascript: void(0)"><?php echo $lang['nc_reply_theme'];?></a> <a class="cancel-btn" href="Javascript:history.go(-1);" nctype="theme_cancle"><?php echo $lang['nc_cancel'];?></a>
            <div id="warning"></div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<div style=" height:50px ;"></div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.iframe-transport.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.ui.widget.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.fileupload.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo TYQ_RESOURCE_SITE_URL;?>/js/miniditor/jquery.insertsome.min.js"></script> 
<script type="text/javascript" src="<?php echo TYQ_RESOURCE_SITE_URL;?>/js/miniditor/ubb.insert.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script> 
<script type="text/javascript">
var c_id = <?php echo $output['c_id'];?>;
var t_id = <?php echo $output['t_id'];?>;
$(function(){
	$('.theme-editor').ncUBB({
		c_id : c_id,
		t_id : t_id,
		UBBContent : $('#replycontent'),
		UBBSubmit : $('a[nctype="reply_submit"]'),
		UBBform : $('#reply_form1'),
		UBBfileuploadurl : 'index.php?app=theme&wwi=image_upload&c_id='+c_id+'&type=reply',
		UBBcontentleast : <?php echo intval(C('tyq_contentleast'));?>
	});
	//自定义滚定条
	$('#scrollbar').perfectScrollbar();
	// 表单验证
    $('#reply_form1').validate({
        errorLabelContainer: $('#warning'),
        invalidHandler: function(form, validator) {
               $('#warning').show();
        },
    	submitHandler:function(form){
    		ajaxpost('reply_form1', TYQ_SITE_URL+'/index.php?app=theme&wwi=save_reply&c_id='+c_id+'&t_id='+t_id, '', 'onerror');
    	},
        rules : {
        	replycontent : {
                required : true
                <?php if(intval(C('tyq_contentleast')) > 0){?>
                ,minlength : <?php echo intval(C('tyq_contentleast'));?>
                <?php }?>
            }
        },
        messages : {
        	replycontent  : {
                required : '<?php echo $lang['nc_content_not_null'];?>'
                <?php if(intval(C('tyq_contentleast')) > 0){?>
                ,minlength : '<?php printf(L('nc_content_min_length'), intval(C('tyq_contentleast')));?>'
                <?php }?>
            }
        }
    });
});
</script>
