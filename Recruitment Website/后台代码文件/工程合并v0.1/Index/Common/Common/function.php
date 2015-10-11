<?php
/*
** Author: 谢辰
**       : 张俊逸
**       : 伍志强
**       ：彭翰元
** functio: 邮件发送函数
**        : 数字与学历映射，数字与性别映射
**        : 由HRID获取新收简历数，获取工作岗位的简历投递数，根据学历得到简历，生日与年龄转换，数字与民族映射，数字与政治面貌映射
**        : 获取时间范围
**        ：非关键字搜索
** AlterTime: 2015/04/05
**/
   //邮件发送函数
    function sendMail($to, $title, $content) {
     
        Vendor('PHPMailer.PHPMailerAutoload');     
        $mail = new PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host=C('MAIL_HOST'); //smtp服务器的名称
        $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证

        $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
        $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
        $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
        $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
        $mail->AddAddress($to,"尊敬的客户");

        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
        $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码

        $mail->Subject =$title; //邮件主题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = "验证了！！！"; //邮件正文不支持HTML的备用显示

        //dump($mail->Send());
       // dump($mail);die;
        return($mail->Send());
    }

    function changedegree($degree){
        if($degree == 0)
            return "无"; 
        if($degree == 1)
            return "高中毕业"; 
        if($degree == '2')
            return "本科"; 
        if($degree == 3)
            return "硕士"; 
        if($degree == 4)
            return "博士及以上"; 
    }


function changesex($sex){
    if($sex == 1)
        return "男";
    else
        return "女";
}
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
function jobgetresumenum($jobId){
    $M = M('interview interview');
    $sql='interview.jobId='.$jobId;
    $num=$M->where($sql)->count();
    return $num;
}

function resumegetegree($resumeId){
    $M = M('education education');
    $sql='education.resumeId='.$resumeId;
    $first=$M->where($sql)->limit(1)->order('educationDegree desc')->select();
    $first=$first['0'];
    $result=changedegree ($first['educationdegree']);
    return $result;
}

function getage($birthday)
{
    return '生日变年龄';
}

function getnat($nat)
{
    return 'int变民族';
}

function getpol($nat)
{
    return 'int变政治面貌';
}

function getWeekRange($date){
         $ret=array();
         $timestamp=strtotime($date);
         $w=strftime('%w',$timestamp); //%w是从周一开始计算，%u是从周日开始计算
         $ret['sdate']=date('Y-m-d 00:00:00',$timestamp-($w-1)*86400);
         $ret['edate']=date('Y-m-d 23:59:59',$timestamp+(7-$w)*86400);
         return $ret;
    }


function getnewresumenum($hrId){
    $num=M('job_info')->where(array('hrId'=>$hrId))->count();
    return $num;
}
?>