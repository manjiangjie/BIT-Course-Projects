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

function getnewresumenum($hrId){
    $num=M('job_info')->where(array('hrId'=>$hrId))->count();
    return $num;
}


?>