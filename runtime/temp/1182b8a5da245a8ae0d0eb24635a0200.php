<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/home/wwwroot/aishan.clwub.xin/public/../application/admin/view/user/rol.html";i:1519803342;}*/ ?>
<!DOCTYPE html>
<!-- saved from url=(0062)http://www.17sucai.com/preview/642854/2016-10-29/2/inbox.html# -->
<html style="overflow: hidden;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>角色管理</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="keywords" content="">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="/static/css1/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- Custom CSS -->
<link href="/static/css1/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/static/css1/morris.css" type="text/css">
<!-- Graph CSS -->
<link href="/static/css1/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="/static/js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href="/static/css1/css" rel="stylesheet" type="text/css">
<link href="/static/css1/css(1)" rel="stylesheet" type="text/css">
<!-- lined-icons -->
<link rel="stylesheet" href="/static/css1/icon-font.min.css" type="text/css">
<script type="text/javascript" src="/static/js/jquery-1.11.3.min.js"></script>
<!-- //lined-icons -->
</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	  <div class="mother-grid-inner">
             <!--header start here-->
				<div class="header-main fixed">
					<div class="logo-w3-agile">
								<h1><a href="/admin/user/index">首页展示</a></h1>
							</div>
					
						 <div class="w3layouts-right" style="margin-left:100px;margin-top: 5px">
							<div class="profile_details_left"><!--notifications of menu start -->
								<ul class="nofitications-dropdown">
									<li class="dropdown head-dpdn">
										
										<ul class="dropdown-menu">
											
											
											
										</ul>
									</li>
									
									<li class="dropdown head-dpdn">奔跑吧！青春</li>
									
									<div class="clearfix"> </div>

								</ul>
								<div class="clearfix"> </div>
							</div>
							</div>
							<!--notification menu end -->
							
							<div class="clearfix"> </div>				
						</div>
						<div class="profile_details w3l" style="float:right;margin-top:-85px;margin-right: 10px">	

								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="/static/images/in4.jpg" alt=""> </span> 
												<div class="user-name">
													
													<span>管理员</span>
												</div>
												<i class="fa fa-angle-down"></i>
												<i class="fa fa-angle-up"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											
											<li> <a href="logout"><i class="fa fa-sign-out"></i>Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							
				     <div class="clearfix"> </div>	
				</div>
				

<!--heder end here-->

	<ol class="breadcrumb">
                 <ol class="breadcrumb">
          <li><a data-toggle="modal" data-target="#addUser">增加权限</a></li>
        </ol>
            </ol>

	
<!-- tab content -->
	<div class="container">
 <div  id="main" style="margin-left: -20px; width:1000px;height:2000px;">
    
        <ol class="breadcrumb">
          <li><a data-toggle="modal" data-target="#addUser">增加角色</a></li>
       
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">角色名</span></th>
                <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">拥有的权限</span></th>
               
                <th><span class="glyphicon glyphicon-pencil"></span> <span class="visible-lg">操作</span></th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($role)): foreach($role as $val): ?>
              <tr>
                <td><?php echo $val['rid']; ?></td>
                <td class="otd" mysign="rid_name"><?php echo $val['rid_name']; ?></td>
               
                
                
                <td >
                            <?php foreach($res2 as $v2): if($v2['rid_name']==$val['rid_name']): ?>
                                    <?php echo $v2['auth_name']; endif; endforeach; ?>
                        </td>
                        <td>
                  <a rel="1" name="delete" class="hrdel">删除</a>
                  <a rel="1" href="/admin/user/upper?id=<?php echo $val['rid']; ?>" name="update" class="hrupdate">修改权限</a>
                </td>
              </tr>
              <?php endforeach; endif; ?>
            </tbody>
          </table>
        </div>
    </div>
            
                </div>
     <script src="/static/js/layui.js" charset="utf-8"></script>
     <script src="/static/js/x-layui.js" charset="utf-8"></script>
   <!--   //增加弹窗 -->
     <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
  <div class="modal-dialog" role="document" style="max-width:650px;">
    <form action="/admin/user/ad" method="post" autocomplete="off" draggable="false">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" >增加角色</h4>
        </div>
        <div class="modal-body">
          <table class="table" style="margin-bottom:0px;">
            <thead>
              <tr> </tr>
            </thead>
            <tbody>
              <tr>
                <td wdith="20%">角色名:</td>
                <td width="80%"><input name="rname" type="text" class="form-control" placeholder="角色名" name="truename" maxlength="10" autocomplete="off" /></td>
              </tr>
               <tr>
                <td wdith="20%">添加权限:</td>
                <td width="80%">
                  <div class="form-control" id='display'>
                    <div id='open' style="color: #999">点击选择</div>
                      <div id='none' style='display:none'>
                      <?php if(!empty($permission)): foreach($permission as $val): ?>
                        <input type="checkbox" value="<?php echo $val['authid']; ?>" name="per[]" class="form-control" name="truename" maxlength="10" autocomplete="off" /><?php echo $val['auth_name']; ?><br>
                      <?php endforeach; endif; ?>
                    </div>
                  </div>
                </td>
              </tr>
             
            </tbody>
            <tfoot>
              <tr></tr>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          <input id="button" type="submit" class="btn btn-primary" value="提交">
        </div>
      </div>
    </form>
  </div>
