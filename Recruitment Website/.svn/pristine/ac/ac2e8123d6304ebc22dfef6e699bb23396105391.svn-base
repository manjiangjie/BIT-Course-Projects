<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$this->display();
    }
    
    public function handle(){
    	if(!IS_AJAX){
    		E('页面不存在');
    	}
    	$data = array(
    		'addressCountry' => I('username'),
    		'addressArea' => I('content'),
    		);


        if(M('address')->data($data)->add()){
           // $this->d = $data;
            $data['status'] = 1;
           // $this->display('./App/Home/View/Index_index.html');
            $this->ajaxReturn($data,'json');
        } else{
            $this->ajaxReturn(array('status'=>0),'json');
        }
    }
}