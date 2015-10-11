<?php if (!defined('THINK_PATH')) exit();?>  <!--  袁路非 2015.4.3 -->
  <!DOCTYPE html>
  <html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>站内信</title>
    <link href="/apply/Public/css/bootstrap.min.css" rel="stylesheet">
    <script src="/apply/Public/js/jquery-2.1.3.js"></script>
    <script src="/apply/Public/js/bootstrap.min.js"></script>
    <style>
    .navimg1{
     width:30PX;
     height:35px;
     margin-top:-5px;
   }
   .navimg2{
    width:30PX;
    height:20px;
    margin-right:10px;
  }		
  .nav-search{
   width:200px;
   position:absolute;
   top:10px;
   left:65px;
 }			
 body{
   padding-top: 70px;
 }
 #sixin-all{
   width:60%;
 }
 #sixin-title{
   font-size:25px;
   font-weight:100;
   margin:10px;				
 }
 .sixin-write{
   margin-left:70%;
   margin-top:-35px;
 }

 .sixin-ul {

   overflow:hidden;
   list-style:none;
 }
 .sixin-img{
   width:55PX;
   height:55px;
   float:left;
   margin-right:5px;
 }

 .sixin-face{
   width:50PX;
   height:50px;
 }
 .sixin-towho{
   float:left;
   font-weight: bold;
   font-size: 100%;
 }
 .sixin-detail{
   font-weight: bold;
   font-size: 100%;
 }
 .sixin-time{
   font-size:90%;
   color:#666;
   margin-top:10px;
 }
 .copyright{
   padding-top:20px;
 }		
 </style>
</head>
<body>
 <nav class="navbar  navbar-fixed-top navbar-inverse " role="navigation">
  <div class="container">
   <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"><img class="navimg1" alt="Brand" src="/apply/Public/image/站内信/u42.png"></a>
    <div class="visible-xs nav-search">  
      <input type="text" class="form-control" placeholder="请输入职位关键字">          
    </div>  <!-- ./nav-search-->  
  </div>

  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav ">

      <li><a href="HOME.html">首页 <span class="sr-only">(current)</span></a></li>
      
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">找职位<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="找职位.html">搜寻职位</a></li>
          <li class="divider"></li>
          <li><a href="职位管理.htm">职位管理</a></li>

        </ul>
      </li><!-- dropdown ！-->

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">人脉圈<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="海外校友.html">海外校友</a></li>
          <li class="divider"></li>
          <li><a href="我的人脉.htm">人脉圈</a></li>

        </ul>
      </li><!-- dropdown ！-->

      <li><a href="知名企业.html">知名企业</a></li>
      <li><a href="#">视频面试</a></li>
      <li><a href="海归路上.html">海归路上</a></li>


             <!--    
               <form class="navbar-form navbar-left" role="search">
             <div class="form-group">  
              <input type="text" class="form-control" placeholder="Search">
            </div>
             </form>
             !-->

           </ul>
           <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo U('WebShow/indi_webNews_show_all');?>"><img class="navimg2" alt="Brand" src="/apply/Public/image/站内信/1_u297.png"></a></li>
            <li><a href="个人界面首页.htm"><img class="navimg2" alt="Brand" src="/apply/Public/image/站内信/2_u299.png"></a></li>
            <li><a href="#">加入收藏</a></li>
          </ul>

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>


    <div class="container" id="sixin-all"> 


      <div class="row">

        <h2 class="panel-title col-md-3" id="sixin-title">我的私信</h2>
        <div class="sixin-write">
          <button type="button"  class="btn btn-primary col-md-6">写私信</button>
        </div>
      </div><!-- ./row-->
      <hr>

      <?php if(is_array($result)): foreach($result as $key=>$item): ?><div class="sixin-duihua">
         <ul class="sixin-ul">
          <div class="row">  
            <li class="col-md-2 sixin-img">   
              <div class="img"><img class="sixin-face" src="/apply/Public/image/我的人脉/u231.jpg" /></div>
            </li>
            <li class="col-md-8 sixin-1">
              <div  class="sixin-towho"><a>我</a> 发送给 <a><?php echo ($item["messagetoid"]); ?></a>:</div>
              <div class="sixin-details"><?php echo ($item["messagecontent"]); ?></div>
              <div class="row">      
                <span  class="sixin-time col-md-3" ><?php echo ($item["messagesendtime"]); ?></span>  
                <div class="col-md-4">
                </div>         
                <div class="col-md-5">
                 <a  href="<?php echo U('WebShow/indi_webNews_show_detail');?>">共7条对话</a>
                 <span>|</span>
                 <a  href="<?php echo U('WebShow/indi_webNews_show_detail');?>">回复</a>
                 <span>|</span>
                 <a>删除</a> 
               </div>
             </div>                                 
           </li>                                     
         </div><!--./row --> 
       </ul>
       <hr>      
     </div><!-- ./sixin-duihua--><?php endforeach; endif; ?>










   
 </div><!-- ./ sixin-all -->  

 <div class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
       <center>
        <span>京ICP09083200号</span>     
        <span>京ICP证070419号</span>   
        <span>人才服务许可证：RC0280</span>  
        <span>京公网安备11010802012824</span> 
      </center>
    </div>

    <div class="col-sm-12">
     <center>
      <span>Copyright©2015 trading13.com All Rights Reserved</span>         
    </center>
  </div>
</div>
</div>
</div><!-- copyright!-->



</body>
</html>