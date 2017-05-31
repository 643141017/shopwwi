
#服务商等级表
CREATE TABLE `si_servicer_store_grade` (
  `ssg_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '等级ID',
  `ssg_name` char(50) DEFAULT NULL COMMENT '服务商等级名称',
  `ssg_discount` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT '服务商等级折扣',
  PRIMARY KEY (`ssg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='服务商等级表（二次开发）';

#供应商等级表
CREATE TABLE `si_supplier_store_grade` (
  `ssg_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '等级ID',
  `ssg_name` char(50) DEFAULT NULL COMMENT '供应商等级名称',
  `ssg_discount` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT '供应商等级折扣',
  PRIMARY KEY (`ssg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供应商等级表（二次开发）';


#订单标识
ALTER TABLE `si_orders`
ADD COLUMN `order_identify`  tinyint(4) NULL DEFAULT 0 COMMENT '订单标识0零售订单1供销订单（二次开发）' AFTER `trade_no`;


ALTER TABLE `si_store`
ADD COLUMN `store_type`  int(11) NOT NULL DEFAULT 0 COMMENT '店铺类型：0商家,1服务商,2供应商（二次开发）' AFTER `is_distribution`;

#店铺供应商等级或者服务等级
ALTER TABLE `si_store`
ADD COLUMN `store_type_grade`  int(11) NOT NULL DEFAULT 0 COMMENT '对应服务商等级或供应商等级，具体对应取决该店铺类型（二次开发）' AFTER `store_type`;

#店铺扩展信息
ALTER TABLE `si_store_joinin`
ADD COLUMN `store_service_hotline`  varchar(20) NULL DEFAULT NULL COMMENT '店铺服务热线（二次开发）' AFTER `store_type`,
ADD COLUMN `store_business_hours`  varchar(20) NULL DEFAULT NULL COMMENT '店铺营业时间（二次开发）' AFTER `store_service_hotline`,
ADD COLUMN `store_service_proverbs`  varchar(100) NULL DEFAULT NULL COMMENT '店铺箴言（二次开发）' AFTER `store_business_hours`,
ADD COLUMN `store_lng`  float NOT NULL DEFAULT 0 COMMENT '店铺经度（二次开发）' AFTER `store_service_proverbs`,
ADD COLUMN `store_lat`  float NOT NULL DEFAULT 0 COMMENT '店铺纬度（二次开发）' AFTER `store_lng`,
ADD COLUMN `store_traffic_routes`  varchar(250) NULL DEFAULT NULL COMMENT '店铺交通路线（二次开发）' AFTER `store_lat`,
ADD COLUMN `store_exhibition_area`  varchar(100) NULL DEFAULT NULL COMMENT '店铺展厅面积（二次开发）' AFTER `store_traffic_routes`;

#店铺法人信息
ALTER TABLE `si_store_joinin`
ADD COLUMN `legal_person`  varchar(50) NULL DEFAULT NULL COMMENT '法人（二次开发）' AFTER `store_exhibition_area`,
ADD COLUMN `legal_person_id_card`  varchar(50) NULL DEFAULT NULL COMMENT '法人身份证号码（二次开发）' AFTER `legal_person`,
ADD COLUMN `legal_person_id_card_photo`  varchar(50) NULL DEFAULT NULL COMMENT '法人身份证图片（二次开发）' AFTER `legal_person_id_card`;

#店铺图片
CREATE TABLE `si_store_images` (
  `store_image_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '店铺图片id',
  `store_id` int(10) unsigned NOT NULL COMMENT '店铺id',
  `store_image` varchar(1000) NOT NULL COMMENT '店铺图片',
  `store_image_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '图片类型，1内景，2外景，3宣传资料',
  PRIMARY KEY (`store_image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='店铺图片';


