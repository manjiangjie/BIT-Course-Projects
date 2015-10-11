<?php
/*
*author: 伍志强
*function: HR修改\添加信息 (新增公司信息和HR注册信息的显示)
*AlterTime: 2015/04/16
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
			$companyId=$userId;
			$company_info=M('company_info');
			$data=$company_info->where(array('companyId'=>$companyId))->find();
			//companyName、companyLicense、companyContactName都非空的情况下才能添加job
			if($data['companyname']!=NULL&&$data['companylicense']!=NULL&&$data['companycontactname']!=NULL)
			{
				$job_info=D('job_info');
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
				$this->error('请完善公司信息！');
				//echo '请完善公司信息';
			}
			
		}
		//hr公司信息显示
		public function compInfoShow(){
			$userId=$_SESSION['userId']; //得到当前hr的用户名
			$companyId=$userId;
			$company_info=M('company_info');
			$condition['companyId']=$companyId;
			$compInfo=$company_info->where($condition)->find();
			//dump($compInfo);
			$this->assign('compInfo',$compInfo);
			$this->display('edit_info');
		}
        //HR修改公司信息
		public function hrChangeCompInfo(){
			$userId=$_SESSION['userId']; //得到当前hr的用户名
			$companyId=$userId;
			$company_info=M('company_info');
            $condition['companyId']=$companyId;
			$data=$company_info->where($condition)->find();
			//dump($data);
			//该hr第一次编辑自己公司的信息
			if(!$data['createtime'])
			{
				//定义自动完成规则
				$auto_rules=array(
				    array('createTime',date('Y-m-d H:i:s'))  //将信息创建时间改为当前时间戳
					);
					$company_info->auto($auto_rules)->create();
					if($company_info->where($condition)->save())
						$this->success('数据更新成功');
					else
						$this->error('数据更新失败');
			}
			else
			{
				//定义自动完成规则
				$auto_rules=array(
					array('lastEditTime',date('Y-m-d H:i:s'))  //将信息最后修改时间更新为当前时间戳
					);
                    $company_info->auto($auto_rules)->create();
					if($company_info->where($condition)->save())
						$this->success('数据更新成功');
					else
						$this->error('数据更新失败');
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
		//HR注册信息显示
		public function hrInfoShow(){
			$userId=$_SESSION['userId'];
			$hrId='1';
			$hr_info=M("hr_info");
			$user_info=M('user_info');
			$condition['hrId']=$hrId;
			$hrInfo=$hr_info->where($condition)->find();
			$userInfo=$user_info->where(array('userId'=>$userId))->find();
			$this->assign('userInfo',$userInfo);
            $this->assign('hrInfo',$hrInfo);
			$this->display('edit_account');
		}
        //HR修改注册信息
		public function hrChangeInfo(){
		    $userId=$_SESSION['userId'];
            $hrId=$userId;
			$hr_info=D('hr_info');
			$user_info=D('user_info');
			$userInfo=array(
				'userEmail'=>I('userEmail'),
			    'userPassword'=>I('userPassword')
				);
			dump($userInfo);
            //定义自动完成规则
	        $rules=array(
                  array('userPassword','md5',3,'function') , // 对userPassword字段在新增和编辑的时候使md5函数处理
		);
		    $user_info->auto($rules)->create($userInfo);
		    $user_info->where(array('userId'=>$userId))->save();  //用户注册信息更新
			$condition['hrId']=$hrId;
			$data=$hr_info->where($condition)->find();
			//该hr第一次编辑自己的信息
			if(!$data['createtime'])
			{
				//定义自动完成规则
				$auto_rules=array(
				    array('createTime',date('Y-m-d H:i:s'))  //将信息创建时间改为当前时间戳
					);
					$hr_info->auto($auto_rules)->create();
					if($hr_info->where($condition)->save())
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
                    $hr_info->auto($auto_rules)->create();
					if($hr_info->where($condition)->save())
						echo '数据更新成功';
					else
						echo '数据更新失败';
			}
		}
        //修改账号可见性状态
		public function hrSetInfo(){
			$userId=$_SESSION['userId'];  //得到当前hr的userId
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
			$this->display('info_show');
			
		}
	}

?>