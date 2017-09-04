<?php
namespace Home\Model;
use Think\Model\RelationModel;
class DepartmentModel extends RelationModel {
	
	protected $_link = array(
		'Duty' => array(
		    'mapping_type'  => self::HAS_MANY,  //一对多关联
		    'class_name'    => 'Duty',	 //要关联的模型类名
		    'foreign_key'   => 'department_id', //关联的外键名称
		    'mapping_name'  => 'duty_data',  //关联映射名称	
		),
		'User' => array(
		    'mapping_type'  => self::HAS_MANY,  //一对多关联
		    'class_name'    => 'User',	 //要关联的模型类名
		    'foreign_key'   => 'department_id', //关联的外键名称
		    'mapping_name'  => 'user_data',  //关联映射名称	
		),
	);
}
?>