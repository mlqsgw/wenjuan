<?php
namespace Home\Model;
use Think\Model\RelationModel;
class QuestionModel extends RelationModel {
	
	protected $_link = array(
		'Title' => array(
		    'mapping_type'  => self::BELONGS_TO,  //多对一关联
		    'class_name'    => 'Title',	 //要关联的模型类名
		    'foreign_key'   => 'title_id', //关联的外键名称
		    'mapping_name'  => 'title_data',  //关联映射名称	
		),
	);
}
?>