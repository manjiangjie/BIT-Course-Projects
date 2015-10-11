<?php
/*
*Author：彭翰元
*Function：功能框架
*date:2015.3.27
*/
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Classes\Users;
	use Lib\Interfaces\Register;
	class IndividualController extends Users implements Register{
		public function indiReg(){
			echo 'indi';

		}//个人注册
		public function hrReg(){

		}

	}
?>