<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/home/wwwroot/aishan.clwub.xin/public/../application/index/view/index/index.html";i:1519741880;s:69:"/home/wwwroot/aishan.clwub.xin/application/index/view/layoutShow.html";i:1519797653;}*/ ?>
<!-- 
	本模板页为视频展示页面所使用
	模板本身包含顶栏（搜索，注册登录）、侧边栏（菜单目录）和底栏（网站信息）
	引用模板时需要补充的部分为中部的展示内容
	简单格式为<div class="main-grids"></div>在此div中添加，class名称满足bootstrap要求

	需要修改的问题：
	1. 根据url在菜单栏上对不同的栏目高亮显示（目前只高亮了主页），可能运用到无限极分类
	2. 判断登录状态以更改登录注册栏（在登录注册栏中直接写判断语句，要修改模板内容）
 -->

<!DOCTYPE HTML>
<html>
<head>
<title>首页-爱闪视频网</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="My Play Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' media="all" />
<!-- //bootstrap -->
<link href="css/dashboard.css" rel="stylesheet">
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' media="all" />
<script src="js/jquery-1.11.1.min.js"></script>
<!--start-smoth-scrolling-->
<style type="text/css" media="screen">
	.btnTop3 {
		font-size: 20px;
		width: 120px;
		height: 30px;
		line-height: 30px;
		border: 0;
		background-color: white;
		outline: none;
	}
	.choice {
		font-size: 25px;
		font-weight: bolder;
		width: 130px;
		height: 40px;
		line-height: 30px;
		border-bottom: 3px solid #ED62ED;
		color:#ED62ED ;
		background-color: white;
	}
	.boxTop3 {
		display: none;
		margin-top: 10px;
	}	
	.show {
		display: block;
	}
	.recommended-info {
		margin-bottom: 10px;
	}
	.recommended-info span a{
		color: #ED62ED;
		text-decoration: none;
		font-size: 16px;
	}
	.recommended-info span a:hover{
		color: #CDCDCD;
		text-decoration: none;
	}
	#getCode {
		border: 0;
		line-height: 38px;
		text-align: center;
		background-color: #ED62ED;
		color: white;
		padding: 0 1em;
		font-size: 16px;
	}
</style>
</head>
  <body>
