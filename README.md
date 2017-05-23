
#服务商等级表
CREATE TABLE `si_servicer_store_grade` (
  `ssg_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '等级ID',
  `ssg_name` char(50) DEFAULT NULL COMMENT '服务商等级名称',
  `ssg_discount` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT '服务商等级折扣',
  PRIMARY KEY (`ssg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='服务商等级表';

#供应商等级表
CREATE TABLE `si_supplier_store_grade` (
  `ssg_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '等级ID',
  `ssg_name` char(50) DEFAULT NULL COMMENT '供应商等级名称',
  `ssg_discount` decimal(10,2) NOT NULL DEFAULT '1.00' COMMENT '供应商等级折扣',
  PRIMARY KEY (`ssg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供应商等级表';

#店铺供应商等级或者服务等级
ALTER TABLE `si_store`
ADD COLUMN `store_type_grade`  int(11) NOT NULL DEFAULT 0 COMMENT '对应服务商等级或供应商等级，具体对应取决该店铺类型' AFTER `store_type`;
