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
        <li><a href="#">考核编辑</a></li>
    </ul>
    </div>
    <form id="data_form">
        <input type="hidden" name="id" value="<?php echo ($id); ?>" />
        <input type="hidden" name="fill_in_user_id" value="<?php echo ($data['fill_in_user_id']); ?>" />
        <input type="hidden" name="type" value="<?php echo ($data['type']); ?>" />
        <div class="formbody">
            <div class="formtitle" >
                <span>考核编辑</span>
            </div>
                <table border="1">
                    <tr> 
                        <th colspan="6" align="center">标题 &nbsp;<input type="text" name="title" value="<?php echo ($data['title']); ?>"></th>
                    </tr>
                    <tr> 
                        <th colspan="6" align="center">使用部门 &nbsp;
                            <select name="use_department_id" id="test" >
                                <?php if($data['department_data']['department_name']): ?><option value="<?php echo ($data['department_data']['id']); ?>"><?php echo ($data['department_data']['department_name']); ?></option>
                                <?php else: ?>
                                    <option value="">请选择使用部门</option><?php endif; ?>
                                <?php if(is_array($department_data)): $i = 0; $__LIST__ = $department_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['department_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="6" align="center">填写时间范围 &nbsp;
                            开始时间<input type="text" id="st" name="st" onclick="return Calendar('st');" value="<?php echo (date('Y-m-d', $data['status_time'])); ?>" class="text" style="width:85px;"/>-结束时间<input type="text" id="et" onclick="return Calendar('et');" value="<?php echo (date('Y-m-d', $data['end_time'])); ?>" name="et" class="text" style="width:85px;"/>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="6" align="center">考核类型 &nbsp;
                            <select name="assess_type" id="">
                                <?php if($data['assess_type'] == 1): ?><option value="1">自评</option>
                                <?php elseif($data['assess_type'] == 2): ?>
                                    <option value="2">互评</option><?php endif; ?>
                                <option value="1">自评</option>
                                <option value="2">互评</option>
                            </select>
                            <?php if($user_type == 1): ?><input type="button" value="重新选择填写人" class="fill_in_user"/>
                            <?php else: ?>
                                <input type="button" value="请选择填写人" class="fill_in_user" /><?php endif; ?> &nbsp;&nbsp;
                            <select>
                                <option value="">参与人信息</option>
                                <?php if(is_array($user_data)): $i = 0; $__LIST__ = $user_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value=""><?php echo ($vo["username"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
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
                        <th rowspan="2">上级评（80%）</th>
                    </tr>
                    <tr>
                        
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><input type="text" name="assessment_name_one" id="assessment_name_one" value="<?php echo ($data['assessment_name_one']); ?>"  /></td>
                        <td align="center"><input type="text" name="score_one" id="score_one" value="<?php echo ($data['score_one']); ?>" /></td>
                        <td width="200px" align="center">
                            <textarea name="require_one" id="require_one" cols="63" rows="5" >
                                <?php echo ($data['require_one']); ?>
                            </textarea>
                        </td>
                        <td width="400px" >
                            <textarea name="opinion_rating_one" id="opinion_rating_one" cols="63" rows="5" >
                                <?php echo ($data['opinion_rating_one']); ?>
                            </textarea>
                            
                        </td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><input type="text" name="assessment_name_two" id="assessment_name_two" value="<?php echo ($data['assessment_name_two']); ?>" /></td>
                        <td align="center"><input type="text" name="score_two" id="score_two" value="<?php echo ($data['score_two']); ?>" /></td>
                        <td width="200px" align="center">
                            <textarea name="require_two" id="require_two" cols="63" rows="5" >
                                <?php echo ($data['require_two']); ?>
                            </textarea>
                        </td>
                        <td width="400px" >
                            <textarea name="opinion_rating_two" id="opinion_rating_two" cols="63" rows="5">
                                <?php echo ($data['opinion_rating_two']); ?>
                            </textarea>
                        </td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><input type="text" name="assessment_name_three" id="assessment_name_three" value="<?php echo ($data['assessment_name_three']); ?>"  /></td>
                        <td align="center"><input type="text" name="score_three" id="score_three" value="<?php echo ($data['score_three']); ?>" /></td>
                        <td width="200px" align="center">
                            <textarea name="require_three" id="require_three" cols="63" rows="5" >
                                <?php echo ($data['require_three']); ?>
                            </textarea>
                        </td>
                        <td width="400px" >
                            <textarea name="opinion_rating_three" id="opinion_rating_three" cols="63" rows="5">
                               <?php echo ($data['opinion_rating_three']); ?>
                            </textarea>
                            
                        </td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><input type="text" name="assessment_name_four" id="assessment_name_four" value="<?php echo ($data['assessment_name_four']); ?>" /></td>
                        <td align="center"><input type="text" name="score_four" id="score_four" value="<?php echo ($data['score_four']); ?>" /></td>
                        <td width="200px" align="center">
                            <textarea name="require_four" id="require_four" cols="63" rows="5" >
                                <?php echo ($data['require_four']); ?>
                            </textarea>
                        </td>
                        <td width="400px" >
                            <textarea name="opinion_rating_four" id="opinion_rating_four" cols="63" rows="5">
                                <?php echo ($data['opinion_rating_four']); ?>
                            </textarea>
                            
                        </td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">小计</td>
                        <td colspan="2" align="center"></td>
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
                        <td height="50px" width="100px" align="center"><input type="text" name="assessment_name_one_xw" id="assessment_name_one_xw" value="<?php echo ($data['assessment_name_one_xw']); ?>" /></td>
                        <td align="center"><input type="text" name="score_one_xw" id="score_one_xw" value="<?php echo ($data['score_one_xw']); ?>" /></td>
                        <td width="200px" align="center">
                            <textarea name="require_one_xw" id="require_one_xw" cols="63" rows="5" >
                                <?php echo ($data['require_one_xw']); ?>
                            </textarea>
                        </td>
                        <td width="400px" >
                            <textarea name="opinion_rating_one_xw" id="opinion_rating_one_xw" cols="63" rows="5" >
                                <?php echo ($data['opinion_rating_one_xw']); ?>
                            </textarea>
                        </td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><input type="text" name="assessment_name_two_xw" id="assessment_name_two_xw" value="<?php echo ($data['assessment_name_two_xw']); ?>" /></td>
                        <td align="center"><input type="text" name="score_two_xw" id="score_two_xw" value="<?php echo ($data['score_two_xw']); ?>" /></td>
                        <td width="200px" align="center">
                            <textarea name="require_two_xw" id="require_two_xw" cols="63" rows="5" >
                                <?php echo ($data['require_two_xw']); ?>
                            </textarea>
                        </td>
                        <td width="400px" >
                            <textarea name="opinion_rating_two_xw" id="opinion_rating_two_xw" cols="63" rows="5">
                                <?php echo ($data['opinion_rating_two_xw']); ?>
                            </textarea>
                        </td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td height="50px" width="100px" align="center"><input type="text" name="assessment_name_three_xw" id="assessment_name_three_xw" value="<?php echo ($data['assessment_name_three_xw']); ?>" /></td>
                        <td align="center"><input type="text" name="score_three_xw" id="score_three_xw" value="<?php echo ($data['score_three_xw']); ?>" /></td>
                        <td width="200px" align="center">
                            <textarea name="require_three_xw" id="require_three_xw" cols="63" rows="5" >
                                <?php echo ($data['require_three_xw']); ?>
                            </textarea>
                        </td>
                        <td width="400px" >
                            <textarea name="opinion_rating_three_xw" id="opinion_rating_three_xw" cols="63" rows="5">
                                <?php echo ($data['opinion_rating_three_xw']); ?>
                            </textarea>
                            
                        </td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">小计</td>
                        <td colspan="2" align="center"></td>
                    </tr>
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
            $.ajax({
                type : "POST",
                url : "<?php echo u('Index/yjkh_edit_do');?>",
                data : $("#data_form").serializeArray(),
                dataType : 'json',
                success : function(data){
                    if(data['status']){
                        layer.open({
                            content : '编辑成功',
                            btn : ['确定'],
                        });

                    } else {
                        layer.open({
                            content : data["message"],
                            btn : ['确定'],
                        });
                    }
                }

            });
        });
        $(".fill_in_user").click(function(){
            var url = "<?php echo u('yjkh_fill_in_user_add');?>";
            layer.open({
                type : 2,
                title : "填写人添加",
                area : ['1000px', '90%'],
                content : url,
            });
        });

        $("#test").click(function(){ //获取被选中部门id
            var id =  $("#test").val(); 
            if(id == 2){
                $("#assessment_name_one").val('招聘达成率');
                $("#score_one").val('30');
                $("#require_one").val('提出招聘需求20天内完成（主管30天），完成需招聘岗位数量90%以上');
                $("#opinion_rating_one").val('在规定时间内完成人员招聘任务，且到岗率高于90%，得35分（加分项）在规定时间内完成人员招聘任务，且到岗率低于90%，得25分其余0分');

                $("#assessment_name_two").val('劳动纠纷解决');
                $("#score_two").val('10');
                $("#require_two").val('劳动纠纷在第一时间解决，且没有对公司造成重大影响');
                $("#opinion_rating_two").val('劳动纠纷解决率100%，未发生劳动仲裁10分 发生劳动仲裁事件 0分');

                $("#assessment_name_three").val('绩效考核指标库建立');
                $("#score_three").val('20');
                $("#require_three").val('绩效每月5日前统计，按要求进度完善绩效考核指标库建立');
                $("#opinion_rating_three").val('按进度要求完成，20分进度拖延1天，15分 进度拖延三天10分');

                $("#assessment_name_four").val('薪酬测算');
                $("#score_four").val('20');
                $("#require_four").val('每月10号前提交上月薪酬核算表格');
                $("#opinion_rating_four").val('按质按时完成，100%正确率，25分（加分项5分）按质按时完成，98%正确率，得20分按质按时完成,98%正确率，得15分 按质按时完成，其他10分');

                $("#assessment_name_one_xw").val('承担责任');
                $("#score_one_xw").val('7');
                $("#require_one_xw").val('1级：承担责任，不推卸，不指责 2级：着手解决问题，减少业务流程 3级：做事有预见，有防误设计');
                $("#opinion_rating_one_xw").val('1级--5分 2级--6分 3级--7分 ');

                $("#assessment_name_two_xw").val('团队合作');
                $("#score_two_xw").val('7');
                $("#require_two_xw").val('1级：善于倾听，能接纳不同意见 2级：支持团队（领导）的决定，能良好的支持并配合工作 3级：乐于奉献，愿意提供即使是不属自己日常工作职责范围的帮助');
                $("#opinion_rating_two_xw").val('1级--5分 2级--6分 3级--7分');

                $("#assessment_name_three_xw").val('知识共享');
                $("#score_three_xw").val('6');
                $("#require_three_xw").val('1级：分享好的观点和信息使团队前进 2级: 建立自己的知识体系，帮助他人提高业务能力 3级：每月读一本好书，并善于总结');
                $("#opinion_rating_three_xw").val('1级--4分 2级--5分 3级--6分');
            } else if(id == 3){
                $("#assessment_name_one").val('项目交期');
                $("#score_one").val('30');
                $("#require_one").val('项目目标按时完成');
                $("#opinion_rating_one").val('a.目标提前完成--35分（加分项5分）b.目标按期达成--30分 c.目标延期一周内达成--20分 d.目标延期严重导致不能交付--15分');

                $("#assessment_name_two").val('工程质量');
                $("#score_two").val('20');
                $("#require_two").val('主流程和主页面无BUG');
                $("#opinion_rating_two").val('a.无明显bug，修复率100%--20分 b.较少bug，修复成功率低于90%以上--15分 c.较多bug，可修复率低--10分');

                $("#assessment_name_three").val('代码规范');
                $("#score_three").val('15');
                $("#require_three").val('严格遵守规范文档，无违规项');
                $("#opinion_rating_three").val('a.严格遵守规范文档，不出现违规项--15分 b.基本遵守规范文档，违规项<3项--10分 c.没有遵守规范文档，违规3项或以上--5分');

                $("#assessment_name_four").val('系统性能');
                $("#score_four").val('15');
                $("#require_four").val('达到系统设计指标');
                $("#opinion_rating_four").val('a.达到系统设计指标--15分 b.未达到系统设计指标--10分 c.有严重损耗导致系统运行缓慢----5分');

                $("#assessment_name_one_xw").val('承担责任');
                $("#score_one_xw").val('5');
                $("#require_one_xw").val('1级：承担责任，不推卸，不指责 2级：着手解决问题，减少业务流程 3级：做事有预见，有防误设计');
                $("#opinion_rating_one_xw").val('1级--3分 2级--4分 3级--5分 ');

                $("#assessment_name_two_xw").val('团队合作');
                $("#score_two_xw").val('5');
                $("#require_two_xw").val('1级：善于倾听，能接纳不同意见 2级：支持团队（领导）的决定，能良好的支持并配合工作 3级：乐于奉献，愿意提供即使是不属自己日常工作职责范围的帮助');
                $("#opinion_rating_two_xw").val('1级--3分 2级--4分 3级--5分');

                $("#assessment_name_three_xw").val('知识共享');
                $("#score_three_xw").val('10');
                $("#require_three_xw").val('1级：分享好的观点或信息使本类岗位的员工进步 2级: 分享好的观点或信息使部门进步 3级：建立自己的专业知识体系，每月自主培训一次，帮助他人提高业务能力');
                $("#opinion_rating_three_xw").val('1级--8分 2级--10分 3级--15分（加分项5分）');
            } else if(id == 4) {
                $("#assessment_name_one").val('产品规划');
                $("#score_one").val('20');
                $("#require_one").val('产品规划详细、合理');
                $("#opinion_rating_one").val('a.比较合理--20分 b.基本合理--15分 c.不合理--10分');

                $("#assessment_name_two").val('需求管理');
                $("#score_two").val('20');
                $("#require_two").val('需求管理及处理得当');
                $("#opinion_rating_two").val('a.比较得当--20分 b.基本得当--15分');

                $("#assessment_name_three").val('工作效率和质量');
                $("#score_three").val('40');
                $("#require_three").val('按时完成工作任务且有质量');
                $("#opinion_rating_three").val('a.提前完成工作，且工作质量100%--45分（加分项5分） b.按时完成工作，且工作质量95%及以上--40分 c.项目拖延1-5天，且工作质量在85%以上--30分 d.项目拖延5天以上，且工作质量在75%以上--20分');

                $("#assessment_name_one_xw").val('承担责任');
                $("#score_one_xw").val('5');
                $("#require_one_xw").val('1级：承担责任，不推卸，不指责 2级：着手解决问题，减少业务流程 3级：做事有预见，有防误设计');
                $("#opinion_rating_one_xw").val('1级--3分 2级--4分 3级--5分 ');

                $("#assessment_name_two_xw").val('团队合作');
                $("#score_two_xw").val('5');
                $("#require_two_xw").val('1级：善于倾听，能接纳不同意见 2级：支持团队（领导）的决定，能良好的支持并配合工作 3级：乐于奉献，愿意提供即使是不属自己日常工作职责范围的帮助');
                $("#opinion_rating_two_xw").val('1级--3分 2级--4分 3级--5分');

                $("#assessment_name_three_xw").val('知识共享');
                $("#score_three_xw").val('10');
                $("#require_three_xw").val('1级：分享好的观点或信息使本类岗位的员工进步 2级: 分享好的观点或信息使部门进步 3级：建立自己的专业知识体系，每月自主培训一次，帮助他人提高业务能力');
                $("#opinion_rating_three_xw").val('1级--8分 2级--10分 3级--15分（加分项5分）');
            } else if(id == 5){
                $("#assessment_name_one").val('万元富整体运营投资金额');
                $("#score_one").val('40');
                $("#require_one").val('当月目标完成率');
                $("#opinion_rating_one").val('万元富运营目标完成率80%以下(15分) 万元富运营目标完成率80%-90 (25分)  万元富运营目标完成率90%-100% (40分)           万元富运营目标完成率100%-110%   (45分)（加分项）');

                $("#assessment_name_two").val('平台推广');
                $("#score_two").val('20');
                $("#require_two").val('软文发放');
                $("#opinion_rating_two").val('每日发布不低于10篇，包括问答类、贴吧论坛、文库博文等 (10分) 推广渠道拓展、营销活动等线上推广工作 (5分)  用户运营 (5分)');

                $("#assessment_name_three").val('账户后台管理');
                $("#score_three").val('20');
                $("#require_three").val('站内运营内容规划、demo规划、公告发布等站内运营');
                $("#opinion_rating_three").val('工作当天完成有差错 (10分) 当天完成无差错 (20分)');

                $("#assessment_name_one_xw").val('承担责任');
                $("#score_one_xw").val('5');
                $("#require_one_xw").val('1级：承担责任，不推卸，不指责 2级：着手解决问题，减少业务流程 3级：做事有预见，有防误设计');
                $("#opinion_rating_one_xw").val('1级--3分 2级--4分 3级--5分 ');

                $("#assessment_name_two_xw").val('团队合作');
                $("#score_two_xw").val('5');
                $("#require_two_xw").val('1级：善于倾听，能接纳不同意见 2级：支持团队（领导）的决定，能良好的支持并配合工作 3级：乐于奉献，愿意提供即使是不属自己日常工作职责范围的帮助');
                $("#opinion_rating_two_xw").val('1级--3分 2级--4分 3级--5分');

                $("#assessment_name_three_xw").val('知识共享');
                $("#score_three_xw").val('10');
                $("#require_three_xw").val('1级：分享好的观点或信息使本类岗位的员工进步 2级: 分享好的观点或信息使部门进步 3级：建立自己的专业知识体系，每月自主培训一次，帮助他人提高业务能力');
                $("#opinion_rating_three_xw").val('1级--8分 2级--10分 3级--15分（加分项5分）');
            } else if(id == 6) {
                $("#assessment_name_one").val('项目交期');
                $("#score_one").val('30');
                $("#require_one").val('项目目标按时完成');
                $("#opinion_rating_one").val('a.目标提前完成--35分（加分项5分）b.目标按期达成--30分 c.目标延期一周内达成--20分 d.目标延期严重导致不能交付--15分');

                $("#assessment_name_two").val('工程质量');
                $("#score_two").val('20');
                $("#require_two").val('主流程和主页面无BUG');
                $("#opinion_rating_two").val('a.无明显bug，修复率100%--20分 b.较少bug，修复成功率低于90%以上--15分 c.较多bug，可修复率低--10分');

                $("#assessment_name_three").val('代码规范');
                $("#score_three").val('15');
                $("#require_three").val('严格遵守规范文档，无违规项');
                $("#opinion_rating_three").val('a.严格遵守规范文档，不出现违规项--15分 b.基本遵守规范文档，违规项<3项--10分 c.没有遵守规范文档，违规3项或以上--5分');

                $("#assessment_name_four").val('系统性能');
                $("#score_four").val('15');
                $("#require_four").val('达到系统设计指标');
                $("#opinion_rating_four").val('a.达到系统设计指标--15分 b.未达到系统设计指标--10分 c.有严重损耗导致系统运行缓慢----5分');

                $("#assessment_name_one_xw").val('承担责任');
                $("#score_one_xw").val('5');
                $("#require_one_xw").val('1级：承担责任，不推卸，不指责 2级：着手解决问题，减少业务流程 3级：做事有预见，有防误设计');
                $("#opinion_rating_one_xw").val('1级--3分 2级--4分 3级--5分 ');

                $("#assessment_name_two_xw").val('团队合作');
                $("#score_two_xw").val('5');
                $("#require_two_xw").val('1级：善于倾听，能接纳不同意见 2级：支持团队（领导）的决定，能良好的支持并配合工作 3级：乐于奉献，愿意提供即使是不属自己日常工作职责范围的帮助');
                $("#opinion_rating_two_xw").val('1级--3分 2级--4分 3级--5分');

                $("#assessment_name_three_xw").val('知识共享');
                $("#score_three_xw").val('10');
                $("#require_three_xw").val('1级：分享好的观点或信息使本类岗位的员工进步 2级: 分享好的观点或信息使部门进步 3级：建立自己的专业知识体系，每月自主培训一次，帮助他人提高业务能力');
                $("#opinion_rating_three_xw").val('1级--8分 2级--10分 3级--15分（加分项5分）');
            } else if(id == 7){
                $("#assessment_name_one").val('');
                $("#score_one").val('');
                $("#require_one").val('');
                $("#opinion_rating_one").val('');

                $("#assessment_name_two").val('');
                $("#score_two").val('');
                $("#require_two").val('');
                $("#opinion_rating_two").val('');

                $("#assessment_name_three").val('');
                $("#score_three").val('');
                $("#require_three").val('');
                $("#opinion_rating_three").val('');

                $("#assessment_name_four").val('');
                $("#score_four").val('');
                $("#require_four").val('');
                $("#opinion_rating_four").val('');

                $("#assessment_name_one_xw").val('承担责任');
                $("#score_one_xw").val('5');
                $("#require_one_xw").val('1级：承担责任，不推卸，不指责 2级：着手解决问题，减少业务流程 3级：做事有预见，有防误设计');
                $("#opinion_rating_one_xw").val('1级--3分 2级--4分 3级--5分 ');

                $("#assessment_name_two_xw").val('团队合作');
                $("#score_two_xw").val('5');
                $("#require_two_xw").val('1级：善于倾听，能接纳不同意见 2级：支持团队（领导）的决定，能良好的支持并配合工作 3级：乐于奉献，愿意提供即使是不属自己日常工作职责范围的帮助');
                $("#opinion_rating_two_xw").val('1级--3分 2级--4分 3级--5分');

                $("#assessment_name_three_xw").val('知识共享');
                $("#score_three_xw").val('10');
                $("#require_three_xw").val('1级：分享好的观点或信息使本类岗位的员工进步 2级: 分享好的观点或信息使部门进步 3级：建立自己的专业知识体系，每月自主培训一次，帮助他人提高业务能力');
                $("#opinion_rating_three_xw").val('1级--8分 2级--10分 3级--15分（加分项5分）');
            } else {
                $("#assessment_name_one").val('');
                $("#score_one").val('');
                $("#require_one").val('');
                $("#opinion_rating_one").val('');

                $("#assessment_name_two").val('');
                $("#score_two").val('');
                $("#require_two").val('');
                $("#opinion_rating_two").val('');

                $("#assessment_name_three").val('');
                $("#score_three").val('');
                $("#require_three").val('');
                $("#opinion_rating_three").val('');

                $("#assessment_name_four").val('');
                $("#score_four").val('');
                $("#require_four").val('');
                $("#opinion_rating_four").val('');

                $("#assessment_name_one_xw").val('');
                $("#score_one_xw").val('');
                $("#require_one_xw").val('');
                $("#opinion_rating_one_xw").val('');

                $("#assessment_name_two_xw").val('');
                $("#score_two_xw").val('');
                $("#require_two_xw").val('');
                $("#opinion_rating_two_xw").val('');

                $("#assessment_name_three_xw").val('');
                $("#score_three_xw").val('');
                $("#require_three_xw").val('');
                $("#opinion_rating_three_xw").val('');
            }
 
        });
    </script>
</body>

</html>