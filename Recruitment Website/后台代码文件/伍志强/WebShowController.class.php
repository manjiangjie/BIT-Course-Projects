<?php
	namespace Home\Controller;
	use Think\Controller;
	use Lib\Interfaces\Show;
	class WebShowController extends Controller implements Show{
    
	// 获取指定日期所在星期的开始时间与结束时间
    public function getWeekRange($date){
         $ret=array();
         $timestamp=strtotime($date);
         $w=strftime('%w',$timestamp); //%w是从周一开始计算，%u是从周日开始计算
         $ret['sdate']=date('Y-m-d 00:00:00',$timestamp-($w-1)*86400);
         $ret['edate']=date('Y-m-d 23:59:59',$timestamp+(7-$w)*86400);
         return $ret;
    }
    //未登录界面的新增职位和视频面试人数显示
	public function newJob_sumVideoPeople_show(){
		$ret=$this->getWeekRange(date('Y-m-d'));
		$sdate=$ret['sdate'];  //当前周的开始时间
		$edate=$ret['edate'];  //当前周的结束时间额
        $job_info=M('job_info');
		$interview=M('interview');
        $condition['createTime'] = array(array('egt',$sdate),array('elt',$edate));
		$newJobCount=$job_info->where($condition)->count();  //$newJobCount是新增职位数
		$VideoPeople=$interview->where($condition)->count(); //$VideoPeople是视频面试人数
		$this->assign('newJobCount',$newJobCount);   //输出本周新增职位
		$this->assign('VideoPeople',$VideoPeople);   //输出本周视频面试人数

	}
    //热门职位显示
	public function topJob_show(){
		$job_info=M('job_info');
		$jobs=$job_info->order('jobClick desc')->limit(100)->select();  //选择排名前100的职位,如果需要还可添加分组
		$this->assign('jobs',$jobs);  //分配到模板
	}
    //企业-显示
	public function comp_show(){
		$company_info=M('company_info');
		$companys=$company_info->select();  //需要根据企业显示的信息定查询的字段
		$this->assign('companys',$companys);  //分配到模板

 
	}
	public function indi_resumeNum_interNum_show(){

	}//个人_投递数_面试数显示
	public function indi_resumeBeScanedNum_show(){

	}//个人-简历被浏览数显示
	public function indi_resumeCompletedper_show(){

	}//个人-简历完成度显示
	public function indi_recommandJob_show(){

	}//个人-推荐职位显示
	public function indi_chosenJob_show(){

	}//个人-投递职位显示
	public function indi_collectedJobComp_show(){

	}//个人-收藏的职位/公司显示
	public function indi_subscribe_show(){

	}//个人-订阅显示
	public function indi_webNews_show(){

	}//个人-站内信，显示收到信息数和列表
	public function hr_recuitmentJob_show(){

	}//HR-职位招聘数
	public function hr_getNewResume_show(){

	}//HR-新收简历数_列表显示
	public function hr_interResume_show(){

	}//HR-待面试简历列表显示
	public function hr_recommandResume_show(){

	}//HR-推荐简历列表显示
	public function hr_searchPageResume_show(){

	}//HR-搜索简历项的简历列表显示
	public function hr_collectedResume_show(){

	}//HR-我的收藏简历列表显示
	public function hr_rejectedResume_show(){

	}//HR-已拒绝简历列表显示
	public function hr_publishedJob_show(){

	}//HR-已发布的职位列表显示
	public function hr_failedJob_show(){

	}//HR-已失效职位列表显示
	public function hr_appointedInter_show(){

	}//HR-预约日程-待面试列表显示
	public function hr_interviewed_show(){
		
	}//HR-已面试列表显示
	}
?>