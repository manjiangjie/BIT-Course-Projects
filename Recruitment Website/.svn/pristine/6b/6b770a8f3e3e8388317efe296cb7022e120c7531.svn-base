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
// 获取指定日期所在星期的开始时间与结束时间
    //未登录界面的新增职位和视频面试人数显示
	public function newJob_sumVideoPeople_show(){
		$ret=getWeekRange(date('Y-m-d'));
		$sdate=$ret['sdate'];  //当前周的开始时间
		$edate=$ret['edate'];  //当前周的结束时间额
        $job_info=M('job_info');
		$interview=M('interview');
        $condition['createTime'] = array(array('egt',$sdate),array('elt',$edate));
		$newJobCount=$job_info->where($condition)->count();  //$newJobCount是新增职位数
		$VideoPeople=$interview->where($condition)->count(); //$VideoPeople是视频面试人数
		$this->assign('newJobCount',$newJobCount);   //输出本周新增职位
		$this->assign('VideoPeople',$VideoPeople);   //输出本周视频面试人数	
	}

    //热门职位显示
	public function topJob_show(){
		$job_info=M('job_info');
		$jobs=$job_info->order('jobClick desc')->limit(100)->select();  //选择排名前100的职位,如果需要还可添加分组
		$this->assign('jobs',$jobs);  //分配到模板
	}
    //企业-显示
	public function comp_show(){
		$company_info=M('company_info');
		$companys=$company_info->select();  //需要根据企业显示的信息定查询的字段
		$this->assign('companys',$companys);  //分配到模板
	}
	//企业简介
	public function comp_introduction()
	{
		$companyName="bit";
		$company_info=M('company_info');
		$company_news=M('company_news');
		$job_info=M('job_info');
		$condition1["companyName"]=$companyName;
		$company=$company_info->where($condition1)->find();  //需要根据企业显示的信息定查询的字段
		$companynews=$company_news->where($condition)->select();
		$condition2['companyId']=$company['companyid'];
		$count=$job_info->where($condition2)->count();//记录job的条数
		$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
		$jobInfo=$job_info->where($condition2)->limit($Page->firstRow.','.$Page->listRows)->select();
		//dump($jobInfo);
		//dump($companynews);
		$this->assign('company',$company);  //分配到模板
		$this->assign('companynews',$companynews);
		$this->assign('jobInfo',$jobInfo);
		$this->assign('page',$show);// 赋值分页输出
		$this->display("WebShow/compInfoShow");
	}
	public function indi_resumeNum_interNum_show(){

	}//个人_投递数_面试数显示
	public function indi_resumeBeScanedNum_show(){

	}//个人-简历被浏览数显示
	public function indi_resumeCompletedper_show(){

	}//个人-简历完成度显示
	public function indi_recommandJob_show(){

	}//个人-推荐职位显示
	public function indi_chosenJob_show(){

	}//个人-投递职位显示
	public function indi_collectedJobComp_show(){

	}//个人-收藏的职位/公司显示
	public function indi_subscribe_show(){

	}//个人-订阅显示
	public function indi_webNews_show(){

	}//个人-站内信，显示收到信息数和列表
	public function hr_recuitmentJob_show(){
		//说明：recuitmentJobNum为职务招聘数
		
			$hrId = session('uid');
			//$hrId='0';
			echo '<meta http-equiv="refresh" content="3">';
			//content中的数据x为x秒，
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();
			$recuitmentJobNum=M('job_info')->where(array('hrId'=>$hrId))->count();
			echo $recuitmentJobNum;
			$this->assign('RecruitmentNum',RecruitmentNum);
		//else
			//$this->redirect('登陆界面');
	}//HR-职位招聘数
	//可行，测试数据库结果为2

	 public function hr_getNewResume_show(){//本函数接口可用,已测试
		
			//说明：NewResumeNum为新收到的简历份数，NewResumeInfo则为新收到的简历内的具体信息
			$hrId = session('uid');
			//$hrId='1';
			$M = M('interview interview,resume_info resume_info,applicant_info applicant_info,job_info job_info,education education');
			$sql='interview.hrId='.$hrId.' 
			and applicant_info.applicantId=resume_info.applicantId 
			and education.resumeId=resume_info.resumeId 
			and job_info.jobId=interview.jobId 
			and interview.resumeId=resume_info.resumeId';
			$count=$M->where($sql)->count();
			$NewResumeNum=$count;
			import('ORG.Util.Page');
			$page = new \Think\Page($count, 1);
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
		
			$hrId = session('uid');
			//$hrId='1';
			$interviewInfo=I('post.');
			$M=M('resume_info resume_info,applicant_info applicant_info,collect collect,job_info job_info,education education');
			$sql='collect.hrId='.$hrId.' 
			and collect.collectType=1
			and collect.jobId=job_info.jobId
			and collect.resumeId=resume_info.resumeId
			and resume_info.applicantId=applicant_info.applicantId
			and resume_info.resumeId=education.resumeId
			and job_info.jobName like \'%'.$interviewInfo[keyword].'%\' ';
			//and job_info.jobName like \'%'.$interviewInfo[ins].'%\'
			// 行业类别未找到
			$count=$M->where($sql)->count();
			import('ORG.Util.Page');//引入分页类
			$page = new \Think\Page($count, 1);
			$limit = $page->firstRow . ',' . $page->listRows;

			$interviewResumeInfo=$M->where($sql)->limit($limit)->select();
			//dump ($interviewResumeInfo);
			$this->assign('interviewResumeInfo',$interviewResumeInfo);// 赋值数据集
			$this->page = $page->show();// 分页显示输出
			$this->display('favorite'); // 输出模板	

	}//HR-待面试简历列表显示
	//测试结果为空


	public function hr_recommandResume_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');
			//$hrId='1';
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
			$page = new \Think\Page($count, 1);
			$limit = $page->firstRow . ',' . $page->listRows;
			$recommandResumeInfo =$M->where($sql)->limit($limit)->select();
			$this->assign('recommandResumeInfo',$recommandResumeInfo);// 赋值数据集
			$this->display('commend_resume'); // 输出模板	
			$this->page = $page->show();// 分页显示输出

	}//HR-推荐简历列表显示
	

	public function hr_searchPageResume_show(){
		// if(isset($_SESSION['uid']))
		// {
		// 	$hrId = session('d');
			$hrId='1';
			$M=M('resume_info resume_info,applicant_info applicant_info');
			$searchInfo=I('post.');
			$sql=//'and resume_info.applicantId='.searchInfo['applicantId'].'
			'applicant_info.applicantId=2
			and applicant_info.applicantId=resume_info.applicantId ';
			
			$searchPageResumeInfo=$M->where($sql)->select();
			dump($searchPageResumeInfo);
			$this->assign('searchPageResumeInfo',$searchPageResumeInfo);// 赋值数据集
			$this->assign('hrId',$hrId);
			$this->display('view_resume'); // 输出模板

		// }
		// else
		// 	{$this->redirect('登陆界面');}
	}//HR-搜索简历项的简历列表显示

	public function hr_collectedResume_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');
			//$hrId='1';
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
			$page = new \Think\Page($count, 1);
			$limit = $page->firstRow . ',' . $page->listRows;

			$collectedResumeInfo=$M->where($sql)->limit($limit)->select();
			//dump ($collectedResumeInfo);
			$this->assign('collectedResumeInfo',$collectedResumeInfo);// 赋值数据集
			$this->page = $page->show();// 分页显示输出
			$this->display('favorite'); // 输出模板	

	}//HR-我的收藏简历列表显示

	public function hr_rejectedResume_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');
			//$hrId='1';
			$rejectedInfo=I('post.');
			$M=M('resume_info resume_info,applicant_info applicant_info,interview interview,job_info job_info,education education');
			$sql='interview.hrId='.$hrId.' 
			and interview.interviewStatus=1 
			and interview.jobId=job_info.jobId
			and interview.resumeId=resume_info.resumeId
			and resume_info.applicantId=applicant_info.applicantId
			and resume_info.resumeId=education.resumeId
			and job_info.jobName like \'%'.$rejectedInfo[keyword].'%\' ';
			//and job_info.jobName like \'%'.$rejectedInfo[ins].'%\'
			// 行业类别未找到
			$count=$M->where($sql)->count();
			import('ORG.Util.Page');//引入分页类
			$page = new \Think\Page($count, 1);
			$limit = $page->firstRow . ',' . $page->listRows;

			$rejectedResumeInfo=$M->where($sql)->limit($limit)->select();
			//dump ($rejectedResumeInfo);
			$this->assign('rejectedResumeInfo',$rejectedResumeInfo);// 赋值数据集
			$this->page = $page->show();// 分页显示输出
			$this->display('refused'); // 输出模板
			$this->display('hrId'); 

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
			$page = new \Think\Page($count, 1);
			$limit = $page->firstRow . ',' . $page->listRows;
			$publishedJobInfo=$M->where($sql)->limit($limit)->select();
			$failedJobInfo=$M->where($sql)->limit($limit)->select();
			dump($failedJobInfo);
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
			echo $sql;
			$failedJobNum=$M->where($sql)->count();

			$count =$failedJobNum;
			import('ORG.Util.Page');
			$page = new \Think\Page($count, 1);
			$limit = $page->firstRow . ',' . $page->listRows;
			$failedJobInfo=$M->where($sql)->limit($limit)->select();
			dump($failedJobInfo);
			$this->page = $page->show();// 分页显示输出
			$this->assign('failedJobInfo',$failedJobInfo);// 赋值数据集
			$this->assign('hrId',$hrId);// 赋值数据集
			$this->display('expired_position');//显示与所在方法同名的html文件


	}//HR-已失效职位列表显示



	public function hr_appointedInter_show(){//本函数接口可用，已测试
		
			$hrId = session('uid');
			//$hrId='1';//测试数据
			$M = M('resume_info resume_info,interview interview,applicant_info applicant_info,job_info job_info');
			$sql='interview.hrId='.$hrId.' 
			and resume_info.resumeId=interview.resumeId 
			and resume_info.applicantId=applicant_info.applicantId 
			and job_info.jobId=interview.jobId 
			and interviewStatus=1';
			$appointedInterNum=$M->where($sql)->count();
			$count =$appointedInterNum;
			import('ORG.Util.Page');
			$page = new \Think\Page($count, 1);
			$limit = $page->firstRow . ',' . $page->listRows;
			$appointedInterInfo=$M->where($sql)->order('interviewDeliverTime DESC')->limit($limit)->select();
			//dump($appointedInterInfo);
			$this->page = $page->show();// 分页显示输出
			$this->assign('appointedInterInfo',$appointedInterInfo);// 赋值数据集
			$this->display('ITview_appointment');//显示与所在方法同名的html文件

	}//HR-预约日程-待面试列表显示
	

	public function hr_interviewed_show(){
		
			$hrId = session('uid');
			$hrId='1';
			$M = M('resume_info resume_info,interview interview,applicant_info applicant_info,job_info job_info');
			$sql='interview.hrId='.$hrId.' 
			and resume_info.resumeId=interview.resumeId 
			and resume_info.applicantId=applicant_info.applicantId 
			and job_info.jobId=interview.jobId 
			and interviewStatus=3';


			$interviewedNum=$M->where($sql)->count();
			$count =$interviewedNum;
			import('ORG.Util.Page');
			$page = new \Think\Page($count, 1);
			$limit = $page->firstRow . ',' . $page->listRows;
			$interviewedInfo=$M->where($sql)->order('interviewDeliverTime DESC')->limit($limit)->select();
			//dump($appointedInterInfo);
			$this->page = $page->show();// 分页显示输出
			$this->assign('interviewedInfo',$interviewedInfo);// 赋值数据集
			$this->display('interviewed');//显示与所在方法同名的html文件

	}//HR-已面试列表显示
}
?>