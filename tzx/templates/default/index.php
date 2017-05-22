<?php defined('ByShopWWI') or exit('Access Invalid!');?>
<div class="tzx-content">
<?php 
$index_file = BASE_UPLOAD_PATH.DS.ATTACH_TZX.DS.'index_html'.DS.'index.html';
if(is_file($index_file)) {
    require($index_file);
}
?>
</div>
