<?php

    function changeCompanysize($companysize){
        if($companysize==1)
            return "20人以下";
        if($companysize==2)
            return "20-50人";
        if($companysize==3)
            return "50-100人";
        if($companysize==4)
            return "100-500人";
        if($companysize==5)
            return "500-1000人";
        if($companysize==6)
            return "1000人以上";
    }
    function changeCompanynature($companynature){
        if($companynature==1)
            return "国企";
        if($companynature==2)
            return "民营";
        if($companynature==3)
            return "外商独资";
        if($companynature==4)
            return "合资";
        if($companynature==5)
            return "事业单位";
        if($companynature==6)
            return "国家机关";
        if($companynature==7)
            return "其他";
    }
    function changeCompanyfinancing($companyfinancing){
        if($companyfinancing==1)
            return "上市公司";
        if($companyfinancing==2)
            return "创业公司";
        if($companyfinancing==3)
            return "A轮";
        if($companyfinancing==4)
            return "B轮";
        if($companyfinancing==5)
            return "C轮";
        if($companyfinancing==6)
            return "无融资";
        if($companyfinancing==7)
            return "其他";
    }
     function upload($pathname){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        //$upload->savePath =  './Public/uploads/';// 设置附件上传目录
        $upload->rootPath  =     './Public/uploads/'; // 设置附件上传根目录
        $upload->autoSub = true;
        $upload->subName = array('');   
        $upload->savePath  = $pathname; // 设置附件上传（子）目录
        // 上传文件 
        $info   = $upload->upload($_FILES);
        if(!$info) {// 上传错误提示错误信息
           echo '上传失败';
        }else{// 上传成功
           return $info['photo']["savename"];
        }
     }
     //计算企业资料的完善程度
     function compInfo_level()
     {
         //$userId=$_SESSION['uid'];
         $nullNum=0;
         $percent=0;
         $count=13;//统计字段总数
         $userId='11';
         $companyId=$userId;
         $condition['companyId']=$companyId;
         $company_info=M('company_info');
         $results=$company_info->where($condition)->select();
         if($results[0]["companyname"]==NUll)
             $nullNum++;
         if($results[0]["companylicense"]==NUll)
             $nullNum++;
          if($results[0]["companylogo"]==NUll)
             $nullNum++;
         if($results[0]["companysize"]==NUll)
             $nullNum++;
         if($results[0]["companynature"]==NUll)
             $nullNum++;
          if($results[0]["companyfinancing"]==NUll)
             $nullNum++;
         if($results[0]["companyprofile"]==NUll)
             $nullNum++;
          if($results[0]["companycontactname"]==NUll)
             $nullNum++;
          if($results[0]["companycontactsex"]==NUll)
             $nullNum++;
          if($results[0]["companycontacttelnum"]==NUll)
             $nullNum++;
          if($results[0]["companywebsite"]==NUll)
             $nullNum++;
         if($results[0]["companyaddress"]==NUll)
             $nullNum++;
          if($results[0]["industryid"]==NUll)
             $nullNum++;
         $percent=number_format(($count-$nullNum)/$count*100,0).('%');
         //echo ($percent);
         return $percent;
     }

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
        $mail->AltBody = "北京十三行公司"; //邮件正文不支持HTML的备用显示

        //dump($mail->Send());
       // dump($mail);die;
        return($mail->Send());
    }
function getWeekRange($date){
         $ret=array();
         $timestamp=strtotime($date);
         $w=strftime('%w',$timestamp); //%w是从周一开始计算，%u是从周日开始计算
         $ret['sdate']=date('Y-m-d 00:00:00',$timestamp-($w-1)*86400);
         $ret['edate']=date('Y-m-d 23:59:59',$timestamp+(7-$w)*86400);
         return $ret;
    }



    function verify_img(){//验证码
        $Verify = new \Think\Verify();  
        $Verify->fontSize = 14;  
        $Verify->length   = 4;  
        $Verify->useNoise = false;  
        $Verify->codeSet = '0123456789';  
        $Verify->imageW = 100;  
        $Verify->imageH = 30;  
        //$Verify->expire = 600;  
        $Verify->entry(1);
    }
   function check_verify($data,$id = '1'){
        //echo 'asdasd';die;
        $Verify = new \Think\Verify();
        //$this->display();
        return $Verify->check($data,$id);
        //$this->redirect('WebShow/HOME');
    }

