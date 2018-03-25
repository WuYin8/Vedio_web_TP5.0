<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/home/wwwroot/aishan.clwub.xin/public/../application/index/view/user/index.html";i:1519741881;s:70:"/home/wwwroot/aishan.clwub.xin/application/index/view/layoutOther.html";i:1519797705;}*/ ?>
<!-- 
	本模板页为除视频播放与视频展示的其他页面所使用
	模板本身包含顶栏（搜索，注册登录）、侧边栏（菜单目录）和底栏（网站信息）
	引用模板时需要补充的部分为中部的展示内容
	简单格式为<div class="show-top-grids"></div>在此div中添加，class名称满足bootstrap要求
	与视频播放模板的区别是未引用播放器的js，不会产生报错

	需要修改的问题：
	1. 需要运用无限极分类展示大版块，小版块，标题的递进
	2. 判断登录状态以更改登录注册栏（在登录注册栏中直接写判断语句，要修改模板内容）
 -->

<!DOCTYPE HTML>
<html>
<head>
<title>个人中心-爱闪视频网</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="My Play Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap -->
<link href="/css/bootstrap.min.css" rel='stylesheet' type='text/css' media="all" />
<!-- //bootstrap -->
<link href="/css/dashboard.css" rel="stylesheet">
<!-- Custom Theme files -->
<link href="/css/style.css" rel='stylesheet' type='text/css' media="all" />
<script src="/js/jquery-1.11.1.min.js"></script>
<!-- 路径的地址都是从url的方法上出发，向上两级后到达默认的public文件夹，再引用样式 -->
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
		top: -170px; 
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
		top: -170px; 
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
    <nav class="navbar navbar-inverse navbar-fixed-top1">
      <div class="container-fluid">
        <div class="navbar-header" style="margin-left: 15px;">
          <a class="navbar-brand" href="/index"><h1><img src="/images/logo.gif" height="49px" alt="" /></h1></a>
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
					<a href="/index/user/index?userID=<?php echo \think\Session::get('id'); ?>"><img style="height: 50px; float: left;" src="<?php echo \think\Session::get('photo'); ?>" title="点击进入个人中心" class="top_photo" /></a>
					<div style="float:left; height: 50px;">
						<span style="float: left; height: 25px; width: 100%; line-height: 25px; text-align: center; font-weight: bolder;" class="top_name"><?php echo \think\Session::get('username'); ?></span>
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
					<script type="text/javascript" src="/js/modernizr.custom.min.js"></script>    
					<link href="/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
					<script src="/js/jquery.magnific-popup.js" type="text/javascript"></script>
					<div id="small-dialog3" class="mfp-hide">
						<h3>注册账号</h3> 
						<div class="social-sits">
						<p style="font-size: 16px; font-weight: bolder;"><a href="#small-dialog" class="play-icon popup-with-zoom-anim" id="goToLog">第三方快速登录点这里</a></p>
							<div class="button-bottom">
								<p><small>第三方登录用户没有发布视频的权限！！<br />需要发布视频的朋友请尽快注册爱闪视频网的账号</small></p>
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
								<p><small>第三方登录用户没有发布视频的权限！！<br />需要发布视频的朋友请尽快注册爱闪视频网的账号</small></p>
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
								} else if (obj['msg'] == 'great') {
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
			<?php endforeach; foreach($bigClass as $bigValue): ?>
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
		
	<style type="text/css">
		.userBox {
			background-color: #F3F3F3;
			box-shadow: 2px 2px 2px #C1C1C1;
			margin: 50px ; 
			padding: 50px;
			text-align: center;
			min-width: 640px;
		}
		.top-grids {
			text-align: left;
		}
		.top-grids button {
			background-color: transparent;
		}
		.userPage1 {
			text-align: center;
			margin-top: 2em;
		}
		.changeLight {
			width: 70%;
			font-size: 16px;
			margin: 0 auto;
			border: 5px solid #EDB2ED;
			border-radius: 10px;
			padding: 0 20px 20px;
			min-width: 440px;
		}
		.changeLight table {
			width: 50%;
			text-align: center;
			margin: 0 auto;
		}
		.changeLight p {
			text-align: left;
			font-size: 22px;
			color: #ED62ED;
		}
		.changeLight table tr{
			height: 40px;
			line-height: 40px;
		}
		.changeHeavy , .changePhoto{
			width: 70%;
			font-size: 16px;
			margin: 50px auto;
			border: 5px solid #EDB2ED;
			border-radius: 10px;
			padding: 0 20px 20px;
			min-width: 440px;
		}
		.changeHeavy p ,  .changePhoto p{
			text-align: left;
			font-size: 22px;
			color: #ED62ED;
		}
		.userPage1 {
			display: none;
		}
		.show {
			display: block;
		}
		.adminLogin {
			font-size: 20px;
			line-height: 20px;
			color: black;
			position: relative;
			top: -5px;
		}
		.btnCode {
			color: black;
		}
		.glyphicon-time {
			color: white;
		}
	</style>
		<!-- 使用window.onload， sessionID和getID不同时，不展示资料管理界面-->
		<div class="show-top-grids">
			<div class="userBox">
				<div class="top-grids">
					<div class="recommended-info">
					<button class="btnTop3 choice">资料管理</button>
					<button class="btnTop3 btnRes">投稿历史</button>
					<button class="btnTop3 btnRes">我的购买</button>
					<?php if(!empty(\think\Session::get('username'))): if(\think\Session::get('grade') == '管理员'): ?>
							<button type="button" class="btn btn-warning adminLogin">后台登录</button>
						<?php endif; endif; ?>
					<!-- 第一个选项卡页面 -->
					<div class="userPage1 show">
						<div class="changeLight">
							<p>基本资料<br /><span style="font-size: 16px; color: #8d8d8d;">单击资料即可修改</span></p>
							<table>
								<tr>
									<td>用户名：</td>
									<td id="tdUname" class="username" tabindex="0" hidefocus="true"><?php echo $username; ?></td>
								</tr>
								<tr>
									<td>邮箱：</td>
									<td id="tdEmail" class="email" tabindex="0" hidefocus="true"><?php echo $email; ?></td>
								</tr>
								<tr>
									<td>手机号：</td>
									<td id="tdPhone" class="phone" tabindex="0" hidefocus="true"><?php echo $phone; ?></td>
								</tr>
							</table>
						</div>
						<div class="changeHeavy">
							<p>安全资料<br /><span style="font-size: 16px; color: #8d8d8d;">旧密码填写正确才可修改</span></p>
							<div class="col-sm-3" style="margin-top: 10px;">
								旧密码：
							</div>
							 <div class="col-sm-9" style="margin-top: 10px;">
								<input type="password" class="pwdOld form-control" placeholder="填写旧密码" /><span class="spanOld" style="color: red; display: none;"></span><br />
							</div>
							<div class="col-sm-3">
								新密码：
							</div>
							 <div class="col-sm-9">
								<input type="password" class="pwdNew form-control" placeholder="密码长度不得少于6位" /><span class="spanNew" style="color: red; display: none;""></span><br  />
							</div>
							<button class="btn btn-info btnCode">修改密码</button>
						</div>
						<div class="changePhoto">
							<p>头像上传<br /><span style="font-size: 16px; color: #8d8d8d;">只支持jpg、jpeg、png和gif的图片格式</span></p>
							<div style="text-align: left; margin: 10px 0 15px 0;">
								当前头像：
								<img src="<?php echo \think\Session::get('photo'); ?>" width="50px;" height="50px;" />
							</div>
							<form action="/index/user/changePhoto" enctype="multipart/form-data" method="post">
								<input type="file" name="image" /> <br />
								<input type="submit" value="上传头像" class="btn btn-info" />
							</form>
						</div>
					</div>
					<script type="text/javascript">
						var tdUname = document.getElementById('tdUname');
						tdUname.onfocus = function () {changed(this)};
						var tdEmail = document.getElementById('tdEmail');
						tdEmail.onfocus = function () {changed(this)};
						var tdPhone = document.getElementById('tdPhone');
						tdPhone.onfocus = function () {changed(this)};

						var flag = true;
						// 更改普通数据的方法
						if (flag) {
							function changed(obj)
							{
								flag = false;
								var str = obj.innerHTML;
								obj.innerHTML ='';
								var newPut = document.createElement('input');
								newPut.type = 'text';
								newPut.value = str;
								newPut.style.width = '100%';
								obj.appendChild(newPut);	
								newPut.onblur = function () {
									flag = true;
									var newValue = newPut.value;
									$.ajax({
										method:'post',
										url:'/index/user/changeInfo',
										async:true,
										data:{
											name:obj.className,
											value:newValue
										},
										success:changeInfo
									});
									function changeInfo(data2)
									{
										var kob = JSON.parse(data2);
							          		obj.innerHTML = newPut.value;
										if (kob['msg'] == '修改成功' && obj.className == 'username') {
											$('.top_name').html(newValue);
										}
									}
								};

							}
						}
						$('.btnCode').on('click', function() {
							// 判断旧密码是否输入
							if ($('.pwdOld').val() == '') {
								$('.spanOld').html('旧密码不得为空');
								$('.spanOld').css('display', 'block');
								return false;
							} else {
								$('.spanOld').html('');
								$('.spanOld').css('display', 'none');
							}
							// 判断新密码格式
							if ($('.pwdNew').val().length < 6) {
								$('.spanNew').html('密码长度不得少于6位');
								$('.spanNew').css('display', 'block');
								return false;
							} else {
								$('.spanNew').html('');
								$('.spanNew').css('display', 'none');
							}
							// 传回后台
							$.ajax({
								url:'/index/user/changePwd',
								async:true,
								type:'post',
								data:{
									pwdOld:$('.pwdOld').val(),
									pwdNew:$('.pwdNew').val(),
								},
								success:changePwd
							});
							function changePwd(data1)
							{
								var kbj = JSON.parse(data1);
								alert(kbj['msg']);
								return false;
							}
							return false;
						});
					</script>
					<!-- 完成-第一个选项卡页面 -->
					<!-- 第二个选项卡页面-遍历，就写三行一页，九个视频一页 -->
					<div class="userPage1" style="height: 1300px;">
						<div id="resBox"></div>
						<!-- 分页区 -->
						<div class="pages col-md-12 resent-grid recommended-grid slider-top-grids">
							<a href ="" class="aPage">首页</a>
							<a href ="" class="aPage">前页</a>
							<a href ="" class="aPage">后页</a>
							<a href ="" class="aPage">尾页</a>
						</div>
						<style type="text/css">
							.pages {
								margin-top: 10px;
							}
							.pages a {
								font-size: 16px;
								text-decoration: none;
								color: #ED62ED;
								margin-left: 10px;
							}
							.pages a:hover {
								color: #cdcdcd;
							}		
						</style>
						<!-- 完成-分页区 -->
					</div>
					<!-- 完成-第二个选项卡页面 -->
					<!-- 第三个选项卡 -->
					<div class="userPage1" style="height: 1080px;">
						<table id="tableBox" border="1" cellspacing="0">
							<tr>
								<th>订单号</th>
								<th>购买人</th>
								<th>购买视频</th>
								<th>价格（元）</th>
								<th>购买时间</th>
							</tr>
						</table>
						<!-- 分页区 -->
						<div class="pages col-md-12 resent-grid recommended-grid slider-top-grids">
							<a href ="" class="aPage2">首页</a>
							<a href ="" class="aPage2">前页</a>
							<a href ="" class="aPage2">后页</a>
							<a href ="" class="aPage2">尾页</a>
						</div>
						<style type="text/css">
							#tableBox {
								width: 100%; 
								padding:40px; 
								border: 2px solid #cdcdcd; 
								font-size: 16px;
								text-align: center;
							}
							#tableBox th {
								text-align: center;
								padding-top: 10px;
								padding-bottom: 10px;
							}
							#tableBox td {
								text-align: center;
								padding-top: 10px;
								padding-bottom: 10px;
							}
							.pages {
								margin-top: 10px;
							}
							.pages a {
								font-size: 16px;
								text-decoration: none;
								color: #ED62ED;
								margin-left: 10px;
							}
							.pages a:hover {
								color: #cdcdcd;
							}		
						</style>
						<!-- 完成-分页区 -->
					</div>
					<!-- 完成-第三个选项卡 -->

					<!-- 选项卡的特效 -->
					<script type="text/javascript">
						$(function () {
							$('.btnTop3').click(function () {
								$(this).addClass('choice').siblings().removeClass('choice');
								var index = $(this).index();
								$('.userPage1').eq(index).addClass('show').siblings().removeClass('show');
							});
						});
						$('.adminLogin').click(function() {
							$(location).prop('href', "/admin/login/login");
						});
					</script>
					<!-- 完成-选项卡的特效 -->
					<!-- 视频的ajax遍历 -->
					<script type="text/javascript">
						var pA = document.getElementsByClassName('aPage');
						var rBox = document.getElementById('resBox');
						var pA2 = document.getElementsByClassName('aPage2');
						var tBox = document.getElementById('tableBox');
						$.ajax({
							type:'post',
							url:'/index/user/getRes',
							data:null,
							async:true,
							success:res
						});
						function res(data)
						{
							var obj = JSON.parse(data);
							console.log(obj);
							// 清空已有视频标签
							rBox.innerHTML = '';
							// 循环创建视频标签
							for (var i = 0; i < obj['Res'].length; i++) {
								// 创建第一层标签
								var rDiv = document.createElement('div');
								rDiv.className = 'col-md-4 resent-grid recommended-grid slider-top-grids';
								$(rDiv).css({
									'margin-bottom': '30px',
								});
								rBox.appendChild(rDiv);
								// 创建第二层标签
								uDiv = document.createElement('div');
								uDiv.className = 'resent-grid-img recommended-grid-img';
								dDiv = document.createElement('div');
								dDiv.className = 'resent-grid-info recommended-grid-info';
								rDiv.appendChild(uDiv);
								rDiv.appendChild(dDiv);
								// 创建第三层标签
								rA = document.createElement('a');
								rA.href = '/index/single/single?vid=' + obj['Res'][i]['id'];
								sDiv = document.createElement('div');
								sDiv.className = 'clck';
								uDiv.appendChild(rA);
								uDiv.appendChild(sDiv);

								rH3 = document.createElement('h3');
								$(rH3).css({
									'height': '25px',
								});
								rUl = document.createElement('ul');
								dDiv.appendChild(rH3);
								dDiv.appendChild(rUl);
								// 创建第四层标签
								rImg = document.createElement('img');
								$('rImg').css({
									'height': '75%',
								});;
								rImg.src = 'http://p3d4qx20z.bkt.clouddn.com/' + obj['Res'][i]['pic'];
								rA.appendChild(rImg);

								rSpan = document.createElement('span');
								rSpan.className = 'glyphicon glyphicon-time';
								rSpan.ariaHidden = 'true';
								rSpan.innerHTML = obj['Res'][i]['time_long'];
								sDiv.appendChild(rSpan);

								rA1 = document.createElement('a');
								rA1.className = 'title title-info';
								rA1.href = '/index/single/single?vid=' + obj['Res'][i]['id'];
								rA1.innerHTML = obj['Res'][i]['title'];
								rH3.appendChild(rA1);

								rLi = document.createElement('li');
								$(rLi).css({
									'text-align': 'left',
								});;
								rLi1 = document.createElement('li');
								rLi1.className = 'right-list';
								rUl.appendChild(rLi);
								rUl.appendChild(rLi1);
								// 第五层标签新建
								rA2 = document.createElement('a');
								rA2.href = '#';
								rA2.className = 'author authorDel';
								rA2.id = obj['Res'][i]['id'];
								rA2.innerHTML = '删除';
								$(rA2).css({
									'font-weight': 'bolder',
									'color': '#21DEEF'
								});;
								// 删除按钮
								rA2.onclick = function() {
									del(this);
									var oDel = this.parentNode.parentNode.parentNode.parentNode;
									rBox.removeChild(oDel);
									return false;
								};
								rLi.appendChild(rA2);
								rP1 = document.createElement('p');
								rP1.className = 'views views-info';
								rP1.innerHTML = obj['Res'][i]['click_num'] /2 + '次浏览';
								rLi1.appendChild(rP1);
							}

							// 清空已有交易记录标签
							tBox.innerHTML = '';
							// 创建table表头
							var pTr1 = document.createElement('tr');
							tBox.appendChild(pTr1);
							var str1 = 
								"<th>订单号</th>" + 
								"<th>购买人</th>" + 
								"<th>购买视频</th>" + 
								"<th>价格（元）</th>" + 
								"<th>购买时间</th>";
							pTr1.innerHTML = str1;

							// 循环创建购买记录
							for (var j = 0; j < obj['pay'].length; j++) {
								// 创建第一层标签
								var pTr = document.createElement('tr');
								tBox.appendChild(pTr);
								// 创建第二层标签
								var str = 
								"<td>" + obj['pay'][j]['id'] + "</td>" + 
								"<td>" + obj['pay'][j]['username'] + "</td>" + 
								"<td>" + obj['pay'][j]['title'] + "</td>" + 
								"<td>" + obj['pay'][j]['price'] + "</td>" + 
								"<td>" + obj['pay'][j]['create_time'] + "</td>";
								pTr.innerHTML = str;
							}

							// 把allpage的链接赋值到a标签上
							var oPage = obj['pages'];
							var i = 0;
							for (var name in oPage) {
								pA[i].href = 'javascript:test(\'' + oPage[name] + '\')';
								i++;
							}

							// 把allpage的链接赋值到a标签上
							var oPage2 = obj['pagesP'];
							var q = 0;
							for (var name in oPage2) {
								pA2[q].href = 'javascript:test(\'' + oPage2[name] + '\')';
								q++;
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
								success:res
							});
						}
						function del(obj) {
							// 获取删除视频的id
							var vID = $(obj).attr('id');
							// 将删除视频的id传到后台
							$.ajax({
								type:'post',
								dataType:'json',
								url:'/index/user/delVideo',
								data:{
									videoID:vID
								},
								async:true,
							});
						};
					</script>
					<!-- 完成-视频的ajax遍历 -->
				</div>
			</div>
		</div>
	

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
		<a href="#"><img src="/images/top.gif" width="50px" height="50px" title="返回顶部" style="position: fixed; right: 0; top: 75%; opacity: 0.8; z-index: 3;" /></a>
	</div>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
  </body>
</html>