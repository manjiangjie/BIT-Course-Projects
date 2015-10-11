<?php
namespace Home\Controller;
use Think\Controller;
class UploadFileController extends Controller {
    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     APP_PATH.'Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件 
        $info   =   $upload->upload();
        $path =__ROOT__."/Admin/Uploads/".$info['photo']['savepath'].$info['photo']['savename'];
       // dump(unlink('./Admin/Uploads/'.$info['photo']['savepath'].$info['photo']['savename']));//删除文件
        $del = './Index/Uploads/'.$info['photo']['savepath'].$info['photo']['savename'];
        $this->assign('del',$del);
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            //$this->success('上传成功！');
            $this->assign('photosrc',$path)->display('Index/gallery');
        }
    }
    public function savepath(){
        if(I('flag')==1){
        $data['applicantPic'] = I('urlpath');
        $m = M('applicant_info');
        $m->where('applicantId=5')->save($data);
        $this->redirect('Index/UserInfo');
    }
    else{
       dump(unlink(I('urlpath')));
    }
    }
}