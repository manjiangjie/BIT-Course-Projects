<?php
/*
*author: 张俊逸
*function：hr操作
*AlterTime: 2015/04/16
*/
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
				return "success";
			}
			else
				return "failed";
		}
		public function HRopenjob(){
  			$jobid=$_GET['jobid'];
  			$M=M('job_info');
			$hrId = session('uid');
			$condition['jobId'] = $jobid;
    		// 更新的条件
			$data['jobStatus'] = '0';
			$result = $M->where($condition)->save($data);
			
			if($result!=null)
			{
				return "success";
			}
			else
				return "failed";
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
				return "success";
			}
			else
				return "failed";

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
				return "success";
			}
			else
				return "failed";
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
				return "success";
			}
			else
				return "failed";
		}

	
	}

?>