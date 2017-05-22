<?php defined('ByShopWWI') or exit('Access Invalid!');?>
<!-- 标题 -->
<div class="tzx-module-title">
    <h2 id="tzx_module_title" nctype="object_module_edit"><?php echo "<?php echo \$module_content['tzx_module_title'];?>";?></h2>
    <?php echo "<?php if(\$output['edit_flag']) { ?>";?>
    <div class="tzx-index-module-handle"><a nctype="btn_module_title_edit" href="JavaScript:void(0);" class="tip-r" title="<?php echo $lang['tzx_index_module_title_edit'];?>"><?php echo $lang['tzx_index_module_title_edit'];?></a></div>
    <?php echo "<?php } ?>";?>
</div>

