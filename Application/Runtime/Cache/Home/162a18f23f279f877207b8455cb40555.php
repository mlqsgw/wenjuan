<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/wenjuan/Public/css/style2.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/wenjuan/Public/js/jquery.js"></script>
<script type="text/javascript" src="/wenjuan/Public/js/layer/layer.js"></script>

</head>
<style>
    * {
            border: 1;
        }
</style>
<body>

    <div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">问卷调查添加</a></li>
    <li><a href="#">选择填写人</a></li>
    </ul>
    </div>
    <form id="data_form">
        <div class="formbody">
            <div class="formtitle" ><span>填写人列表</span></div>
                <table border="1" style="margin:auto;">
                    <tr> 
                        <th colspan="6" align="center">用户信息</th>
                    </tr>
                    <tr>
                        <th rowspan="3">部门</th>
                        <th rowspan="3" >成员</th>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <?php if(is_array($department_data)): $i = 0; $__LIST__ = $department_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td height="80px" width="100px" align="center"><?php echo ($vo['department_name']); ?></td>
                            <td width="600px" >
                                <?php if(is_array($vo['user_data'])): $i = 0; $__LIST__ = $vo['user_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo_user): $mod = ($i % 2 );++$i;?><input type="checkbox" name="user_id[]" value="<?php echo ($vo_user['id']); ?>" /><?php echo ($vo_user['username']); endforeach; endif; else: echo "" ;endif; ?>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    
                    <tr>
                        <td colspan="6" align="center"><li><label>&nbsp;</label><input name="" type="button" class="btn" value="提交"/></li></td>
                    </tr>
                </table>
                
                <ul class="forminfo" >
                    
                </ul>
            </div>
    </form>
    
    <script type="text/javascript">
        $(".btn").click(function(){
            // console.log($("#data_form").serializeArray());
            $.ajax({
                type : "POST",
                url : "<?php echo u('Index/yjkh_fill_in_user_add_to');?>",
                data : $("#data_form").serializeArray(),
                dataType : 'json',
                success : function(data){
                    if(data['status']){
                        layer.open({
                            content : '提交成功',
                            btn : ['确定']
                        });

                    } else {
                        layer.open({
                            content : data["message"],
                            btn : ['确定']
                        });
                    }
                }

            });
        });
    </script>
</body>

</html>