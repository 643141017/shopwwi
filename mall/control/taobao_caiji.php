<?php
/**
 * @网店运维提供技术支持 授权请购买shopwwi授权
 * @license    http://www.shopwwi.com
 * @link       交流群号：111731672
 * */


defined('ByShopWWI') or exit ('Access Invalid!');
class taobao_caijiControl extends BaseSellerControl{
//采集输出样式
	private function checkStore(){
        if(!checkPlatformStore()){
            // 是否到达商品数上限
            $goods_num = Model('goods')->getGoodsCommonCount(array('store_id' => $_SESSION['store_id']));
            if (intval($this->store_grade['sg_goods_limit']) != 0) {
                if ($goods_num >= $this->store_grade['sg_goods_limit']) {
                    showMessage(L('store_goods_index_goods_limit') . $this->store_grade['sg_goods_limit'] . L('store_goods_index_goods_limit1'), 'index.php?app=store_goods&wwi=goods_list', 'html', 'error');
                }
            }
        }
    }
     public function indexWwi(){
	         require_once(BASE_RESOURCE_PATH.DS.'phpqrcode'.DS.'index.php');
        $PhpQRCode = new PhpQRCode();
        $PhpQRCode->set('pngTempDir',BASE_UPLOAD_PATH.DS.ATTACH_STORE.DS.$_SESSION['store_id'].DS);
     $model_goods = Model('goods');
	 
		$this->othersWwi();
		exit;
	}
	    public function __construct() {
        parent::__construct();
        Language::read('member_store_goods_index');
    }

