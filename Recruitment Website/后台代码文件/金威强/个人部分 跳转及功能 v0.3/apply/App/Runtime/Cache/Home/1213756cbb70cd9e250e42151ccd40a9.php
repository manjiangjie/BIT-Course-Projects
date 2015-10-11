<?php if (!defined('THINK_PATH')) exit();?><!--created  by 宁方迪 2015-4-6 -->
<!DOCTYPE html>
<html>
<head lang="zh-cn">
    <meta charset="UTF-8">
    <title>主页</title>
    <link href="/apply/Public/css&js/bootstrap.min.css" rel="stylesheet">
    <link href="/apply/Public/css&js/style.css" rel="stylesheet">
    <script src="/apply/Public/css&js/jquery-2.1.3.min.js"></script>
    <script src="/apply/Public/css&js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/apply/Public/js/HOME.js"></script>
    
    <style>
    
	.navimg1{
			width:30PX;
			height:35px;
			margin-top:-5px;
		}
	.navimg2{
		width:30PX;
			height:20px;
			margin-right:5px;
			}
		.nav-search{
			width:200px;
			position:absolute;
			top:10px;
			left:65px;
		}
		
	</style>
</head>

<body>

<nav class="navbar  navbar-fixed-top navbar-inverse " role="navigation">
  <div class="container">
   <div class="navbar-header">
    <div class="navbar-brand nav-brand1"><a href="<?php echo U('WebShow/indi_Home');?>"><img class="navimg1" alt="Brand" src="/apply/Public/image/首页/u42.png"></a></div> 
      
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
                  
             <div class="visible-xs nav-search">  
              <input type="text" class="form-control" placeholder="请输入职位关键字">          
             </div>  <!-- ./nav-search-->  
                 
   </div><!-- ./navbar-header-->
         
    <div class="collapse navbar-collapse" id="nav-1">
      <ul class="nav navbar-nav ">
  	
        <li class="active"><a href="<?php echo U('WebShow/indi_Home');?>">首页 <span class="sr-only">(current)</span></a></li>
      
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">找职位<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo U('WebShow/indi_search');?>">搜寻职位</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo U('WebShow/indi_jobmanaging');?>">职位管理</a></li>
           
          </ul>
          </li><!-- dropdown ！-->
          
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">人脉圈<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo U('WebShow/indi_myfriends');?>">海外校友</a></li>
            <li class="divider"></li>
            <li><a href="#">人脉圈</a></li>
            
           </ul>
           </li><!-- dropdown ！-->
            
            <li><a href="<?php echo U('WebShow/indi_famous');?>">知名企业</a></li>
              <li><a href="#">视频面试</a></li>
                <li><a href="#">海归路上</a></li>
              </ul>   
                       
     <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo U('WebShow/indi_webNews_show_all');?>"><img class="navimg2" alt="Brand" src="/apply/Public/image/首页/1_u297.png"></a></li>
          <li><a href="<?php echo U('WebShow/indi_personalfront');?>"><img class="navimg2" alt="Brand" src="/apply/Public/image/首页/2_u299.png"></a></li>
          <li><a href="#">加入收藏</a></li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>




<div><!--搜索栏-->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="/apply/Public/image/首页/u195.jpg" class="img-responsive" alt="...">
                <div class="carousel-caption">
               
                </div>
            </div>
            <div class="item">
                <img src="/apply/Public/image/首页/u195.jpg" class="img-responsive" alt="...">
                <div class="carousel-caption">
                    
                </div>
            </div>
            <div class="item">
                <img src="/apply/Public/image/首页/u195.jpg" class="img-responsive" alt="...">
                <div class="carousel-caption">
                  
                </div>
            </div>

        </div><!--./carousel-inner-->

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div><!-- ./carosel-->
 </div><!-- 搜索栏-->

    <!--div style="position:absolute;width: 200px;;height: 100px;z-indent:2;left:50%;top: 10px;;"-->
    <div class="home-1 hidden-xs">
        <div class="home-search">
        <form class="form-inline">
            <div class="form-control">
                <label for="city">城市</label>
                <select name="cars" id="city">
                    <option value="bj">北京</option>
                    <option value="sh">上海</option>
                    <option value="gz">广州</option>
                    <option value="sz">深圳</option>
                </select>
            </div>
            <div class="form-group">
                <label for="search"></label>
                <input type="email" class="form-control" id="search" placeholder="IT工程师">
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>

            <div class="gray">
                热门：产品经理　投资经理　海外项目经理　平面设计师　工业设计师<br>
            </div>
            <div class="gray2">
                本周新增职位 <a> 25 </a> 个  
                其中　<a>0</a> 人选择了视频面试！
            </div>
        </div><!-- ./ left-f -->

        <div>
            <embed src="http://player.youku.com/player.php/sid/XMzI2NTc4NTMy/v.swf"                 
                   type="application/x-shockwave-flash"  class="home-vedio">
            </embed>
        </div>
    </div><!--./ jicheng-->



