<?php
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Interfaces\AddInfo;
	class HRAddinfoController extends Controller implements AddInfo{
		public function HRclosejob(){
  			$jobid=$_GET['jobid'];
  			$M=M('job_info');
			$hrId = session('uid');
			$condition['jobId'] = $jobid;
    		// 更新的条件
			$data['jobStatus'] = '1';
			$result = $M->where($condition)->save($data);
			if($result!=null)
			{
				$x['status']='1';
			 	$this->ajaxReturn($x);
			}
			else
			{
				$x['status']='0';
			 	$this->ajaxReturn($x);
			}
		}
		public function HRopenjob(){
  			$jobid=$_GET['jobid'];
  			$M=M('job_info');
			$hrId = session('uid');
			$condition['jobId'] = $jobid;
    		// 更新的条件
			$data['jobStatus'] = '0';
			$result = $M->where($condition)->save($data);
			echo '<meta http-equiv="refresh" content="1">';
			if($result!=null)
			{
				$x['status']='1';
			 	$this->ajaxReturn($x);
			}
			else
			{
				$x['status']='0';
			 	$this->ajaxReturn($x);
			}
		}
		public function interview(){

			$hrId = session('uid');
			$applicantid=$_GET['applicantid'];
			$jobid=$_GET['jobid'];
			$M=M('resume_info resume_info,applicant_info applicant_info');
			$sql='applicant_info.applicantId='.$applicantid.'
			and applicant_info.applicantId=resume_info.applicantId ';
			$result=$M->where($sql)->select();

			$data['interviewStatus']='3';
			$data['resumeId']=$result[0]['resumeid'];
			$data['hrId']=$hrId;
			$data['jobId']=$jobid;
			$data['createTime']=date('Y-m-d H:i:s');
			$data['lastEditTime']=date('Y-m-d H:i:s');
			$M = D('interview');
			$sql='interviewStatus=3 
			and resumeId='.$result[0]['resumeid'].' 
			and hrId='.$hrId.'
			and jobId='.$jobid;
			$result=$M->where($sql)->find();
			if($result!=null)
			{
				$M->add($data);
				$x['status']='1';
			 	$this->ajaxReturn($x);
			}
			else
			{
				$x['status']='0';
			 	$this->ajaxReturn($x);
			}
		}

		public function download(){
  			$hrId = session('uid');
			$applicantid=$_GET['applicantid'];
			$M=M('resume_info resume_info,applicant_info applicant_info');
			$sql='applicant_info.applicantId='.$applicantid.'
			and applicant_info.applicantId=resume_info.applicantId ';
			$info=$M->where($sql)->select();
			
			$M=M('education education');
			$sql='education.applicantId='.$applicantid;
			$education=$M->where($sql)->select();
		

			$M=M('resume_work resume_work');
			$sql='resume_work.resumeId='.$info[0]['resumeid'];
			$work=$M->where($sql)->select();
			
  			excel($info[0],$education,$work);
		}

		public function HRrefused(){
  			$jobid=$_GET['jobid'];

			$hrId = session('uid');
			$applicantid=$_GET['applicantid'];
			$jobid=$_GET['jobid'];
			$M=M('resume_info resume_info,applicant_info applicant_info');
			$sql='applicant_info.applicantId='.$applicantid.'
			and applicant_info.applicantId=resume_info.applicantId ';
			$result=$M->where($sql)->select();

			$data['interviewStatus']='4';
			$data['resumeId']=$result[0]['resumeid'];
			$data['hrId']=$hrId;
			$data['jobId']=$jobid;
			$data['createTime']=date('Y-m-d H:i:s');
			$data['lastEditTime']=date('Y-m-d H:i:s');
			$M = D('interview');
			$sql='interviewStatus=4 
			and resumeId='.$result[0]['resumeid'].' 
			and hrId='.$hrId.'
			and jobId='.$jobid;
			$result=$M->where($sql)->find();

			if($result!=null)
			{
				$M->add($data);
				$x['status']='1';
			 	$this->ajaxReturn($x);
			}
			else
			{
				$x['status']='0';
			 	$this->ajaxReturn($x);
			}
		}


		public function aaa(){
			$jobid='1';

			$hrId = '11';
			$applicantid=$_GET['applicantid'];
			$jobid=$_GET['jobid'];
			$M=M('resume_info resume_info,applicant_info applicant_info');
			$sql='applicant_info.applicantId='.$applicantid.'
			and applicant_info.applicantId=resume_info.applicantId ';
			$result=$M->where($sql)->select();

			$data['collectType']='2';
			$data['resumeId']=$result[0]['resumeid'];
			$data['hrId']=$hrId;
			$data['jobId']=$jobid;
			$data['createTime']=date('Y-m-d H:i:s');
			$data['lastEditTime']=date('Y-m-d H:i:s');
			$M = D('collect');
			$sql='collectType=2 
			and resumeId='.$result[0]['resumeid'].' 
			and hrId='.$hrId.'
			and jobId='.$jobid;
			$result=$M->where($sql)->find();
		}
		public function HRcollect(){
  			$jobid=$_GET['jobid'];

			$hrId = session('uid');
			$applicantid=$_GET['applicantid'];
			$jobid=$_GET['jobid'];
			$M=M('resume_info resume_info,applicant_info applicant_info');
			$sql='applicant_info.applicantId='.$applicantid.'
			and applicant_info.applicantId=resume_info.applicantId ';
			$result=$M->where($sql)->select();

			$data['collectType']='2';
			$data['resumeId']=$result[0]['resumeid'];
			$data['hrId']=$hrId;
			$data['jobId']=$jobid;
			$data['createTime']=date('Y-m-d H:i:s');
			$data['lastEditTime']=date('Y-m-d H:i:s');
			$M = D('collect');
			$sql='collectType=2 
			and resumeId='.$result[0]['resumeid'].' 
			and hrId='.$hrId.'
			and jobId='.$jobid;
			$result=$M->where($sql)->find();
			if($result!=null)
			{
				$M->add($data);
				$x['status']='1';
			 	$this->ajaxReturn($x);
			}
			else
			{
				$x['status']='0';
			 	$this->ajaxReturn($x);
			}
		}
		public function indiAddResume(){

		}
		public function indiResumeSet(){

		}
		public function Addjob(){
			$this->display("/WebShow/new_position");
		}
        //HR添加新职位
		public function hrAddJob(){
			//dump($_POST);
            $userId=$_SESSION['uid']; //得到当前hr的用户名
			//$userId='11';
			//$hrId='11';
			$hrId=$userId;
			$tagId=array(
			'1' => I("tag1"),
			'2' => I("tag2"),
			'3' => I("tag3"),
			'4' => I("tag4"),
			'5' => I("tag5"),
			'6' => I("tag6"),
			'7' => I("tag7"),
			'8' => I("tag8"),
			'9' => I("tag9"),
			'10' => I("tag10"),
			'11' => I("tag11"),
			'12' => I("tag12"),
			'13' => I("tag13"),
			'14' => I("tag14"),
			'15' => I("tag15"),
			'16' => I("tag16"),
			'17' => I("tag17"),
			'18' => I("tag18"),
			'19' => I("tag19"),
			'20' => I("tag20"),
			'21' => I("tag21"),
			"22" => I("tag22"),
			);
			$tagname=array(
			'1' => "五险一金",
			'2' => "年底双薪",
			'3' => "绩效奖金",
			'4' => "年终分红",
			'5' => "股票期权",
			'6' => "加班补助",
			'7' => "包吃",
			'8' => "包住",
			'9' => "交通补助",
			'10' => "餐补",
			'11' => "房补",
			'12' => "通讯补贴",
			'13' => "采暖补贴",
			'14' => "带薪年假",
			'15' => "弹性工作",
			'16' => "补充医疗保险",
			'17' => "定期体检",
			'18' => "免费班车",
			'19' => "员工旅游",
			'20' => "高温补贴",
			'21' => "全勤奖",
			'22' => "节日福利",
			
			);
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
					if($jobId=$job_info->add())
					{
						$job_tag=M("job_tag");
						for($i=1;$i<=22;$i++)
							if($tagId[$i]!='')
							{ 
								$tag=array(
								    'tagTypeId' => $tagId[$i],
									'tagContent' => $tagname[$i],
									'jobId' =>$jobId
								);
								$job_tag->data($tag)->add();
							}
						$this->success('工作添加成功');   //代码集成时需要改为相应的错误提示
					}
					else
						$this->error('工作添加失败');
			}
			else
			{
				$this->error('请完善公司信息！');
				//echo '请完善公司信息';
			}
			
		}
		//hr公司信息显示
		public function compInfoShow(){
			$userId=$_SESSION['uid']; //得到当前hr的用户名
			//$userId='11';
			$companyId=$userId;
			$company_info=M('company_info');
			$condition['companyId']=$companyId;
			$compInfo=$company_info->where($condition)->find();
			//dump($compInfo);
			$this->assign('compInfo',$compInfo);
			$this->display('/WebShow/company_info');
		}
        //HR修改公司信息
		public function hrChangeCompInfo(){
			$userId=$_SESSION['uid']; //得到当前hr的用户名
			//$userId='11';
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
            $userId=$_SESSION['uid']; //得到当前hr的userId
			//$userId="11";
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
			$userId=$_SESSION['uid'];
			//$hrId='1';
			$hr_info=M("hr_info");
			$user_info=M('user_info');
			$condition['hrId']=$hrId;
			$hrInfo=$hr_info->where($condition)->find();
			$userInfo=$user_info->where(array('userId'=>$userId))->find();
			$this->assign('userInfo',$userInfo);
            $this->assign('hrInfo',$hrInfo);
			$this->display('WebShow/edit_account');
		}
        //HR修改注册信息
		public function hrChangeInfo(){
		    $userId=$_SESSION['uid'];
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
			$userId=$_SESSION['uid'];  //得到当前hr的userId
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