<?php
namespace Home\Model;
use Think\Model\RelationModel;
class DutyModel extends RelationModel {
	
	protected $_link = array(
		'Department' => array(
		    'mapping_type'  => self::BELONGS_TO,  //多对一关联
		    'class_name'    => 'department',	 //要关联的模型类名
		    'foreign_key'   => 'department_id', //关联的外键名称
		    'mapping_name'  => 'department_data',  //关联映射名称	
		),
	);
}
?>