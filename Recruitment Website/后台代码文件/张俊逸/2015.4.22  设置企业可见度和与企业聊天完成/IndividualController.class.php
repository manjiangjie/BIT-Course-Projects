<?php
/*
*author: 伍志强
*function: 个人注册功能
*AlterTime: 2015/04/07
*/
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Classes\Users;
	use Lib\Interfaces\Register;
	class IndividualController extends Users implements Register{
		public function indiReg(){
    //定义自动完成规则
	$auto_rules=array(
		array('userType','0'),  //个人注册将userType标志为0
	    array('userRegisterTime',date("Y-m-d H:i:s")),  //自动填充当前时间戳
        array('userPassword','md5',3,'function')  // 对userPassword字段在新增和编辑的时候使md5函数处理
		);
        $user_info = M("user_info");                     // 实例化user_info对象
		$applicant_info=M('applicant_info');             
        if (!$user_info->auto($auto_rules)->create()){

            // 如果创建失败 表示验证没有通过 输出错误提示信息
             exit($user_info->getError());
       }
	    else{
           // 验证通过 可以进行其他数据操作
	       $result=$user_info->add();   //执行添加操作,$result里存的是最新插入的id
		   if($result)
			{
               $data=array('applicantId' => $result);
			   $applicant_info->data($data)->add();  //将当前useId的值插入applicantId
			   $this->success('注册成功');
			}
		   else
               $this->error('注册失败');
            }
		}//个人注册

		public function hrReg(){
			$this->display();
           
		}
	}
?>