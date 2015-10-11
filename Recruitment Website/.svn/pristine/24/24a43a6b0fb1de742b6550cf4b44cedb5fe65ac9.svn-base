<?php
/*
**Author: 谢辰
**Function: 登录登出
**AlterTime: 2015/04/17
**         : 2015/04/23
**         : 2015/04/24
*/
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Interfaces\Login;

class UserLogController extends Controller implements Login{
	public function home(){
		//verify_img();
		$this->display('WebShow/home');
	}
	public function getVerify(){
		verify_img();
	}
	public function login(){
		$username = I('username');
		$password = I('password','',md5);
		$userType_individual = I('individualRadio1');
		$userType_hr = I('hrRadio1');
		//echo $username.','.I('password').','.$userType_individual.','.$userType_hr;die;
		if(!$username || !$password){
			$this->redirect('WebShow/home');
	    }
		//$remember_pwd = I('chk_remember_pwd');

		$user = M('user_info')->where(array('userEmail' => $username))->find();

		if($user['useremail'] != $username || $user['userpassword'] != $password){
			$this->error('用户或密码错误','HOME');
		}
		if($user['userstatus'] == 3){
			$this->error('账户被锁定','HOME');
		}
		session('userId', $user['userid']);
		session('userName', $user['useremail']);
		session('userType', $user['usertype']);
		//echo 'individualRadio:'.$userType.',hrRadio:'.$userType1.',';
		//echo 'individualRadio:'.$userType_individual.',hrRadio:'.$userType_hr.',';
		//echo $remember_pwd;die;
		//dump($user);die;
		//$this->success('登录成功','');
		/*if($userType_individual == 'on'){
			echo 'adasdadasd';
			die;
		}*/
		
		if($user['usertype'] == 0 && $userType_individual == 'on'){
			//if($remember_pwd){
				//echo 'asd';die;
			//	session('pwd',$password);
			//}
			$this->redirect('Index/personal-front');
		}
		else if($user['usertype'] == 1 && $userType_individual == 'on'){
			$this->redirect('Index/HRPage');
		}
	}//登录
	public function logout(){
		session_unset();
		session_destroy();
		$this->redirect('WebShow/home');
	}
	public function findPwd(){
			//$email = $_SESSION['userName'];
			$emailAddr = I('email');
			$verify = I('verify');
			if(!check_verify($verify)){
				//$this->error('验证码错误');
				$this->ajaxReturn(array('status' => '验证码错误'),'json');
			}

			$result = M('user_info')->where(array('userEmail' => $emailAddr))->find();
			if($result['useremail'] != $emailAddr){
				$this->ajaxReturn(array('status' => '邮箱未注册'),'json');
		    }
			$mailTitle = '十三行密码找回邮件';
			//$findNUm = $result['useremailcode'];
			$uid = $result['usereid'];
			$randNum = md5(mt_rand(1,10000));
			$mailContent = '点这里->_->'.'http://localhost/'.U('WebShow/find_password',array('params'=> $randNum, '/uid'=>$uid),'');
			if(sendMail($emailAddr,$mailTitle,$mailContent)){
				$this->ajaxReturn(array('status' => '发送成功'),'json');
			}
			else{
				//$this->error('发送失败');
				$this->ajaxReturn(array('status' => '发送失败'),'json');
			}
	}//密码找回

	public function resetPwd(){
		//$this->ajaxReturn(array('status' => '修改成功'),'json');
		$uid = I('uid');
		$res = M('user_info')->where(array('md5(userId)' => $uid))->select();
		$this->ajaxReturn(array('status' => $uid),'json');
		//dump($res);die;
		if($res){
			$verify  =I('verify');
			if(!check_verify($verify)){
				//$this->error('验证码错误');
				$this->ajaxReturn(array('status' => '验证码错误'),'json');
			}
			$newPwd = I('password','',md5);
			M('user_info')->where(array('userId' => $uid))->save(array('userPassword' => $newPwd));
			$this->ajaxReturn(array('status' => '修改成功'),'json');
		}
		$this->ajaxReturn(array('status' => '修改失败'),'json');
	}
	public function pass(){
		$paramVal = $_GET['params'];
		dump($paramVal);die;
		$this->success('asdas',U('Index/HOME'));
	}
}
?>