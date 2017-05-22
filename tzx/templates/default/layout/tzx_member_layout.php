<?php defined('ByShopWWI') or exit('Access Invalid!');?>
<?php require TZX_BASE_TPL_PATH.'/layout/top.php';?>
<style type="text/css">
.search-tzx { display: none !important;}
#topHeader .warp-all { height: 80px !important;}
#topHeader .tzx-logo { top: 8px !important;}
</style>


<div class="tzx-member-nav-bar"> 
  <!-- TZX用户中心导航 -->
  <ul class="tzx-member-nav">
    <li <?php echo $_GET['app']=='member_article'&&$_GET['wwi']!='article_edit'?' class="current"':'';?>><a href="<?php echo TZX_SITE_URL.DS;?>index.php?app=member_article&wwi=article_list" ><i class="a"></i><?php echo $lang['tzx_article_list'];?></a></li>
    <li <?php echo $_GET['wwi']=='publish_article'?' class="current"':'';?>><a href="<?php echo TZX_SITE_URL.DS;?>index.php?app=publish&wwi=publish_article"><i class="b"></i><?php echo $lang['tzx_article_publish'];?></a></li>
    <li <?php echo $_GET['app']=='member_picture'&&$_GET['wwi']!='picture_edit'?' class="current"':'';?>><a href="<?php echo TZX_SITE_URL.DS;?>index.php?app=member_picture&wwi=picture_list"><i class="c"></i><?php echo $lang['tzx_picture_list'];?></a></li>
    <li <?php echo $_GET['wwi']=='publish_picture'?' class="current"':'';?>><a href="<?php echo TZX_SITE_URL.DS;?>index.php?app=publish&wwi=publish_picture"><i class="d"></i><?php echo $lang['tzx_picture_publish'];?></a></li>
    <li><a href="<?php echo urlLogin('login', 'logout');?>"><i class="e"></i><?php echo $lang['tzx_loginout'];?></a></li>
  </ul></div>
  <?php require_once($tpl_file);?>

<?php require TZX_BASE_TPL_PATH.'/layout/footer.php';?>
