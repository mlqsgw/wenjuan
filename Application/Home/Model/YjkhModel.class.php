<?php
namespace Home\Model;
use Think\Model\RelationModel;
class YjkhModel extends RelationModel {
	
	protected $_link = array(
		'Department' => array(
		    'mapping_type'  => self::BELONGS_TO,  //多对一关联
		    'class_name'    => 'Department',	 //要关联的模型类名
		    'foreign_key'   => 'use_department_id', //关联的外键名称
		    'mapping_name'  => 'department_data',  //关联映射名称	
		),
	);

}
?>