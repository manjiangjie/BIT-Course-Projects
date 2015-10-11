<?php
/*
*author: 张俊逸
*function: HR界面的显示功能
*AlterTime: 2015/04/06
*/
namespace Home\Controller;
use Think\Controller;
use Lib\Interfaces\Show;


class WebShowController extends Controller implements Show{
//
	public function hr_recuitmentJob_show(){
		//说明：recuitmentJobNum为职务招聘数
		
			$hrId = session('uid');
			// $hrId='0';
			// echo '<meta http-equiv="refresh" content="3">';
			// content中的数据x为x秒，
			// $hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();
			// $recuitmentJobNum=M('job_info')->where(array('hrId'=>$hrId))->count();
			// $this->assign('RecruitmentNum',RecruitmentNum);




			$M=M('company_info company_info,hr_info hr_info');
			$sql='hr_info.hrId='.$hrId.'
			and company_info.hrId='.$hrId;
			$info=$M->where($sql)->find();
			//dump($info);die;
			$this->assign('info',$info);
			
			$this->display('HRfrontpage'); // 输出模板
	}//HR-职位招聘数
	//可行，测试数据库结果为2

	 public function hr_getNewResume_show(){//本函数接口可用,已测试
			//说明：NewResumeNum为新收到的简历份数，NewResumeInfo则为新收到的简历内的具体信息
			$hrId = session('uid');
			$M = M('interview interview,resume_info resume_info,applicant_info applicant_info,job_info job_info,education education');
			$sql='interview.hrId='.$hrId.' 
			and applicant_info.applicantId=resume_info.applicantId 
			and education.resumeId=resume_info.resumeId 
			and job_info.jobId=interview.jobId 
			and interview.resumeId=resume_info.resumeId';
			$count=$M->where($sql)->count();
			$NewResumeNum=$count;
			import('ORG.Util.Page');
			$page = new \Think\Page($count, 10);
			$limit = $page->firstRow . ',' . $page->listRows;
			$NewResumeInfo =$M->where($sql)->limit($limit)->select();
			//dump($NewResumeInfo);
			$this->page = $page->show();// 分页显示输出
			$this->assign('NewResumeInfo',$NewResumeInfo);// 赋值数据集
			$this->assign('NewResumeNum',$NewResumeNum);
			$this->assign('hrId',$hrId);
			$this->display('new_resume'); // 输出模板

	}//HR-新收简历数_列表显示
	



