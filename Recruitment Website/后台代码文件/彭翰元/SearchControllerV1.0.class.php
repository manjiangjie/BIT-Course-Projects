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

			import('ORG.Util.Page');

			$key = I("key");
			$sex = I("sex");
			$age = I("age");
			$edu = I("edu");
			$joined = I("joined");
			$time = I("time");
			$industry = I("industry");

			$model = new \Think\Model();
			if($sex =="男")
				$sex = 1;
			else if($sex =="女")
				$sex = 2;
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
			if($key==""){

				if($industry == "不限"){//如果行业为空\
					$sql = 'resume_speciality.resumeId = resume_info.resumeId 
					and education.resumeId = resume_info.resumeId 
					and resume_work.resumeId = resume_info.resumeId 
					and resume_info.applicantId = applicant_info.applicantId';
					$table ='applicant_info ,resume_info ,resume_work ,education ,resume_speciality ';
					$field = 'applicantName,applicantSex,max(educationDegree),resume_info.lastEditTime';

					$count = $model->field($field)->table($table)->where($sql)->count('distinct applicant_info.applicantName');
					$page = new \Think\Page($count,10);
					$limit = $page->firstRow . ',' . $page->listRows;

					$info = $model->field($field)->table($table)->where($sql)->group('applicant_info.applicantName')->limit($limit)->select();
					//dump($info[0]);die;
					if($info[0]['applicantname'] == NULL)
						$info = array();
					//dump($info);die;
				}
				else{//如果行业不为空

					$sql = 'resume_speciality.specialityContent like "%'.$key.'%" 
					and resume_work.workCompany like "%'.$joined.'%" 
					and applicant_info.applicantSex like "%'.$sex.'%" 
					and education.educationDegree > "'.$edu.'" 
					and year(applicant_info.applicantBirthday) > "'.$age.'" 
					and datediff("'.date('Y-m-d').'",date_format(resume_info.lastEditTime,"%Y-%m-%d")) < "'.$time.'" 
					and resume_info.resumeIndustry like "%'.$industry.'%" 
					and resume_speciality.resumeId = resume_info.resumeId 
					and education.resumeId = resume_info.resumeId 
					and resume_work.resumeId = resume_info.resumeId 
					and resume_info.applicantId = applicant_info.applicantId';
					$table = 'applicant_info ,resume_info ,resume_work ,education ,resume_speciality ';
					$field = 'applicantName,applicantSex,max(educationDegree),resume_info.lastEditTime';

					$count = $model->field($field)->table($table)->where($sql)->count('distinct applicant_info.applicantName');
					//echo $count;
					$page = new \Think\Page($count,10);
					$limit = $page->firstRow . ',' . $page->listRows;
				
					$info = $model->field($field)->table($table)->where($sql)->limit($limit)->select();
					if($info['applicantName'] == NULL)
						$info = array();
					//dump($info);
				}

			/*	$sql = "select * from applicant_info,resume_info,resume_work,education,resume_speciality 
				where resume_speciality.resumeId = resume_info.resumeId 
				and education.resumeId = resume_info.resumeId 
				and resume_work.resumeId = resume_info.resumeId 
				and resume_info.applicantId = applicant_info.applicantId 
				group by applicantName;";*/
			}
			else{//如果不搜索全部

				if($industry == "不限"){//如果行业为空\

					$sql = 'resume_speciality.specialityContent like "%'.$key.'%" 
					and resume_work.workCompany like "%'.$joined.'%" 
					and applicant_info.applicantSex like "%'.$sex.'%" 
					and education.educationDegree > "'.$edu.'" 
					and year(applicant_info.applicantBirthday) > "'.$age.'" 
					and datediff("'.date('Y-m-d').'",date_format(resume_info.lastEditTime,"%Y-%m-%d")) < "'.$time.'" 
					and resume_speciality.resumeId = resume_info.resumeId 
					and education.resumeId = resume_info.resumeId 
					and resume_work.resumeId = resume_info.resumeId 
					and resume_info.applicantId = applicant_info.applicantId';
					$table = 'applicant_info ,resume_info ,resume_work ,education ,resume_speciality ';
					$field = 'applicantName,applicantSex,max(educationDegree),resume_info.lastEditTime';

					$count = $model->field($field)->table($table)->where($sql)->count('distinct applicant_info.applicantName');
					//echo $count;
					$page = new \Think\Page($count,10);
					$limit = $page->firstRow . ',' . $page->listRows;
				
					$info = $model->field($field)->table($table)->where($sql)->limit($limit)->select();
					if($info['applicantName'] == NULL)
						$info = array();

				/*	$sql = "select applicantName,applicantSex,max(educationDegree) from applicant_info,resume_info,resume_work,education,resume_speciality 
					where resume_speciality.specialityContent like '%".$key."%' 
					and resume_work.workCompany like '%".$joined."%' 
					and applicant_info.applicantSex like '%".$sex."%' 
					and education.educationDegree > '".$edu."' 
					and year(applicant_info.applicantBirthday) > '".$age."' 
					and datediff('".date('Y-m-d')."',date_format(resume_info.lastEditTime,'%Y-%m-%d')) < '".$time."'
					and resume_speciality.resumeId = resume_info.resumeId 
					and education.resumeId = resume_info.resumeId 
					and resume_work.resumeId = resume_info.resumeId 
					and resume_info.applicantId = applicant_info.applicantId 
					group by applicantName";  */
				}
				else{//如果行业不为空

					$sql = 'resume_speciality.specialityContent like "%'.$key.'%" 
					and resume_work.workCompany like "%'.$joined.'%" 
					and applicant_info.applicantSex like "%'.$sex.'%" 
					and education.educationDegree > "'.$edu.'" 
					and year(applicant_info.applicantBirthday) > "'.$age.'" 
					and datediff("'.date('Y-m-d').'",date_format(resume_info.lastEditTime,"%Y-%m-%d")) < "'.$time.'" 
					and resume_info.resumeIndustry like "%'.$industry.'%" 
					and resume_speciality.resumeId = resume_info.resumeId 
					and education.resumeId = resume_info.resumeId 
					and resume_work.resumeId = resume_info.resumeId 
					and resume_info.applicantId = applicant_info.applicantId';
					$table = 'applicant_info ,resume_info ,resume_work ,education ,resume_speciality ';
					$field = 'applicantName,applicantSex,max(educationDegree),resume_info.lastEditTime';

					$count = $model->field($field)->table($table)->where($sql)->count('distinct applicant_info.applicantName');
					//echo $count;
					$page = new \Think\Page($count,10);
					$limit = $page->firstRow . ',' . $page->listRows;
				
					$info = $model->field($field)->table($table)->where($sql)->limit($limit)->select();
					if($info['applicantName'] == NULL)
						$info = array();
				/*	$sql = "select applicantName,applicantSex,max(educationDegree) from applicant_info,resume_info,resume_work,education,resume_speciality 
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
					and resume_info.applicantId = applicant_info.applicantId ";	*/	
				}
			}
			
			$this->assign('page',$page->show());
			$this->info = $info;
			$this->display('Index/html/search');
			//dump($info);
			//echo $sql ;
		}//搜索简历
		
		public function searchFiledResume(){
			$model = new \Think\Model();
			$sql = "select applicantName,applicantSex,max(educationDegree) from interview,applicant_info,resume_info,resume_work,education,resume_speciality 
			where resume_speciality.resumeId = resume_info.resumeId 
			and education.resumeId = resume_info.resumeId 
			and resume_work.resumeId = resume_info.resumeId 
			and resume_info.applicantId = applicant_info.applicantId 
			and interview.resumeId = resume_info.resumeId 
			and interview.interviewStatus = 4
			group by applicantName;";
			$info = $model->query($sql);
			$this->info = $info;
			$this->display('Index/html/search');
		}//搜索被拒绝简历
	}
?>