<!-- 顶栏 -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header" style="margin-left: 15px;">
          <a class="navbar-brand" href="/index"><h1><img src="images/logo.gif" height="49px" alt="" /></h1></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
		<div class="top-search">
			<form class="navbar-form navbar-right" method="post" action="/index/search/search">
				<input type="text" class="form-control" name="sWord" placeholder="想看什么...">
				<input type="submit" value=" ">
			</form>
		</div>
		<div class="header-top-right">
			<!-- 运用模板引擎，判断session传值后，展示用户信息 -->
			 <?php if(!empty(\think\Session::get('id'))): ?>
			 	<div class="file1" style="height: 100%; line-height: 50px; float:left;">
					<a href="/index/user/index?userID=<?php echo \think\Session::get('id'); ?>"><img style="height: 50px; float: left;" src="<?php echo \think\Session::get('photo'); ?>" title="点击进入个人中心"/></a>
					<div style="float:left; height: 50px;">
						<span style="float: left; height: 25px; width: 100%; line-height: 25px; text-align: center;"><b><?php echo \think\Session::get('username'); ?></b></span>
						<span style="float: left; height: 25px; width: 100%; line-height: 25px; text-align: center;"><?php echo \think\Session::get('grade'); ?></span>
					</div>
				</div>	
	                     <?php endif; ?>
			<!-- 完成-用户信息展示-->
			<!-- 上传按钮 -->
			<div class="file">
				<a href="/index/Upload/upload">上传</a>
			</div>	
			<!-- 若不存在session值，则显示登录注册 -->
			 <?php if(empty(\think\Session::get('id'))): ?>
			<!-- 注册按钮及界面 -->
			<div class="signin">
				<a href="#small-dialog3" class="play-icon popup-with-zoom-anim">注册</a>
					<!-- 弹出的注册界面 -->
					<script type="text/javascript" src="js/modernizr.custom.min.js"></script>    
					<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
					<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
					<div id="small-dialog3" class="mfp-hide">
						<h3>注册账号</h3> 
						<div class="social-sits">
						<p style="font-size: 16px; font-weight: bolder;"><a href="#small-dialog" class="play-icon popup-with-zoom-anim" id="goToLog">第三方快速登录点这里</a></p>
							<div class="button-bottom">
								<p><small>第三方登录用户的权限被限制：<br />
								1. 限制发布视频的权限<br />
								2. 限制管理个人资料的权限<br />
								注册爱闪视频网的账号即可解除权限的限制</small></p>
								<p>已有注册账号?  点击这里<a href="#small-dialog" class="play-icon popup-with-zoom-anim" id="goToLog">登录</a></p>
							</div>
						</div>
						<div class="signup">
							<form>
								<input type="text" class="email" id="inputUname" placeholder="用户名" title="输入用户名" />
								<br /><span class="register" id="spanUname"></span>
								<input type="password" class="password" id="inputPwd" placeholder="密码" title="密码不得小于6位" autocomplete="off" />
								<br /><span class="register" id="spanPwd"><br /></span>
								<input type="password" class="password2" id="inputPwd2" placeholder="再次输入密码" title="两次输入密码应相同" autocomplete="off" />
								<br /><span class="register" id="spanPwd2"><br /></span>
								<input type="text" class="email" id="inputEmail" placeholder="常用邮箱" title="输入可用邮箱地址"/>
								<br /><span class="register" id="spanEmail"><br /></span>
								<input type="text" class="email" id="inputPhone" placeholder="手机号码" maxlength="11" title="输入常用手机号" />
								<br /><span class="register" id="spanPhone"><br /></span>
								<input type="text" class="phoneCode" id="inputCode" placeholder="手机验证码" title= "输入短信验证码"/>
								<button id="getCode" >获取验证码</button>
								<br /><span class="register" id="spanCode"><br /></span>
								<input type="submit" class="registerBtn" id="registerBtn" value="注册" style="font-weight: bolder;" />
							</form>
						</div>
						<div class="clearfix"> </div>
					</div>	
					<!-- 完成-弹出的注册界面 -->
					<script>
							$('.register').css({
								'color': 'red',
								'display': 'none'
							});
							$(document).ready(function() {
								$('.popup-with-zoom-anim').magnificPopup({
									type: 'inline',
									fixedContentPos: false,
									fixedBgPos: true,
									overflowY: 'auto',
									closeBtnInside: true,
									preloader: false,
									midClick: true,
									removalDelay: 300,
									mainClass: 'my-mfp-zoom-in'
								});				
							});
							// 获取验证码
							var i = 60;
							var flagCode = true;
							$('#getCode').on('click' , function() {
								inputPhone = $('#inputPhone').val();
								// 手机号格式判断
								reg1 = /^[1][3,4,5,7,8][0-9]{9}$/;
								if (reg1.test(inputPhone)) {
									$('#spanPhone').html('');
									$('#spanPhone').css('display', 'none');
								} else {
									$('#spanPhone').html('手机号格式不正确');
									$('#spanPhone').css('display', 'block');
									return false;
								}
								$.ajax({
									type:'get',
									url:'/index/index/Code',
									dataType:'json',
									data:{
										phone:inputPhone,
									},
									async:true,
									success:success
								})
								if (flagCode) {
									flagCode = false;
									var timer = setInterval( function () {
										$('#getCode').html( i + '秒后重新发送');
										i--;
										if (i <= 0) {
											clearInterval(timer);
											$('#getCode').html( '获取验证码');
											i = 60;
											flagCode = true;
										}
									} , 1000);
								}
								function success(data){
									console.log(data);
								};
								return false;
							});
							// 前台判断格式，所有需要后台的判断留在点击注册这个动作上
							$('#registerBtn').on('click', function() {
								// 注册信息，格式判断
								inputUname = $('#inputUname').val();
								inputPwd = $('#inputPwd').val();
								inputPwd2 = $('#inputPwd2').val();
								inputEmail = $('#inputEmail').val();
								inputPhone = $('#inputPhone').val();
								inputCode = $('#inputCode').val();
								flag = false;
								// 用户名格式判断
								if (inputUname.length == 0) {
									$('#spanUname').html('用户名不得为空');
									$('#spanUname').css('display', 'block');
									flag = false;
								} else {
									$('#spanUname').html('');
									$('#spanUname').css('display', 'none');
								}
								// 密码格式判断
								if (inputPwd.length < 6) {
									$('#spanPwd').html('密码长度不得小于6位');
									$('#spanPwd').css('display', 'block');
									flag = false;
								} else {
									$('#spanPwd').html('');
									$('#spanPwd').css('display', 'none');
								}
								// 二次密码格式判断
								if (inputPwd2 !== inputPwd) {
									$('#spanPwd2').html('两次输入密码不相同');
									$('#spanPwd2').css('display', 'block');
									flag = false;
								} else {
									$('#spanPwd2').html('');
									$('#spanPwd2').css('display', 'none');
								}
								// 邮箱格式判断
								reg = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
								if (reg.test(inputEmail)) {
									$('#spanEmail').html('');
									$('#spanEmail').css('display', 'none');
								} else {
									$('#spanEmail').html('邮箱格式不正确');
									$('#spanEmail').css('display', 'block');
									flag = false;
								}
								// 手机号格式判断
								reg1 = /^[1][3,4,5,7,8][0-9]{9}$/;
								if (reg1.test(inputPhone)) {
									$('#spanPhone').html('');
									$('#spanPhone').css('display', 'none');
								} else {
									$('#spanPhone').html('手机号格式不正确');
									$('#spanPhone').css('display', 'block');
									flag = false;
								}
								// 判断验证码格式
								if (inputCode.length == 0) {
									$('#spanCode').html('手机验证码不得为空');
									$('#spanCode').css('display', 'block');
									flag = false;
								} else {
									$('#spanCode').html('');
									$('#spanCode').css('display', 'none');
									flag = true;
								}
								// 以上所有格式要求满足后，ajax传参到后台
								if (flag) {
									$.ajax({
										type:'post',
										url:'/index/index/register',
										dataType:'json',
										data:{
											username:inputUname,
											password:inputPwd,
											email:inputEmail,
											phone:inputPhone,
											code:inputCode,
										},
										async:true,
										success:success1
									})
									function success1(data)
									{
										// console.log(data);
										var obj = JSON.parse(data);
										if (obj['msg'] == 'noC') {
											alert('未获取验证码');
											return false;
										} else if (obj['msg'] == 'haveN') {
											alert('用户名已注册');
											return false;
										}else if (obj['msg'] == 'haveE') {
											alert('邮箱已注册');
											return false;
										} else if (obj['msg'] == 'haveP') {
											alert('手机号已注册');
											return false;
										} else if (obj['msg'] == 'wrongC') {
											alert('验证码不正确');
											return false;
										} else if (obj['msg'] == 'bad') {
											alert('注册失败，请联系管理员或重试');
											$('#goToLog').click();
										}  else if (obj['msg'] == 'great') {
											alert('注册成功,马上去登录');
											$('#goToLog').click();
										} 
									}
								}
								return false;
							});
					</script>
			</div>
			<!-- 完成-注册按钮及界面 -->
			<!-- 登录按钮及界面 -->
			<div class="signin">
				<a href="#small-dialog" class="play-icon popup-with-zoom-anim">登录</a>
				<!-- 弹出的登录界面 -->
				<div id="small-dialog" class="mfp-hide">
					<h3>登录账号</h3> 
						<div class="social-sits">
						<span style="font-size: 16px; font-weight: bolder;">第三方快速登录</span>
						
							<div class="button-bottom">
						<div style="margin-bottom: 20px;">
							<script type="text/javascript" src="http://open.51094.com/user/myscript/15a745a263b141.html"></script>
							<span id="hzy_fast_login"></span>
						</div>
								<p><small>第三方登录用户的权限被限制：<br />
								1. 限制发布视频的权限<br />
								2. 限制管理个人资料的权限<br />
								注册爱闪视频网的账号即可解除权限的限制</small></p>
								<p>还没有账号?  点击这里<a href="#small-dialog3" class="play-icon popup-with-zoom-anim">注册</a></p>
							</div>
						</div>
					<div class="signup">
						<form>
							<input type="text" class="email" id="loginName" placeholder="用户名" title="输入用户名" />
							<br /><span class="register" id="spanLname"></span>
							<input type="password" placeholder="密码" id="loginPwd" title="输入密码" autocomplete="off" />
							<br /><span class="register" id="spanLpwd"></span>
							<input type="submit" class="loginBtn" id="loginBtn"  value="登录"/>
						</form>
						<div class="forgot">
							<a href="/index/mail/mail" class="mail">忘记密码 ?</a>
							<script type="text/javascript">
								$('.mail').on('click', function() {
									if ('<?php echo \think\Session::get('id'); ?>'.length > 0) {
										alert('当前处于登录状态，请进入个人资料进行修改');
										return false;
									}
								});
							</script>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<!-- 完成-弹出的登录界面 -->
				<script>
					$('.register').css({
						'color': 'red',
						'display': 'none'
					});

					// 前台判断格式，所有需要后台的判断留在点击注册这个动作上
					$('#loginBtn').on('click', function() {
						// 注册信息，格式判断
						loginName = $('#loginName').val();
						loginPwd = $('#loginPwd').val();
						flag = false;
						// 用户名格式判断
						if (loginName.length == 0) {
							$('#spanLname').html('用户名不得为空');
							$('#spanLname').css('display', 'block');
							flag = false;
						} else {
							$('#spanLname').html('');
							$('#spanLname').css('display', 'none');
							flag = true;
						}
						// 密码格式判断
						if (loginPwd.length < 6) {
							$('#spanLpwd').html('密码长度不得小于6位');
							$('#spanLpwd').css('display', 'block');
							flag = false;
						} else {
							$('#spanLpwd').html('');
							$('#spanLpwd').css('display', 'none');
							flag = true;
						}
						if (flag) {
							$.ajax({
								type:'post',
								url:'/index/index/login',
								dataType:'json',
								data:{
									username:loginName,
									password:loginPwd,
								},
								async:true,
								success:success2
							})
							function success2(data)
							{
								var obj = JSON.parse(data);
								if (obj['msg'] == 'noN') {
									alert('用户名不存在');
									return false;
								} else if (obj['msg'] == 'wrongP') {
									alert('密码不正确');
									return false;
								} else if (obj['msg'] == 'shit') {
									alert('账户已被拉黑，请联系管理员');
									$(location).prop('href', '/index');
								}  else if (obj['msg'] == 'great') {
									alert('登录成功，返回首页');
									window.location.reload();
								} 
							}
						}
						return false;
					});
				</script>
			</div>
			<!-- 完成-登录按钮及界面 -->
			<?php else: ?>
			<!-- 若存在session值，显示退出 -->
			<div class="file" style="margin-left: 20px;">
				<a href="#" id="logoutBtn">登出</a>
			</div>
			<script type="text/javascript">
				$('#logoutBtn').on('click', function() {
					alert('账号登出完成');
					$.ajax({
						type:'post',
						url:'/index/index/logout',
						dataType:'json',
						data:{},
						async:true
					})
					window.location.reload();
					return false;
				});
			</script>
			<?php endif; ?>
			<div class="clearfix"> </div>
		</div>
        </div>
		<div class="clearfix"> </div>
      </div>
    </nav>
