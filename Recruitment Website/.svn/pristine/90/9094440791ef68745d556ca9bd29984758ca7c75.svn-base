<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<link rel="stylesheet" type="text/css" href="/thinktest/Index/Home/View/Index/css&js/css/position.css">
<meta charset="utf-8">
</head>
<body>
<!--header-->
<div class="header">
	<img id="title-img" src="/thinktest/Index/Home/View/Index/css&js/image/title.png">
    <!--导航-->
	<ul class="navigator">
        <li>首页</li>
        <li>人脉圈</li>
        <li>知名企业</li>
        <li>视频面试</li>
        <li>海归路上</li>
    </ul>
    <!--搜索-->
    <div class="search">
    	<img src="/thinktest/Index/Home/View/Index/css&js/image/blank.png" id="search-bg">
    	<input type="text" id="search-input">
    	<img src="/thinktest/Index/Home/View/Index/css&js/image/magnifying-glass.png" id="search-magnifying"><img src="/thinktest/Index/Home/View/Index/css&js/image/close.png" id="search-close">
    </div>
</div>
<div class="container" id="search">
	<div class="content">
    	<div class="left">
        	<ul class="menu">
            	<li>HR首页</li>
                <li>简历管理
                	<ul class="submenu">
                    	<li><label>新收到简历</label>
                        	<div id="new-resume"><?php echo (getnewresumenum($hrId)); ?></div>
                        </li>
                        <li><label>待面试简历</label></li>
                        <li><label>推荐简历</label></li>
                        <li><label>搜索简历</label></li>
                        <li><label>我的收藏</label></li>
                        <li><label>已拒绝简历</label></li>
                    </ul>
                </li>
                <li>职位管理
                	<ul class="submenu">
                    	<li><label>发布新职位</label></li>
                        <li><label>已发布职位</label></li>
                        <li><label>已失效职位</label></li>
                    </ul>
                </li>
                <li>视频面试
                	<ul class="submenu">
                    	<li><label>预约日程</label></li>
                        <li><label>已面试</label></li>
                    </ul>
                </li>
                <li>企业主页</li>
                <li>控制面板</li>
            </ul>
        </div>
        <div class="right">
   	  		<div class="block" id="block-title">简历搜索</div>
            <form>
            	<div class="block">
                    <br>
                    <label class="lab-title">关键词	</label>
              		<input type="text">
                    <label class="lab-title">行业类别</label>
                    <input type="text">
                    <label class="pos-des">▶更多条件</label>
                    <input type="submit" value="搜索">
                    <br><br>
                </div>
                <div class="block">
                	<br>
                    <label class="lab-title">排序方式</label>
                    <ul class="order-resume">
                    	<li>时间 ↓ </li>
                        <li>学历 ↓ </li>
                    </ul>
                    <br>
                    <?php if(is_array($NewResumeInfo)): foreach($NewResumeInfo as $key=>$r): ?><div class="resume">
                    	<ul>
                        	<li class="icon"><img src="/thinktest/Index/Home/View/Index/css&js/image/icon1.png"></li>
                            <li class="profile">
                            	<div class="upper">
                                	<label class="left-lab">个人资料：</label>
                                	<label class="middle-lab"><?php echo ($r["applicantname"]); ?></label>
                                	<label class="info"><?php echo (changesex($r["applicantsex"])); ?>
                                                  /<?php echo (changedegree($r["educationdegree"])); ?>
                                            /NOT DONE/ <?php echo ($r["resumeaddress"]); ?></label>
                                </div>
                                <div class="lower">
                                	<label class="left-lab">应聘职位：</label>
                                	<label class="middle-lab"><?php echo ($r["jobname"]); ?></label>
                                	<label class="download-resume">下载简历</label>
                                </div>
                            </li>
                            <li class="oper">
                            	<div class="upper">
                                <label class="update-time">投递时间:  <?php echo (date('Y-m-d h:i',$r["lastedittime"])); ?></label></div>
                                <div class="lower">
                                	<label class="inform">通知面试</label>
                                	<label class="favorite2">收藏</label>
                                    <label class="refuse">拒绝</label>
                                </div>
                            </li>
                        </ul>
                    </div><?php endforeach; endif; ?>
                    <br>
                    <div class="page">
                    	<label class="page1">共 10 页</label>
                        <label class="page2">上一页</label>
                        <label class="page1">第 <input type="text" value="1"> 页</label>
                        <label class="page2">下一页</label>
                    </div>
                    <br><br>
            	</div>
            </form>
  		</div>
	</div>
</div>
<div class="tail" id="search-tail">
京ICP备09083200号　京ICP证070419号　人才服务许可证：RC0280　京公网安备11010802012824<br>
Copyright©2000-2014 13hang.com All Rights Reserved
</div>
</body>
</html>