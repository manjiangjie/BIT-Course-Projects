<?php
/*
*author: 谢辰
       : 彭翰元
*function: 用户登录，用户登出的功能
*AlterTime: 2015/04/05
*/
	namespace Lib\Classes;
	use Lib\Interfaces\Login;
	use Lib\Interfaces\AddInfo;
	use Lib\Interfaces\Search;
	use Think\Controller;
	use Home\Controller\CommonController;
	

	class Users extends CommonController implements Login{
		public function login(){
			echo 'adfad';die;
			$username = I('username');
			$password = I('password','','md5');

			$user = M('user_info')->where(array('userEmail' => $username))->find();
			
			if($user['userEmail'] != $username || $user['userPassword'] != $password){
				$this->error('用户或密码错误');

			}

			session('uid', $user['userID']);
			session('userName', $user['userEmail']);
			session('userType', $user['userType']);

			$this->success('登录成功','');
			if($user['userType'] == 0){
				$this->redirect('IndividualPage.html');
			}
			else if($user['userType'] == 1){
				$this->redirect('HRPage.html');
			}
		}//登录

		public function emailCheck(){
			$email = $_SESSION['userName'];
			$mailTitle = '十三行邮箱验证邮件';
			$registerNum = md5($_SESSION['uid']);
			$mailContent = '验证了！！！！！！！！'.'http://localhost/'.U('Common/pass',array('params'=>$registerNum,'template'=>'default'),'');
			if(sendMail($email,$mailTitle,$mailContent)){
				$this->success('发送成功',U('Common/home'));
			}
			else{
				$this->error('发送失败');
			}
		}//邮箱验证
		public function logout(){
			session_unset();
			session_destroy();
			$this->redirect('Common/logout');
		}
	}
?>