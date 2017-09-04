<?php
namespace Home\Model;
use Think\Model\RelationModel;
class TitleModel extends RelationModel {
	protected $_link = array(
		'Question' => array(
		    'mapping_type'  => self::HAS_MANY,  //一对多关联
		    'class_name'    => 'Question',	 //要关联的模型类名
		    'foreign_key'   => 'title_id', //关联的外键名称
		    'mapping_name'  => 'title_data',  //关联映射名称	
		    'mapping_order' => 'create_time desc', //关联查询的排序
		),
	);
}
?>