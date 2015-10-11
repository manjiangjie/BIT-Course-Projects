<?php
/*
**Author: 谢辰
**Function: 登录登出
**AlterTime: 2015/04/17
*/
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Interfaces\Login;

class UserLogController extends Controller implements Login{
	public function home(){
		$this->display('Index/Home');
	}
	public function login(){
		$username = I('username');
		$password = I('password','','md5');
		$userType = I('individualRadio');

		$user = M('user_info')->where(array('userEmail' => $username))->find();
		echo $username.','.$password.','.$userType;
		

		if($user['useremail'] != $username || $user['userpassword'] != $password){
			$this->error('用户或密码错误','Index/HOME');
		}
		session('uid', $user['userid']);
		session('userName', $user['useremail']);
		session('userType', $user['usertype']);

		//$this->success('登录成功','');
		if($user['usertype'] == 0){
			$this->redirect('Index/IndividualPage');
		}
		else if($user['usertype'] == 1){
			$this->redirect('Index/HRPage');
		}
	}//登录
	public function logout(){
		session_unset();
		session_destroy();
		$this->redirect('Index/HOME');
	}
}
?>