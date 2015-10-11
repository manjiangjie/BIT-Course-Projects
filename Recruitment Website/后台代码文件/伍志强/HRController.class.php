<?php
/*
*author: 伍志强
*function: HR注册功能
*AlterTime: 2015/04/07
*/
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Classes\Users;
	use Lib\Interfaces\Register;
	class HRController extends Users implements Register{
		public function indiReg(){
            
		}
		public function hrReg(){
 
    //定义自动完成规则
	$auto_rules=array(
		array('userType','1'),  //HR注册将userType标志为1
	    array('userRegisterTime',date("Y-m-d H:i:s")),  //自动填充当前时间戳
        array('userPassword','md5',3,'function') , // 对userPassword字段在新增和编辑的时候使md5函数处理
		);
        $user_info = D("user_info");                     // 实例化user_info对象
		$hr_info=M('hr_info');
        if (!$user_info->auto($auto_rules)->create()){

            // 如果创建失败 表示验证没有通过 输出错误提示信息
             exit($user_info->getError());   
       }
	    else{
           // 验证通过 可以进行其他数据操作
	       $result=$user_info->add();
		   if($result)
			{
               $data=array('hrId' => $result);
			   $hr_info->data($data)->add();  //将该userId存入hrId
			   $this->success('注册成功');
			}
		   else
               $this->error('注册失败');
            }
	
		}//HR注册

	}
?>