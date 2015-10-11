<?php
/*
*Author：彭翰元
*Function：搜索功能
*date:2015.4.6
*/
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Interfaces\Search;
	use Home\Model\applicant_infoModel;
	class SearchController extends Controller implements Search{
		public function showjob	(){
			//$this->display('Index/Search');//显示搜索页面
			$info = M('job_info')->select();//搜索全部
			$this->assign('info',$info)->display('Index/Search');
		}
		public function showresume(){
			$info = M('resume_info')->select();//搜索全部
			$this->assign('info',$info)->display('Index/Search_re');
		}
		public function searchJob(){
			$m_job = M('job_info');
			$keytype = I('keytype');
			$salary = I('salary');
			$key = I('key');
			$time = I('time');
			echo $keytype;
			if($keytype =='职位名')//按照职位名搜索
			{
				//$key = I('key');
				if($key=="" ){//如果没有关键字
					$info = no_search();
					//echo no;
				}
				else{//如果有关键字，搜索关键
					$sql['jobName'] = array('like','%'.$key.'%');//数组传递where条件
					if($time!=""){//如果有时间限制
						$sql['jobReleaseTime'] = array('between','2014-01-10,2015-03-07');
						$sql['_logic'] = 'and';//添加时间限制条件
						$salary = I('salary');
						if($salary!=''){//如果有薪酬限制
							$sql['jobSalary'] = array('between','0,10000');
							//$sql['_logic'] = 'and';//添加薪酬条件
						}
					}
					else{//如果没有时间限制
						if($salary!=""){//如果有薪酬限制
							$sql['jobSalary'] = array('between','0,10001');//这里需要把数据库改成int型
						//	$sql['_logic'] = 'and';//添加薪酬条件
						}
					}
					$info = $m_job->where($sql)->select();
					
					//
				}
			}
			else if($keytype =='公司名称')//按照公司名搜索
			{
				if($key == ""){//如果没有关键字
					$info = no_search();
				}
				else{//如果有关键字，搜索关键字
					if($time!=''){//如果有时间限制
						$info = $m_job->table('job_info job, company_info comp')->where('job.jobReleaseTime between "2014-01-30" and "2015-05-30" 
							and comp.companyName like "%'.$key.'%"and job.jobCompanyId = comp.companyId')->select();
						//搜索时间限制
						if($salary!=''){//如果有薪酬要求
							$info = $m_job->table('job_info job, company_info comp')->where('job.jobSalary between "1" and "10" and 
							job.jobReleaseTime between "2014-01-30" and "2015-05-30" 
							and comp.companyName like "%'.$key.'%" and job.jobCompanyId = comp.companyId')->select();
						}
					}
					else{//如果没有时间限制
						$info = $m_job->table('job_info job, company_info comp')->where('comp.companyName like "%'.$key.'%" and 
							job.jobCompanyId = comp.companyId')->select();
						if($salary!=''){//如果有薪酬要求
							$info = $m_job->table('job_info job, company_info comp')->where('job.jobSalary between "1" and "9000" and 
							job.jobReleaseTime between "2014-01-30" and "2015-05-30" 
							and comp.companyName like "%'.$key.'%" and job.jobCompanyId = comp.companyId')->select();
						}
					}
					//多表查
				}
			}
			//将数据提交到前台
			$this->assign('key',$key);
			$this->assign('keytype',$keytype);
			$this->assign('salary',$salary);
			$this->assign('info',$info)->display('Index/Search');
		}//搜索职位

		public function searchAll(){
			echo 1111;

		}

		public function hrSearchResume(){
			$key = I("key");
			$sex = I("sex");
			$age = I("age");
			$edu = I("edu");
			$joined = I("joined");
			$time = I("time");
			$industry = I("industry");

			$m_resume = M("resume_info");

			$model = new \Think\Model();
			if($sex =="男")
				$sex = 0;
			else if($sex =="女")
				$sex = 1;
			else 
				$sex = "";
			if($age == "不限")//如果年龄为空
				$age = date('Y') - 100;
			else{
				$age = date('Y') - $age;
			}
			if($edu =="不限")
				$edu = 0;
			if($time == "不限")
				$time = 100;
			if($industry == "不限"){//如果行业为空
				$sql = "select applicantSex,applicantName from applicant_info,resume_info,resume_work,education,resume_speciality 
				where resume_speciality.specialityContent like '%".$key."%' 
				and resume_work.workCompany like '%".$joined."%' 
				and applicant_info.applicantSex like '%".$sex."%' 
				and education.educationDegree > '".$edu."' 
				and year(applicant_info.applicantBirthday) > '".$age."' 
				and datediff('".date('Y-m-d')."',date_format(resume_info.lastEditTime,'%Y-%m-%d')) < '".$time."'
				and resume_speciality.resumeId = resume_info.resumeId 
				and education.resumeId = resume_info.resumeId 
				and resume_work.resumeId = resume_info.resumeId 
				and resume_info.applicantId = applicant_info.applicantId ";
			}
			else{//如果行业不为空
				$sql = "select applicantSex from applicant_info,resume_info,resume_work,education,resume_speciality 
				where resume_speciality.specialityContent like '%".$key."%' 
				and resume_work.workCompany like '%".$joined."%' 
				and applicant_info.applicantSex like '%".$sex."%' 
				and education.educationDegree > '".$edu."' 
				and year(applicant_info.applicantBirthday) > '".$age."' 
				and resume_info.resumeIndustry like '%".$industry."%' 
				and datediff('".date('Y-m-d')."',date_format(resume_info.lastEditTime,'%Y-%m-%d')) < '".$time."'	
				and resume_speciality.resumeId = resume_info.resumeId 
				and education.resumeId = resume_info.resumeId 
				and resume_work.resumeId = resume_info.resumeId 
				and resume_info.applicantId = applicant_info.applicantId ";		
			}
			$info = $model->query($sql);
			dump($info);
			echo $sql ;
		}//搜索简历
		
		public function searchFiledResume(){

		}//搜索失效简历
	}
?>