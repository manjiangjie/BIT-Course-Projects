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
<div class="container">
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
   	  		<div class="block" id="block-title">已发布职位</div>
            <form>
            	<div class="block">
                    <br>
                    <label class="lab-title">发布时间</label>
              		<select id="pos-type"></select>
                    <label class="lab-title">收简历数</label>
                    <select id="pos-type"></select>
                    <input type="submit" value="搜索">
                    <br><br>
                </div>
                <div class="block">
                	<br>
                    <input type="checkbox">	
                    <label id="lab-checkbox">全选</label>
                    <span class="pos-des">结束发布</span>
                    <br><br>
                    <?php if(is_array($publishedJobInfo)): foreach($publishedJobInfo as $key=>$a): ?><div class="position">
                    	<input class="choose-check" type="checkbox">
              			<div class="info-pos">
                        	<div class="pos-name"><?php echo ($a["jobname"]); ?></div>
                            <div class="pos-intro">地点：<?php echo ($a["jobaddress"]); ?> | 薪水：<?php echo ($a["jobsalary"]); ?>/月 | 招聘人数：<?php echo ($a->jobrecruitnum); ?> | 已收到简历<?php echo (jobgetresumenum($a["jobid"])); ?> 份 | 发布时间：<?php echo ($a["createtime"]); ?></div>
                        </div>
                        <div  class="end-post"><label>结束发布</label></div>
                    </div><?php endforeach; endif; ?>
                    <br>
                    <div class="page">
                    	<label class="page1">共 10 页</label>
                        <label class="page2">上一页</label>
                        <label class="page1">第 1 页</label>
                        <label class="page2">下一页</label>
                    </div>
                    <br><br>
            	</div>
            </form>
  		</div>
	</div>
</div>
<div class="tail">
京ICP备09083200号　京ICP证070419号　人才服务许可证：RC0280　京公网安备11010802012824<br>
Copyright©2000-2014 13hang.com All Rights Reserved
</div>
</body>
</html>