<?php
/*
*Author：彭翰元
*Function：功能框架
*date:2015.3.27
*/
	namespace Lib\Interfaces;
	interface AddInfo{
		public function indiAddResume();//个人简历提交
		public function indiResumeSet();//设置可见性和黑名单
		public function hrAddJob();//HR添加新职位
		public function hrChangeCompInfo();//HR修改公司信息
		public function hrAddCompNews();//HR修改/添加企业新闻
		public function hrChangeInfo();//HR修改注册信息
		public function hrSetInfo();//修改账号可见性状态
		public function chat();//站内信
		
	}
?>