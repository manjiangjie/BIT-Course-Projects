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
		$this->redirect('WebShow/home');
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
		//echo '<script type="javascript/text">alert("adasdad");</script>';
		if(!$username || !$password){
			$this->redirect('WebShow/home');
	    }
		//$remember_pwd = I('chk_remember_pwd');

		$user = M('user_info')->where(array('userEmail' => $username))->find();
		if(is_null($user)){
			$this->error('用户不存在','HOME');
		}
		if($user['useremail'] != $username || $user['userpassword'] != $password){
			$this->error('用户或密码错误','HOME');
		}
		if($user['userstatus'] == 2){
			$this->error('账户被锁定，请联系我们','HOME');
		}
		else if ($user['userstatus'] == 0) {

			$this->display('Index/comfirm_account');
			return;
		}
		session('uid', $user['userid']);
		session('userName', $user['useremail']);
		session('userType', $user['usertype']);
		session('userStatus',$user['userstatus']);
		//echo 'individualRadio:'.$userType.',hrRadio:'.$userType1.',';
	//	echo 'individualRadio:'.$userType_individual.',hrRadio:'.$userType_hr.',';
	//	//echo $remember_pwd;die;
	//	dump($user);die;
		//echo $user['usertype'];die;
		//$this->success('登录成功','');
		/*if($userType_individual == 'on'){
			echo 'adasdadasd';
			die;
		}*/
		
		if($user['usertype'] == 1 && $userType_individual == 'on'){
			//if($remember_pwd){
				//echo 'asd';die;
			//	session('pwd',$password);
			//}
			//dump(1111);die;
			$basedInfo = M('applicant_info')->where(array('applicantId' => $user['userid']))->find();
			if(!$basedInfo['applicantname'] || !$basedInfo['applicantbirthday'] || !$basedInfo['applicantsex']){
				//$this->redirect('Index/添加个人基本信息');
			}
			$this->redirect('WebShow/personal-front');
		}
		else if($user['usertype'] == 2 && $userType_hr == 'on'){
			$basedInfo = M('hr_info')->where(array('hrId' => $user['userid']))->find();
			if(!$basedInfo['hrname'] || !$basedInfo['hrsex'] || !$basedInfo['hrtelnum'] || !$basedInfo['hremail'] || !$basedInfo['hrjob']){
				//$this->redirect('Index/添加HR基本信息');
			}
			$this->redirect('WebShow/HRfrontpage');
		}
		$this->error('用户不存在!','HOME');
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
			$url = U('WebShow/find_password',array('params'=> md5($uid)),'');
			$mailContent = '点这里->_->'.'http://localhost/'.$url;

			//$this->ajaxReturn(array('status' => $url ),'json');

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
		$verify  =I('verify');
		$res = M('user_info')->select();//->where(array('md5(userName)' => $uid))
		//dump($res);die;
		//echo $res[0]['userid'].','.$uid;die;
		if(!check_verify($verify)){
			//$this->error('验证码错误');
			$this->ajaxReturn(array('status' => '验证码错误'),'json');
		}
		//$this->ajaxReturn(array('status' => $uid),'json');
		//$this->ajaxReturn(array('status' => $res['username']),'json');
		$i=0;
		foreach($res as $r){
	    //$this->ajaxReturn(array('status' => $res['userid']),'json');
		//dump($res);die;

		   if(md5($r[$i]['userid']) == $uid){
			  //$this->ajaxReturn(array('status' => 'asasdsad','json'));
			  $newPwd = I('password','',md5);
			  M('user_info')->where(array('userid' => $r[$i]['userid']))->save(array('userPassword' => $newPwd));
			  $this->ajaxReturn(array('status' => '修改成功'),'json');
		   }
		   $i=$i+1;
	    }
		$this->ajaxReturn(array('status' => '修改失败'),'json');
	}
	public function pass(){
		$uemail = $_GET['params'];
		$res = M('user_info')->select();
		//dump(md5($res[0]['useremail']));echo $uemail;die;
		//$i=0;
		foreach($res as $r){
			//dump($r);
			if(md5($r['useremail']) == $uemail){
				M('user_info')->where(array('userEmail' => $r['useremail']))->save(array('userStatus' => '1'));
				$this->success('验证成功，即将跳转回主页',U('WebShow/HOME'));
		    }
		    //$i = $i + 1;
		}
		die;
		//dump($paramVal);die;
		$this->error('验证失败，即将跳转回主页',U('WebShow/HOME'));
	}
	public function comfirm_account(){
		$emailAddr = I('emailAddr');
		$verify = I('verify');
		if(!check_verify($verify)){
			//$this->error('验证码错误');
			$this->ajaxReturn(array('status' => '验证码错误'),'json');
		}
		R('HR/emailCheck',array('emailAddr' => $emailAddr));
		$this->ajaxReturn(array('status' => '验证邮件已发出'),'json');
    }
}
?>