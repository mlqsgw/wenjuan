<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/wenjuan/Public/css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/wenjuan/Public/js/jquery.js"></script>

<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});
	
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
})	
</script>


</head>

<body style="background:#f0f9fd;">
	<div class="lefttop"><span></span>管理列表</div>
    
    <dl class="leftmenu">
        
    <?php if($user_data['user_type'] != 0 ): ?><dd><div class="title"><span><img src="/wenjuan/Public/images/leftico03.png" /></span>用户管理</div>
        <ul class="menuson">
            <li class="active"><cite></cite><a href="index.html" target="rightFrame">首页模版</a><i></i></li>
            <li><cite></cite><a href="<?php echo u('department_list');?>" target="rightFrame">部门列表</a><i></i></li>
            <li><cite></cite><a href="<?php echo u('duty_list');?>" target="rightFrame">职务列表</a><i></i></li>
            <li><cite></cite><a href="<?php echo u('user_list');?>" target="rightFrame">用户列表</a><i></i></li>
        </ul>    
        </dd>  
        <dd><div class="title"><span><img src="/wenjuan/Public/images/leftico04.png" /></span>管理员考核管理</div>
        <ul class="menuson">
            <li><cite></cite><a href="<?php echo u('yjkh_list');?>" target="rightFrame">考核模板列表</a><i></i></li>
            <li><cite></cite><a href="<?php echo u('user_yjkh_list');?>" target="rightFrame">考核历史列表</a><i></i></li>
        </ul>
        </dd><?php endif; ?>
    
    <dd><div class="title"><span><img src="/wenjuan/Public/images/leftico04.png" /></span>我的考核管理</div>
    <ul class="menuson">
        <li><cite></cite><a href="<?php echo u('yjkh_list_oneself');?>" target="rightFrame">我的考核列表</a><i></i></li>
    </ul>
    </dd>   
    
    </dl>
    
</body>
</html>