<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/wenjuan/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="/wenjuan/Public/css/jquery.monthpicker.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="/wenjuan/Public/js/jquery.js"></script>
<!-- <script type="text/javascript" src="/wenjuan/Public/js/showdate.js"></script> -->
<script type="text/javascript" src="/wenjuan/Public/js/showdate.js"></script>
<script type="text/javascript" src="/wenjuan/Public/js/jquery.monthpicker.js"></script>
<script type="text/javascript" src="/wenjuan/Public/js/layer/layer.js"></script>


<style>  
    .pages a,  
    .pages span {  
        display: inline-block;  
        padding: 2px 5px;  
        margin: 0 1px;  
        border: 1px solid #f0f0f0;  
        -webkit-border-radius: 3px;  
        -moz-border-radius: 3px;  
        border-radius: 3px;  
    }  
      
    .pages a,  
    .pages li {  
        display: inline-block;  
        list-style: none;  
        text-decoration: none;  
        color: #58A0D3;  
    }  
      
    .pages a.first,  
    .pages a.prev,  
    .pages a.next,  
    .pages a.end {  
        margin: 0;  
    }  
      
    .pages a:hover {  
        border-color: #50A8E6;  
    }  
      
    .pages span.current {  
        background: #50A8E6;  
        color: #FFF;  
        font-weight: 700;  
        border-color: #50A8E6;  
    }  
</style>  

</head>


<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">用户管理</a></li>
    <li><a href="#">用户列表</a></li>
    </ul>
    </div>
    
    <div class="rightinfo">
    
    <div class="tools">
    
    	<ul class="toolbar">
        <!-- <li class="click" id="yjkh_look"><span><img src="/wenjuan/Public/images/t01.png" /></span>添加</li> -->
        <li class="click" id="add_button"><a href="#"><span><img src="/wenjuan/Public/images/t01.png" /></span>添加</a></li>
        
        <!-- <li><span><img src="/wenjuan/Public/images/t03.png" /></span>删除</li> -->
        <!-- <li><span><img src="/wenjuan/Public/images/t04.png" /></span>统计</li> -->
        </ul>
        
        <!-- <ul class="toolbar">
            <li class="click"><a href="<?php echo u('payExport');?>"><span></span>导出Excel</a></li>
        </ul> -->
    </div>
    
    
    <table class="tablelist">
    	<thead>
    	<tr>
        <th><input name="" type="checkbox" value="" checked="checked"/></th>
        <th>编号</th>
        <th>用户姓名</th>
        <th>登录账户</th>
        <th>所属部门</th>
        <th>职务</th>
        <th>创建时间</th>
        <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td><input name="" type="checkbox" value="" /></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["username"]); ?></td>
        <td><?php echo ($vo["account"]); ?></td>
        <td><?php echo ($vo["department_data"]["department_name"]); ?></td>
        <td><?php echo ($vo["duty_data"]["duty_name"]); ?></td>

        <td><?php echo (date("Y-m-d H:i:s", $vo["create_time"])); ?></td>
        <td><a href="#" class="user_edit" user_edit_id = <?php echo ($vo["id"]); ?>>编辑</a>|<a href="#" class="user_del" user_del_id = <?php echo ($vo["id"]); ?>>删除</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    
    <div class="pages">
        <?php echo ($page); ?>
    </div>
    
    </div>
    
    <script type="text/javascript">

       $(".user_edit").click(function(){
            var edit_id = $(this).attr("user_edit_id");
            var url3 = "<?php echo u('user_edit');?>?id=" + edit_id;
            layer.open({
                type : 2,
                title : "绩绩考核编辑",
                area : ['1210px', '90%'],
                content : url3,
                end : function(){
                    location.reload();
                }
            });
       });

       $(".user_del").click(function(){
            var del_id = $(this).attr("user_del_id");
            $.ajax({
                type : "POST",
                url : "<?php echo u('user_del');?>",
                data : {id : del_id},
                dataType : 'json',
                success : function(data){
                    if(data['status']){
                        layer.open({
                            content : "删除成功",
                            btn : ['确定'],
                            yes : function(){
                                location.href = "<?php echo u('user_list');?>";
                            }
                        });
                    } else {
                        layer.open({
                            content : "删除失败",
                            btn : ['确定'],
                            yes : function(){
                                location.href = "<?php echo u('user_list');?>";
                            }
                        });
                        
                    }
                }
            });
       });

       $("#add_button").click(function(){
            var url = "<?php echo u('user_add');?>";
            layer.open({
                type : 2,
                title : "部门添加页面",
                area : ['800px', '90%'],
                content :url,
                end : function(){
                    location.reload();
                }
            });
       });
	</script>

</body>

</html>