<!--<img src="home/u195.jpg" class="img-responsive" alt="Responsive image" >-->
<div class="hidden-xs">
<form class="home-login">

    <div class="btn-group login-title" data-toggle="buttons">
        <label class="btn btn-primary active" id="opt1">
            <input type="radio" name="options"  autocomplete="off" checked> 求职者
        </label>
        <label class="btn btn-primary" id="opt2">
            <input type="radio" name="options"autocomplete="off"> 企业HR
        </label>
    </div>
    <div class="login-head">
        <input type="text">
        <input type="password">
        <ul id="login-psd-deal">
            <li class="left"><input type="checkbox"></li>
            <li class="left"><label>记住密码</label></li>
            <li class="right"><label>忘记密码？</label></li>
        </ul>
        <input type="submit" value="登录">
        <li class="left"><label>还没有求职者账号？</label></li>
        <label id="login-lab-register" data-toggle="modal" data-target="#modal-zhuce" class="btn">立即注册</label>
    </div>
</form>
</div><!--./home-login-->




<div class="blockline">

</div>

<blockquote class="Ltitle">
    <p>热门职位</p>
</blockquote>
<!--企业列表内容-->
<div class="main">
    <div class="container  home-container">
        <div class="title"></div>
        <div class="row">

            <div class="col-sm-6 col-md-3">
                <div class="modul">
                    <div><!--企业logo-->
                        <a href="#"><img src="/apply/Public/image/首页/u24.png" class="img3"/></a></div>
                    <!--文字内容-->
                    <div class="row">
                        <table class="table">
                            <tr>
                                <td><p1>数据研发工程师</p1></td>
                                <td><p1>多地</p1></td>
                            </tr>
                            <tr>
                                <td><p1>客户端开发工程师</p1></td>
                                <td><p1>上海</p1></td>
                            </tr>
                            <tr>
                                <td><p1>欧洲资金渠道合作经理</p1></td>
                                <td><p1>海外</p1></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="modul">
                    <div><!--企业logo-->
                        <a href="#"><img src="/apply/Public/image/首页/u24.png" class="img3"/></a></div>
                    <!--文字内容-->
                    <div class="row">
                        <table  class="table">
                            <tr>
                                <td><p1>数据研发工程师</p1></td>
                                <td><p1>多地</p1></td>
                            </tr>
                            <tr>
                                <td><p1>客户端开发工程师</p1></td>
                                <td><p1>上海</p1></td>
                            </tr>
                            <tr>
                                <td><p1>欧洲资金渠道合作经理</p1></td>
                                <td><p1>海外</p1></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="modul">
                    <div><!--企业logo-->
                        <a href="#"><img src="/apply/Public/image/首页/u24.png" class="img3"/></a></div>
                    <!--文字内容-->
                    <div class="row">
                        <table  class="table">
                            <tr>
                                <td><p1>数据研发工程师</p1></td>
                                <td><p1>多地</p1></td>
                            </tr>
                            <tr>
                                <td><p1>客户端开发工程师</p1></td>
                                <td><p1>上海</p1></td>
                            </tr>
                            <tr>
                                <td><p1>欧洲资金渠道合作经理</p1></td>
                                <td><p1>海外</p1></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="modul">
                    <div><!--企业logo-->
                        <a href="#"><img src="/apply/Public/image/首页/u24.png" class="img3"/></a></div>
                    <!--文字内容-->
                    <div class="row">
                        <table  class="table">
                            <tr>
                                <td><p1>数据研发工程师</p1></td>
                                <td><p1>多地</p1></td>
                            </tr>
                            <tr>
                                <td><p1>客户端开发工程师</p1></td>
                                <td><p1>上海</p1></td>
                            </tr>
                            <tr>
                                <td><p1>欧洲资金渠道合作经理</p1></td>
                                <td><p1>海外</p1></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blockline">
        <div>.</div>
    </div>
</div>
<blockquote class="Ltitle">
    <p>知名企业</p>
