<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['shopwwi_set'];?></h3>
        <h5><?php echo $lang['shopwwi_set_subhead'];?></h5>
      </div>
      <?php echo $output['top_link'];?> </div>
  </div>
  <!-- 操作说明 -->
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
    <ul>
      <li>在这里可以设置网店运维开发的一些基本功能。</li>
    </ul>
  </div>
  <form method="post" enctype="multipart/form-data" name="form1">
    <input type="hidden" name="form_submit" value="ok" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="shopwwi_stitle"><?php echo $lang['shopwwi_stitle'];?></label>
        </dt>
        <dd class="opt">
          <input id="shopwwi_stitle" name="shopwwi_stitle" value="<?php echo $output['list_setting']['shopwwi_stitle'];?>" class="input-txt" type="text" />
          <p class="notic"><?php echo $lang['shopwwi_stitle_notice'];?></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="shopwwi_phone"><?php echo $lang['shopwwi_phone'];?></label>
        </dt>
        <dd class="opt">
          <input id="shopwwi_phone" name="shopwwi_phone" value="<?php echo $output['list_setting']['shopwwi_phone'];?>" class="input-txt" type="text" />
          <p class="notic"><?php echo $lang['shopwwi_phone_notice'];?></p>
        </dd>
      </dl>
            <dl class="row">
        <dt class="tit">
          <label for="shopwwi_time"><?php echo $lang['shopwwi_time'];?></label>
        </dt>
        <dd class="opt">
          <input id="shopwwi_time" name="shopwwi_time" value="<?php echo $output['list_setting']['shopwwi_time'];?>" class="input-txt" type="text" />
          <p class="notic"><?php echo $lang['shopwwi_time_notice'];?></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="shopwwi_default_city">默认城市</label>
        </dt>
        <dd class="opt">
          <input id="shopwwi_default_city" name="shopwwi_default_city" value="<?php echo $output['list_setting']['shopwwi_default_city'];?>" class="input-txt" type="text" />
          <p class="notic">请填写全站默认城市</p>
        </dd>
      </dl>
       <dl class="row">
        <dt class="tit">
          <label for="shopwwi_index_brand">首页推荐品牌</label>
        </dt>
        <dd class="opt">
          <input id="shopwwi_index_brand" name="shopwwi_index_brand" value="<?php echo $output['list_setting']['shopwwi_index_brand'];?>" class="input-txt" type="text" />
          <p class="notic">请填写品牌ID以（,）号分隔</p>
        </dd>
      </dl>
       <dl class="row">
        <dt class="tit">
          <label for="shopwwi_index_store">首页推荐店铺</label>
        </dt>
        <dd class="opt">
          <input id="shopwwi_index_store" name="shopwwi_index_store" value="<?php echo $output['list_setting']['shopwwi_index_store'];?>" class="input-txt" type="text" />
          <p class="notic">请填写店铺ID以（,）号分隔</p>
        </dd>
      </dl>
             <dl class="row">
        <dt class="tit">
          <label for="shopwwi_index_goods">首页推荐商品</label>
        </dt>
        <dd class="opt">
          <input id="shopwwi_index_goods" name="shopwwi_index_goods" value="<?php echo $output['list_setting']['shopwwi_index_goods'];?>" class="input-txt" type="text" />
          <p class="notic">请填写商品ID以（,）号分隔，上限5个</p>
        </dd>
      </dl>
       <dl class="row">
        <dt class="tit">
          <label for="shopwwi_invite2">二级佣金比</label>
        </dt>
        <dd class="opt">
          <input id="shopwwi_invite2" name="shopwwi_invite2" value="<?php echo $output['list_setting']['shopwwi_invite2'];?>" class="w60" type="text" /><i>%</i>
          <p class="notic">二级佣金=1级佣金*二级佣金比</p>
        </dd>
      </dl>
             <dl class="row">
        <dt class="tit">
          <label for="shopwwi_invite3">三级佣金比</label>
        </dt>
        <dd class="opt">
          <input id="shopwwi_invite3" name="shopwwi_invite3" value="<?php echo $output['list_setting']['shopwwi_invite3'];?>" class="w60" type="text" /><i>%</i>
          <p class="notic">三级佣金=1级佣金*三级佣金比</p>
        </dd>
      </dl>
       
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="document.form1.submit()"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>