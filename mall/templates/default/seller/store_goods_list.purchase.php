<?php defined('ByShopWWI') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<form method="get" action="index.php">
  <table class="search-form">
    <input type="hidden" name="app" value="store_goods_purchase" />
    <input type="hidden" name="wwi" value="index" />
    <tr>
      <td>&nbsp;</td>
      <th>
        <select name="search_type">
          <option value="0" <?php if ($_GET['type'] == 0) {?>selected="selected"<?php }?>><?php echo $lang['store_goods_index_goods_name'];?></option>
        </select>
      </th>
      <td class="w160"><input type="text" class="text" name="keyword" value="<?php echo $_GET['keyword']; ?>"/></td>
      <td class="tc w70"><label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>" /></label></td>
    </tr>
  </table>
</form>
<table class="wwist-default-table">
  <thead>
    <tr nc_type="table_header">
      <th class="w30"></th>
      <th class="w50"></th>
      <th><?php echo $lang['store_goods_index_goods_name'];?></th>
      <th class="w100">采购<?php echo $lang['store_goods_index_price'];?></th>
      <th class="w100"><?php echo $lang['store_goods_index_stock'];?></th>
      <th class="w100"><?php echo $lang['nc_handle'];?></th>
    </tr>
    <?php  if (!empty($output['goods_list'])) { ?>
    <tr>
      <td class="tc"><input type="checkbox" id="all" class="checkall"/></td>
      <td colspan="10"><label for="all"><?php echo $lang['nc_select_all'];?></label>
        
    </tr>
    <?php } ?>
  </thead>
  <tbody>
    <?php if (!empty($output['goods_list'])) { ?>
    <?php foreach ($output['goods_list'] as $val) { ?>
    <tr>
      <th class="tc"><input type="checkbox" class="checkitem tc" value="<?php echo $val['goods_commonid']; ?>"/></th>
      <th colspan="20">SPU：<?php echo $val['goods_commonid'];?></th>
    </tr>
    <tr>
      <td class="trigger"></td>
      <td><div class="pic-thumb">
        <a href="<?php echo urlMall('goods', 'index', array('goods_id' => $output['storage_array'][$val['goods_commonid']]['goods_id']));?>" target="_blank"><img src="<?php echo thumb($val, 60);?>"/></a></div></td>
      <td class="tl"><dl class="goods-name">
          <dt style="max-width: 450px !important;">
            <a href="<?php echo urlMall('goods', 'index', array('goods_id' => $val['goods_id']));?>" target="_blank"><?php echo $val['goods_name']; ?></a></dt>
          <dd><?php echo $lang['store_goods_index_goods_no'].$lang['nc_colon'];?><?php echo $val['goods_serial'];?></dd>
        </dl></td>
      <td><span><?php echo $lang['currency'].ncPriceFormat($val['goods_price']); ?></span></td>
      <td><span><?php echo $val['g_storage']. $lang['piece']; ?></span></td>
      <td class="nscs-table-handle">
        <span>
        	<a href="javascript:void(0)"  nctype="add_cart" src="<?php echo $val['goods_image'];?>" data-gid="<?php echo $val['goods_id'];?>" class="btn-bluejeans"><i class="icon-mallping-cart"></i><p>加入购物车</p></a>
    	</span> 
    </td>
    </tr>
    <tr style="display:none;"><td colspan="20"><div class="wwist-goods-sku ps-container"></div></td></tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
    </tr>
    <?php } ?>
  </tbody>
    <?php  if (!empty($output['goods_list'])) { ?>
  <tfoot>
    <tr>
      <th class="tc"><input type="checkbox" id="all2" class="checkall"/></th>
      <th colspan="10"><label for="all2"><?php echo $lang['nc_select_all'];?></label>
    </tr>
    <tr>
      <td colspan="20"><div class="pagination"> <?php echo $output['show_page']; ?> </div></td>
    </tr>
  </tfoot>
  <?php } ?>
</table>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.poshytip.min.js"></script>
<script src="<?php echo MALL_RESOURCE_SITE_URL;?>/js/store_goods_list.js"></script> 
<script>
$(function(){
    //Ajax提示
    $('.tip').poshytip({
        className: 'tip-yellowsimple',
        showTimeout: 1,
        alignTo: 'target',
        alignX: 'center',
        alignY: 'top',
        offsetY: 5,
        allowTipHover: false
    });


    // 加入购物车

    $('a[nctype="add_cart"]').click(function() {
   	   var data_gid = $(this).attr('data-gid');
       addcart(data_gid,1,'');
    }); 
});
</script>