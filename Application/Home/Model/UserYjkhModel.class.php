<?php
namespace Home\Model;
use Think\Model\RelationModel;
class UserYjkhModel extends RelationModel {
	
	protected $_link = array(
		'Yjkh' => array(
		    'mapping_type'  => self::BELONGS_TO,  //多对一关联
		    'class_name'    => 'Yjkh',	 //要关联的模型类名
		    'foreign_key'   => 'yjkh_id', //关联的外键名称
		    'mapping_name'  => 'yjkh_data',  //关联映射名称	
		),
		'Yjkh2' => array(
		    'mapping_type'  => self::BELONGS_TO,  //多对一关联
		    'class_name'    => 'Yjkh',	 //要关联的模型类名
		    'foreign_key'   => 'user_department_id', //关联的外键名称
		    'mapping_name'  => 'yjkh_data_two',  //关联映射名称	
		),
		'User' => array(
		    'mapping_type'  => self::BELONGS_TO,  //多对一关联
		    'class_name'    => 'User',	 //要关联的模型类名
		    'foreign_key'   => 'by_appraiser_id', //关联的外键名称
		    'mapping_name'  => 'user_data',  //关联映射名称	
		    'mapping_fields' => 'id,username', //关联要查询的字段
		),
		'User2' => array(
		    'mapping_type'  => self::BELONGS_TO,  //多对一关联
		    'class_name'    => 'User',	 //要关联的模型类名
		    'foreign_key'   => 'appraiser_id', //关联的外键名称
		    'mapping_name'  => 'user_data_oneself',  //关联映射名称	
		    'mapping_fields' => 'id,username', //关联要查询的字段
		),
	);
}
?>