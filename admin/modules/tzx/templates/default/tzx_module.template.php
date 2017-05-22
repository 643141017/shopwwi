<?php defined('ByShopWWI') or exit('Access Invalid!');?>
<div class="tzx-page-module-frame module-style-<?php echo "<?php echo \$value['module_style']?>";?>">
<div class="tzx-module-frame">
    <?php if($output['module_display_title']) { ?>
    <div class="tzx-module-frame-title">
        <?php require('tzx_module.assembly_title.php');?>
    </div>
    <?php } ?>
    <?php if(!empty($output['frame_structure']) && is_array($output['frame_structure'])) {?>
    <?php foreach ($output['frame_structure'] as $key=>$value) {?>
    <?php if(empty($value['child'])) { ?>
    <div nctype="tzx_module_content" class="tzx-module-frame-<?php echo $value['name'];?>">
        <?php if(!empty($output['frame_block'][$key])) { ?>
        <?php $block_name = $key;?>
        <?php require('tzx_module.assembly_'.$output['frame_block'][$key].'.php');?>
        <?php } ?>
    </div>
    <?php } else { ?>
    <div nctype="tzx_module_content" class="tzx-module-frame-<?php echo $value['name'];?>">
        <?php foreach($value['child'] as $key_child=>$value_child) { ?>
        <div class="tzx-module-frame-<?php echo $value_child['name'];?>">
            <?php if(!empty($output['frame_block'][$key_child])) { ?>
            <?php $block_name = $key_child;?>
            <?php require('tzx_module.assembly_'.$output['frame_block'][$key_child].'.php');?>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <?php } ?>
    <div class="clear"></div>
    <?php } ?>
</div>
</div>

