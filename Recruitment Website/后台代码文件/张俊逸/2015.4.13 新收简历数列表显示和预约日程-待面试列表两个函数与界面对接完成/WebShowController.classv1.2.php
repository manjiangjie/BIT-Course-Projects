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
	public function newJob_sumVideoPeople_show(){

	}//未登录界面的新增职位和视频面试人数显示
	public function topJob_show(){

	}//热门职位显示
	public function comp_show(){

	}//企业-显示
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
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			//$hrId='0';
			echo '<meta http-equiv="refresh" content="3">';
			//content中的数据x为x秒，
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();
			$recuitmentJobNum=M('job_info')->where(array('hrId'=>$hrId))->count();
			echo $recuitmentJobNum;
			$this->assign('RecruitmentNum',RecruitmentNum);
		}
		else
			$this->redirect('登陆界面.html');
	}//HR-职位招聘数
	//可行，测试数据库结果为2

	 public function hr_getNewResume_show(){
		if(isset($_session['hrId']))
		{
			//说明：NewResumeNum为新收到的简历份数，NewResumeInfo则为新收到的简历内的具体信息
			$hrId = session('hrId');
			$hrId='1';
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
			$this->page = $page->show();// 分页显示输出
			$this->assign('NewResumeInfo',$NewResumeInfo);// 赋值数据集
			$this->assign('NewResumeNum',$NewResumeNum);
			$this->display('interviewed'); // 输出模板
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-新收简历数_列表显示
	//本函数接口可用



	public function hr_interResume_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			//select * from interview,resume_info,applicant_info where interview.resumeId=resume_info.resumeId and resume_info.applicantId=applicant_info.applicantId;
			//$hrId='0';
			$condition['hrId']=$hrId;
			$condition['interview.resumeId']=$condition['resume.resumeId'];
			$condition['resume.applicantId']=$condition['applicant.applicantId'];
			$condition['interviewStatus']='1';
			$condition['_logic'] = 'AND';//select语句的判断封装
			$interResumeNum=M('resume_info resume,interview,applicant_info applicant')->where($condition)->count();
			$count =$NewResumeNum;
			$page = new \Think\Page($count, 10);
			$show = $Page->show();// 分页显示输出
			$interResumeInfo=M('resume_info resume,interview,applicant_info applicant')->where($condition)
			->select();
			//print_r ($interResumeInfo);
			$this->assign('interResumeInfo',$interResumeInfo);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->display(); // 输出模板
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-待面试简历列表显示
	//测试结果为空


	public function hr_recommandResume_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$recommandInfo=I('post.'); 
			$condition['interview.resumeId']=$condition['resume_info.resumeId'];
			$condition['resume_info.applicantId']=$condition['applicant_info.applicantId'];
			$condition['推荐排序方式']='推荐排序方式';
			$condition['resumeRecommend']='是推荐';
			$condition['_logic'] = 'AND';//select语句的判断封装
			$recommandResumeNum=M('resume_info,interview,applicant_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$recommandResumeNum;
			$page = new \Think\Page($count, 10);
			$show = $Page->show();// 分页显示输出
			$recommandResumeInfo=M('resume_info,interview,applicant_info')->where($condition)->select();
			$this->assign('recommandResumeInfo',$recommandResumeInfo);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->display(); // 输出模板	
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-推荐简历列表显示

	public function hr_searchPageResume_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$searchInfo=I('post.');
			$condition['resume_info.resumeId']=$searchInfo['resumeId'];
			$condition['resume_info.resumeId']=$condition['applicant_info.resumeId'];
			$searchPageResumeInfo=M('resume_info,applicant_info')->where($condition);
			$this->assign('searchPageResumeInfo',searchPageResumeInfo);
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-搜索简历项的简历列表显示

	public function hr_collectedResume_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$collectedInfo=I('post.');
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();
			$condition['collectType']='1';
			$condition['collect.hrId']=$hrId;
			$condition['resume_work.resumeId']=$condition['collect.resumeId'];
			$condition['resume_work.resumeId']=$condition['resume_info.resumeId'];
			$condition['resume_work.resumeId']=$condition['applicant_info.resumeId'];
			$condition['resume_work.resumeId']=$condition['education.resumeId'];
			if($collectedInfo['职位']!=null)
				$condition['collect.jobId']=$collectedInfo['职位'];
			else
				$condition['collect.jobId']=array('like',"%%");
			if($collectedInfo['工作经验']!=null)
				$condition['resume_work.workTime']=$collectedInfo['工作经验'];
			else
				$condition['resume_work.workTime']=array('like',"%%");
			if($collectedInfo['学历']!=null)
				$condition['education.educationDegree']=$collectedInfo['工作经验'];
			else
				$condition['education.educationDegree']=array('like',"%%");
			if($collectedInfo['性别']!=null)
				$condition['applicant_info.applicantSex']=$collectedInfo['性别'];
			else
				$condition['applicant_info.applicantSex']=array('like',"%%");
			if($collectedInfo['城市']!=null)
				$condition['resume_info.resumeNationality']=$collectedInfo['城市'];
			else
				$condition['resume_info.resumeNationality']=array('like',"%%");
			$condition['_logic'] = 'AND';//select语句的判断封装
			$collectedResumNum=M('resume_info,applicant_info,collect,resume_work,education')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$collectedResumNum;
			$page = new \Think\Page($count, 10);
			$show = $Page->show();// 分页显示输出
			$collectedResumeInfo=M('resume_info,applicant_info,collect,resume_work,education')->where($condition)->select();
			$this->collectedResumeInfo = $collectedResumeInfo;
			$this->assign('collectedResumeInfo',$collectedResumeInfo);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->display(); // 输出模板	
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-我的收藏简历列表显示

	public function hr_rejectedResume_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$rejectedInfo=I('post.');
			$condition['interview.interviewStatus']='已拒绝';
			$condition['interview.hrId']=$hrId;
			$condition['interview.resumeId']=$condition['resume_info.resumeId'];
			$condition['interview.resumeId']=$condition['applicant_info.resumeId'];
			if($rejectedInfo['简历投递时间']!=null)
				$condition['interview.interviewDeliverTime']=$rejectedInfo['简历投递时间'];
			else
				$condition['interview.interviewDeliverTime']=array('like',"%%");
			$condition['_logic'] = 'AND';//select语句的判断封装
			$rejectedResumNum=M('interview,resume_info,applicant_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$rejectedResumNum;
			$page = getpage($count,10);
			$limit = $page->firstRow . ',' . $page->listRows;
			$rejectedResumInfo=M('interview,resume_info,applicant_info')->where($condition)->limit($limit)->select();
			$this->assign('rejectedResumInfo', $rejectedResumInfo); // 赋值数据集
        	$this->assign('page', $page->show()); // 赋值分页输出
			$this->display();//显示与所在方法同名的html文件
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-已拒绝简历列表显示

	public function hr_publishedJob_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$publishedInfo=I('post.');

			$condition['job_info.hrId']=$hrId;
			$condition['job_info.resumeId']=$condition['interview.resumeId'];
			$condition['job_info.resumeId']=$condition['resume_info.resumeId'];
			$condition['过期时间字段'] = array('gt',now());//过期时间>现在时间
			$condition['_logic'] = 'AND';//select语句的判断封装

			$publishedJobNum=M('job_info,interview,resume_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$publishedJobNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new \Think\Page();
			$limit = $page->firstRow . ',' . $page->listRows;
			$publishedJobInfo=M('job_info,interview,resume_info')->where($condition)->limit($limit)->select();
			//此处应当涉及到多表，应该如何修改？
			$this->publishedJobInfo = $publishedJobInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
			$this->display();//显示与所在方法同名的html文件
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-已发布的职位列表显示

	public function hr_failedJob_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$faliedInfo=I('post.');
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();

			$condition['job_info.hrId']=$hrId;
			$condition['job_info.resumeId']=$condition['interview.resumeId'];
			$condition['job_info.resumeId']=$condition['resume_info.resumeId'];
			$condition['过期时间字段'] = array('lt',now());//过期时间<现在时间
			$condition['jobReleaseTime']=array('between',$faliedInfo['发布时间下限'].','.$faliedInfo['发布时间上限']);
			$condition['_logic'] = 'AND';//select语句的判断封装

			$failedJobNum=M('job_info,interview,resume_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$failedJobNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new\Think\Page();
			$limit = $page->firstRow . ',' . $page->listRows;
			$failedJobInfo=M('job_info,interview,resume_info')->where($condition)->limit($limit)->select();
			//此处应当涉及到多表，应该如何修改？
			$this->failedJobInfo = $failedJobInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
			$this->display();//显示与所在方法同名的html文件
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-已失效职位列表显示



	public function hr_appointedInter_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
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
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-预约日程-待面试列表显示
	//本函数接口可用，已测试

	public function hr_interviewed_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');

			$hrId = session('hrId');
			$condition['interview.hrId']=$hrId;
			$condition['resume_info.resumeId']=$condition['interview.resumeId'];
			$condition['resume_info.resumeId']=$condition['applicant_info.resumeId'];
			$condition['interviewStatus']='已面试';
			$condition['_logic'] = 'AND';//select语句的判断封装

			$interviewedNum=M('resume_info,interview,applicant_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$interviewedNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new \Think\Page();
			$limit = $page->firstRow . ',' . $page->listRows;
			$interviewedInfo=M('resume_info,interview,applicant_info')->where($condition)->order('面试时间字段 DESC')->limit($limit)->select();
			$this->interviewedInfo = $interviewedInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
			$this->display();//显示与所在方法同名的html文件
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-已面试列表显示
}
?>