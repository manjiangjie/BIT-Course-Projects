<?php
/*
*author: 伍志强
*function: HR修改\添加信息
*AlterTime: 2015/04/07
*/
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Interfaces\AddInfo;
	class HRAddinfoController extends Controller implements AddInfo{
		public function indiAddResume(){
  
		}
		public function indiResumeSet(){

		}
        //HR添加新职位
		public function hrAddJob(){
            $userId=$_SESSION['userId']; //得到当前hr的用户名
			$hrId=$userId;
			$companyId=$userId;
			$company_info=M('company_info');
			$data=$company_info->where(array('companyId'=>$companyId))->find();
			//companyName、companyLicense、companyContactName都非空的情况下才能添加job
			if($data['companyName']&&$data['companyLicense']&&$data['companyContactName'])
			{
				$job_info=M('job_info');
				$auto_rules=array(
					array('companyId',$companyId),
					array('createTime',date('Y-m-d H:i:s')),   //将创建时间更改为当前时间戳
				    array('hrId',$hrId)
					);
					$job_info->auto($auto_rules)->create();
					if($job_info->add())
						echo 'job添加成功';   //代码集成时需要改为相应的错误提示
					else
						echo 'job添加失败';
			}
			else
			{
				echo '请完善公司信息';
			}
			
		}
        //HR修改公司信息
		public function hrChangeCompInfo(){
			$userId=$_SESSION['userId']; //得到当前hr的用户名
			$companyId=$userId;
			$company_info=M('company_info');
            $condition['companyId']=$companyId;
			$data=$company_info->where($condition)->find();
			//该hr第一次编辑自己公司的信息
			if(!$data['createTime'])
			{
				//定义自动完成规则
				$auto_rules=array(
				    array('createTime',date('Y-m-d H:i:s'))  //将信息创建时间改为当前时间戳
					);
					$company_info->auto($auto_rules)->create();
					if($company_info->add())
						echo '数据更新成功';
					else
						echo '数据更新失败';
			}
			else
			{
				//定义自动完成规则
				$auto_rules=array(
					array('lastEditTime',date('Y-m-d H:i:s'))  //将信息最后修改时间更新为当前时间戳
					);
					if($company_info->where($condition)->save())
						echo '数据更新成功';
					else
						echo '数据更新失败';
			}
		}
         //HR修改/添加企业新闻
		public function hrAddCompNews(){
            $userId=$_SESSION['userId']; //得到当前hr的userId
			$companyId=$userId;
			//定义自动完成规则
            $rules= array (
             array('companyId',$companyId),  // 新增的时候把companyId字段设置为companyId
				);
			$company_news=D('company_news');
			$company_news->auto($rules)->create();
			if($company_news->add())
				echo '企业新闻添加成功';
			else
				echo '企业新闻添加失败';

		}
        //HR修改注册信息
		public function hrChangeInfo(){
		    $userId=$_SESSION['userId'];
			$hrId=$userId;
			$hr_info=M('hr_info');
			$condition['hrId']=$hrId;
			$data=$hr_info->where($condition)->find();
			//该hr第一次编辑自己的信息
			if(!$data['createTime'])
			{
				//定义自动完成规则
				$auto_rules=array(
				    array('createTime',date('Y-m-d H:i:s'))  //将信息创建时间改为当前时间戳
					);
					$hr_info->auto($auto_rules)->create();
					if($hr_info->add())
						echo '数据更新成功';
					else
						echo '数据更新失败';
			}
			else
			{
				//定义自动完成规则
				$auto_rules=array(
					array('lastEditTime',date('Y-m-d H:i:s'))  //将信息最后修改时间更新为当前时间戳
					);
					if($hr_info->where($condition)->save())
						echo '数据更新成功';
					else
						echo '数据更新失败';
			}
		}
        //修改账号可见性状态
		public function hrSetInfo(){
			$userId=$_SESSION('userId');  //得到当前hr的userId
			$hrId=$userId;
			$hr_info=M('hr_info');
			$condition['hrId']=$hrId;
			$hr_info->create();
			if($hr_info->where($condition)->save())
				echo '状态更新成功';
			else
				echo '状态更新失败';

		}
		public function chat(){
			
		}
	}

?>