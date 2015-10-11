<?php
/*
*Author：彭翰元
*Function：功能框架
*date:2015.3.27
*/
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Interfaces\AddInfo;


	class IndiAddinfoController extends Controller implements AddInfo{
		public function indiAddResume(){
			//$applicantId=$_SESSION['userId']; //得到当前user的usrid
			$applicantId='2';
			$rinfo=I('post.');
			if ($rinfo['type']=='resume')//如果是简历的保存
			{
				$applicant_info=M('applicant_info');//先是求职者表的更新
				$condition['applicantId'] = $applicantId;
				$data['applicantName']=$rinfo['applicantName'];
				$data['applicantPic']=$rinfo['applicantPic'];
				$rinfo['applicantSex']='男';
				$data['applicantSex']=sexchange($rinfo['applicantSex']);
				$applicantBirthday=$rinfo['biryear'].'-'.$rinfo['birmonth'].'-'.$rinfo['birdate'];
				$rinfo['applicantBirthday']=$applicantBirthday;
				$result1 = $applicant_info->where($condition)->save($data);

				$resume_info=M('resume_info');//然后是简历表的更新
				$condition['applicantId'] =$applicantId;
				$data1['resumeEthnic']=$rinfo['resumeEthnic'];
				$data1['resumePic']=$rinfo['resumePic'];
				$data1['resumeNationality']=$rinfo['resumeNationality'];
				$resumeStartWorkTime=$rinfo['workyear'].'-'.$rinfo['workmonth'];
				$data1['resumeStartWorkTime']=$resumeStartWorkTime;
				$data1['resumeAddress']=$resumeAddress;
				$data1['resumeProfile']=$resumeProfile;
				$result2 = $resume_info->where($condition)->save($data1);
				if(($result1 !== false)&&($result2!==false)){
					echo '简历数据更新成功！';
				}else{
					echo '简历数据更新失败！';
				}
			}
			else if ($rinfo['type']=='education')//如果是教育信息的保存
			{
				$education=M('education');
				$data['applicantId'] = $applicantId;
				$data['educationSchoolName']=$rinfo['educationSchoolName'];
				$data['educationMajor']=$rinfo['educationMajor'];
				$rinfo['country']='中国';
				$rinfo['area']='北京';
				$educationSchoolAddress=$rinfo['country'].'-'.$rinfo['area'];
				$data['educationSchoolAddress']=$educationSchoolAddress;

				$educationStartTime=$rinfo['stryear'].'-'.$rinfo['stmonth'].'-'.$rinfo['stdate'];
				$rinfo['educationStartTime']=$educationStartTime;
				$educationEndTime=$rinfo['endryear'].'-'.$rinfo['endmonth'].'-'.$rinfo['enddate'];
				$rinfo['educationEndTime']=$educationEndTime;
				$result = $education->add($data);

				if($result!== false){
					echo '教育数据增加成功！';
				}else{
					echo '教育数据增加失败！';
				}
			}

			
			else if ($rinfo['type']=='language')//如果是语言能力的添加
			{
				$resume_language=M('resume_language');
				$resume_info=M('resume_info');//然后是简历表的更新
				$condition['applicantId'] =$applicantId;
				$x=$resume_info->where($conditon)->find();
				$resumeId=$x['resumeid'];

				$data['languageCategory']=$rinfo['languageCategory'];
				$result = $education->where($condition)->save($data1);
				if($result!== false){
					echo '语言数据增加成功！';
				}else{
					echo '语言数据增加失败！';
				}
			}


		}//添加简历
		public function indiResumeSet(){
			$applicantId=$_SESSION['userId'];
			$M=M('resume_info resume_info');
    		$condition['resumeId'] = $applicantId;
			$visibility=I('resumeVisibility','','htmlspecialchars');
			$data['resumeVisibility'] = $visibility;
			$result = $M->where($condition)->save($data);
			if($result !== false){
				echo '数据更新成功！';
			}else{
				echo '数据更新失败！';
			}
		}//设置简历可见度
	
	}

?>