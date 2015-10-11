<?php
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Interfaces\AddInfo;
	class IndiAddinfoController extends Controller implements AddInfo{
		public function indiEditResume(){
			$applicantId=$_SESSION['uid']; 
			$M=M('applicant_info ,user_info ,resume_info ');//先是求职者表的更新
			$sql='applicant_info.applicantId='.$applicantId.'
			 and user_info.userId='.$applicantId.'
			and resume_info.applicantId='.$applicantId;
			$info =$M->where($sql)->select();
			//dump($info);die;
			$this->assign('info',$info);
			
			$M=M('education ');
			$sql='education.applicantId='.$applicantId;
			$education=$M->where($sql)->select();
			//dump($education);die;
			$this->assign('education',$education);// 赋值数据集
			

			$M=M('resume_work');
			$sql='resumeId='.$info[0]['resumeid'];
			$work=$M->where($sql)->order('workTime')->select();
			$this->assign('work',$work);// 赋值数据
			//dump($work);die;


			$this->display("/WebShow/resumeedit");

		}


		public function indiAddResume(){
			$applicantId=$_SESSION['uid']; //得到当前user的usrid

				$age = I('age');
				$tel = I('tel');
				$mail = I('mail');
				$nation = I('nation');
				$nation =nationchange($nation);
				$address = I('address');
				$status = I('status');//无效
				$condition['applicantId'] = $applicantId;
				$data['userTelNum']=$tel;
				$data['userEmail']=$mail;
				$result1 =M('user_info')->where($condition)->save($data);
				$data['resumeNationality']=$nation;
				$data['resumeAddress']=$address;
				$result2 =M('resume_info')->where($condition)->save($data);
			

				// $applicant_info=M('applicant_info');//先是求职者表的更新
				// $condition['applicantId'] = $applicantId;
				// $data['applicantName']=$rinfo['applicantName'];
				// $data['applicantPic']=$rinfo['applicantPic'];
				// $rinfo['applicantSex']='男';
				// $data['applicantSex']=sexchange($rinfo['applicantSex']);
				// $applicantBirthday=$rinfo['biryear'].'-'.$rinfo['birmonth'].'-'.$rinfo['birdate'];
				// $rinfo['applicantBirthday']=$applicantBirthday;
				// $result1 = $applicant_info->where($condition)->save($data);

				// $resume_info=M('resume_info');//然后是简历表的更新
				// $condition['applicantId'] =$applicantId;
				// $data1['resumeEthnic']=$rinfo['resumeEthnic'];
				// $data1['resumePic']=$rinfo['resumePic'];
				// $data1['resumeNationality']=$rinfo['resumeNationality'];
				// $resumeStartWorkTime=$rinfo['workyear'].'-'.$rinfo['workmonth'];
				// $data1['resumeStartWorkTime']=$resumeStartWorkTime;
				// $data1['resumeAddress']=$resumeAddress;
				// $data1['resumeProfile']=$resumeProfile;
				// $result2 = $resume_info->where($condition)->save($data1);
				if(($result1 !== false)&&($result2!==false)){
					echo '简历数据更新成功！';
				}else{
					echo '简历数据更新失败！';
				}
			}


			public function indiAddEducation()
			{
				$applicantId=$_SESSION['uid']; //得到当前user的usrid
				$school = I('school');
				$major = I('major');
				$sty = I('sty');
				$stm = I('stm');
				$eny = I('eny');
				$enm = I('enm');
				$degree =I('degree');
				$degree =degreechange($degree);
				
				$education=M('education');
				$data['applicantId'] = $applicantId;
				$data['educationSchoolName']=$school;
				$data['educationMajor']=$major;
				$data['educationDegree']=$degree;

				$educationStartTime=$sty.'-'.$stm;
				$data['educationStartTime']=$educationStartTime;
				$educationEndTime=$eny.'-'.$enm;
				$data['educationEndTime']=$educationEndTime;
				$result = $education->add($data);

			}

			
			public function indiAddWork()
			{
				$applicantId=$_SESSION['uid']; //得到当前user的usrid
				$result=M('resume_info')->where('applicantId='.$applicantId)->select();
				$resumeId=$result[0]['resumeid'];

				$company = I('company');
				$job = I('job');
				$workaddress = I('workaddress');
				$wsy = I('wsy');
				$wsm = I('wsm');
				$wey = I('wey');
				$wem = I('wem');
				//时间字段待使用
				$workStartTime=$wsy.'-'.$wsm;
				$data['workTime']=$workStartTime;
				$data['resumeId']=$resumeId;
				$data['workCompany'] = $company;
				$data['workJob']=$job;

				$result = M('resume_work')->add($data);

			}



			
			// public function indiAddLanguage()
			// {
			// 	$resume_language=M('resume_language');
			// 	$resume_info=M('resume_info');//然后是简历表的更新
			// 	$condition['applicantId'] =$applicantId;
			// 	$x=$resume_info->where($conditon)->find();
			// 	$resumeId=$x['resumeid'];

			// 	$data['languageCategory']=$rinfo['languageCategory'];
			// 	$result = $education->where($condition)->save($data1);
			// 	if($result!== false){
			// 		echo '语言数据增加成功！';
			// 	}else{
			// 		echo '语言数据增加失败！';
			// 	}
			// }

		public function indiResumeSet()
		{
			$applicantId=$_SESSION['uid'];
			$M=M('resume_info resume_info');
    		$condition['resumeId'] = $applicantId;
			$visibility=I('resumeVisibility','','htmlspecialchars');
			$data['resumeVisibility'] = $visibility;
			$result = $M->where($condition)->save($data);
			if($result !== false){
				echo '数据更新成功！';
			}else{
				echo '数据更新失败！';
			}//设置简历可见度
		}
		public function hrAddJob(){

		}
		public function hrChangeCompInfo(){

		}
		public function hrAddCompNews(){

		}
		public function hrChangeInfo(){

		}
		public function hrSetInfo(){

		}
		public function chat(){
			
		}//和企业聊天
		public function submitJob(){
			if(isset( $_SESSION['uid']))
			{
			$uid = $_SESSION['uid'];
			//dump($uid);
			$info = M('resume_info')->where('applicantid = '.$uid)->select();
			$hrid = I('hrid');
			$jobid = I('jobid');
			//$hrid = 12;
			//$jobid = 1;
			$add = array('interviewStatus'=>1,
				'createTime'=>date('Y-m-d H:i:s'),
				'lastEditTime'=>date('Y-m-d H:i:s'),
				'interviewDeliverTime' =>date('Y-m-d H:i:s'),
				'jobId'=>$jobid,
				'resumeId'=>$info[0]['resumeid'],
				'hrId'=>$hrid
				);
			$m = M('interview');
			$m->add($add);
			$data['status'] = 1;
			$data['url'] = U('WebShow/home');
			$this->ajaxReturn($data);
		}
			//$this->send = 'send';
		else	//$this->send = 'send';
		{
			$data['status'] = 0;
			$data['url'] = U('WebShow/home');
			$this->ajaxReturn($data);
		}
		
		}
	}

?>