<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/wenjuan/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="/wenjuan/Public/js/webuploader/webuploader.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" src="/wenjuan/Public/js/jquery.js"></script>
<script language="JavaScript" src="/wenjuan/Public/js/webuploader/webuploader.js"></script>
<script language="JavaScript" src="/wenjuan/Public/js/layer/layer.js"></script>

<style>
    #user_id {width: 115px;}
</style>

</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">用户管理</a></li>
    <li><a href="#">职务编辑</a></li>
    </ul>
    </div>
    <form id="data_form">
        <input type="hidden" name="id" value="<?php echo ($id); ?>" />
        <div class="formbody">
            <div class="formtitle"><span>职务编辑</span></div>
            <ul class="forminfo">
                <li>
                    <label>所属部门</label>
                    <select name="department_id" id="" style="background-color: #96cef3;margin-top:10px;">
                    <?php if(empty($data["department_id"])): ?><option value="">选择所属部门</option>
                    <?php else: ?>
                        <option value="<?php echo ($data['department_id']); ?>"><?php echo ($data['department_data']['department_name']); ?></option><?php endif; ?>
                    
                    <?php if(is_array($department_data)): $i = 0; $__LIST__ = $department_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["department_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                
                <li><label>职务名称</label><input name="duty_name" type="text" value="<?php echo ($data['duty_name']); ?>" class="dfinput" /></li>
                
                <li><label>&nbsp;</label><input name="" type="button" class="btn" value="确认保存"/></li>
            </ul>
        </div>

    </form>
   
    
    <script type="text/javascript">
        $(".btn").click(function(){
            $.ajax({
                type : "POST",
                url : "<?php echo u('Index/duty_edit_do');?>",
                data : $("#data_form").serializeArray(),
                dataType : 'json',
                success : function(data){
                    if(data['status']){
                        layer.open({
                            content : "编辑成功",
                            btn : ['确定']
                            
                        });

                    } else {
                        layer.open({
                            content : data['message'],
                            btn : ['确定']
                        });
                    }
                }

            });
        });
    </script>
</body>

</html>