    public function othersWwi(){
  // 实例化商品分类模型
        $model_goodsclass = Model('goods_class');

        // 商品分类
        $goods_class = $model_goodsclass->getGoodsClass($_SESSION['store_id']);

        // 常用商品分类
        $model_staple = Model('goods_class_staple');
        $param_array = array();
        $param_array['member_id'] = $_SESSION['member_id'];
        $staple_array = $model_staple->getStapleList($param_array);
        self::profile_menu('others','others');
        Tpl::output('staple_array', $staple_array);
        Tpl::output('goods_class', $goods_class);
        Tpl::showpage('store_goods_taobao.step1');
		
	}
    public function others2Wwi(){
	                // 实例化店铺商品分类模型
        $store_goods_class = Model('store_goods_class')->getClassTree(array('store_id' => $_SESSION ['store_id'], 'stc_state' => '1'));
        Tpl::output('store_goods_class', $store_goods_class);
	    $good_cat_id = $_GET['class_id'];
		self::profile_menu('others','others');
		Tpl::output('good_cat_id', $good_cat_id);
		Tpl::showpage('store_goods_others');
	}
    public function batchcoWwi(){
  // 实例化商品分类模型
        $model_goodsclass = Model('goods_class');

        // 商品分类
        $goods_class = $model_goodsclass->getGoodsClass($_SESSION['store_id']);

        // 常用商品分类
        $model_staple = Model('goods_class_staple');
        $param_array = array();
        $param_array['member_id'] = $_SESSION['member_id'];
        $staple_array = $model_staple->getStapleList($param_array);
        self::profile_menu('batchco','batchco');
        Tpl::output('staple_array', $staple_array);
        Tpl::output('goods_class', $goods_class);
		Tpl::showpage('store_goods_taobao.step2');
	}
    public function malldataWwi(){
  // 实例化商品分类模型
        $model_goodsclass = Model('goods_class');

        // 商品分类
        $goods_class = $model_goodsclass->getGoodsClass($_SESSION['store_id']);

        // 常用商品分类
        $model_staple = Model('goods_class_staple');
        $param_array = array();
        $param_array['member_id'] = $_SESSION['member_id'];
        $staple_array = $model_staple->getStapleList($param_array);
        self::profile_menu('malldata','malldata');
        Tpl::output('staple_array', $staple_array);
        Tpl::output('goods_class', $goods_class);
		Tpl::showpage('store_goods_taobao.step3');
	}
	
static $heads='<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<style type="text/css">
body{ padding:5px 0; background:#FFF; text-align:center; width:80%;min-width:400px;background: #F5F5F5;}
body, td, input, textarea, select, button{ color:#666; font:12px/1.5 Verdana, Tahoma, Arial, "Microsoft Yahei", "Simsun", sans-serif; }
.container{ overflow:hidden; margin:0 auto; width:700px; height:auto !important;text-align:left; border:1px solid #B5CFD9; }
.main{ padding:20px 20px 0; background:#F7FBFE url(bg_repx.gif) repeat-x 0 -194px; }
.main h3{ margin:10px auto; width:75%; color:#6CA1B4; font-weight:700; }
#notice {overflow-y:scroll; margin: 20px; padding: 5px 20px; border: 1px solid #B5CFD9; text-align: left; background: #fff;height:70%;}
#notice img{margin: 5px 0 0;width:30px; height:30px; border: 2px solid #ccc;vertical-align: bottom; }
#notice .yuantu{width:34px; height:16px; border:none;vertical-align: bottom; }
#notice a{color: #666;}
#notice a:hover{color: #FF6600;}
.hide{display:none}
.cj_green{color:#009900;}
.cj_purple{color:#ffoocc;}
.cj_red{color:#FF0000;}
.cj_bulue{color:#0033FF;}
.cj_cn{color:#FF00FF;}
.cj_hui{color:#999;}
.cj_fanyi{color:#009900;}
.cj_black{color:#000;}
.cj_over1{color:#000;}
.cj_over{color:#FF0000;}
</style>
<meta name="Copyright" content="Comsenz Inc.">
</head>
<body>
<script type="text/javascript">
function showmessage(message,ext) {
    document.getElementById("notice1").innerHTML += message + "<br/>";
	if (ext==1){
			document.getElementById("zload").innerHTML="";
    }
	document.getElementById("notice").scrollTop = 100000000;
}
</script><br />
<div id="notice">
<div id="notice1"></div>
</div>';
    public function otherscolectWwi(){
	$stime=time()+microtime();
    $keyword = trim($_REQUEST['keyword']); 
	$cat_id =  (int)$_REQUEST['cat_id'];
	self::flush_echo(self::$heads);//打印网页头
	self::showjsmessage('<font class="cj_purple"> SHOPWWI淘宝采集 </font>');	
	self::showjsmessage('正在准备采集...');//输出信息	
	
	$flg = 0;

	$all_goods_sn=false;//获取所有商品货号

	if (!$all_goods_sn)
	{$all_goods_sn[0]=0;}
		$keyword=str_replace("_id","",$keyword)	;
      if(preg_match_all('/id=(\d{8}\d+)/',$keyword,$r)) {//判断输入的是链接，含有ID
			$arry[] = $r[1];
			$iids=array_values(array_flip(array_flip($arry[0]))); //移除数组中的重复的值
			if (empty($all_goods_sn)){$all_goods_sn[0]='000000';} //没有商品时加一个假ID
			$iids_Repeat=array_intersect($iids,$all_goods_sn);//获得货号和ID交集,得知重复的商品ID
			foreach((array)$iids_Repeat as $key=>$value)
			{
				showjsmessage('<font  class="cj_red">['.$value.']商品已存在,跳过！</font>');
			}
			$coiids=array_values(array_diff($iids,$all_goods_sn));//获得货号和ID差集，检查是否商品重复
	
		 }
//		  print_r($coiids);
//		  exit;
		  $goods_sl = count($coiids);
		  if($goods_sl == 0)
		  {		self::showjsmessage('<br>没有符合采集的数据！');
		  		exit;			  
			}
		self::showjsmessage('开始采集'.$goods_sl.'条数据');			  
		$flag  = 0;
		for($i=0;$i<$goods_sl;$i++){
				
			 $coiids[$i] = trim($coiids[$i]);
			 @set_time_limit(0);
			 $data['num_iid'] = $coiids[$i];
			 $data['goods_url']	= '';
			 $data['cat_id']	= $cat_id;
			 $data['mall_url'] = '';
			 $data['commission_rate'] = 0;	 
			 if($ratetag) {
			 	$data['ratenum'] = rand(10,50); }
			 else{
			 	$data['ratenum'] = 0;
			 }
			 
		 			 $tag = self::all_s_colect($data);

			$flag +=1; 
			 
			if($tag) 
				self::showjsmessage('<font  class="cj_green">[ID]&nbsp;&nbsp;'. $flag .':&nbsp;&nbsp;' . $coiids[$i] . '</font>&nbsp;&nbsp;[<font  class="cj_black">'.$tag['title'].']</font>... 成功');
			else
			{
				self::showjsmessage('<font  class="cj_green">[ID]&nbsp;&nbsp;'. $flag .'.&nbsp;&nbsp;' . $coiids[$i] . '</font>... <font  class="cj_red">失败</font>');
			   $erro++;
			   if ($erro>1)
			   {
				   self::showjsmessage('<font  class="cj_red">采集终止</font>');
				   exit;
			   }
			 }
			
		}
			
		if(empty($flg)){$flg = $goods_sl;}
		unset($buffer);
		unset($tb_data);
		$pass_time=self::cj_timer($stime);
		self::showjsmessage( '<br><font class="cj_over"><strong>['. $goods_sl. ']</strong>条数据采集完成！</font>(用时：'.$pass_time.'秒)<br>');
		self::showjsmessage( '进入<a href="index.php?app=store_goods_online&wwi=index">商品列表</a>',1);
	    // $link[] = array('href' => 'goods.php?app=list', 'text' => "进入商品列表");
   		// sys_msg($flg."条数据采集完成！", 1, $link);
	
}

public function batchco2Wwi(){
	                // 实例化店铺商品分类模型
$store_goods_class = Model('store_goods_class')->getClassTree(array('store_id' => $_SESSION ['store_id'], 'stc_state' => '1'));
Tpl::output('store_goods_class', $store_goods_class);
$good_cat_id = $_GET['class_id'];
Tpl::output('good_cat_id', $good_cat_id);
self::profile_menu('batchco','batchco');
Tpl::showpage('store_goods_batchco');
}
/*批量ID采集*/
public function getbatchcoWwi()
{
	$stime=time()+microtime();
	self::flush_echo(self::$heads);//打印网页头
	self::showjsmessage('<font class="cj_purple">SHOPWWI淘宝采集 </font>');	
	self::showjsmessage('正在准备采集...');			  
	$batchcontent =$_REQUEST['content'];
	$cat_id =  (int)$_POST['cat_id'];
	$iids = array();
		
		$batchcontent=str_replace("_id","",$batchcontent)	;
        if(preg_match_all('/id=(\d{8}\d+)/',$batchcontent,$r))//判断输入的是链接，含有ID
		{
			$arry[] = $r[1];
			$iids=array_values(array_flip(array_flip($arry[0]))); //移除数组中的重复的值
	
		}
		else
		{
			//分割输入的内容
			if(is_int(strpos($batchcontent,','))){
			
				$iids = explode(',',$batchcontent);
			
			}
			elseif(is_int(strpos($batchcontent,';'))){
				
				$iids = explode(';',$batchcontent);
			
			}
			else {
				$batchcontent = preg_replace('/\s+/', ',', $batchcontent);
				$iids = explode(',',$batchcontent);
			}
		}


//print_r($iids);

		
		
		$iidarr = array_filter($iids);
		self::showjsmessage('正在批量ID采集[<strong>' . count($iidarr) . 
		'</strong>]条数据...');			  
		$flag = 0;
		for($i=0; $i<count($iidarr); $i++){

				
			 @set_time_limit(0);
			 $data['num_iid'] = $iidarr[$i];
			 $data['goods_url']	= '';
			 $data['mall_url'] = '';
			 $data['commission_rate'] = 0;
             $data['cat_id']	= $cat_id;
	 			 $tag = self::all_s_colect($data);
			
			$flag +=1; 
			 
			if($tag) {
				self::showjsmessage('<font  class="cj_green">[ID]&nbsp;&nbsp;'. $flag .'.&nbsp;&nbsp;' . $iidarr[$i] . '</font>&nbsp;&nbsp;[<font  class="cj_black">'.$tag['title'].']</font>... 成功');
				}
			else
			{
				self::showjsmessage('<font  class="cj_green">[ID]&nbsp;&nbsp;'. $flag .'.&nbsp;&nbsp;' . $iidarr[$i] . '</font>... <font  class="cj_red">失败</font>');
			   $erro++;
			   if ($erro>1)
			   {
				   self::showjsmessage('<font  class="cj_red">采集终止</font>');
				   exit;
			   }
			  }
		
		}	

		$pass_time=self::cj_timer($stime);
		self::showjsmessage('<br><font class="cj_over"><strong>['. $flag . ']</strong>个商品采集完成！</font>(用时：'.$pass_time.'秒)<br>');	
		self::showjsmessage('进入<a href="index.php?app=store_goods_online&wwi=index">商品列表</a>',1);
		
}
//==================================店铺采集=============================================//
//=======================================================================================//
public function malldata2Wwi(){
	                // 实例化店铺商品分类模型
$store_goods_class = Model('store_goods_class')->getClassTree(array('store_id' => $_SESSION ['store_id'], 'stc_state' => '1'));
Tpl::output('store_goods_class', $store_goods_class);
$good_cat_id = $_GET['class_id'];
Tpl::output('good_cat_id', $good_cat_id);
self::profile_menu('malldata','malldata');
Tpl::showpage('store_goods_malldata');
}
/*店铺采集*/
public function getAlmmmallWwi()
{

    $stime=time()+microtime();
	self::flush_echo(self::$heads);//打印网页头
	self::showjsmessage('<font class="cj_purple"> SHOPWWI店铺采集</font>');	
	self::showjsmessage('正在准备采集....');		
	    $conum = (int)($_REQUEST['conum']);	  
		$batchcontent = trim($_POST['g_body']);
		$cat_id =  (int)$_POST['cat_id'];
		
		$iids = array();
		$batchcontent=str_replace("_id","",$batchcontent)	;
        if(preg_match_all('/item\.taobao\.com\/item\.htm\?id=(\d{8}\d+)/',$batchcontent,$r))//判断输入的是链接，含有ID
		{
			$arry[] = $r[1];
			$iids=array_values(array_flip(array_flip($arry[0]))); //移除数组中的重复的值
	
		}
		else
		{
			//分割输入的内容
			if(is_int(strpos($batchcontent,','))){
			
				$iids = explode(',',$batchcontent);
			
			}
			elseif(is_int(strpos($batchcontent,';'))){
				
				$iids = explode(';',$batchcontent);
			
			}
			else {
				$batchcontent = preg_replace('/\s+/', ',', $batchcontent);
				$iids = explode(',',$batchcontent);
			}
		}
//pr($iids,1);

        $iidsc = array_slice($iids, 0, $conum);   // returns "a", "b", and "c"

		$iidarr = array_filter($iidsc);
		
		self::showjsmessage('正在进行店铺采集[<strong>' . count($iidarr) . 
		'</strong>]条数据...');			  
		$flag = 0;
		for($i=0; $i<count($iidarr); $i++){
             @set_time_limit(0);
			 $data['num_iid'] = $iidarr[$i];
			 $data['goods_url']	= '';
			 $data['mall_url'] = '';
			 $data['commission_rate'] = 0;
			 $data['cat_id'] = $cat_id;
			 $tag = self::all_s_colect($data);
	  
			
			$flag +=1; 
			 
			if($tag) 
				self::showjsmessage('<font  class="cj_green">[ID]&nbsp;&nbsp;'. $flag .'.&nbsp;&nbsp;' . $iidarr[$i] . '</font>&nbsp;&nbsp;[<font  class="cj_black">'.$tag['title'].']</font>... 成功');
			else
			{
				self::showjsmessage('<font  class="cj_green">[ID]&nbsp;&nbsp;'. $flag .'.&nbsp;&nbsp;' . $iidarr[$i] . '</font>... <font  class="cj_red">失败</font>');
			   $erro++;
			   if ($erro>1)
			   {
				   self::showjsmessage('<font  class="cj_red">采集终止</font>');
				   exit;
			   }
			  }
		
		 }		

		$pass_time=self::cj_timer($stime);
		self::showjsmessage('<br><font class="cj_over"><strong>['. $flag . ']</strong>个商品采集完成！</font>(用时：'.$pass_time.'秒)<br>');	
		self::showjsmessage('进入<a href="index.php?app=store_goods_online&wwi=index">商品列表</a>',1);
}
//==================================采集设置=============================================//
//=======================================================================================//
public function tb_settingWwi(){
self::profile_menu('tb_setting','tb_setting');
Tpl::showpage('store_goods_tb_setting');
}





//==================================常规采集数据===========================================//	

public function all_s_colect($data) 
{
$model_store_goods	= Model('goods');
$model_goods = Model('goods');
// $host = $_SERVER['HTTP_HOST']; 
// $ip = $_SERVER['REMOTE_ADDR'];
// $client = $_SERVER['SERVER_NAME']; 
$host = "nc.ectouch.cc"; 
$ip = $_SERVER['REMOTE_ADDR'];
$client ="nc.ectouch.cc"; 
$iipp = self::get_client_ip();
$time =date('Y-m-d H:i:s');
$cat_id = $data['cat_id'] ? $data['cat_id']:1;
$goods_class = Model('goods_class')->getGoodsClassLineForTag(intval($cat_id));
		$market_price_rate = $data['market_price_rate'];
		$ratenum = $data['ratenum'];
		$price_change = $data['price_change'];
		$price_change1 = $data['price_change1'];
		$num_iid = $data['num_iid'];

		$goods_url = $data['goods_url'];
		$mall_url = $data['mall_url'];
		$commission_rate = $data['commission_rate'];
		$istbk = $data['istbk'];
		
		$not_sale = $data['not_sale'];
		$only_img = $data['only_img'];
		$not_brand = $data['not_brand'];
		$only_tbk = $data['only_tbk'];
		
        // $url = 'http://cj.ectouch.cc/huahua/huahua_tb_get.php?app=tb';
		// $res_json = self::get_curl_data($url,$num_iid);
		// $goods_detail = json_decode($res_json,true);
		
		//破解采集---------------------------------------------------------S-------------------------
			$url = 'http://cj.ectouch.cc/huahua/huahua_tb_get.php?app=tb';
			$data = array('id' =>$num_iid);
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$a = curl_exec($ch);
			curl_close($ch);
			$goods_detail = json_decode($a,true);
			//file_put_contents('kkkkkkkk-001.txt', var_export($goods_detail,true));
		//破解采集----------------------------------------------------------E------------------------	
		
		

      

$mall_price       = $goods_detail['price'];//原价
$nick             = $goods_detail['nick'];
$title            = $goods_detail['title'];
$picture          = $goods_detail['picture'];
$item['desc']     = $goods_detail['des'];
$sku              = $goods_detail['skus'];
$sku2             = $goods_detail['skus2'];
$pro              = $goods_detail['pro'];
$pro2             = $goods_detail['pro2'];
$props            = $goods_detail['props'];
$item['seller_id']= $goods_detail['tb_seller_id'];
$gallery          = $goods_detail['gallery'];
$mall_url         = $goods_detail['mall_url'];
$credit           = $goods_detail['credit'];
$istmall          = $goods_detail['istmall'];
$goods_brief      = $goods_detail['goods_brief'];
$mallname         = $goods_detail['mallname'];
$goods_number          = $goods_detail['goods_number'];//库存
$sellCount             = $goods_detail['sellCount'];//销量
$extraPromPrice        = $goods_detail['extraPromPrice'];//促销价
$location              = $goods_detail['location'];
$goods_sn = $goods_detail['goods_sn'];
$deliveryFees          = $goods_detail['deliveryFees'];


$price = $mall_price;
if($price){
$item['price'] = $price;}
$item['num_iid'] = $num_iid;
$item['goods_sn'] = $goods_sn;
$item['nick'] = $nick;
$item['title'] = $title;
$item['goods_brief'] = $goods_brief;
$market_price = $mall_price * $market_price_rate;
$item['is_taobao'] = 0;
$item['click_url'] = 'http://item.taobao.com/item.htm?id='.$num_iid;
if($mall_url){
$item['mall_click_url'] = $mall_url;}
else {
$item['mall_click_url'] = '';}
$item['mall_title'] = $mallname;
$item['goods_img'] = addslashes($picture .'_400x400.jpg');
$item['goods_thumb'] = addslashes($picture .'_300x300.jpg');
$item['original_img'] = addslashes($picture);
$item['item_location'] = $location;
$item['is_promote'] = 0;
$item['promote_price']=0;
$item['procotent']='零售';
$item['num'] = $goods_number;
$item['post_fee'] = $deliveryFees;
$item['express_fee'] = $deliveryFees;
$item['ems_fee'] = $deliveryFees;
$item['credit'] = $credit;
$item['goods_brief'] = $goods_brief;

$promote_price = $extraPromPrice;
if($promote_price>0)
{
$item['promote_price'] = $promote_price;
$item['promote_start_date'] = self::gmtime() -3600*24;
$item['promote_end_date'] = self::gmtime() +3600*24*360;
$item['is_promote'] = 1;
}
$item['volume'] =$sellCount;
$item['commission_rate'] = 0;
$item['commission'] = 0;
$item['commission_num'] = $istmall;
$item['commission_volume'] = (float)$item['commission_volume'];
$item['is_on_sale'] = 1;
if($not_sale == 1) {
$item['is_on_sale'] = 0;
}
$suppliers_id=0;
$item['nick']= $item['nick'];
$item['mall_title']= $item['mall_title'];
$goods_detail['is_shipping']==0;
$goods_type_id = $data['goods_type_id'];
$item['gc_id'] = $cat_id;
$item['gc_id1'] = intval($goods_class['gc_id_1']);
$item['gc_id2'] = intval($goods_class['gc_id_2']);
$item['gc_id3'] = intval($goods_class['gc_id_3']);
$item['cate_name'] = $goods_class['gc_tag_name'];
$item['goods_promotion_type'] = 0;
$item['goods_state'] = 1;
$item['goods_verify'] = 1;
$item['areaid_1'] = 1;
$item['areaid_2'] = 36;
$item['transport_id'] = 0;
$item['goods_freight'] = 0;
$item['goods_commend'] = 1;
$item['goods_stcids'] = ',0,';
$item['evaluation_good_star'] = 5;
$item['is_own_mall'] = 1;
  //查询店铺商品分类
 //查询店铺商品分类
            $goods_stcids_arr = array();
            if (!empty($_POST['sgcate_id'])){
                $sgcate_id_arr = array();
                foreach ($_POST['sgcate_id'] as $k=>$v){
                    $sgcate_id_arr[] = intval($v);
                }
                $sgcate_id_arr = array_unique($sgcate_id_arr);
                $store_goods_class = Model('store_goods_class')->getStoreGoodsClassList(array('store_id' => $_SESSION ['store_id'], 'stc_id' => array('in', $sgcate_id_arr), 'stc_state' => '1'));
                if (!empty($store_goods_class)){
                    foreach ($store_goods_class as $k=>$v){
                        if ($v['stc_id'] > 0){
                            $goods_stcids_arr[] = $v['stc_id'];
                        }
                        if ($v['stc_parent_id'] > 0){
                            $goods_stcids_arr[] = $v['stc_parent_id'];
                        }
                    }
                    $goods_stcids_arr = array_unique($goods_stcids_arr);
                    sort($goods_stcids_arr);
                }
            }
            if (empty($goods_stcids_arr)){
                $common_array['goods_stcids'] = '';
            } else {
                $common_array['goods_stcids'] = ','.implode(',',$goods_stcids_arr).',';// 首尾需要加,
            }
                               
			$param	= array();
					$param['goods_name']			= $item['title'];
					$param['gc_id']					= $item['gc_id'];
					$param['gc_id_1']				= $item['gc_id1'];
					$param['gc_id_2']				= $item['gc_id2'];
					$param['gc_id_3']				= $item['gc_id3'];
					$param['gc_name']				= $item['cate_name'];
					$param['spec_name']				= 'N;';
					$param['spec_value']		    = 'N;';
					$param['store_name']	        = $_SESSION['store_name'];
					$param['store_id']				= $_SESSION['store_id'];
					$param['type_id']				= '0';
					$param['goods_image']			= $item['goods_img'];
					$param['goods_marketprice']		= $mall_price;
					$param['goods_price']           = $item['price'];
					//$param['goods_show']			= '1';
					$param['goods_commend']			= $item['goods_commend'];
					$param['goods_addtime']		    = time();
					$param['goods_body']			= $item['desc'];
					$param['goods_state']			= $item['goods_state'];
					$param['goods_verify']			= $item['goods_verify'];
					$param['areaid_1']				= $item['areaid_1'];
					$param['areaid_2']			    = $item['areaid_2'];
					$param['goods_stcids']          = $common_array['goods_stcids'];
				    $param['goods_serial']	        = $item['goods_sn'];
					$param['is_taobao']	            = 1;
					$goods_id	= $model_store_goods->addGoodsCommon($param);
			        
					//添加库存
			        $param	= array();
				    $param['goods_commonid']        = $goods_id;
					$param['goods_name']			= $item['title'];
					$param['gc_id']					= $item['gc_id'];
					$param['store_id']				= $_SESSION['store_id'];
					$param['goods_image']			= $item['goods_img'];
					$param['goods_marketprice']		= $mall_price;
					$param['goods_price']           = $item['price'];
					//$param['goods_show']			= '1';
					$param['goods_commend']			= $item['goods_commend'];
					$param['goods_addtime']	    	=    time();
					$param['goods_state']			= $item['goods_state'];
					$param['goods_verify']			= $item['goods_verify'];
					$param['areaid_1']				= $item['areaid_1'];
					$param['areaid_2']			    = $item['areaid_2'];
				    $param['goods_stcids']          = $common_array['goods_stcids'];
					$param['goods_storage']     	= $item['num'];
					$param['goods_serial']	        = $item['goods_sn'];
					$param['gc_id_1']				= $item['gc_id1'];
					$param['gc_id_2']				= $item['gc_id2'];
					$param['gc_id_3']				= $item['gc_id3'];
					$param['goods_promotion_price'] = $item['price'];
					$param['color_id']              = $item['goods_sn'];
					$param['goods_spec']			= 'N;';
					$param['store_name']	        = $_SESSION['store_name'];
					$param['is_taobao']	        = 1;
			        $goods_id1=$model_store_goods->addGoods($param);
					
					//添加图片
                   $model_goods = Model('goods');
                    // 商品默认主图
                    $update_array = array();        // 更新商品主图
                    $update_where = array();
                    $update_array['goods_image']    = $gallery[0];
                    $update_where['goods_commonid'] = $param['goods_commonid'];
                    $update_where['color_id']       = 0;
                        // 更新商品主图

                        $model_goods->editGoods($update_array, $update_where);
                     $model_goods = Model('goods');
                      $insert_array = array();
            foreach ($gallery as $key => $v) {
                   if ($gallery== '') {
                        continue;
                    }
                    $tmp_insert = array();
                    $tmp_insert['goods_commonid']   = $param['goods_commonid'];
                    $tmp_insert['store_id']         = $param['store_id'];
                    $tmp_insert['color_id']         = $item['goods_sn'];
                    $tmp_insert['goods_image']      = $v;
                    $tmp_insert['goods_image_sort'] = 0;
					if(intval($key)==0){
                    $tmp_insert['is_default']       = 1;
					}
					else{
					$tmp_insert['is_default']       = 0;
					}
                    $insert_array[] = $tmp_insert;
         
            }
            $rs = $model_goods->addGoodsImagesAll($insert_array);
  

return $item;
}	
	
	
	
	
	
	
	
	
/*	
  public function save_image($gallery){
            $common_id = intval($_POST['commonid']);
            $model_goods = Model('goods');
                    // 商品默认主图
                    $update_array = array();        // 更新商品主图
                    $update_where = array();
                    $update_array['goods_image']    = $gallery[0];
                    $update_where['goods_commonid'] = $common_id;
                    $update_where['color_id']       = 0;
                        // 更新商品主图
                        $model_goods->editGoods($update_array, $update_where);
           $insert_array =array();
           foreach ($gallery as $key => $v) {					
                    $tmp_insert = array();
                    $tmp_insert['goods_commonid']   = $common_id;
                    $tmp_insert['store_id']         = $_SESSION['store_id'];
                    $tmp_insert['color_id']         = $key;
                    $tmp_insert['goods_image']      = $v;
                    $tmp_insert['goods_image_sort'] = 0;
					if($key=0){
                    $tmp_insert['is_default']       = 1;
					}
					$tmp_insert['is_default']       = 0;
                    $insert_array[] = $tmp_insert;
                }
 
            $rs = $model_goods->addGoodsImagesAll($insert_array);
           
        }
    }	
*/
public function Getimg_tolocal($r_img_url,$key,$local)
{
	if (!strpos($r_img_url,'ttp://')>0) //如果不是远程图片，返回nohttpimg
	{
//		pr($r_img_url,1);
		return "";
	}

	@set_time_limit(0);
	$imgurl = IMAGE_DIR."/".date('Ymd')."/" . $local;
	$imgpath = ROOT_PATH.$imgurl;
	$millisecond = date("YmdHms");
	if (!file_exists($imgpath))
	{
	  if (!make_dir($imgpath))
	  {
		echo("无法创建图片下载目录！");
		exit;
	  }
	}

   $img_rand = rand(1000,9999);
   $value = trim($r_img_url);
   $get_file = @file_get_contents($value);
   $rndfilename = $imgpath."/".$millisecond.$key . $img_rand .".".substr($value,-3,3);
   
   //$fileurl = "http://".$_SERVER['SERVER_NAME']."/".$imgurl."/".$millisecond.$key.".".substr($value,-3,3);

   $fileurl = $imgurl."/".$millisecond.$key. $img_rand . "." . substr($value,-3,3);

   if($get_file)
   {
       $fp = @fopen($rndfilename,"w");
       @fwrite($fp,$get_file);
       @fclose($fp);
   }
   
	return $fileurl;
}	
  /**
     * 保存商品颜色图片
     */
public function save_image(){
        
           
     

    }
	
public function cj_timer($stime)
{
	$etime=time()+microtime();
	$pass_time=sprintf("%.2f", $etime-$stime);//消耗时间
	return $pass_time;
}	
public function table($str)
    {
        return '`' .$this->db_name. '`.`'.$this->prefix.$str.'`';
    }	

	/**
	 * 打印页面
	 */  
public function flush_echo($data) {

	ob_end_flush();
	ob_implicit_flush(true);
	echo $data;


}	
public function get_curl_data($url,$num_iid)
{
// $host = $_SERVER['HTTP_HOST']; 
// $ip = $_SERVER['REMOTE_ADDR'];
// $client = $_SERVER['SERVER_NAME']; 

$host = "nc.ectouch.cc"; 
$ip =  "219.137.148.33"; 
$client ="nc.ectouch.cc"; 
$data = array('id' =>$num_iid,'host' => $host,'ip' => $ip,'client' => $client);
file_put_contents('8888-001.txt', var_export($data,true));  
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$a = curl_exec($ch);

curl_close($ch);
file_put_contents('8888-002.txt', var_export($a,true));
return $a;

}  
public function showjsmessage($message,$ext=0) {
//echo('showmessage(\''.addslashes($message).' \','.$ext.')');
//exit;
		self::flush_echo('
<script type="text/javascript">showmessage(\''.addslashes($message).'\','.$ext.');</script>
'."\r\n");
		
}	 
public function get_all_goods_sn()
{
	$count = $GLOBALS['db']->getAll('SELECT num_iid FROM ' .$GLOBALS['ecs']->table('goods'). ' where is_delete = 0 and num_iid <> "" ' );//获取所有货号
	foreach((array)$count as $key=>$value)
	{
		$all_goods_sn[$key]=$value['num_iid'];
	}
	if ($all_goods_sn)
	 	return $all_goods_sn;
	else
	 	return false;
	
	
}	 
public function get_client_ip() 
 { 
if ($_SERVER['REMOTE_ADDR']) { 
$cip = $_SERVER['REMOTE_ADDR']; 
} elseif (getenv("REMOTE_ADDR")) { 
$cip = getenv("REMOTE_ADDR"); 
} elseif (getenv("HTTP_CLIENT_IP")) { 
$cip = getenv("HTTP_CLIENT_IP"); 
} else { 
$cip = "unknown"; 
} 
return $cip; 
}	 
public function gmtime()
{
    return (time() - date('Z'));
}	 
	/**
	 * 用户中心右边，小导航
	 *
	 * @param string	$menu_type	导航类型
	 * @param string 	$menu_key	当前导航的menu_key
	 * @return
	 */
	private function profile_menu($menu_type,$menu_key=''){
		$menu_array	= array();
		switch ($menu_type) {
			case 'others':
				$menu_array	= array(
				1=>array('menu_key'=>'others','menu_name'=>Language::get('nc_member_path_taobao_caiji_others'),'menu_url'=>'index.php?app=taobao_caiji&wwi=others'),
				2=>array('menu_key'=>'batchco','menu_name'=>Language::get('nc_member_path_taobao_caiji_batchco'),'menu_url'=>'index.php?app=taobao_caiji&wwi=batchco'),
				3=>array('menu_key'=>'malldata','menu_name'=>Language::get('nc_member_path_taobao_caiji_malldata'),'menu_url'=>'index.php?app=taobao_caiji&wwi=malldata')
				);
				break;
			case 'batchco':
				$menu_array	= array(
				1=>array('menu_key'=>'others','menu_name'=>Language::get('nc_member_path_taobao_caiji_others'),'menu_url'=>'index.php?app=taobao_caiji&wwi=others'),
				2=>array('menu_key'=>'batchco','menu_name'=>Language::get('nc_member_path_taobao_caiji_batchco'),'menu_url'=>'index.php?app=taobao_caiji&wwi=batchco'),
				3=>array('menu_key'=>'malldata','menu_name'=>Language::get('nc_member_path_taobao_caiji_malldata'),'menu_url'=>'index.php?app=taobao_caiji&wwi=malldata')
				);
				break;
			case 'malldata':
				$menu_array	= array(
				1=>array('menu_key'=>'others','menu_name'=>Language::get('nc_member_path_taobao_caiji_others'),'menu_url'=>'index.php?app=taobao_caiji&wwi=others'),
				2=>array('menu_key'=>'batchco','menu_name'=>Language::get('nc_member_path_taobao_caiji_batchco'),'menu_url'=>'index.php?app=taobao_caiji&wwi=batchco'),
				3=>array('menu_key'=>'malldata','menu_name'=>Language::get('nc_member_path_taobao_caiji_malldata'),'menu_url'=>'index.php?app=taobao_caiji&wwi=malldata')
				);
				break;
			case 'tb_setting':
				$menu_array	= array(
				1=>array('menu_key'=>'others','menu_name'=>Language::get('nc_member_path_taobao_caiji_others'),'menu_url'=>'index.php?app=taobao_caiji&wwi=others'),
				2=>array('menu_key'=>'batchco','menu_name'=>Language::get('nc_member_path_taobao_caiji_batchco'),'menu_url'=>'index.php?app=taobao_caiji&wwi=batchco'),
				3=>array('menu_key'=>'malldata','menu_name'=>Language::get('nc_member_path_taobao_caiji_malldata'),'menu_url'=>'index.php?app=taobao_caiji&wwi=malldata')
				);
				break;
		}
		Tpl::output('member_menu',$menu_array);
		Tpl::output('menu_key',$menu_key);
	}

}

?>