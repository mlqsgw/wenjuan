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
    <li><a href="#">考核详情</a></li>
    </ul>
    </div>
    <form id="data_form">
        <div class="formbody">
            <div class="formtitle">
                <span>考核详情</span>
            </div>
                <table border="1">
                    <tr> 
                        <th colspan="6" align="center">标题 &nbsp;<?php echo ($data['yjkh_data']['title']); ?></th>
                    </tr>
                    <tr> 
                        <th colspan="6" align="center">使用部门 &nbsp;<?php echo ($department_data['department_name']); ?></th>
                    </tr>
                    <tr>
                        <th colspan="6" align="center">填写时间范围 &nbsp;
                            开始时间&nbsp;<?php echo (date("Y-m-d", $data["yjkh_data"]["status_time"])); ?>结束时间 &nbsp;<?php echo (date("Y-m-d", $data["yjkh_data"]["end_time"])); ?>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="6" align="center">考核类型 &nbsp; 
                            <?php if($data['assess_type'] == 1): ?>自评
                            <?php elseif($data['assess_type'] == 2): ?>
                                互评<?php endif; ?>
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="3">考核项目</th>
                        <th rowspan="3">分值（总分80分）</th>
                        <th rowspan="3">指标要求</th>
                        <th rowspan="3" >评分等级</th>
                        <th colspan="2">得分</th>
                    </tr>
                    <tr>
                        <th rowspan="2">自评（20%）</th>
                        <th rowspan="2">互评（80%）</th>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><?php echo ($data['yjkh_data']['assessment_name_one']); ?></td>
                        <td align="center"><?php echo ($data['yjkh_data']['score_one']); ?></td>
                        <td width="200px" align="center"><?php echo ($data['yjkh_data']['require_one']); ?></td>
                        <td width="400px" >
                            <?php echo ($data['yjkh_data']['opinion_rating_one']); ?>
                        </td>
                        <td align="center"><?php echo ($data['self_assessment_one']); ?></td>
                        <td align="center"><?php echo ($data['peer_assessment_one']); ?></td>
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><?php echo ($data['yjkh_data']['assessment_name_two']); ?></td>
                        <td align="center"><?php echo ($data['yjkh_data']['score_two']); ?></td>
                        <td width="200px" align="center"><?php echo ($data['yjkh_data']['require_two']); ?></td>
                        <td width="400px" >
                            <?php echo ($data['yjkh_data']['opinion_rating_two']); ?>
                        </td>
                        <td align="center"><?php echo ($data['self_assessment_two']); ?></td>
                        <td align="center"><?php echo ($data['peer_assessment_two']); ?></td>
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><?php echo ($data['yjkh_data']['assessment_name_three']); ?></td>
                        <td align="center"><?php echo ($data['yjkh_data']['score_three']); ?></td>
                        <td width="200px" align="center"><?php echo ($data['yjkh_data']['require_three']); ?></td>
                        <td width="400px" >
                            <?php echo ($data['yjkh_data']['opinion_rating_three']); ?>
                        </td>
                        <td align="center"><?php echo ($data['self_assessment_three']); ?></td>
                        <td align="center"><?php echo ($data['peer_assessment_three']); ?></td>
                    </tr>
                    <?php if(!empty($$data['yjkh_data']['assessment_name_four'])): ?><tr>
                            <td height="50px" width="100px" align="center"><?php echo ($data['yjkh_data']['assessment_name_four']); ?></td>
                            <td align="center"><?php echo ($data['yjkh_data']['score_four']); ?></td>
                            <td width="200px" align="center"><?php echo ($data['yjkh_data']['require_four']); ?></td>
                            <td width="400px" >
                                <?php echo ($data['yjkh_data']['opinion_rating_four']); ?>
                            </td>
                            <td align="center"><?php echo ($data['self_assessment_four']); ?></td>
                            <td align="center"><?php echo ($data['peer_assessment_four']); ?></td>
                        </tr><?php endif; ?>
                    
                    <tr>
                        <td colspan="2" align="center">评价人：<?php echo ($data['user_data_oneself']['username']); ?></td>
                        <td colspan="2" align="center">被评价人：<?php echo ($data['user_data']['username']); ?></td>
                        <td colspan="2" align="center">小计:<?php echo ($data['score_total']); ?></td>
                    </tr>
                    <tr>
                        <th colspan="6" align="center">行为考核</th>
                    </tr>
                    <tr>
                        <th rowspan="3">
                                考核指标
                        </th>
                        <th rowspan="3">
                                分值（总分20分）
                        </th>
                        <th rowspan="3">
                                指标说明
                        </th>
                        <th rowspan="3" >
                                考核评分
                        </th>
                        <th colspan="2">得分</th>
                    </tr>
                    <tr>
                        <th rowspan="2">自评（20%）</th>
                        <th rowspan="2">互评（80%）</th>
                    </tr>
                     <tr>
                        
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><?php echo ($data['yjkh_data']['assessment_name_one_xw']); ?></td>
                        <td align="center"><?php echo ($data['yjkh_data']['score_one_xw']); ?></td>
                        <td width="200px" align="center"><?php echo ($data['yjkh_data']['require_one_xw']); ?></td>
                        <td width="400px" ><?php echo ($data['yjkh_data']['opinion_rating_one_xw']); ?></td>
                        <td align="center"><?php echo ($data['self_assessment_one_xw']); ?></td>
                        <td align="center"><?php echo ($data['peer_assessment_one_xw']); ?></td>
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><?php echo ($data['yjkh_data']['assessment_name_two_xw']); ?></td>
                        <td align="center"><?php echo ($data['yjkh_data']['score_two_xw']); ?></td>
                        <td width="200px" align="center"><?php echo ($data['yjkh_data']['require_two_xw']); ?></td>
                        <td width="400px" ><?php echo ($data['yjkh_data']['opinion_rating_two_xw']); ?></td>
                        <td align="center"><?php echo ($data['self_assessment_two_xw']); ?></td>
                        <td align="center"><?php echo ($data['peer_assessment_two_xw']); ?></td>
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><?php echo ($data['yjkh_data']['assessment_name_three_xw']); ?></td>
                        <td align="center"><?php echo ($data['yjkh_data']['score_three_xw']); ?></td>
                        <td width="200px" align="center"><?php echo ($data['yjkh_data']['require_three_xw']); ?></td>
                        <td width="400px" ><?php echo ($data['yjkh_data']['opinion_rating_three_xw']); ?></td>
                        <td align="center"><?php echo ($data['self_assessment_three_xw']); ?></td>
                        <td align="center"><?php echo ($data['peer_assessment_three_xw']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">评价人：<?php echo ($data['user_data_oneself']['username']); ?></td>
                        <td colspan="2" align="center">被评价人：<?php echo ($data['user_data']['username']); ?></td>
                        <td colspan="2" align="center">小计:<?php echo ($data['score_total_xw']); ?></td>
                    </tr>
                </table>
                
                <ul class="forminfo" >
                    
                </ul>
            </div>
    </form>
    
</body>

</html>