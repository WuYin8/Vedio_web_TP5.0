<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/home/wwwroot/aishan.clwub.xin/public/../application/admin/view/danmu/danmu.html";i:1519741876;}*/ ?>
<!DOCTYPE html>
<!-- saved from url=(0062)http://www.17sucai.com/preview/642854/2016-10-29/2/inbox.html# -->
<html style="overflow: hidden;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>弹幕展示内容</title>
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
                <li class="breadcrumb-item"><a href="">弹幕展示内容</a></li>
            </ol>

	
<!-- tab content -->
	<div class="container">

                <table class="table table-hover" style="font-weight: bold;margin-left:-25px;width: 1010px">
                <thead>
                	<tr>
                		<th></th><th>视频标题</th><th>弹幕ID</th><th>用户名</th><th>弹幕内容</th><th>发送时间</th><th>出现时间（秒）</th><th>弹幕类型</th><th>操作</th>

                	</tr>
                </thead>
		<tbody id="showBox">
  					
		</tbody>
		</table>
		<!-- 分页区 -->
		<div class="pages">
			<a href ="" class="aPage">首页</a>
			<a href ="" class="aPage">前页</a>
			<a href ="" class="aPage">后页</a>
			<a href ="" class="aPage">尾页</a>
		</div>
		<script type="text/javascript">
			$.ajax({
				type:'post',
				url:'/admin/danmu/getDanmu',
				data:null,
				dataType:'json',
				async:true,
				success:getReports
			});
			function getReports(data)
			{
				// 获取数据与分页url
				var pA =document.getElementsByClassName('aPage');
				var obj = JSON.parse(data);
				// 开始弹幕遍历展示
				var sBox = document.getElementById('showBox');
				$(sBox).html('');
				for (var i = 0; i < obj['data'].length; i++) {
					// 添加第一层的tr标签
					var oTr = document.createElement('tr');
					sBox.appendChild(oTr);
					// 添加tr内的td标签
					var str = 
						"<td><input type='checkbox'/></td>" +
						"<td><a href='/index/single/single?vid=" + obj['data'][i]['vid'] + "'>" + obj['data'][i]['title'] + "</a></td>" +
						"<td>" + obj['data'][i]['did'] + "</td>" +
						"<td>" + obj['data'][i]['username'] + "</td>" +
						"<td>" + obj['data'][i]['word'] + "</td>" +
						"<td>" + obj['data'][i]['create_time'] + "</td>" +
						"<td>" + obj['data'][i]['time'] + "</td>" +
						"<td>" + obj['data'][i]['action'] + "</td>" +
						"<td><a href='#' onclick='deletes(" + obj['data'][i]['did'] + ")' class='btn btn-link del' type='button'>删除</a></td>";
					oTr.innerHTML = str;
				}
				// 把allpage的链接赋值到a标签上
				var oPage = obj['page'];
				var i = 0;
				for (var name in oPage) {
					pA[i].href = 'javascript:test(\'' + oPage[name] + '\')';
					i++;
				}
			}
			function test(url)
			{
				$.ajax({
					type:'get',
					url:url,
					async:true,
					data:null,
					dataType:'json',
					success:getReports
				});
			}
		</script>
               	<!-- 完成-分页区 -->
    </div>
			 <script type="text/javascript">
           function deletes(id){

           	if(confirm('确认要删除吗!'))
           	{
           		$.ajax({
           			type:'get',
           			url:'/admin/danmu/delete',
           			data:{did:id},
           			error:error,
           			success:success

           		});
           		// console.log(id);
           		var data = id;
           		function success(data)
           		{
           			console.log(data);
           			
           			$('body').html(data);

           		}
           		function error()
           		{
           			alert('删除失败');
           		}

           	}
           }
            </script>   
          
               




<!-- script-for sticky-nav -->
		<script type="text/javascript">
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
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