<?php if (!defined('THINK_PATH')) exit();?>  <!--  袁路非 2015.4.17  微调-->
  <!DOCTYPE html>
  <html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>职位管理</title>
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
 #jobtab {
   width:80%;
 }
 #handinsubs{
   width:70%
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
      <a class="navbar-brand" href="<?php echo U('WebShow/indi_Home');?>"><img class="navimg1" alt="Brand" src="/apply/Public/image/职位管理/u42.png"></a>
      <div class="visible-xs nav-search">  
        <input type="text" class="form-control" placeholder="请输入职位关键字">          
      </div>  <!-- ./nav-search-->  
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav ">

        <li><a href="<?php echo U('WebShow/indi_Home');?>">首页 <span class="sr-only">(current)</span></a></li>

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


             <!--    
               <form class="navbar-form navbar-left" role="search">
             <div class="form-group">  
              <input type="text" class="form-control" placeholder="Search">
            </div>
             </form>
             !-->

           </ul>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo U('WebShow/indi_webNews_show_all');?>"><img class="navimg2" alt="Brand" src="/apply/Public/image/职位管理/1_u297.png"></a></li>
            <li><a href="<?php echo U('WebShow/indi_personalfront');?>"><img class="navimg2" alt="Brand" src="/apply/Public/image/职位管理/2_u299.png"></a></li>
            <li><a href="#">加入收藏</a></li>
          </ul>

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>

    <div class="container" id="jobtab">
      <ul class="nav nav-tabs" role="tablist" id="myTab">
        <li role="presentation"><a href="#deliver" aria-controls="deliver" role="tab" data-toggle="tab">我的投递</a></li>
        <li role="presentation"><a href="#favorites" aria-controls="favorites" role="tab" data-toggle="tab">我的收藏</a></li>
        <li role="presentation"><a href="#subscription" aria-controls="subscription" role="tab" data-toggle="tab">订阅器</a></li>

      </ul>

      <div class="tab-content">

        <div role="tabpanel" class="tab-pane fade in active" id="deliver">
         <div class="table-responsive">

           <div class="panel panel-default">
             <div class="panel-body">
               <div class="form-group">
                 <label for="投递" class="col-lg-5 control-label">我投递的职位</label>
               </div><!--/. form !-->
             </div><!-- /.panel-body -->
             <table class="table table-striped table-hover">
              <tr>
                <td>职位信息</td>
                <td>投递信息</td>
                <td>跟踪信息</td>
              </tr>
              <?php if(is_array($deliverlist)): foreach($deliverlist as $key=>$item): ?><tr>
                  <td>
                    <p><?php echo ($item["jobname"]); ?></p>
                    <p><?php echo ($item["companyname"]); ?>|<?php echo ($item["companyaddress"]); ?></p>
                    <p><?php echo ($item["jobindustry"]); ?></p>
                  </td>
                  <td><?php echo ($item["interviewdelivertime"]); ?></td>
                  <td> 
                    <p>面试邀约</p>
                  </td>
                  <td><button class="btn btn-default" type="submit">进入面试</button></td>
                </tr><?php endforeach; endif; ?>

            </table>

          </div> <!-- panel -->  
        </div><!-- table-responsive -->                  
        <nav>
          <div class="container">
            <center>
              <div class="row">

                <div class="col-md-3">
                </div>

                <div class="col-md-3">
                  <ul class="pagination ">
                    <?php echo ($deliverpage); ?>
                  </ul>
                </div><!-- ./col-md-3 -->

              </div><!-- /.row!-->
            </center>
          </div><!--./container -->
        </nav>
      </div><!--deliver-->


      <div role="tabpanel" class="tab-pane fade in" id="favorites">
        <div class="table-responsive">
          <div class="panel panel-default">
           <div class="panel-body">
             <div class="form-group">
               <label for="收藏" class="col-lg-5 control-label">我收藏的职位</label>
             </div><!--/. form !-->
           </div><!-- /.panel-body -->
           <table class="table table-striped table-hover">

            <tr>
              <td>职位名称</td>
              <td>所属企业</td>
              <td>所属行业</td>
              <td>工作地点</td>
              <td>收藏时间</td>
              <td>职位动态</td>
            </tr>

            <?php if(is_array($collectlist)): foreach($collectlist as $key=>$item): ?><tr>
                <td><?php echo ($item["jobname"]); ?></td>
                <td><?php echo ($item["companyname"]); ?></td>
                <td><?php echo ($item["jobindustry"]); ?></td>
                <td><?php echo ($item["companyaddress"]); ?></td>
                <td><?php echo ($item["createtime"]); ?></td>
                <td><?php echo ($item["jobstatus"]); ?></td>
              </tr><?php endforeach; endif; ?>
          </table>

        </div> <!-- panel -->  
      </div><!-- table-responsive -->
      <nav>
          <div class="container">
            <center>
              <div class="row">

                <div class="col-md-3">
                </div>

                <div class="col-md-3">
                  <ul class="pagination ">
                    <?php echo ($collectpage); ?>
                  </ul>
                </div><!-- ./col-md-3 -->

              </div><!-- /.row!-->
            </center>
          </div><!--./container -->
        </nav>
    </div><!-- favorites!-->


    <div role="tabpanel" class="tab-pane fade in" id="subscription">
      <div class="table-responsive">
        <div class="panel panel-default">
         <div class="panel-body">
           <div class="form-group">
             <label for="订阅" class="col-lg-5 control-label">我订阅的职位</label>
           </div><!--/. form !-->
         </div><!-- /.panel-body -->
         <table class="table table-bordered table-condensed table-hover">

          <tr>
            <td>订阅名称</td>
            <td>邮件接收频率</td>
            <td>职位订阅量</td>
            <td>接收邮箱</td>
            <td>创建时间</td>
            <td>操作</td>
          </tr>

          <tr>
            <td>
              我的订阅器1
            </td>
            <td>每周一次</td>
            <td>5</td>
            <td>mail@trading13.com</td>
            <td>2015-01-13</td>
            <td>修改  删除</td>
          </tr>


        </table>
      </div> <!-- panel -->  
    </div><!-- table-responsive -->

    <div class="jumbotron" id="handinsubs">
      <h4>新建职位订阅(还可新建<a id="numsubs">4</a>个)</h4>
      <form>
        <div class="form-group row">
          <label for="订阅器名" class="col-md-2 control-label">订阅器名:</label>   
          <div class="col-md-3">
            <input type="text" class="form-control" name="subscribeName" placeholder="">
          </div>
          <div class="col-md-7"></div>
        </div>

        <div class="form-group row">
          <label for="行业分类" class="col-md-2 control-label">行业分类:</label>  
          <div class="col-md-5">
            <input type="text" class="form-control" name="industrySort" placeholder="">
          </div>
          <div class="col-md-5"></div>
        </div>

        <div class="form-group row">
          <label for="职能分类" class="col-md-2 control-label">职能分类:</label>  
          <div class="col-md-5">
            <input type="text" class="form-control" name="jobSort" placeholder="">
          </div>
          <div class="col-md-5"></div>
        </div>

        <div class="form-group row">
          <label for="工作地点" class="col-md-2 control-label">工作地点:</label>  
          <div class="col-md-5">
            <input type="text" class="form-control" name="jobPlace" placeholder="">
          </div>
          <div class="col-md-5"></div>
        </div>

        <div class="form-group row">
          <label for="年薪范围" class="col-md-2 control-label">年薪范围:</label>  
          <div class="col-md-3">
            <select class="form-control">
              <option>5万以下</option>
              <option>5万-10万</option>
              <option>10万-20万</option>
              <option>20万以上</option>
            </select>
          </div>
          <div class="col-md-4"></div>
        </div>

        <div class="form-group row">
          <label for="关键字" class="col-md-2 control-label">关键字:</label>  
          <div class="col-md-3">
            <input type="text" class="form-control" name="keyWord" placeholder="">
          </div>
          <div class="col-md-7"></div>
        </div>

        <div class="form-group row">
          <label for="接收邮箱" class="col-md-2 control-label">接收邮箱:</label>  
          <a class="col-md-3">mail@trading13.com</a>
          <div class="col-md-7"></div>
        </div>

      </form>

      <p><center><a class="btn btn-primary btn-lg" href="<?php echo U('WebShow/indi_subscribe');?>" role="button">提交订阅</a></center></p>

    </div><!-- /.jumbotron !-->


  </div><!-- subscription-->


</div><!--tab-content-->
</div><!-- ./container-->


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