<?php

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