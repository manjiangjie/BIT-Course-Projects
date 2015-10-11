<?php
	function no_search(){
		$m_job = M('job_info');
		$keytype = I('keytype');
		$salary = I('salary');
		$key = I('key');
		$time = I('time');
		if($time!=''){//如果有时间限制
			$sql['jobReleaseTime'] = array('between','2014-01-10,2015-01-10');
			$salary = I('salary');
			if($salary!=''){//如果有薪酬限制
				$sql['jobSalary'] = array('between','0,10');
				$sql['_logic'] = 'and';
			}
			$info = $m_job->where($sql)->select();//搜索时间限制
		}
		else{//如果没有时间限制
			$salary = I('salary');
			if($salary!=''){//如果有薪酬限制
				$sql['jobSalary'] = array('between','0,1000');
				$info = $m_job->where($sql)->select();
			}
			else
				$info = $m_job->select();//搜索全部
		}
		return $info;
	}
	function changesex($sex){
		if($sex == 1){
			return "男";
		}
		else
			return "女";
	}
	function changedegree($degree){
		if($degree == 0)
			return "无"; 
		if($degree == 1)
			return "高中毕业"; 
		if($degree == 2)
			return "本科"; 
		if($degree == 3)
			return "硕士"; 
		if($degree == 4)
			return "博士及以上"; 
	}
?>