<!-- 完成-顶栏 -->
<!-- 侧面菜单栏 下拉内容等待遍历完成 -->
        <div class="col-sm-3 col-md-2 sidebar">
		<div class="drop-navigation drop-navigation">
		  <ul class="nav nav-sidebar">
		  	<li>&nbsp;</li>
			<li><a href="/index" class="home-icon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>首页</a></li>
			<?php if(!empty(\think\Session::get('id'))): ?>
			<li><a href="/index/user/showMsg" class="sub-icon"><span class="glyphicon glyphicon-home glyphicon-hourglass" aria-hidden="true"></span>个人留言板</a></li>
			<?php endif; foreach($bigClass as $bigValue): ?>
			<li><a href="#" class="menu<?php echo $bigValue['id']; ?>"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><?php echo $bigValue['name']; ?><span id="spanMdown1" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></a>
				<ul class="cl-effect cl-effect-<?php echo $bigValue['id']; ?>">
					<?php foreach($smallClass as $smallValue): if($smallValue['pid'] == $bigValue['id']): ?>
					<li><a href="/index/index/class?cid=<?php echo $smallValue['id']; ?>"><?php echo $smallValue['name']; ?></a></li>                
					<?php endif; endforeach; ?>
				</ul></li>
				<!-- script-for-menu -->
				<script>
					$( "li a.menu<?php echo $bigValue['id']; ?>" ).click(function() {
						$( "ul.cl-effect-<?php echo $bigValue['id']; ?>" ).slideToggle( 300);
					});
				</script>
			<?php endforeach; ?>
			<li><a href="/index/msg/msg" class="news-icon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>站内公告</a></li>
		  </ul>
		  <!-- script-for-menu -->
				<script>
					$( ".top-navigation" ).click(function() {
					$( ".drop-navigation" ).slideToggle( 300, function() {
					// Animation complete.
					});
					});
				</script>
		</div>
        </div>