</blockquote>
<!--企业列表内容-->
<div class="main">
    <div class="container home-container">
        <div class="title"></div>
        <div class="row">

            <div class="col-sm-6 col-md-3">
                <div class="modul">
                    <div><!--企业logo-->
                        <a href="#"><img src="/apply/Public/image/首页/u24.png" class="img3"/></a></div>
                    <!--文字内容-->
                    <div class="row">
                        <table class="table">
                            <tr>
                                <td><p1>数据研发工程师</p1></td>
                                <td><p1>多地</p1></td>
                            </tr>
                            <tr>
                                <td><p1>客户端开发工程师</p1></td>
                                <td><p1>上海</p1></td>
                            </tr>
                            <tr>
                                <td><p1>欧洲资金渠道合作经理</p1></td>
                                <td><p1>海外</p1></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="modul">
                    <div><!--企业logo-->
                        <a href="#"><img src="/apply/Public/image/首页/u24.png" class="img3"/></a></div>
                    <!--文字内容-->
                    <div class="row">
                        <table  class="table">
                            <tr>
                                <td><p1>数据研发工程师</p1></td>
                                <td><p1>多地</p1></td>
                            </tr>
                            <tr>
                                <td><p1>客户端开发工程师</p1></td>
                                <td><p1>上海</p1></td>
                            </tr>
                            <tr>
                                <td><p1>欧洲资金渠道合作经理</p1></td>
                                <td><p1>海外</p1></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="modul">
                    <div><!--企业logo-->
                        <a href="#"><img src="/apply/Public/image/首页/u24.png" class="img3"/></a></div>
                    <!--文字内容-->
                    <div class="row">
                        <table  class="table">
                            <tr>
                                <td><p1>数据研发工程师</p1></td>
                                <td><p1>多地</p1></td>
                            </tr>
                            <tr>
                                <td><p1>客户端开发工程师</p1></td>
                                <td><p1>上海</p1></td>
                            </tr>
                            <tr>
                                <td><p1>欧洲资金渠道合作经理</p1></td>
                                <td><p1>海外</p1></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="modul">
                    <div><!--企业logo-->
                        <a href="#"><img src="/apply/Public/image/首页/u24.png" class="img3"/></a></div>
                    <!--文字内容-->
                    <div class="row">
                        <table  class="table">
                            <tr>
                                <td><p1>数据研发工程师</p1></td>
                                <td><p1>多地</p1></td>
                            </tr>
                            <tr>
                                <td><p1>客户端开发工程师</p1></td>
                                <td><p1>上海</p1></td>
                            </tr>
                            <tr>
                                <td><p1>欧洲资金渠道合作经理</p1></td>
                                <td><p1>海外</p1></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="blockline">
    <div>.</div>
</div>
<div class="kong">
    .
</div>
<div class="blockline2">
    <center><div >.</div></center>
</div>

<div class="footter hidden-xs">

    <div class="footterword">

            <strong><font size="5">简介</font></strong>
            <div>北京十三行</div>
            <div>产品服务</div>
            <div>创新优势</div>
            <div>联系我们</div>
    </div>
    <div class="standline">.</div>
    <div class="footterword">

        <strong><font size="5">简介</font></strong>
        <div>北京十三行</div>
        <div>产品服务</div>
        <div>创新优势</div>
        <div>联系我们</div>
    </div>
    <div class="standline">.</div>
    <div class="footterword">

        <strong><font size="5">简介</font></strong>
        <div>北京十三行</div>
        <div>产品服务</div>
        <div>创新优势</div>
        <div>联系我们</div>
    </div>
    <div class="standline">.</div>
    <div class="footterword">

        <button type="button" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Star
        </button>
        <div>联系我们</div>
        <div>合作咨询</div>
    </div>

</div>
<div class="copyright">
    <div>京ICP备09083200号　京ICP证070419号　人才服务许可证：RC0280　京公网安备11010802012824</div>
        <div>Copyright©2015 trading13.com All Rights Reserved</div>
</div>

<div class="home-zhuce">
<div class="modal fade" id="modal-zhuce">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">新用户注册</h4>
      </div>
      <div class="modal-body">
       
      
  <div class="form-group1">
    <label class="control-label">邮箱：</label>
  <input type="text"  placeholder="请输入您的邮箱">
  </div>
        <div class="form-group1">
    <label class="control-label">密码：</label>
  <input type="password" onKeyUp="CheckIntensity(this.value)"  placeholder="请输入您的密码">        
<table width="174" border="0" cellpadding="0" cellspacing="0" style="margin-left:46px;margin-top:10px;"> 
  <tr align="center"> 
    <td id="pwd_Weak" class="pwd pwd_c">&nbsp;</td> 
    <td id="pwd_Medium" class="pwd pwd_c pwd_f">无</td> 
    <td id="pwd_Strong" class="pwd pwd_c pwd_c_r">&nbsp;</td> 
  </tr> 
</table> 
       </div>
         <div class="form-group2">
    <label class="control-label">确认密码：</label>
  <input type="text"  placeholder="请确认您的密码">
       </div>
         <div class="form-group3">
         <label class="control-label">验证码：</label>
          <input type="text" >
       </div>
              
  </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-warning">确认注册</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!--./home-zhuce-->
</body>
</html>