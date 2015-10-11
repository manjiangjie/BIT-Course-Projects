<?php
/*
** Author: 张俊逸
** functio: 
** AlterTime: 2015/04/05
**/
   //邮件发送函数
   
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

function getmail($applicantid){
    $M = M('user_info ');
    $sql='user_info.userId='.$applicantid;
    $first=$M->where($sql)->select();
    $result=$first['0']['useremail'];
    return $result;
}

function getage($birthday)
{
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