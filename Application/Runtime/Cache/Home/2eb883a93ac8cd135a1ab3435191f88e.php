<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/js/webuploader/webuploader.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" src="/Public/js/jquery.js"></script>
<script language="JavaScript" src="/Public/js/webuploader/webuploader.js"></script>
<script language="JavaScript" src="/Public/js/layer/layer.js"></script>

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
    <li><a href="#">用户添加</a></li>
    </ul>
    </div>
    <form id="data_form">
        <div class="formbody">
            <div class="formtitle"><span>用户添加</span></div>
            <ul class="forminfo">
                <li>
                    <label>所属部门</label>
                    <select name="department_id" id="" style="background-color: #96cef3;margin-top:10px;">
                    <option value="">选择所属部门</option>
                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["department_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                <li>
                    <label>所属职务</label>
                    <select name="duty_id" id="" style="background-color: #96cef3;margin-top:10px;">
                    <option value="">选择所属职务</option>
                    <?php if(is_array($data_duty)): $i = 0; $__LIST__ = $data_duty;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["duty_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </li>
                <li>
                    <label>用户类型</label>
                    <select name="user_type" id="" style="background-color: #96cef3;margin-top:10px;">
                    <option value="">选择用户类型</option>
                    <option value="0">普通用户</option>
                    <option value="1">管理员</option>
                    </select>
                </li>
                <li><label>用户姓名</label><input name="username" type="text" class="dfinput" /></li>
                <li><label>登录账户</label><input name="account" type="text" class="dfinput" /></li>

                <li><label>&nbsp;</label><input name="" type="button" class="btn" value="确认保存"/></li>
            </ul>
        </div>

    </form>
   
    
    <script type="text/javascript">
        $(".btn").click(function(){
            $.ajax({
                type : "POST",
                url : "<?php echo u('Index/user_add_do');?>",
                data : $("#data_form").serializeArray(),
                dataType : 'json',
                success : function(data){
                    if(data['status']){
                        layer.open({
                            content : "添加成功",
                            btn : ['确定'],
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