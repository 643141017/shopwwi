<?php

$tbconfig =array();
$tbconfig['web_root'] = '../../../data/upload/mall/store/goods/';//上传图片的存放位置。shopwwi默认存放在/data/upload/mall/store/goods/ 目录下，如果你未更改，则此处无需修改。默认存放位置在 /global.php文件中定义，由define('DIR_UPLOAD','data/upload'); define('ATTACH_GOODS','mall/store/goods');共同决定。
	//如果你修改了shopwwi的默认存放位置，此处需要相应作出修改。
$tbconfig['datahost']     = 'localhost:3306';//数据库服务器地址和端口
$tbconfig['datausername'] = 'shopwwi';//数据库用户名
$tbconfig['datauserpass'] = 'S@!15152.yb';//数据库用户密码
$tbconfig['databasename'] = 'shopwwi';//使用的数据库名
$tbconfig['datatablepre'] = 'shopwwi_'; //数据表前缀