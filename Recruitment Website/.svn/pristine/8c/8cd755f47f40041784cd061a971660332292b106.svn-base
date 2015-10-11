<?php
/*
**author: 伍志强
**      : 谢辰
**function: HR注册功能
**AlterTime: 2015/04/07
**         : 2015/04/19
**         : 2015/04/25---改成Ajax异步
*/
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Classes\Users;
	use Lib\Interfaces\Register;
	class HRController extends Users implements Register{
		public function indiReg(){
            $this->display();
		}
		public function hrReg(){
			$reg_data = array(
				'userType' => '1',
				'userEmail' => I("reg_username"),
				'userPassword' => I("reg_password",'',md5),
				'userEmailCode' => $rand=mt_rand(100000,999999),
				'userTelCode' => $rand=mt_rand(100000,999999),
				);
			$verify = I("verify_ip");
			if(!check_verify($verify)){
				//$this->error('验证码错误');
				$this->ajaxReturn(array('status' => '验证码错误'),'json');
			}
			//$_SESSION['verify'];die;
			//dump($reg_data);die;
            //定义自动完成规则
            $rules=array(
				array('userEmail', '', '邮箱名称已经存在！',0,'unique',1),
				);
	        $auto_rules=array(
		      //array('userType','1'),  //HR注册将userType标志为1
	          //array('userEmail', 'unique', '邮箱名称已经存在！',1,'unique'),
	          array('userRegisterTime',date("Y-m-d H:i:s")),  //自动填充当前时间戳
              //array('userPassword','md5',3,'function') , // 对userPassword字段在新增和编辑的时候使md5函数处理
              //array('userEmailCode' => $rand=mt_rand(100000,999999)),
              //array('userTelCode' => $rand=mt_rand(100000,999999)),
		    );
            $user_info = M("user_info");                     // 实例化user_info对象
		    $hr_info=M('hr_info');
            if (!$user_info->auto($auto_rules)->validate($rules)->create($reg_data)){
            // 如果创建失败 表示验证没有通过 输出错误提示信息
            	//exit($user_info->getError());   
            	$this->ajaxReturn(array('status' => $user_info->getError()),'json');
           }
	       else{
           // 验证通过 可以进行其他数据操作
	            $result=$user_info->add();
	            if($result){
               $data=array('hrId' => $result, 'hrEmail' => $reg_data['userEmail']);
			   $hr_info->data($data)->add();  //将该userId存入hrId
			   //$this->success('注册成功');
			    R('HR/emailCheck',array('emailAddr' => $reg_data['userEmail'], 'checkCode' => $reg_data['userEmailCode']));
			    $this->ajaxReturn(array('status' => '注册成功'),'json');
			}
		    else
               //$this->error('注册失败');
		    	$this->ajaxReturn(array('status' => '注册失败'),'json');
            }
	
		}//HR注册

	}
?>