function p ($array){
	dump($array,1,'<pre>',0);
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

    function degreechange($degree){
        if($degree == "无")
            return 0; 
        if($degree == "高中毕业")
            return 1; 
        if($degree == "本科")
            return 2; 
        if($degree == "硕士")
            return 3; 
        if($degree == "博士及以上")
            return 4; 
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
    //dump($first);die;
    // $first=$first['0'];
    $result=changedegree ($first['educationdegree']);
    return $result;
}

// function getmail($applicantid){
//     $M = M('user_info ');
//     $sql='user_info.userId='.$applicantid;
//     $first=$M->where($sql)->select();
//     $result=$first['0']['useremail'];
//     return $result;
// }

function getage($birthday)
{
    echo $birthday；die;
    $time=date('Y-m-d');
    $birthday=intval ( $time )- intval ( $birthday );
    return $birthday;
}

function getnat($nat)
{
    if($nat == 1)
        return "汉族"; 
    else
        return "少数民族";
}

function getpol($nat)
{
    if($nat == 0)
        return "无党派人士"; 
    else if($nat==1)
        return "共青团员";
    else if($nat==2)
        return "党员";
    else if($nat==3)
        return "其他";

}

function getnation($nat)
{
    if($nat == 1)
        return "中国"; 
    else if($nat==2)
        return "美国";
    else if($nat==3)
        return "新加坡";
    else if($nat==4)
        return "日本";
    else if($nat==5)
        return "其他";

}

function nationchange($nat)
{
    if($nat =="中国" )
        return 1; 
    else if($nat=="美国")
        return 2;
    else if($nat=="新加坡")
        return 3;
    else if($nat=="日本")
        return 4;
    else if($nat=="其他")
        return 5;

}



function getjobnum($hrId){
    $num=M('job_info')->where(array('hrId'=>$hrId))->count();
    return $num;
}

function getnewresumenum($hrId){
    $num=M('interview')->where(array('hrId'=>$hrId,'interviewStatus'=>1))->count();
    return $num;
}

function getnum($num,$d){
    $x=$num%$d;
    $num=($num-$x)/$d;
    return $num;
}


function excel($info,$education,$work){
    include '/../../../PHPExcel/Classes/PHPExcel.php';
    include '/../../../PHPExcel/Writer/Excel2007.php';
    //或者include 'PHPExcel/Writer/Excel5.php'; 
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
    $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(15);



    $objPHPExcel->getActiveSheet()->setCellValue('A1', '个人简历');
    $objPHPExcel->getActiveSheet()->mergeCells('A1:E3');


    $objPHPExcel->getActiveSheet()->setCellValue('A4', '姓　　名：');
    $objPHPExcel->getActiveSheet()->setCellValue('A5', '出生年月：');
    $objPHPExcel->getActiveSheet()->setCellValue('A6', '学　　历：');
    $objPHPExcel->getActiveSheet()->setCellValue('A7', '语言等级：');
    $objPHPExcel->getActiveSheet()->setCellValue('A8', '联系电话：');
    $objPHPExcel->getActiveSheet()->setCellValue('A9', '特长或证书：');
    $objPHPExcel->getActiveSheet()->setCellValue('A10', '联系地址：');
    $objPHPExcel->getActiveSheet()->mergeCells('E4:E7');
    $objPHPExcel->getActiveSheet()->mergeCells('D8:E8');
    $objPHPExcel->getActiveSheet()->setCellValue('B4', $info['applicantname']);
    $objPHPExcel->getActiveSheet()->setCellValue('B5', $info['applicantbirthday']);
    $objPHPExcel->getActiveSheet()->setCellValue('B6', resumegetegree($info['applicantid']));
    $objPHPExcel->getActiveSheet()->setCellValue('B8', $info['resumetelnum']);
    $objPHPExcel->getActiveSheet()->setCellValue('B10', $info['resumeaddress']);


    $objPHPExcel->getActiveSheet()->setCellValue('C4', '性    别：');
    $objPHPExcel->getActiveSheet()->setCellValue('C5', '政治面貌: ');
    $objPHPExcel->getActiveSheet()->setCellValue('C6', '专　　业：');
    $objPHPExcel->getActiveSheet()->setCellValue('C7', '第二语言：');
    $objPHPExcel->getActiveSheet()->setCellValue('C8', '电子信箱：');
    $objPHPExcel->getActiveSheet()->setCellValue('A11', '其　　它：');
    $objPHPExcel->getActiveSheet()->setCellValue('B11', '微    信：');
    $objPHPExcel->getActiveSheet()->setCellValue('D11', 'FACEBOOK：');
    $objPHPExcel->getActiveSheet()->mergeCells('B9:E9');
    $objPHPExcel->getActiveSheet()->mergeCells('B10:E10');
    $objPHPExcel->getActiveSheet()->setCellValue('D4', changesex($info['applicantsex']));
    $objPHPExcel->getActiveSheet()->setCellValue('D5', getpol($info['resumepoliticalstatus']));
    $objPHPExcel->getActiveSheet()->setCellValue('D6', $education[0]['applicantid']);
    $objPHPExcel->getActiveSheet()->setCellValue('C11', $info['applicantwechat']);
    $objPHPExcel->getActiveSheet()->setCellValue('E11', $info['applicantfacebook']);

    $objPHPExcel->getActiveSheet()->setCellValue('A12', '教育背景：');
    $objPHPExcel->getActiveSheet()->mergeCells('A12:E12');
    $educationcount=count($education);
    $i=13;
    $x=$i;
    for($i;$i<$educationcount+13;$i++)
    {
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 
            substr($education[$i-$x]['educationstarttime'],0,4).'年'.
            substr($education[$i-$x]['educationstarttime'],5,6).'月~'.
            substr($education[$i-$x]['educationgraduatetime'],0,4).'年'.
            substr($education[$i-$x]['educationgraduatetime'],5,6).'月');
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $education[$i-$x]['educationschoolname']);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
        $objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':E'.$i);
    }
    $x=$i;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$x, '工作中的实习经历：');
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$x.':E'.$x);
    $x=$x+1;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$x, '时间');
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$x, '企业');
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$x, '职位');
    $objPHPExcel->getActiveSheet()->mergeCells('A'.$x.':B'.$x);
    $objPHPExcel->getActiveSheet()->mergeCells('C'.$x.':D'.$x);
    $workcount=count($work);
    $x=$x+1;
    $i=$x;
    for($i;$i<$workcount+$x;$i++)
    {
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 
            substr($work[$i-$x]['workTime'],0,4).'年'.
            substr($work[$i-$x]['workTime'],5,6).'月~'.
            substr($work[$i-$x]['workTime'],0,4).'年'.
            substr($work[$i-$x]['workTime'],5,6).'月');
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $work[$i-$x]['workcompany']);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $work[$i-$x]['workcompany']);
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$i.':B'.$i);
        $objPHPExcel->getActiveSheet()->mergeCells('C'.$i.':D'.$i);
    }  
    $i=$i-1;

    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$i)->getFont()->setSize(11);
    $objPHPExcel->getActiveSheet()->getStyle('A5:E'.$i)->getFont()->setNAME('宋体');


    $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
    $styleArray = array(  
        'borders' => array(  
            'allborders' => array(  
                'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框  
                ),  
            ),  
        );  
    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$i)->applyFromArray($styleArray);//这里就是画出从单元格A5到N5的

    //保存excel—2007格式
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    $objWriter->save("./PHPExcel/Result/resume.xlsx");

}


?>