<!-- 完成-侧边菜单栏 -->

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		
		
	<!-- 视频展示页面 -->
	<div class="main-grids">
		<!-- 排行榜 -->
		<div class="top-grids">
			<div class="recommended-info">
				<button class="btnTop3 choice">新晋TOP3</button>
				<button class="btnTop3">优选TOP3</button>
				<button class="btnTop3">热榜TOP3</button>
			</div>
			<!-- 排行榜视频第一批展示-需要遍历 -->
			<div class="boxTop3 show">
				<?php foreach($noTime as $vTime): ?>
				<div class="col-md-4 resent-grid recommended-grid slider-top-grids">
					<div class="resent-grid-img recommended-grid-img">
						<a href="/index/single/single?vid=<?php echo $vTime['id']; ?>"><img src="http://p3d4qx20z.bkt.clouddn.com/<?php echo $vTime['pic']; ?>" alt="" style="box-shadow: 2px 2px 2px #C1C1C1;" /></a>
						<div class="clck">
							<span class="glyphicon glyphicon-time" aria-hidden="true"><?php echo $vTime['time_long']; ?></span>
						</div>
					</div>
					<div class="resent-grid-info recommended-grid-info">
						<h3 style="height: 25px;"><a href="/index/single/single?vid=<?php echo $vTime['id']; ?>" class="title title-info"><?php echo $vTime['title']; ?></a></h3>
						<ul>
							<li><p class="author author-info"><a href="" class="author"><?php echo $vTime['up_name']; ?></a></p></li>
							<li class="right-list"><p class="views views-info"><?php echo $vTime['click_num'] / 2; ?>次浏览</p></li>
						</ul>
					</div>
				</div>
				<?php endforeach; ?>
				<div class="clearfix"> </div>
			</div>
			<!-- 排行榜视频第二批展示-需要遍历 -->
			<div class="boxTop3">
				<?php foreach($noLike as $vLike): ?>
				<div class="col-md-4 resent-grid recommended-grid slider-top-grids">
					<div class="resent-grid-img recommended-grid-img">
						<a href="/index/single/single?vid=<?php echo $vLike['id']; ?>"><img src="http://p3d4qx20z.bkt.clouddn.com/<?php echo $vLike['pic']; ?>" alt="" style="box-shadow: 2px 2px 2px #C1C1C1;" /></a>
						<div class="clck">
							<span class="glyphicon glyphicon-time" aria-hidden="true"><?php echo $vLike['time_long']; ?></span>
						</div>
					</div>
					<div class="resent-grid-info recommended-grid-info">
						<h3 style="height: 25px;"><a href="/index/single/single?vid=<?php echo $vLike['id']; ?>" class="title title-info"><?php echo $vLike['title']; ?></a></h3>
						<ul>
							<li><p class="author author-info"><a href="" class="author"><?php echo $vLike['up_name']; ?></a></p></li>
							<li class="right-list"><p class="views views-info"><?php echo $vLike['click_num'] / 2; ?>次浏览</p></li>
						</ul>
					</div>
				</div>
				<?php endforeach; ?>
				<div class="clearfix"> </div>
			</div>
			<!-- 排行榜视频第三批展示-需要遍历 -->
			<div class="boxTop3">
				<?php foreach($noClick as $vClick): ?>
				<div class="col-md-4 resent-grid recommended-grid slider-top-grids">
					<div class="resent-grid-img recommended-grid-img">
						<a href="/index/single/single?vid=<?php echo $vClick['id']; ?>"><img src="http://p3d4qx20z.bkt.clouddn.com/<?php echo $vClick['pic']; ?>" alt="" style="box-shadow: 2px 2px 2px #C1C1C1;" /></a>
						<div class="clck">
							<span class="glyphicon glyphicon-time" aria-hidden="true"><?php echo $vClick['time_long']; ?></span>
						</div>
					</div>
					<div class="resent-grid-info recommended-grid-info">
						<h3 style="height: 25px;"><a href="/index/single/single?vid=<?php echo $vClick['id']; ?>" class="title title-info"><?php echo $vClick['title']; ?></a></h3>
						<ul>
							<li><p class="author author-info"><a href="" class="author"><?php echo $vClick['up_name']; ?></a></p></li>
							<li class="right-list"><p class="views views-info"><?php echo $vClick['click_num'] / 2; ?>次浏览</p></li>
						</ul>
					</div>
				</div>
				<?php endforeach; ?>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- 排行榜的选项卡 -->
		<script type="text/javascript">
			$(function () {
				$('.btnTop3').mouseover(function () {
					$(this).addClass('choice').siblings().removeClass('choice');
					var index = $(this).index();
					$('.boxTop3').eq(index).addClass('show').siblings().removeClass('show');
				});
			});
		</script>
		<!-- 完成-排行榜 -->
		<!-- 各版块视频展示 -->
		<div class="recommended">
			<!-- 随机视频版块-->
			<style type="text/css">
				#randomLeft {
					width:50px; 
					height: 70px; 
					line-height: 70px; 
					text-align: center; 
					font-size: 40px; 
					background-color: #cdcdcd; 
					border:0px; 
					border-radius: 5px; 
					float: left;
					top: -190px; 
					left: 1px;
					z-index: 2; 
					opacity: 0.6;"
				}
				#randomRight {
					width:50px; 
					height: 70px; 
					line-height: 70px; 
					text-align: center; 
					font-size: 40px; 
					background-color: #cdcdcd; 
					border:0px; 
					border-radius: 5px; 
					position: relative; 
					top: -190px; 
					right: 15px;
					float: right;
					z-index: 2; 
					opacity: 0.8;"
				}
				.randVedio {
					display: none;
				}	
				.randShow {
					display: block;
				}
			</style>
			<div class="recommended-grids" id="randBox">
				<!-- 随机版块标题 -->
				<div class="recommended-info">
					<span style="font-size:20px;"><b>手气不错</b></span>
					<script type="text/javascript">
						$('.changeRand').on('click', function() {
							window.location.reload();
						return false;
						});
					</script>
				</div>
				<!-- 随机展示视频-需要遍历 -->
				<!-- <?php echo $i = 0; ?> -->
				<?php foreach($randRes as $randValue): if($i <4): if(!empty($randValue['0'])): ?>
					<div class="col-md-3 resent-grid recommended-grid randVedio randShow">
						<div class="resent-grid-img recommended-grid-img">
							<a href="/index/single/single?vid=<?php echo $randValue['0']['id']; ?>"><img src="http://p3d4qx20z.bkt.clouddn.com/<?php echo $randValue['0']['pic']; ?>" alt="" style="box-shadow: 2px 2px 2px #C1C1C1;" /></a>
							<div class="time small-time">
								<p class="glyphicon glyphicon-time"><?php echo $randValue['0']['time_long']; ?></p>
							</div>
						</div>
						<div class="resent-grid-info recommended-grid-info video-info-grid">
							<h5 style="height: 25px;"><a href="/index/single/single?vid=<?php echo $randValue['0']['id']; ?>" class="title"><?php echo $randValue['0']['title']; ?></a></h5>
							<ul>
								<li><p class="author author-info"><a href="" class="author"><?php echo $randValue['0']['up_name']; ?></a></p></li>
								<li class="right-list"><p class="views views-info"><?php echo $randValue['0']['click_num'] / 2; ?>次浏览</p></li>
							</ul>
						</div>
					</div>
					<!-- <?php echo $i++; ?> -->
					<?php endif; else: if(!empty($randValue['0'])): ?>
					<div class="col-md-3 resent-grid recommended-grid randVedio">
						<div class="resent-grid-img recommended-grid-img">
							<a href="/index/single/single?vid=<?php echo $randValue['0']['id']; ?>"><img src="http://p3d4qx20z.bkt.clouddn.com/<?php echo $randValue['0']['pic']; ?>" alt="" style="box-shadow: 2px 2px 2px #C1C1C1;" /></a>
							<div class="time small-time">
								<p class="glyphicon glyphicon-time"><?php echo $randValue['0']['time_long']; ?></p>
							</div>
						</div>
						<div class="resent-grid-info recommended-grid-info video-info-grid">
							<h5><a href="/index/single/single?vid=<?php echo $randValue['0']['id']; ?>" class="title"><?php echo $randValue['0']['title']; ?></a></h5>
							<ul>
								<li><p class="author author-info"><a href="" class="author"><?php echo $randValue['0']['up_name']; ?></a></p></li>
								<li class="right-list"><p class="views views-info"><?php echo $randValue['0']['click_num'] / 2; ?>次浏览</p></li>
							</ul>
						</div>
					</div>
					<?php endif; endif; endforeach; ?>
				<div class="clearfix"> </div>
				<button id="randomLeft" class="glyphicon glyphicon-menu-left" ></button>
				<button id="randomRight" class="glyphicon glyphicon-menu-right" ></button>
				<div class="clearfix" style="height: 10px;"></div>
			</div>
			<!-- 完成-随机版块 -->
			<!-- 定时轮播 -->
				<script type="text/javascript">
					var oRand = 0;
					var AllRand = $('.randVedio').length;
					// 轮播按钮-下一个
					$('#randomRight').click(next);
					function next() 
					{
						if (oRand >= (AllRand-4)) {
							oRand = -1;
						}
						oRand = oRand + 1;
						$('.randVedio').eq(oRand % AllRand).addClass('randShow').siblings().removeClass('randShow');
						$('.randVedio').eq((oRand+1)% AllRand).addClass('randShow');
						$('.randVedio').eq((oRand+2)% AllRand).addClass('randShow');
						$('.randVedio').eq((oRand+3) % AllRand).addClass('randShow');
					};
					// 轮播按钮-上一个
					$('#randomLeft').click(prevv);
					function prevv() 
					{
						if (oRand <= 0) {
							oRand = AllRand-3;
						}
						$('.randVedio').eq(oRand-1 % AllRand).addClass('randShow').siblings().removeClass('randShow');
						$('.randVedio').eq((oRand)% AllRand).addClass('randShow');
						$('.randVedio').eq((oRand+1)% AllRand).addClass('randShow');
						$('.randVedio').eq((oRand+2) % AllRand).addClass('randShow');
						oRand = oRand - 1;
					};
					var timer = setInterval(next , 2000);
					$('#randBox').mouseover(function () {
						clearInterval(timer);
					});
					$('#randBox').mouseout(function () {
						clearInterval(timer);
						timer = setInterval(next , 2000);
					});
				</script>
				<!-- 完成-定时轮播 -->
			<!-- 完成-随机视频展示页面 -->
			<!-- 频道视频展示-需要遍历 -->
			<div class="recommended-grids">
				<!-- <?php echo $j = 0; ?> -->
				<?php foreach($childRes as $vChild): ?>
				<!-- 单个版块标题 -->
				<div class="recommended-info">
					<span style="font-size:20px; width: 100%;"><b><?php echo $bigClass[$j]['name']; ?></b>&nbsp;&nbsp;<a href="/index/index/class?cid=<?php echo $bigClass[$j]['id']; ?>">查看更多</a></span>
				</div>
				<!-- <?php echo $j++; ?> -->
				<!-- 完成-单个版块标题 -->
					<?php foreach($vChild as $vcRes): ?>
					<!-- 单个频道展示四个视频 -->
					<div class="col-md-3 resent-grid recommended-grid" style="padding-bottom: 60px;">
						<div class="resent-grid-img recommended-grid-img">
							<a href="/index/single/single?vid=<?php echo $vcRes['id']; ?>">
								<img src="http://p3d4qx20z.bkt.clouddn.com/<?php echo $vcRes['pic']; ?>" alt="" style="box-shadow: 2px 2px 2px #C1C1C1;" />
							</a>
							<div class="time small-time">
								<p class="glyphicon glyphicon-time"><?php echo $vcRes['time_long']; ?></p>
							</div>
						</div>
						<div class="resent-grid-info recommended-grid-info video-info-grid">
							<h5 style="height: 20px;"><a href="/index/single/single?vid=<?php echo $vcRes['id']; ?>" class="title"><?php echo $vcRes['title']; ?></a></h5>
							<ul>
								<li><p class="author author-info"><a href="" class="author"><?php echo $vcRes['up_name']; ?></a></p></li>
								<li class="right-list"><p class="views views-info"><?php echo $vcRes['click_num'] / 2; ?>次浏览</p></li>
							</ul>
						</div>
					</div>
					<!-- 完成-单个频道展示 -->
					<?php endforeach; endforeach; ?>
				<div class="clearfix"> </div>
			<!-- 完成-频道视频展示页面 -->
			</div>
		</div>
	</div>
	<!-- 完成-视频展示页面 -->
	

		<!-- 底栏 -->
		<div class="footer">
			<div class="footer-grids">
				<div class="footer-top">
					<div class="footer-top-nav">
						<ul>
							<li><a href="/index/msg/msg#aboutUs">关于我们</a></li>
							<li><a href="/index/msg/msg#joinUs">加入我们</a></li>
							<li><a href="/index/msg/msg#friendLink">友情链接</a></li>
							<li><a href="/index/msg/msg#official">官方认证</a></li>
							<li><a href="/index/msg/msg#callUs">联系我们</a></li>
						</ul>
					</div>
					<div class="footer-bottom-nav">
						<ul>
							<li>Copyright &copy; 2015.</li>
							<li>Company name All rights reserved.</li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
		<!-- 完成-底栏 -->
		<div class="clearfix"> </div>
		<!-- 返回顶部 -->
		<a href="#"><img src="images/top.gif" width="50px" height="50px" title="返回顶部" style="position: fixed; right: 0; top: 75%; opacity: 0.8; z-index: 3;" /></a>
	</div>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
  </body>
</html>