	public function hr_interResume_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');//测试数据
			$M = M('resume_info resume_info,interview interview,applicant_info applicant_info,job_info job_info');
			$sql='interview.hrId='.$hrId.' 
			and resume_info.resumeId=interview.resumeId 
			and resume_info.applicantId=applicant_info.applicantId 
			and job_info.jobId=interview.jobId 
			and interviewStatus=1';
			$appointedInterNum=$M->where($sql)->count();
			$count =$appointedInterNum;
			import('ORG.Util.Page');
			$page = new \Think\Page($count, 10);
			$limit = $page->firstRow . ',' . $page->listRows;
			$interviewResumeInfo=$M->where($sql)->order('interviewDeliverTime DESC')->limit($limit)->select();
			//dump($interviewResumeInfo);die;
			$this->page = $page->show();// 分页显示输出
			$this->assign('interviewResumeInfo',$interviewResumeInfo);// 赋值数据集
			$this->assign('hrId',$hrId);
			$this->display('to_be_interviewed');//显示与所在方法同名的html文件

	}//HR-待面试简历列表显示
	//测试结果为空


	public function hr_recommandResume_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');
			$recommandInfo=I('post.'); 
			$M=M('resume_info resume_info,interview interview,applicant_info applicant_info,job_info job_info,resume_work resume_work');
			$sql='interview.hrId='.$hrId.' 
			and applicant_info.applicantId=resume_info.applicantId 
			and interview.resumeId=resume_info.resumeId 
			and job_info.jobId=interview.jobId 
			and resume_work.resumeId=resume_info.resumeId
			and resumeRecommend=1
			and job_info.jobName like \'%'.$recommandInfo[keyword].'%\' ';
			//and job_info.jobName like \'%'.$recommandInfo[ins].'%\'
			// 行业类别未找到
			$recommandResumeNum=$M->where($sql)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$recommandResumeNum;
			$page = new \Think\Page($count, 10);
			$limit = $page->firstRow . ',' . $page->listRows;
			$recommandResumeInfo =$M->where($sql)->limit($limit)->select();
			$this->assign('recommandResumeInfo',$recommandResumeInfo);// 赋值数据集
			//dump($recommandResumeInfo);die;
			$this->assign('hrId',$hrId);
			$this->display('commend_resume'); // 输出模板	
			$this->page = $page->show();// 分页显示输出

	}//HR-推荐简历列表显示
	

	public function hr_searchPageResume_show(){
		// if(isset($_SESSION['uid']))
		// {
			$hrId = session('uid');
			$applicantid=$_GET['applicantid'];
			$jobid=$_GET['jobid'];
			$M=M('resume_info resume_info,applicant_info applicant_info');
			$sql='applicant_info.applicantId='.$applicantid.'
			and applicant_info.applicantId=resume_info.applicantId ';
			$searchPageResumeInfo=$M->where($sql)->select();
			$this->assign('searchPageResumeInfo',$searchPageResumeInfo);// 赋值数据集
			
			$M=M('education education');
			$sql='education.applicantId='.$applicantid;
			$education=$M->where($sql)->select();
			$this->assign('education',$education);// 赋值数据集
			//dump($education);die;

			$M=M('resume_work resume_work');
			$sql='resume_work.resumeId='.$searchPageResumeInfo[0]['resumeid'];
			$work=$M->where($sql)->select();
			$this->assign('work',$work);// 赋值数据

			$this->assign('jobid',$jobid);// 赋值数据
			//xdump($work);die;
			//dump($searchPageResumeInfo[0]);die;
			$this->display('resume_view'); // 输出模板

		// }
		// else
		// 	{$this->redirect('登陆界面');}
	}//HR-搜索简历项的简历列表显示

	public function hr_collectedResume_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');
			$collectedInfo=I('post.');
			$M=M('resume_info resume_info,applicant_info applicant_info,collect collect,job_info job_info,education education');
			$sql='collect.hrId='.$hrId.' 
			and collect.collectType=2 
			and collect.jobId=job_info.jobId
			and collect.resumeId=resume_info.resumeId
			and resume_info.applicantId=applicant_info.applicantId
			and resume_info.resumeId=education.resumeId
			and job_info.jobName like \'%'.$collectedInfo[keyword].'%\' ';
			//and job_info.jobName like \'%'.$collectedInfo[ins].'%\'
			// 行业类别未找到
			$count=$M->where($sql)->count();
			import('ORG.Util.Page');//引入分页类
			$page = new \Think\Page($count, 10);
			$limit = $page->firstRow . ',' . $page->listRows;

			$collectedResumeInfo=$M->where($sql)->limit($limit)->select();
			
			$this->assign('collectedResumeInfo',$collectedResumeInfo);// 赋值数据集
			//dump ($collectedResumeInfo);die;
			$this->assign('hrId',$hrId);
			$this->page = $page->show();// 分页显示输出
			$this->display('favorite'); // 输出模板	

	}//HR-我的收藏简历列表显示

	public function hr_rejectedResume_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');
			$rejectedInfo=I('post.');
			$M=M('resume_info resume_info,applicant_info applicant_info,interview interview,job_info job_info,education education');
			$sql='interview.hrId='.$hrId.' 
			and interview.interviewStatus=4
			and interview.jobId=job_info.jobId
			and interview.resumeId=resume_info.resumeId
			and resume_info.applicantId=applicant_info.applicantId
			and resume_info.resumeId=education.resumeId
			and job_info.jobName like \'%'.$rejectedInfo[keyword].'%\' ';
			//and job_info.jobName like \'%'.$rejectedInfo[ins].'%\'
			// 行业类别未找到
			$count=$M->where($sql)->count();
			import('ORG.Util.Page');//引入分页类
			$page = new \Think\Page($count, 10);
			$limit = $page->firstRow . ',' . $page->listRows;

			$rejectedResumeInfo=$M->where($sql)->limit($limit)->select();
			//dump ($rejectedResumeInfo);
			$this->assign('rejectedResumeInfo',$rejectedResumeInfo);// 赋值数据集
			$this->assign('hrId',$hrId);// 赋值数据集
			$this->page = $page->show();// 分页显示输出
			$this->display('refused'); // 输出模板
			

	}//HR-已拒绝简历列表显示

	public function hr_publishedJob_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');
			//$hrId='2';
			$publishedInfo=I('post.');
			$M = M('job_info job_info,interview interview,resume_info resume_info');
			$sql=$sql='job_info.hrId='.$hrId.' 
			and job_info.jobStatus=0';
			$count=$M->where($sql)->count();
			import('ORG.Util.Page');//引入分页类
			$page = new \Think\Page($count, 10);
			$limit = $page->firstRow . ',' . $page->listRows;
			$publishedJobInfo=$M->where($sql)->limit($limit)->select();
			$failedJobInfo=$M->where($sql)->limit($limit)->select();
			//dump($failedJobInfo);
			$this->page = $page->show();// 分页显示输出
			$this->assign('publishedJobInfo',$publishedJobInfo);// 赋值数据集
			$this->assign('hrId',$hrId);// 赋值数据集
			$this->display('posted_postion');//显示与所在方法同名的html文件


	}//HR-已发布的职位列表显示

	public function hr_failedJob_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');
			$faliedInfo=I('post.');
			//$hrId = '1';



			$M = M('interview interview,job_info job_info');
			$sql='interview.hrId='.$hrId.' 
			and job_info.jobId=interview.jobId 
			and jobStatus=1';//已失效
			//测试查看结果status改成5
			//echo $sql;die;
			$failedJobNum=$M->where($sql)->count();

			$count =$failedJobNum;
			import('ORG.Util.Page');
			$page = new \Think\Page($count, 10);
			$limit = $page->firstRow . ',' . $page->listRows;
			$failedJobInfo=$M->where($sql)->limit($limit)->select();
			//dump($failedJobInfo);
			$this->page = $page->show();// 分页显示输出
			$this->assign('failedJobInfo',$failedJobInfo);// 赋值数据集
			$this->assign('hrId',$hrId);// 赋值数据集
			$this->display('expired_position');//显示与所在方法同名的html文件


	}//HR-已失效职位列表显示



	public function hr_appointedInter_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');//测试数据
			$M = M('resume_info resume_info,interview interview,applicant_info applicant_info,job_info job_info');
			$sql='interview.hrId='.$hrId.' 
			and resume_info.resumeId=interview.resumeId 
			and resume_info.applicantId=applicant_info.applicantId 
			and job_info.jobId=interview.jobId 
			and interviewStatus=1';
			$appointedInterNum=$M->where($sql)->count();
			$count =$appointedInterNum;
			import('ORG.Util.Page');
			$page = new \Think\Page($count, 10);
			$limit = $page->firstRow . ',' . $page->listRows;
			$appointedInterInfo=$M->where($sql)->order('interviewDeliverTime DESC')->limit($limit)->select();
			dump($appointedInterInfo);die;
			$this->page = $page->show();// 分页显示输出
			$this->assign('appointedInterInfo',$appointedInterInfo);// 赋值数据集
			$this->assign('hrId',$hrId);
			$this->display('to_be_interviewed');//显示与所在方法同名的html文件

	}//HR-预约日程-待面试列表显示
	

	public function hr_interviewed_show(){
		
			$hrId = session('uid');
			$M = M('resume_info resume_info,interview interview,applicant_info applicant_info,job_info job_info');
			$sql='interview.hrId='.$hrId.' 
			and resume_info.resumeId=interview.resumeId 
			and resume_info.applicantId=applicant_info.applicantId 
			and job_info.jobId=interview.jobId 
			and interviewStatus=3';


			$interviewedNum=$M->where($sql)->count();
			$count =$interviewedNum;
			import('ORG.Util.Page');
			$page = new \Think\Page($count, 10);
			$limit = $page->firstRow . ',' . $page->listRows;
			$interviewedInfo=$M->where($sql)->order('interviewDeliverTime DESC')->limit($limit)->select();
			//dump($appointedInterInfo);
			$this->page = $page->show();// 分页显示输出
			$this->assign('interviewedInfo',$interviewedInfo);// 赋值数据集
			$this->assign('hrId',$hrId);
			$this->display('interviewed');//显示与所在方法同名的html文件

	}//HR-已面试列表显示

public function job_show(){
		$id = I('jobid');//需要id
		$m = M('job_info job_info,hr_info hr_info');
		$info = $m->where('jobid = '.$id.' and job_info.hrid = hr_info.hrid')->select();
		dump($info);
		$this->job = $info[0];
		$jobid = $info[0]['jobid'];
		$mtag = M('job_tag');
		$sql='jobid = '.$jobid;
		//echo $sql;die;
		$tag = $mtag->where($sql)->select();
		//dump($tag);
		$this->assign('tag',$tag);
		$this->display('WebShow/jobinfo');
		
		//die;
		//$this->display('Index/jobinfo');
	}
}
?>