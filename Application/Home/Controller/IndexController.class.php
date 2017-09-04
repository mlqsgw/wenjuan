<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    

    //判断是否登录
    public function if_login(){
        $u_id = session("user_id");
        if(empty($u_id)){
            $this->error('请先登录',U('Index/login'));
            $this->redirect('Index/login');
        }
    }

    public function top(){
       $this->if_login();
       $session_data = array(
          "user_id" => session("user_id"),
          "user_type" => session("user_type"),
          "username" => session("username"),
       );

       $this->assign("user_data", $session_data);
       $this->display();
    }

    public function left(){
      $this->if_login();
      $session_data = array(
          "user_id" => session("user_id"),
          "user_type" => session("user_type"),
          "username" => session("username")
      );

      $this->assign("user_data", $session_data);
      $this->display();
    }

    //登录页面
    public function login(){

      $this->display();
    }

    //执行登录
    public function do_login(){
        session_unset();
        $m_user = D('user');
        $user_data = $_POST;

        if($user_data["account"] == '' || $user_data["password"] == ""){
            $result = array(
                "status" => false,
                "message" => "账号和密码不能为空"
            );
        } else {
            $where = array(
              "account" => $user_data["account"],
              "password" => md5($user_data["password"]),
              "is_del" => 0
            );

            $user_data = $m_user->where($where)->find();

            if($user_data && $user_data['user_type'] == 0 ){
                $result = array(
                    "status" => true,
                );
                session("user_id", $user_data["id"]);
                session("username", $user_data["username"]);
                session("account", $user_data["account"]);
                session("user_type", 0); //普通用户
            } elseif($user_data && $user_data['user_type'] == 1) {
                $result = array(
                    "status" => true
                );
                session("user_id", $user_data["id"]);
                session("username", $user_data["username"]);
                session("account", $user_data["account"]);
                session("user_type", 1); //管理员
            } elseif($user_data && $user_data['user_type'] == 2){
                $result = array(
                    "status" => true
                );
                session("user_id", $user_data["id"]);
                session("username", $user_data["username"]);
                session("account", $user_data["account"]);
                session("user_type", 2); //董事长
            } 
            else {
                $result = array(
                    "status" => false,
                    "message" => "账号或密码错误"
                );
            }
        }

        $this->ajaxReturn($result);
    }

    //退出登录
    public function logout(){
        session_unset(); //清除session
        $this->redirect('Index/login');
    }

    //修改登录密码
    public function update_password(){
        $session_data = array(
            "user_id" => session("user_id"),
            "user_type" => session("user_type"),
            "username" => session("username"),
            "account" =>session("account")
        ); 

        $this->assign("session_data", $session_data);
        $this->display();
    }

    //执行密码修改
    public function do_update_password(){
        $data = $_POST;
        if(!$data['password'] || !$data['new_password'] || !$data['r_password']){
            $result = array(
                "status" => false,
                "message" => "填写信息不完整"
            );
        } elseif($data["new_password"] != $data["r_password"]){
            $result = array(
                "status" => false,
                "message" => "新密码和确认密码不一致"
            );
        } else {
          $where = array(
              "id" => $data["user_id"],
              "password" => md5($data["password"])
          );

          $m_user = D('user');
          $user_data = $m_user->where($where)->find();

          if($user_data){
              $update_data = array(
                  "password" => md5($data["new_password"]),
              );
              
              $update_password = $m_user->where(array('user_id' => $data["user_id"]))->data($update_data)->save();
              
              if($update_password){
                  $result = array(
                      "status" => true,
                  );

              }
          } else {
              $result = array(
                  "status" => false,
                  "message" => "原密码错误"
              );
          }
        }
        
        $this->ajaxReturn($result);
    }


    public function index(){
      $this->if_login();

      $session_data = array(
          "user_id" => session("user_id"),
          "user_type" => session("user_type"),
          "username" => session("username"),
          "user_account" =>session("user_account")
      ); 

      $this->assign("session_data", $session_data);
      $this->display();
    }

    public function main(){
       $this->if_login();
        
       $this->display();
    }



    //************************************************************用户管理***************************************************************//

    //部门列表
    public function department_list(){
        $m_department = D('department');

        $where = array(
            "is_del" => 0
        );

        $count = $m_department->where($where)->count();
        $p = getpage($count,20);
        $list = $m_department->where($where)->limit($p->firstRow, $p->listRows)->order('id desc')->select();

        $this->assign('page', $p->show()); //赋值分页输出
        $this->assign('list', $list);
        $this->display();
    }

    //部门添加页面
    public function department_add(){

      $this->display();
    }

    //执行部门添加
    public function department_add_do(){
      $post_data = $_POST;

      if(!$post_data['department_name']){
          $return = array(
              "status" => false,
              "message" => "部门名称不能为空"
          );
      } else {
          $add_data = array(
              "department_name" => $post_data["department_name"],
              "create_time" => time()
          );
          $m_department = D('department');
          $result = $m_department->add($add_data);

          if($result){
              $return = array(
                  "status" => true
              );
          } else {
              $return = array(
                  "status" => false,
                  "message" => "添加失败"
              );
          }
      }
      
      $this->ajaxReturn($return);
    }

    //部门编辑页面
    public function department_edit(){
      $id = $_GET['id'];
      $post_data = $_POST;

      $m_department = D('department');
      $where = array(
          "id" => $id
      );
      $data = $m_department->where($where)->find();

      $this->assign("data", $data);
      $this->assign("id", $id);
      $this->display();
    }

    //执行部门编辑
    public function department_edit_do(){
      $post_data = $_POST;

      if(!$post_data['department_name']){
          $return = array(
              "status" => false,
              "message" => "部门名称不能为空"
          );
      }
      $m_department = D('department');

      $result = $m_department->save($post_data);

      if($result){
          $return = array(
              "status" => true
          );
      } else {
          $return = array(
              "status" => false,
              "message" => "编辑失败"
          );
      }

      $this->ajaxReturn($return);
    }

    //部门删除
    public function department_del(){
      $id = $_POST['id'];
      $m_department = D('department');

      $save_data = array(
          "id" => $id,
          "is_del" => 1
      );
      $result = $m_department->save($save_data);

      if($result){
          $return = array(
              "status" => true
          );
      } else {
          $return = array(
              "status" => false,
              "message" => "删除失败"
          );
      }

      $this->ajaxReturn($return);
    }



    //职务列表
    public function duty_list(){
      $m_duty = D('duty');
      $where = array(
          "is_del" => 0
      );      

      $count = $m_duty->where($where)->count();
      $p = getpage($count, 20);
      $list = $m_duty->where($where)->limit($p->firstRow, $p->listRows)->order('id desc')->relation(true)->select();

      $this->assign("list", $list);
      $this->assign("page", $p->show());
      $this->display();
    }


    //职务添加
    public function duty_add(){
      //获取部门数据
      $m_department = D('department');
      $where = array(
          "is_del" => 0
      ); 
      $data = $m_department->where($where)->select();

      $this->assign("data", $data);
      $this->display();
    }

    //执行职务添加
    public function duty_add_do(){
      $post_data = $_POST;
      if(!$post_data['department_id']){
          $return = array(
              "status" => false,
              "message" => "所属部门不能为空"
          );
      } elseif(!$post_data['duty_name']){
          $return = array(
              "status" => false,
              "message" => "职务名称不能为空"
          );
      } else {
          $add_data = array(
              "department_id" => $post_data["department_id"],
              "duty_name" => $post_data["duty_name"],
              "create_time" => time()
          );
          $m_duty = D('duty');
          $result = $m_duty->add($add_data);

          if($result){
              $return = array(
                  "status" => true
              );
          } else {
              $return = array(
                  "status" => false,
                  "message" => "添加失败"
              );
          }
      }
      
      $this->ajaxReturn($return);
    }

    //职务编辑页面
    public function duty_edit(){
        //获取所有部门数据
        $m_department = D('department');
        $where = array(
            "is_del" => 0
        ); 
        $department_data = $m_department->where($where)->select();

        $id = $_GET['id'];
        $post_data = $_POST;

        $m_duty = D('duty');
        $where = array(
            "id" => $id
        );
        $data = $m_duty->where($where)->relation(true)->find();

        $this->assign("department_data", $department_data);
        $this->assign("data", $data);
        $this->assign("id", $id);
        $this->display();
    }

    //执行职务编辑
    public function duty_edit_do(){
        $post_data = $_POST;

        if(!$post_data['duty_name']){
            $return = array(
                "status" => false,
                "message" => "职务名称不能为空"
            );
        }
        $m_duty = D('duty');
        $result = $m_duty->save($post_data);

        if($result){
            $return = array(
                "status" => true
            );
        } else {
            $return = array(
                "status" => false,
                "message" => "编辑失败"
            );
        }

        $this->ajaxReturn($return);
    }

    //执行职务删除
    public function duty_del(){
        $id = $_POST['id'];
        $m_duty = D('duty');

        $save_data = array(
            "id" => $id,
            "is_del" => 1
        );
        $result = $m_duty->save($save_data);

        if($result){
            $return = array(
                "status" => true
            );
        } else {
            $return = array(
                "status" => false,
                "message" => "删除失败"
            );
        }

        $this->ajaxReturn($return);
    }

    //用户列表
    public function user_list(){
      $m_user = D('user');
      $where = array(
          "is_del" => 0
      );

      $count = $m_user->where($where)->count();
      $p = getpage($count, 20);

      $list = $m_user->where($where)->limit($p->firstRow, $p->listRows)->order('id desc')->relation(true)->select();

      $this->assign("list", $list);
      $this->assign("page", $p->show());
      $this->display();
    }

    //用户添加页面
    public function user_add(){
        //获取部门数据
        $m_department = D('department');
        $where = array(
            "is_del" => 0
        ); 
        $data = $m_department->where($where)->select();
        //获取职务数据
        $m_duty = D('duty');
        $data_duty = $m_duty->where($where)->select();

        $this->assign("data_duty", $data_duty);
        $this->assign("data", $data);
        $this->display();
    }

    //执行用户添加
    public function user_add_do(){
      $post_data = $_POST;
      if(!$post_data['department_id']){
          $return = array(
              "status" => false,
              "message" => "所属部门不能为空"
          );
      } elseif(!$post_data['duty_id']){
          $return = array(
              "status" => false,
              "message" => "所属职务不能为空"
          );
      } elseif($post_data['user_type'] == ""){
          $return = array(
              "status" => false,
              "message" => "用户类型不能为空"
          );
      } elseif(!$post_data['username']){
          $return = array(
              "status" => false,
              "message" => "用户姓名不能为空"
          );
      } elseif(!$post_data['account']){
          $return = array(
              "status" => false,
              "message" => "登录账户不能为空"
          );
      } else {
          $add_data = array(
              "department_id" => $post_data["department_id"],
              "duty_id" => $post_data["duty_id"],
              "user_type" => $post_data["user_type"],
              "username" => $post_data["username"],
              "account" => $post_data["account"],
              "create_time" => time()
          );
          $m_user = D('user');
          $result = $m_user->add($add_data);

          if($result){
              $return = array(
                  "status" => true
              );
          } else {
              $return = array(
                  "status" => false,
                  "message" => "添加失败"
              );
          }
      }
      
      $this->ajaxReturn($return);
    }

    //用户编辑页面
    public function user_edit(){
      //获取所有部门数据
      $m_department = D('department');
      $where = array(
          "is_del" => 0
      ); 
      $department_data = $m_department->where($where)->select();

      //获取所有职务数据
      $m_duty = D('duty');
      $where_duty = array(
          "is_del" => 0
      );
      $duty_data = $m_duty->where($where_duty)->select();


      $id = $_GET['id'];
      $post_data = $_POST;

      $m_user = D('user');
      $where = array(
          "id" => $id
      );
      $data = $m_user->where($where)->relation(true)->find();

      $this->assign("duty_data", $duty_data);
      $this->assign("department_data", $department_data);
      $this->assign("data", $data);
      $this->assign("id", $id);
      $this->display();
    }

    //执行用户编辑
    public function user_edit_do(){
      $post_data = $_POST;

      if(!$post_data['department_id']){
          $return = array(
              "status" => false,
              "message" => "所属部门不能为空"
          );
      } elseif(!$post_data['duty_id']){
          $return = array(
              "status" => false,
              "message" => "所属职务不能为空"
          );
      } elseif($post_data['user_type'] == ""){
          $return = array(
              "status" => false,
              "message" => "用户类型不能为空"
          );
      } elseif(!$post_data['username']){
          $return = array(
              "status" => false,
              "message" => "用户姓名不能为空"
          );
      } elseif(!$post_data['account']){
          $return = array(
              "status" => false,
              "message" => "登录账户不能为空"
          );
      } else {
          $m_user = D('user');
          $result = $m_user->save($post_data);

          if($result){
              $return = array(
                  "status" => true
              );
          } else {
              $return = array(
                  "status" => false,
                  "message" => "编辑失败"
              );
          }
      }
        

        $this->ajaxReturn($return);
    }

    //执行用户删除
    public function user_del(){
        $id = $_POST['id'];
        $m_user = D('user');

        $save_data = array(
            "id" => $id,
            "is_del" => 1
        );
        $result = $m_user->save($save_data);

        if($result){
            $return = array(
                "status" => true
            );
        } else {
            $return = array(
                "status" => false,
                "message" => "删除失败"
            );
        }

        $this->ajaxReturn($return);
    }





    //***********************************************************业绩考核管理************************************************************//
    
    //业绩考核列表
    public function yjkh_list(){
      $m_yjkh = D('yjkh');

      $where = array(
          "is_del" => 0
      );

      $count = $m_yjkh->where($where)->count();// 查询满足要求的总记录数
      $p = getpage($count,20); 
      $list = $m_yjkh->where($where)->limit($p->firstRow, $p->listRows)->order('id desc')->relation(true)->select();

      $this->assign('page', $p->show()); //赋值分页输出
      $this->assign("list", $list);
      $this->display();
    }

    //业绩考核添加页面
    public function yjkh_add(){
        //获取考核类型
        $type = $_GET['type'];
        //获取填写人数据
        $user_id_list = session("user_id_list");
        if($user_id_list){
            $user_type = 1;
        } else {
            $user_type = 0;
        }

        //获取所有部门信息
        $m_department = D('department');
        $where = array(
            "is_del" => 0
        );

        $department_data = $m_department->where($where)->select();

        $this->assign("type", $type);
        $this->assign('department_data', $department_data);
        $this->assign('user_type', $user_type);
        $this->display();
    }

    //执行业绩考核添加
    public function yjkh_add_do(){

      $post_data = $_POST;
      $user_id_array = session("user_id_list");
      $user_id_list=implode(',',$user_id_array);

      $use_department_id = $_POST['use_department_id'];
      $assess_type = $_POST['assess_type'];

      $where = array(
          "use_department_id" => $use_department_id,
          "assess_type" => $assess_type 
      );

      

      if(!$post_data['title']){
          $result = array(
              "status" => false,
              "message" => "标题不能为空"
          );
      } elseif (!$post_data['use_department_id']) {
          $result = array(
              "status" => false,
              "message" => "使用部门不能为空"
          );
      } elseif(!$post_data['st'] || !$post_data['et']){
          $result = array(
              "status" => false,
              "message" => "时间范围不能为空"
          );
      } elseif(!$post_data['assess_type']){
          $result = array(
              "status" => false,
              "message" => "考勤类型不能为空"
          );
      } elseif(!$user_id_list){
          $result = array(
              "status" => false,
              "message" => "填写人不能为空"
          );
      } elseif (!$post_data['assessment_name_one']) {
          $result = array(
              "status" => false,
              "message" => "业绩考核项目名称不能为空"
          );
      } elseif (!$post_data['score_one']) {
          $result = array(
              "status" => false,
              "message" => "业绩分数不能为空"
          );
      } elseif (!$post_data['require_one']) {
          $result = array(
              "status" => false,
              "message" => "业绩指标要求不能为空"
          );
      } elseif (!$post_data['opinion_rating_one']) {
          $result = array(
              "status" => false,
              "message" => "业绩评价等级要求不能为空"
          );
      } elseif (!$post_data['assessment_name_one_xw']) {
          $result = array(
              "status" => false,
              "message" => "行为考核指标名称不能为空"
          );
      } elseif (!$post_data['score_one_xw']) {
          $result = array(
              "status" => false,
              "message" => "行为分值不能为空"
          );
      } elseif (!$post_data['require_one_xw']) {
          $result = array(
              "status" => false,
              "message" => "行为指标说明不能为空"
          );
      } elseif (!$post_data['opinion_rating_one_xw']) {
          $result = array(
              "status" => false,
              "message" => "行为考核评分要求不能为空"
          );
      } 

      else {
          $add_data = array(
              "title" => $post_data['title'],
              "use_department_id" => $post_data['use_department_id'],
              "status_time" => strtotime($post_data['st']),
              "end_time" => strtotime($post_data['et']) + 24*60*60-1,
              "assess_type" => $post_data['assess_type'],
              "fill_in_user_id" => $user_id_list,
              "assessment_name_one" => $post_data['assessment_name_one'],
              "score_one" => $post_data["score_one"],
              "require_one" => $post_data["require_one"],
              "opinion_rating_one" => $post_data["opinion_rating_one"],

              "assessment_name_two" => $post_data["assessment_name_two"],
              "score_two" => $post_data["score_two"],
              "require_two" => $post_data["require_two"],
              "opinion_rating_two" => $post_data["opinion_rating_two"],

              "assessment_name_three" => $post_data["assessment_name_three"],
              "score_three" => $post_data["score_three"],
              "require_three" => $post_data["require_three"],
              "opinion_rating_three" => $post_data["opinion_rating_three"],
              
              "assessment_name_four" => $post_data["assessment_name_four"],
              "score_four" => $post_data["score_four"],
              "require_four" => $post_data["require_four"],
              "opinion_rating_four" => $post_data["opinion_rating_four"],

              "assessment_name_one_xw" => $post_data['assessment_name_one_xw'],
              "score_one_xw" => $post_data["score_one_xw"],
              "require_one_xw" => $post_data["require_one_xw"],
              "opinion_rating_one_xw" => $post_data["opinion_rating_one_xw"],

              "assessment_name_two_xw" => $post_data["assessment_name_two_xw"],
              "score_two_xw" => $post_data["score_two_xw"],
              "require_two_xw" => $post_data["require_two_xw"],
              "opinion_rating_two_xw" => $post_data["opinion_rating_two_xw"],

              "assessment_name_three_xw" => $post_data["assessment_name_three_xw"],
              "score_three_xw" => $post_data["score_three_xw"],
              "require_three_xw" => $post_data["require_three_xw"],
              "opinion_rating_three_xw" => $post_data["opinion_rating_three_xw"],
              
              "create_time" => time()
          );

          $m_yjkh = D('yjkh');

          $return = $m_yjkh->add($add_data);
          if($return){
              $result = array(
                  "status" =>true,
              );
          } else {
              $result = array(
                  "status" => false,
                  "message" => "添加失败"
              );
          }
      }

      $this->ajaxReturn($result);
    }

    //绩效考核详情
    public function yjkh_details(){
      $id = $_GET['id'];
      $m_yjkh = D('yjkh');
      $where = array(
          "id" => $id,
          "is_del" => 0
      );
      $data = $m_yjkh->where($where)->relation(true)->find();
      //获取参与用户数据
      $fill_in_user_id_array = explode(',',$data['fill_in_user_id']); //将字符串转换成数组
      $m_user = D('user');
      foreach ($fill_in_user_id_array as $key => $value) {
          //获取参与用户数据
          $user_data[] = $m_user->where(array('id' => $value))->field('id,username')->find();
      }

      $this->assign("data", $data);
      $this->assign("user_data", $user_data);

      $this->display();
    }

    //绩效考核编辑页面
    public function yjkh_edit(){
      $id = $_GET['id'];
      $m_yjkh = D('yjkh');
      $where = array(
          "id" => $id,
          "status" => 0
      );
      $data = $m_yjkh->where($where)->relation(true)->find();
      //获取参与用户数据
      $fill_in_user_id_array = explode(',',$data['fill_in_user_id']); //将字符串转换成数组
      $m_user = D('user');
      foreach ($fill_in_user_id_array as $key => $value) {
          //获取参与用户数据
          $user_data[] = $m_user->where(array('id' => $value))->field('id,username')->find();
      }

      //查询所有部门信息
      $m_department = D('department');
      $where_department = array(
          "is_del" => 0
      );
      $department_data = $m_department->where($where_department)->field('id,department_name')->select();

      $this->assign("department_data", $department_data);
      $this->assign("data",$data);
      $this->assign("user_data", $user_data);

      $this->assign('id', $id);
      $this->display();      
    }

    //执行绩效考核编辑
    public function yjkh_edit_do(){
        $post_data = $_POST;
        $user_id_array = session("user_id_list");

        $user_id_list=implode(',',$user_id_array);

        if(!$user_id_list){
            $user_id_list = $post_data['fill_in_user_id'];
        }

        $assess_type = $_POST['assess_type'];

        if(!$post_data['title']){
          $result = array(
              "status" => false,
              "message" => "标题不能为空"
          );
        } elseif (!$post_data['use_department_id']) {
            $result = array(
                "status" => false,
                "message" => "使用部门不能为空"
            );
        } elseif(!$post_data['st'] || !$post_data['et']){
            $result = array(
                "status" => false,
                "message" => "时间范围不能为空"
            );
        } elseif(!$post_data['assess_type']){
            $result = array(
                "status" => false,
                "message" => "考勤类型不能为空"
            );
        } elseif(!$user_id_list){
            $result = array(
                "status" => false,
                "message" => "填写人不能为空"
            );
        } elseif (!$post_data['assessment_name_one']) {
            $result = array(
                "status" => false,
                "message" => "考核项目名称不能为空"
            );
        } elseif (!$post_data['score_one']) {
            $result = array(
                "status" => false,
                "message" => "分数不能为空"
            );
        } elseif (!$post_data['require_one']) {
            $result = array(
                "status" => false,
                "message" => "指标要求不能为空"
            );
        } elseif (!$post_data['opinion_rating_one']) {
            $result = array(
                "status" => false,
                "message" => "评价等级要求不能为空"
            );
        } elseif (!$post_data['assessment_name_one_xw']) {
          $result = array(
              "status" => false,
              "message" => "行为考核指标名称不能为空"
          );
      } elseif (!$post_data['score_one_xw']) {
          $result = array(
              "status" => false,
              "message" => "行为分值不能为空"
          );
      } elseif (!$post_data['require_one_xw']) {
          $result = array(
              "status" => false,
              "message" => "行为指标说明不能为空"
          );
      } elseif (!$post_data['opinion_rating_one_xw']) {
          $result = array(
              "status" => false,
              "message" => "行为考核评分要求不能为空"
          );
      } 

        else {
            $edit_data = array(
                "id" => $post_data["id"],
                "title" => $post_data['title'],
                "use_department_id" => $post_data['use_department_id'],
                "status_time" => strtotime($post_data['st']),
                "end_time" => strtotime($post_data['et']) + 24*60*60-1,
                "assess_type" => $post_data['assess_type'],
                "fill_in_user_id" => $user_id_list,

                "assessment_name_one" => $post_data["assessment_name_one"],
                "score_one" => $post_data["score_one"],
                "require_one" => $post_data["require_one"],
                "opinion_rating_one" => $post_data["opinion_rating_one"],

                "assessment_name_two" => $post_data["assessment_name_two"],
                "score_two" => $post_data["score_two"],
                "require_two" => $post_data["require_two"],
                "opinion_rating_two" => $post_data["opinion_rating_two"],

                "assessment_name_three" => $post_data["assessment_name_three"],
                "score_three" => $post_data["score_three"],
                "require_three" => $post_data["require_three"],
                "opinion_rating_three" => $post_data["opinion_rating_three"],

                "assessment_name_four" => $post_data["assessment_name_four"],
                "score_four" => $post_data["score_four"],
                "require_four" => $post_data["require_four"],
                "opinion_rating_four" => $post_data["opinion_rating_four"],

                "assessment_name_one_xw" => $post_data['assessment_name_one_xw'],
                "score_one_xw" => $post_data["score_one_xw"],
                "require_one_xw" => $post_data["require_one_xw"],
                "opinion_rating_one_xw" => $post_data["opinion_rating_one_xw"],

                "assessment_name_two_xw" => $post_data["assessment_name_two_xw"],
                "score_two_xw" => $post_data["score_two_xw"],
                "require_two_xw" => $post_data["require_two_xw"],
                "opinion_rating_two_xw" => $post_data["opinion_rating_two_xw"],

                "assessment_name_three_xw" => $post_data["assessment_name_three_xw"],
                "score_three_xw" => $post_data["score_three_xw"],
                "require_three_xw" => $post_data["require_three_xw"],
                "opinion_rating_three_xw" => $post_data["opinion_rating_three_xw"]
            );

            $m_yjkh = D('yjkh');
            $request = $m_yjkh->save($edit_data);

            if($request){
                $result = array(
                    "status" => true
                );
            } else {
                $result = array(
                    "status" => false,
                    "message" => "编辑失败"
                );
            }
        }

        $this->ajaxReturn($result);
    }

    //绩效考核删除
    public function yjkh_del(){
        $id = $_POST['id'];
        $m_yjkh = M('yjkh');
        $save_data = array(
            "id" => $id,
            "is_del" => 1
        );
        
        $result = $m_yjkh->save($save_data);
        
        if($result){
            $result = array(
                "status" => true
            );
        } else {
            $result = array(
                "status" => false
            );
        }
        
        $this->ajaxReturn($result);
    }

    //填写人群列表
    public function yjkh_fill_in_user_add(){
        $m_department = D('department');
        $where = array(
            "is_del" => 0
        );

        $department_data = $m_department->where($where)->relation(true)->select();


        $this->assign('department_data', $department_data);
        $this->display();
    }

    //执行添加填写人
    public function yjkh_fill_in_user_add_to(){
        session("user_id_list", $_POST['user_id']);

        $user_id_list = session("user_id_list");
        
        if($user_id_list){
            $result = array(
                "status" => true
            );
        } else {
            $result = array(
                "status" => false,
                "message" => "提交失败"
            );
        }    

        $this->ajaxReturn($result);  
    }

    //我的绩效考核列表
    public function yjkh_list_oneself(){
        $m_user_yjkh = D('user_yjkh');
        $where = array(
            "is_del" => 0,
            "appraiser_id" => session("user_id")
        );
        
        $count = $m_user_yjkh->where($where)->count();
        $p = getpage($count, 20);
        $list = $m_user_yjkh->where($where)->limit($p->firstRow, $p->listRows)->relation(true)->select();

        //获取用户信息
        $m_user = D('user');
        $user_id = session("user_id");
        $user_data = $m_user->where(array('id' => $user_id))->find();
        $department_id = $user_data['department_id'];
        $m_yjkh = D('yjkh');

        //查询当前用户是否有考核（自评）
        $where_data_one = array(
            "is_del" => 0,
            "assess_type" => 1
        );

        $result_one = $m_yjkh->where($where_data_one)->select();

        $yjkh_data_one = array();
        foreach ($result_one as $key => $value) {
            $fill_in_user_id_array_one = explode(',',$value['fill_in_user_id']); //将字符串转换成数组
            if(in_array($user_id, $fill_in_user_id_array_one)){ //填写人id是否包含当前用户id
                  $yjkh_data_one[] = $value;
            }
        }
        
        if($yjkh_data_one){
            $yjkh_data_one = true;
        } else {
            $yjkh_data_one = false;
        }

        //查询当前用户是否有绩效考核（互评）
        $where_data_two = array(
            "is_del" => 0,
            "assess_type" => 2
        );
        $result_two = $m_yjkh->where($where_data_two)->select();

        $yjkh_data_two = array();
        foreach ($result_two as $key => $value) {
            $fill_in_user_id_array_two = explode(',',$value['fill_in_user_id']); //将字符串转换成数组
            if(in_array($user_id, $fill_in_user_id_array_two)){ //填写人id是否包含当前用户id
                  $yjkh_data_two[] = $value;
            }
        }
        
        if($yjkh_data_two){
            $yjkh_data_two = true;
        } else {
            $yjkh_data_two = false;
        }
        
        $this->assign("yjkh_data_one",$yjkh_data_one);
        $this->assign("yjkh_data_two",$yjkh_data_two);

        $this->assign("username", session("username"));
        $this->assign("page", $p->show());
        $this->assign("list", $list);
        $this->display();
    }

    //我的绩效考核添加页面
    public function user_yjkh_add(){
        
        $user_id = session("user_id");
        $m_user = D('user');
        $m_yjkh = D('yjkh');
        $where = array(
            "id" => $_GET['id']
        );
        $yjkh_list = $m_yjkh->where($where)->find();
        $yjkh_data = array();

        $fill_in_user_id_array = explode(',',$yjkh_list['fill_in_user_id']); //将字符串转换成数组
        if(in_array($user_id, $fill_in_user_id_array)){ //填写人id是否包含当前用户id
              $yjkh_data = $yjkh_list;
        }

        //除去自己的id
        foreach ($fill_in_user_id_array as $key => $value) {
            if($user_id == $value) {
                unset($fill_in_user_id_array[$key]);
            }
        }

        //查询出所有互评用户信息
        foreach ($fill_in_user_id_array as $key => $value) {
            $where_user = array(
               "id" => $value
            );

            $assess_user_data[] = $m_user->where($where_user)->field('id,username')->find();
        }
        
        $this->assign("assess_user_data", $assess_user_data);
        $this->assign("type", $type);
        $this->assign("assess_type", $assess_type);
        $this->assign('yjkh_data', $yjkh_data);
        $this->display();
    }

    //执行我的业绩考核添加
    public function user_yjkh_add_do(){
        $post_data = $_POST;
        //判断当前时间是否在填写时间范围内
        $now_time = time();
        $status_time = $_POST['status_time'];
        $end_time = $_POST['end_time'];
        //判断是否已经填写过该类型的考核
        $yjkh_id = $_POST['yjkh_id'];

        $is_true = false;

        if($post_data['assess_type'] == 1){ //自评
            if(!$post_data['self_assessment_one'] || !$post_data['self_assessment_one_xw']){
                $result = array(
                    "status" => false,
                    "message" => "评分信息不完整"
                );
            } else {
              $is_true = true;
              $post_data['by_appraiser_id'] = session('user_id');
            }
        } elseif($post_data['assess_type'] == 2){ //互评
            if(!$post_data['peer_assessment_one'] || !$post_data['peer_assessment_one_xw']){
                $result = array(
                    "status" => false,
                    "message" => "评分信息不完整"
                );
            } elseif (!$post_data['by_appraiser_id']) {
              $result = array(
                      "status" => false,
                      "message" => "互评人不能为空"
                  );
            } else {
                  $is_true = true;
            }
        }

        if($is_true){
            $add_data = array(
                "appraiser_id" => session("user_id"), //评价人id
                "by_appraiser_id" => $post_data['by_appraiser_id'],  //被评价人id
                "yjkh_id" => $post_data['yjkh_id'],
                "assess_type" => $post_data["assess_type"],
                "self_assessment_one" => $post_data['self_assessment_one'],
                "peer_assessment_one" => $post_data['peer_assessment_one'],
                "self_assessment_two" => $post_data['self_assessment_two'],
                "peer_assessment_two" => $post_data['peer_assessment_two'],
                "self_assessment_three" => $post_data['self_assessment_three'],
                "peer_assessment_three" => $post_data['peer_assessment_three'],
                "self_assessment_four" => $post_data['self_assessment_four'],
                "peer_assessment_four" => $post_data['peer_assessment_four'],

                "self_assessment_one_xw" => $post_data['self_assessment_one_xw'],
                "peer_assessment_one_xw" => $post_data['peer_assessment_one_xw'],
                "self_assessment_two_xw" => $post_data['self_assessment_two_xw'],
                "peer_assessment_two_xw" => $post_data['peer_assessment_two_xw'],
                "self_assessment_three_xw" => $post_data['self_assessment_three_xw'],
                "peer_assessment_three_xw" => $post_data['peer_assessment_three_xw'],

                "score_total" => $post_data['score_total'],
                "score_total_xw" => $post_data['score_total_xw'],
                "create_time" => time()
            );

            $m_user_yjkh = D('userYjkh');
            $request = $m_user_yjkh->add($add_data);

            if($request){
                $result = array(
                    "status" => true,
                );
            } else {
                $result = array(
                    "status" => false,
                    "message" => "添加失败"
                );
            }
        }

        $this->ajaxReturn($result);
    }

    //绩效考核编辑页面
    public function user_yjkh_edit(){
      $id = $_GET['id'];
      $user_id = session("user_id");
      $m_user_yjkh = D('userYjkh');
      $m_user = D('user');
      $where = array(
          "id" => $id
      );

      $user_yjkh_data = $m_user_yjkh->where($where)->relation(true)->find();
      //互评人id
      $fill_in_user_id_array = explode(',',$user_yjkh_data['yjkh_data']['fill_in_user_id']); //将字符串转换成数组

      //除去自己的id
      foreach ($fill_in_user_id_array as $key => $value) {
          if($user_id == $value) {
              unset($fill_in_user_id_array[$key]);
          }
      }

      //查询出所有互评用户信息
      foreach ($fill_in_user_id_array as $key => $value) {
          $where_user = array(
             "id" => $value
          );

          $assess_user_data[] = $m_user->where($where_user)->field('id,username')->find();
      }

      $this->assign('id', $id);
      $this->assign('assess_user_data', $assess_user_data);
      $this->assign('user_yjkh_data', $user_yjkh_data);
      $this->display();
    }

    //执行绩效考核编辑
    public function user_yjkh_edit_to(){
        $post_data = $_POST;
        $m_user_yjkh = D('user_yjkh');
        $return = $m_user_yjkh->save($post_data);

        if($return){
            $result = array(
                "status" => trun
            );
        } else {
            $result = array(
                "status" => false,
                "message" => "编辑失败"
            );
        }     

        $this->ajaxReturn($result);  
    }

    //考核历史页面
    public function user_yjkh_list(){
        $m_user_yjkh = D('userYjkh');
        $where = array(
            "is_del" => 0
        );

        $count = $m_user_yjkh->where($where)->count();
        $p = getpage($count, 20);
        $list = $m_user_yjkh->where($where)->limit($p->firstRow, $p->listRows)->relation(true)->select();

        $this->assign("page", $p->show());
        $this->assign("list", $list);
        $this->display();
    }

    //考核历史详情页
    public function user_yjkh_details(){
        $id = $_GET['id'];
        $where = array(
            "id" => $id
        );

        $m_user_yjkh = D('userYjkh');
        $data = $m_user_yjkh->where($where)->relation(true)->find();
        //使用部门查询
        $department_data = D('department')->where(array('id' => $data['yjkh_data']['use_department_id']))->find();

        $this->assign('department_data', $department_data);
        $this->assign('data', $data);
        $this->display();
    }

    //考核类型列表
    public function user_yjkh_type_list(){

        //获取用户信息
        $user_id = session("user_id");
        $assess_type = $_GET['assess_type'];
        $m_yjkh = D('yjkh');

        //查询当前用户是否有绩效考核
        $where_data_one = array(
            "is_del" => 0,
            "assess_type" => $assess_type
        );

        $result_data = $m_yjkh->where($where_data_one)->select();
        $yjkh_data = array();

        foreach ($result_data as $key => $value) {
            $fill_in_user_id_array = explode(',',$value['fill_in_user_id']); //将字符串转换成数组
            if(in_array($user_id, $fill_in_user_id_array)){ //填写人id是否包含当前用户id
                  $yjkh_data[] = $value;
            }
        }
        
        $this->assign("list", $yjkh_data);
        $this->display();
      }
    

}