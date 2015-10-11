<?php
/*
*Author：彭翰元
*Function：功能框架
*date:2015.3.27
*/
namespace Lib\Interfaces;
	interface Search{
		public function searchJob();//搜索职位
		public function searchAll();//搜索全部
		public function hrSearchResume();//搜索简历
		public function searchFiledResume();//搜索失效简历

	}//搜索接口
?>