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
		

		public function interview(){
  			$jobid=$_GET['jobid'];

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

			$M->add($data);

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

			$M->add($data);

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

			$M->add($data);
		}

	
	}

?>