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
			echo '<meta http-equiv="refresh" content="3">';
		//content中的数据x为x秒，
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();
			$recuitmentJobNum=M('job_info')->where(array('jobCompanyId' => $hr_info['hrCompanyId'],array('jobHrId'=>$hrId)))->count();
			$this->assign('RecruitmentNum',RecruitmentNum);
		}
		else
			$this->redirect('登陆界面.html');
	}//HR-职位招聘数

	public function hr_getNewResume_show(){
		if(isset($_session['hrId']))
		{
		//说明：NewResumeNum为新收到的简历份数，NewResumeInfo则为新收到的简历内的具体信息
			$hrId = session('hrId');
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();

			$condition['简历投递公司字段']=$hr_info['hrCompanyId'];

			$NewResumeNum=M('resume_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$NewResumeNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new Page($count, $pageShow);
			$limit = $page->firstRow . ',' . $page->listRows;
			$NewResumeInfo=M('resume_info')->where($condition)
			->order('resumeDelieverTime DESC')->limit($limit)->select();
			$this->NewResumeInfo = $NewResumeInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
			$this->display();//显示与所在方法同名的html文件

			$this->assign('NewResumeNum',NewResumeNum);
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-新收简历数_列表显示

	public function hr_interResume_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();

			$condition['简历投递公司字段']=$hr_info['hrCompanyId'];
			$condition['简历是否面试字段']='待面试';
			$condition['_logic'] = 'AND';//select语句的判断封装

			$interResumeNum=M('resume_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$interResumeNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new Page($count, $pa geShow);
			$limit = $page->firstRow . ',' . $page->listRows;
			$interResumeInfo=M('resume_info')->where($condition)->order('面试时间字段 DESC')->limit($limit)->select();
			$this->interResumeInfo = $interResumeInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
			$this->display();//显示与所在方法同名的html文件
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-待面试简历列表显示


	public function hr_recommandResume_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$recommandInfo=I('post.');
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();

			$condition['简历投递公司字段']=$hr_info['hrCompanyId'];
			$condition['简历工作职位']=array('like','%'.$recommandInfo['关键字'].'%');//模糊查询
			$condition['applicant.applicantResumeId']=$condition['resume_info.resumeId'];
			$condition['行业分级']=$recommandInfo['行业分级'];
			$condition['工作地点']=$recommandInfo['工作地点'];
			$condition['applicant.学历']=array('between',$recommandInfo['学历下限'].','.$recommandInfo['学历上限']);
			$condition['applicant.性别']=$recommandInfo['性别'];
			$condition['applicant.年龄']=$recommandInfo['年龄'];
			$condition['工作年限']=$recommandInfo['工作年限'];
			$condition['推荐排序方式']='推荐排序方式';

			$condition['_logic'] = 'AND';//select语句的判断封装

			$recommandResumeNum=M('resume_info resume,applicant_info applicant')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$recommandResumeNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new Page($count, $pageShow);
			$limit = $page->firstRow . ',' . $page->listRows;
			$recommandResumeInfo=M('resume_info resume,applicant_info applicant')->where($condition)->limit($limit)->select();
			$this->recommandResumeInfo = $recommandResumeInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
			$this->display();//显示与所在方法同名的html文件
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-推荐简历列表显示

	public function hr_searchPageResume_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$searchInfo=I('post.');
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();

			$condition['简历投递公司字段']=$hr_info['hrCompanyId'];
			$condition['简历工作职位']=array('like','%'.$searchInfo['关键字'].'%');//模糊查询
			$condition['applicant.applicantResumeId']=$condition['resume_info.resumeId'];
			$condition['行业分级']=$searchInfo['行业分级'];
			$condition['工作地点']=$searchInfo['工作地点'];
			$condition['学历']=array('between',$recommandInfo['学历下限'].','.$recommandInfo['学历上限']);
			$condition['就职过的公司']=$searchInfo['就职过的公司'];
			$condition['applicant.性别']=$searchInfo['性别'];
			$condition['applicant.年龄']=$searchInfo['年龄'];
			$condition['工作年限']=$searchInfo['工作年限'];
			$condition['简历更新时间']=$searchInfo['简历更新时间'];
			$condition['_logic'] = 'AND';//select语句的判断封装

			$searchResumNum=M('resume_info resume,applicant_info applicant')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$searchResumNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new Page($count, $pageShow);
			$limit = $page->firstRow . ',' . $page->listRows;
			$rsearchResumeInfo=M('resume_info resume,applicant_info applicant')->where($condition)->limit($limit)->select();
			$this->rsearchResumeInfo = $rsearchResumeInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
			$this->display();//显示与所在方法同名的html文件
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

			$condition['简历是否收藏字段']='已收藏';
			$condition['简历投递公司字段']=$hr_info['hrCompanyId'];
			$condition['applicant.applicantResumeId']=$condition['resume_info.resumeId'];
			$condition['职位']=$collectedInfo['职位'];
			$condition['工作经验']=$collectedInfo['工作经验'];
			$condition['学历']=$collectedInfo['学历'];
			$condition['性别']=$collectedInfo['性别'];
			$condition['城市']=$collectedInfo['城市'];
			$condition['_logic'] = 'AND';//select语句的判断封装

			$collectedResumNum=M('resume_info resume,applicant_info applicant')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$collectedResumNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new Page($count, $pageShow);
			$limit = $page->firstRow . ',' . $page->listRows;
			$collectedResumeInfo=M('resume_info resume,applicant_info applicant')->where($condition)->limit($limit)->select();
			$this->collectedResumeInfo = $collectedResumeInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
			$this->display();//显示与所在方法同名的html文件
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-我的收藏简历列表显示

	public function hr_rejectedResume_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$rejectedInfo=I('post.');
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();

			$condition['简历是否拒绝字段']='已拒绝';
			$condition['简历投递公司字段']=$hr_info['hrCompanyId'];
			$condition['applicant.applicantResumeId']=$condition['resume_info.resumeId'];
			$condition['简历投递时间']=$rejectedInfo['简历投递时间'];
			$condition['_logic'] = 'AND';//select语句的判断封装

			$rejectedResumNum=M('resume_info resume,applicant_info applicant')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$rejectedResumNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new Page($count, $pageShow);
			$limit = $page->firstRow . ',' . $page->listRows;
			$rejectedResumInfo=M('resume_info resume,applicant_info applicant')->where($condition)->limit($limit)->select();
			$this->rejectedResumInfo = $rejectedResumInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
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
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();

			$condition['jobCompanyId']=$hr_info['hrCompanyId'];
			$condition['jobHrId']=$hrId;
			$condition['过期时间字段'] = array('gt',now());//过期时间>现在时间
			$condition['_logic'] = 'AND';//select语句的判断封装

			$publishedJobNum=M('job_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$publishedJobNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new Page($count, $pageShow);
			$limit = $page->firstRow . ',' . $page->listRows;
			$publishedJobInfo=M('job_info')->where($condition)->limit($limit)->select();
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

			$condition['jobCompanyId']=$hr_info['hrCompanyId'];
			$condition['jobHrId']=$hrId;
			$condition['过期时间字段'] = array('lt',now());//过期时间<现在时间
			$condition['jobReleaseTime']=array('between',$faliedInfo['发布时间下限'].','.$faliedInfo['发布时间上限']);
			$condition['_logic'] = 'AND';//select语句的判断封装

			$failedJobNum=M('job_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$failedJobNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new Page($count, $pageShow);
			$limit = $page->firstRow . ',' . $page->listRows;
			$failedJobInfo=M('job_info')->where($condition)->limit($limit)->select();
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
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();

			$condition['简历投递公司字段']=$hr_info['hrCompanyId'];
			$condition['简历是否面试字段']='待面试';
			$condition['_logic'] = 'AND';//select语句的判断封装

			$appointedInterNum=M('resume_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$appointedInterNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new Page($count, $pageShow);
			$limit = $page->firstRow . ',' . $page->listRows;
			$appointedInterInfo=M('resume_info')->where($condition)->order('面试时间字段 DESC')->limit($limit)->select();
			$this->appointedInterInfo = $appointedInterInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
			$this->display();//显示与所在方法同名的html文件
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-预约日程-待面试列表显示

	public function hr_interviewed_show(){
		if(isset($_session['hrId']))
		{
			$hrId = session('hrId');
			$hr_info=M('hr_info')->where(array('hrId' => $hrId))->find();

			$condition['简历投递公司字段']=$hr_info['hrCompanyId'];
			$condition['简历是否面试字段']='已面试';
			$condition['_logic'] = 'AND';//select语句的判断封装

			$interviewedNum=M('resume_info')->where($condition)->count();
			import('ORG.Util.Page');//引入分页类
			$count =$interviewedNum;
			$pageShow = 10;//每页显示的条数，暂定为10
			$page = new Page($count, $pageShow);
			$limit = $page->firstRow . ',' . $page->listRows;
			$interviewedInfo=M('resume_info')->where($condition)->order('面试时间字段 DESC')->limit($limit)->select();
			$this->interviewedInfo = $interviewedInfo;
			$this->page = $page->show();//将页码分配给前端的page变量
			$this->display();//显示与所在方法同名的html文件
		}
		else
			{$this->redirect('登陆界面.html');}
	}//HR-已面试列表显示
}
?>