<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['nc_tzx_manage'];?></h3>
        <h5><?php echo $lang['nc_tzx_manage_subhead'];?></h5>
      </div>
    </div>
  </div>
  <form id="add_form" method="post" enctype="multipart/form-data" action="index.php?app=tzx_manage&wwi=tzx_manage_save">
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="tzx_isuse"><?php echo $lang['tzx_isuse'];?></label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="tzx_isuse_1" class="cb-enable <?php if($output['setting']['tzx_isuse'] == '1'){ ?>selected<?php } ?>" title="<?php echo $lang['nc_open'];?>"><?php echo $lang['nc_open'];?></label>
            <label for="tzx_isuse_0" class="cb-disable <?php if($output['setting']['tzx_isuse'] == '0'){ ?>selected<?php } ?>" title="<?php echo $lang['nc_close'];?>"><?php echo $lang['nc_close'];?></label>
            <input type="radio" id="tzx_isuse_1" name="tzx_isuse" value="1" <?php echo $output['setting']['tzx_isuse']==1?'checked=checked':''; ?>>
            <input type="radio" id="tzx_isuse_0" name="tzx_isuse" value="0" <?php echo $output['setting']['tzx_isuse']==0?'checked=checked':''; ?>>
          </div>
          <p class="notic"><?php echo $lang['tzx_isuse_explain'];?></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="class_image"><?php echo $lang['nc_tzx'].'LOGO';?></label>
        </dt>
        <dd class="opt">
          <div class="input-file-show"><span class="show">
            <?php if(empty($output['setting']['tzx_logo'])) { ?>
            <a class="nyroModal" rel="gal" href="<?php echo UPLOAD_SITE_URL.DS.ATTACH_TZX.DS.'tzx_default_logo.png';?>"> <i class="fa fa-picture-o" onMouseOver="toolTip('<img src=<?php echo UPLOAD_SITE_URL.DS.ATTACH_TZX.DS.'tzx_default_logo.png';?>>')" onMouseOut="toolTip()"></i></a>
            <?php } else { ?>
            <a class="nyroModal" rel="gal" href="<?php echo UPLOAD_SITE_URL.DS.ATTACH_TZX.DS.$output['setting']['tzx_logo'];?>"> <i class="fa fa-picture-o" onMouseOver="toolTip('<img src=<?php echo UPLOAD_SITE_URL.DS.ATTACH_TZX.DS.$output['setting']['tzx_logo'];?>>')" onMouseOut="toolTip()"></i> </a>
            <?php } ?>
            </span><span class="type-file-box">
            <input class="type-file-file" id="tzx_logo" name="tzx_logo" type="file" size="30" hidefocus="true" nc_type="tzx_image" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
            </span></div>
          <p class="notic"><?php echo $lang['tzx_logo_explain'];?></p>
        </dd>
      </dl>
      <!-- 投稿需要审核 -->
      <dl class="row">
        <dt class="tit">
          <label for="taobao_app_key"><?php echo $lang['tzx_submit_verify'];?></label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="tzx_submit_verify_flag_1" class="cb-enable <?php if($output['setting']['tzx_submit_verify_flag'] == '1'){ ?>selected<?php } ?>" title="<?php echo $lang['nc_open'];?>"><?php echo $lang['nc_open'];?></label>
            <label for="tzx_submit_verify_flag_0" class="cb-disable <?php if($output['setting']['tzx_submit_verify_flag'] == '0'){ ?>selected<?php } ?>" title="<?php echo $lang['nc_close'];?>"><?php echo $lang['nc_close'];?></label>
            <input type="radio" id="tzx_submit_verify_flag_1" name="tzx_submit_verify_flag" value="1" <?php echo $output['setting']['tzx_submit_verify_flag']==1?'checked=checked':''; ?>>
            <input type="radio" id="tzx_submit_verify_flag_0" name="tzx_submit_verify_flag" value="0" <?php echo $output['setting']['tzx_submit_verify_flag']==0?'checked=checked':''; ?>>
          </div>
          <p class="notic"><?php echo $lang['tzx_submit_verify_explain'];?></p>
        </dd>
      </dl>
      <!-- 允许评论 -->
      <dl class="row">
        <dt class="tit">
          <label for="taobao_app_key"><?php echo $lang['tzx_comment_allow'];?></label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="tzx_comment_flag_1" class="cb-enable <?php if($output['setting']['tzx_comment_flag'] == '1'){ ?>selected<?php } ?>" title="<?php echo $lang['nc_open'];?>"><?php echo $lang['nc_open'];?></label>
            <label for="tzx_comment_flag_0" class="cb-disable <?php if($output['setting']['tzx_comment_flag'] == '0'){ ?>selected<?php } ?>" title="<?php echo $lang['nc_close'];?>"><?php echo $lang['nc_close'];?></label>
            <input type="radio" id="tzx_comment_flag_1" name="tzx_comment_flag" value="1" <?php echo $output['setting']['tzx_comment_flag']==1?'checked=checked':''; ?>>
            <input type="radio" id="tzx_comment_flag_0" name="tzx_comment_flag" value="0" <?php echo $output['setting']['tzx_comment_flag']==0?'checked=checked':''; ?>>
          </div>
          <p class="notic"><?php echo $lang['tzx_comment_allow_explain'];?></p>
        </dd>
      </dl>
      <!-- 允许心情 -->
      <dl class="row">
        <dt class="tit">
          <label for="taobao_app_key"><?php echo $lang['tzx_attitude_allow'];?></label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="tzx_attitude_flag_1" class="cb-enable <?php if($output['setting']['tzx_attitude_flag'] == '1'){ ?>selected<?php } ?>" title="<?php echo $lang['nc_open'];?>"><?php echo $lang['nc_open'];?></label>
            <label for="tzx_attitude_flag_0" class="cb-disable <?php if($output['setting']['tzx_attitude_flag'] == '0'){ ?>selected<?php } ?>" title="<?php echo $lang['nc_close'];?>"><?php echo $lang['nc_close'];?></label>
            <input type="radio" id="tzx_attitude_flag_1" name="tzx_attitude_flag" value="1" <?php echo $output['setting']['tzx_attitude_flag']==1?'checked=checked':''; ?>>
            <input type="radio" id="tzx_attitude_flag_0" name="tzx_attitude_flag" value="0" <?php echo $output['setting']['tzx_attitude_flag']==0?'checked=checked':''; ?>>
          </div>
          <p class="notic"><?php echo $lang['tzx_attitude_allow_explain'];?></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="tzx_seo_title"><?php echo $lang['tzx_seo_title'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['setting']['tzx_seo_title'];?>" name="tzx_seo_title" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="tzx_seo_keywords"><?php echo $lang['tzx_seo_keywords'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['setting']['tzx_seo_keywords'];?>" name="tzx_seo_keywords" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="tzx_seo_description"><?php echo $lang['tzx_seo_description'];?></label>
        </dt>
        <dd class="opt">
          <textarea name="tzx_seo_description" class="tarea" rows="6"><?php echo $output['setting']['tzx_seo_description'];?></textarea>
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <div class="bot"><a id="submit" href="javascript:void(0)" class="ncap-btn-big ncap-btn-green"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo ADMIN_RESOURCE_URL;?>/js/jquery.nyroModal.js"></script>

<script type="text/javascript">
$(document).ready(function(){

    //文件上传
    var textButton1="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='选择上传...' class='type-file-button' />";
    $(textButton1).insertBefore("#tzx_logo");
    $("#tzx_store_banner").change(function(){
        $("#textfield3").val($("#tzx_logo").val());
    });
    $("input[nc_type='tzx_image']").live("change", function(){
        var src = getFullPath($(this)[0]);
        $(this).parent().prev().find('.low_source').attr('src',src);
        $(this).parent().find('input[class="type-file-text"]').val($(this).val());
    });

    $("input[nc_type='tzx_image']").live("change", function(){
        var src = getFullPath($(this)[0]);
        $(this).parent().prev().find('.low_source').attr('src',src);
        $(this).parent().find('input[class="type-file-text"]').val($(this).val());
    });

    $("#submit").click(function(){
        $("#add_form").submit();
    });
	// 点击查看图片
	$('.nyroModal').nyroModal();
});
</script> 