</div>
     

		
<!-- 功能 -->
			<script>
$(function () {
  //展开权限
  $("#display").click(function(){
    $(this).removeClass('form-control');
    $("#none").css('display','block');
    $("#open").css('display','none');
  });
  //右侧的删除按钮
  $('.hrdel').on('click',function() {
    //获取到id
    var hrid = $(this).parent().parent().children('td:first-child').text();
    $(this).parent().parent().css('display','none');
    //发送给php
     $.ajax({
          url:'/admin/user/roldel',
          type:'post',
          data:{id:hrid},
        });
  });
   //修改内容，双击生成input
  $('.otd').on('click',function() {
    //获取自定义的属性值
    var mysign = $(this).attr('mysign');
    // alert(mysign);
    var content = $(this).text();
    //判断是否生成input框

    if (!$(this).has('.input').length) {
      // 当td中没有input的时候添加input框
      $(this).html('');
      $("<input class='input' type='text' value="+content+">").appendTo($(this));
      //失去焦点是移除input，获得里面内容给td中
      $('.input').on('mouseout',function() {
        //获取input的内容
        var contents = $(this).val();
        //alert(content);
        //获取id
        var oid = $(this).parent().parent().children("td:first-child").text(); 
       // alert(oid);
        //将input中的新内容发给php
        $.ajax({
          type:'post',
          url:'/admin/user/update',
          data:{
            content:contents,
            id:oid,
            sign:mysign
          }
        });
        //将input中的内容赋值给td
        $(this).parent().text(contents);
      });
    }
  });
});
</script>

                
           
       
        <script src="/static/lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="/static/js/x-layui.js" charset="utf-8">
        </script>
       
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
			
          
       
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
	
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo1">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
					</header>

						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                          <div class="menu">
								<?php foreach($result as $val): if($val['pid']==0): ?>
						<ul id="menu">
										
										
							 <li id="menu-academico">
										
									 <a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i>
									 <span><?php echo $val['auth_name']; ?></span> <span class="fa fa-angle-right" style="float: right"></span></a>
									
										
									 <div class="clearfix"></div>
									
									 <ul id="menu-academico-sub">
											 <?php foreach($re as $v): if($val['authid']==$v['pid']): ?>
										   <li id="menu-academico-avaliacoes"><a href="<?php echo $v['url']; ?>"><?php echo $v['auth_name']; ?></a></li>
										   <?php endif; endforeach; ?>
										 
									</ul>
										
						  	</li>
						</ul>
						 <?php endif; endforeach; ?>
					</div>
								
					<div class="clearfix"></div>		
				</div>
							<script type="text/javascript";>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="/static/js/jquery.nicescroll.js"></script>
<script src="/static/js/scripts.js"></script><div id="ascrail2000" class="nicescroll-rails" style="width: 6px; z-index: 1000; background: rgb(255, 255, 255); cursor: default; position: fixed; top: 0px; height: 100%; right: 0px; opacity: 0;"><div style="position: relative; top: 0px; float: right; width: 6px; height: 224px; background-color: rgb(27, 147, 225); border: 0px; background-clip: padding-box; border-radius: 10px;"></div></div><div id="ascrail2000-hr" class="nicescroll-rails" style="height: 6px; z-index: 1000; background: rgb(255, 255, 255); position: fixed; left: 0px; width: 100%; bottom: 0px; cursor: default; opacity: 0; display: none;"><div style="position: relative; top: 0px; height: 6px; width: 1280px; background-color: rgb(27, 147, 225); border: 0px; background-clip: padding-box; border-radius: 10px;"></div></div>
<!-- Bootstrap Core JavaScript -->
   <script src="/static/js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   


</body></html>