<?php
/*
**author: 谢辰
       : 彭翰元
**function: 用户登录，用户登出的功能
**AlterTime: 2015/04/05
**         : 2015/04/17
*/
	namespace Lib\Classes;
	use Lib\Interfaces\AddInfo;
	use Lib\Interfaces\Search;
	use Think\Controller;
	

	class Users extends Controller{
		public function emailCheck(){
			$email = $_SESSION['userName'];
			$mailTitle = '十三行邮箱验证邮件';
			$registerNum = md5($_SESSION['uid']);
			$mailContent = '验证了！！！！！！！！'.'http://localhost/'.U('Common/pass',array('params'=>$registerNum,'template'=>'default'),'');
			if(sendMail($email,$mailTitle,$mailContent)){
				$this->success('发送成功',U('Common/HOME'));
			}
			else{
				$this->error('发送失败');
			}
		}//邮箱验证
	}
?>