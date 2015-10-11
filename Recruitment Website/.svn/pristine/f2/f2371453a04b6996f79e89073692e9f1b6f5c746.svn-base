<?php
/*
*Author：金威强
*Function：个人显示功能
*date:2015.4.10
*/
namespace Home\Controller;
use Think\Controller;
class WebShowController extends Controller{
	public function indi_resumeNum_interNum_show(){
		session('indiId','5');  //设置session
		if(isset($_SESSION['indiId']))
		{
			$indiId = session('indiId');
			$result=M('applicant_info')->where(array('applicantId' => $indiId))->select();
			p($DelieverNum);
			echo($result[0]['applicantdelievernum']);
			echo($result[0]['applicantinterviewnum']);
			die;
			$this->assign('applicantDelieverNum',applicantDelieverNum);
			$this->assign('applicantInterviewNum',applicantInterviewNum);
		}
		//else
			//$this->redirect('登陆界面.html');
	}//个人_投递数_面试数显示

	public function indi_resumeBeScanedNum_show(){
		session('indiId','5');  //设置session
		if(isset($_SESSION['indiId']))
		{
			$indiId = session('indiId');
			$result=M('applicant_info')->where(array('applicantId' => $indiId))->select();
			p($result);
			echo($result[0]['applicantchecknum']);
			die;
			$this->assign('applicantCheckNum',applicantCheckNum);
		}
		// else
		// 	$this->redirect('登陆界面.html');

	}//个人-简历被浏览数显示

	public function indi_resumeCompletedper_show(){
		session('indiId','1');  //设置session
		if(isset($_SESSION['indiId']))
		{
			$indiId = session('indiId');
			$result=M('resume_info')->where(array('applicantId' => $indiId))->select();
			p($result);
			echo($result[0]['resumeprogress']);
			die;
			$this->assign('resumeProgress',resumeProgress);
		}
		// else
		// 	$this->redirect('登陆界面.html');

	}//个人-简历完成度显示

	// public function indi_recommandJob_show(){
	// 	session('indiId','1');  //设置session
	// 	if(isset($_SESSION['indiId']))
	// 	{
	// 		$indiId = session('indiId');
	// 		$condition['indiId']=$indiId;
	// 		$condition['interview.resumeId']=$condition['resume_info.resumeId'];
	// 		$condition['resume_info.applicantId']=$condition['applicant_info.applicantId'];
	// 		$condition['interviewStatus']='1';
	// 		$condition['_logic'] = 'AND';//select语句的判断封装

	// 		$interResumeNum=M('resume_info,interview,applicant_info')->where($condition)->count();
	// 		import('ORG.Util.Page');//引入分页类
	// 		$count =$interResumeNum;
	// 		$page = new \Think\Page($count, 10);
	// 		$limit = $page->firstRow . ',' . $page->listRows;
	// 		$interResumeInfo=M('resume_info,interview,applicant_info')->where($condition)->order('createTime DESC')->limit($limit)->select();
	// 		$this->interResumeInfo = $interResumeInfo;
	// 		$this->page = $page->show();//将页码分配给前端的page变量
	// 		$this->display();//显示与所在方法同名的html文件
	// 	}
	// 	// else
	// 	// 	$this->redirect('登陆界面.html');
	// }//个人-推荐职位显示

	public function indi_chosenJob_show(){
		session('indiId','3');  //设置session
		if(isset($_SESSION['indiId']))
		{
			$indiId = session('indiId');
			$M=M('interview interview,resume_info resume_info,job_info job_info,company_info company_info');
			$sql='resume_info.applicantId='.$indiId.' 
			and interview.resumeId = resume_info.resumeId
			and interview.jobId = job_info.jobId
			and interview.hrId = company_info.hrId';
			$result=$M->where($sql)->select();

			// $result=M('resume_info')->where(array('applicantId' => $indiId))->select();
			p($sql);
			p($result);
			echo($result[0]['resumeprogress']);
			die;
			$this->assign('resumeProgress',resumeProgress);
		}
		// else
		// 	$this->redirect('登陆界面.html');
	}//个人-投递职位显示

	// public function indi_collectedJobComp_show(){
	// 	session('indiId','1');  //设置session
	// 	if(isset($_SESSION['indiId']))
	// 	{
	// 		$indiId = session('indiId');
	// 		$result=M('resume_info')->where(array('applicantId' => $indiId))->select();
	// 		p($result);
	// 		echo($result[0]['resumeprogress']);
	// 		die;
	// 		$this->assign('resumeProgress',resumeProgress);
	// 	}
	// }//个人-收藏的职位/公司显示

	// public function indi_subscribe_show(){
	// 	session('indiId','1');  //设置session
	// 	if(isset($_SESSION['indiId']))
	// 	{
	// 		$indiId = session('indiId');
	// 		$result=M('resume_info')->where(array('applicantId' => $indiId))->select();
	// 		p($result);
	// 		echo($result[0]['resumeprogress']);
	// 		die;
	// 		$this->assign('resumeProgress',resumeProgress);
	// 	}
	// }//个人-订阅显示
	
	// public function indi_webNews_show(){
	// 	session('indiId','1');  //设置session
	// 	if(isset($_SESSION['indiId']))
	// 	{
	// 		$indiId = session('indiId');
	// 		$result=M('resume_info')->where(array('applicantId' => $indiId))->select();
	// 		p($result);
	// 		echo($result[0]['resumeprogress']);
	// 		die;
	// 		$this->assign('resumeProgress',resumeProgress);
	// 	}
	// }//个人-站内信，显示收到信息数和列表

}
?>