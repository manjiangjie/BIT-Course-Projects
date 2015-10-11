<?php
/*
**author: 谢辰
**      : 彭翰元
**function: 邮箱验证功能
**AlterTime: 2015/04/05
**         : 2015/04/17
**         : 2015/04/26
*/
	namespace Lib\Classes;
	use Lib\Interfaces\AddInfo;
	use Lib\Interfaces\Search;
	use Think\Controller;
	

	class Users extends Controller{
		public function emailCheck($emailAddr){
			//$email = $_SESSION['userName'];
			$mailTitle = '十三行邮箱验证邮件';
			//$registerNum = md5(mt_rand(100000,999999));
			$mailContent = '验证了！！！！！！！！'.'http://localhost/'.U('UserLog/pass',array('params'=>$emailAddr),'');
			if(sendMail($emailAddr,$mailTitle,$mailContent)){
				$this->success('发送成功',U('WebShow/home'));
			}
			else{
				$this->error('发送失败');
			}
		}//邮箱验证
		
	}
?>