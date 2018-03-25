<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/aishan.clwub.xin/public/../application/index/view/upload/upload.html";i:1519741880;s:70:"/home/wwwroot/aishan.clwub.xin/application/index/view/layoutOther.html";i:1519797705;}*/ ?>
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
<title>视频上传-爱闪视频网</title>
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
		.msgBox {
			background-color: #F3F3F3;
			box-shadow: 2px 2px 2px #C1C1C1;
			margin: 50px ; 
			padding: 70px 80px 70px 80px;
			text-align: left;
			min-width: 500px;
		}
		.form-group {
			font-size: 2em;
			text-align: left;
			margin-top: 15px;
		}
		.form-control-input {
			margin-top: 10px;
		}
		#btn{  
		        border: 1px solid #CCC;  
		        width: 100px;  
		        height: 100px;  
		        font-size: 55px;
		        border-radius: 10px;
		        display: block;
		        color: white;
			background-color: #c8c8c8;
		}
		 .ac_file{  
		        width: 100px;  
		        height: 100px;  
		        position: relative; 
		        top: -100px;  
		        cursor: pointer;  
		        opacity: 0;  
		}
		#btnUp {
			width: 150px;
			height: 40px;
			line-height: 30px;
			font-size: 20px;
			color: white;
			background-color: #ED62ED;
			border: 0;
			margin-left: 41%;
			position: relative;
			top: -60px;
		}
		#btnMsg {
			font-size: 14px;
			margin-left: 5px;
		}
	</style>
		<div class="show-top-grids">
			<div class="msgBox">
				<form method="post" action="http://upload-z1.qiniup.com/" enctype="multipart/form-data">
					<div class="form-group">
					    <label>视频标题</label> <small id="msgTitle">标题长度不得超过20个字符</small>
					    <input type="text" class="form-control form-control-input" id="inputTitle" maxlength="20" placeholder="在此填写视频标题">
					 </div>
					<div class="form-group">
					    <label>视频标签</label> <small id="msgLabel">最多填写五个标签，标签长度不得超过6个字符</small>
					    <input type="text" class="form-control form-control-input" id="inputLabel1" maxlength="6" placeholder="标签1">
					    <input type="text" class="form-control form-control-input" id="inputLabel2" maxlength="6" placeholder="标签2">
					    <input type="text" class="form-control form-control-input" id="inputLabel3" maxlength="6" placeholder="标签3">
					    <input type="text" class="form-control form-control-input" id="inputLabel4" maxlength="6" placeholder="标签4">
					    <input type="text" class="form-control form-control-input" id="inputLabel5" maxlength="6" placeholder="标签5">
					 </div>
					 <div class="form-group">
					    <label>视频描述</label> 
					    <textarea class="form-control form-control-input" rows="4" placeholder="在此填写视频描述" id="inputWord"></textarea>
					 </div>
					 <div class="form-group"><label>所属版块</label></div>
					 <div class="form-group">
					    <!-- 此处需要遍历 -->
					   	<select class="form-control form-control-input" id="inputSelect1" style="width: 45%; float: left; position: relative; top: -10px; margin-right: 10%;">
					   	<?php foreach($classBig as $vBig): ?>
						  	<option value="<?php echo $vBig['id']; ?>"><?php echo $vBig['name']; ?></option>
						<?php endforeach; ?>
						</select>
					   	<select class="form-control form-control-input" id="inputSelect2"  style="width: 45%; float: left; position: relative; top: -10px;">
						  <option ></option>
						</select>
					 </div>
					 <div class="form-group" style="padding-top: 55px;"><label>选择视频</label></div>
				<!-- 七牛云需要的上传 -->
					  <input name="token" type="hidden" value="<?php echo $token; ?>"/>
					  <input name="accept" type="hidden"/>
					<button id="btn" class="glyphicon glyphicon-folder-open"></button>
					<span id="btnMsg">选择视频文件</span>
					<!-- 更改上传文件按钮样式 -->
					  <input  name="file" type="file" id="fileUp"  class="ac_file" "/>
					  <input type="submit" value="上传" id="btnUp"/>
				</form>
			</div>
		</div>
	<script type="text/javascript">
		$(function () {
			// 上传按钮，鼠标覆盖，变色
			$('#btn').mouseover(function() {
				$(this).css({
					'color': '#272C2E',
					'background-color': 'white',
					'border': '2px solid #CDCDCD'
				});
			});
			$('#btn').mouseout(function() {
				$(this).css({
					'color': 'white',
					'background-color': '#c8c8c8',
					'border': '0'
				});
			});
			// 根据大选项卡的值调整小选项卡，需要用ajax遍历
			$('#inputSelect1').click(function() {
				bigSelect = $(this).val();
				$('#inputSelect2').empty();
				<?php foreach($classBig as $vBig): ?>
					if (bigSelect == <?php echo $vBig['id']; ?>) {
						<?php foreach($classSmall as $vSmall): if($vSmall['pid'] == $vBig['id']): ?>
							$('#inputSelect2').append('<option value=' + <?php echo $vSmall['id']; ?> + '>' + '<?php echo $vSmall['name']; ?>' + '</option>');
							
						<?php endif; endforeach; ?>
					}
				<?php endforeach; ?>
			});
		});
		// 点击上传视频前，判断需要的信息是否符合要求
		$('#btnUp').on('click', function() {
			// 输入标题的内容
			inputTitle = $('#inputTitle').val();
			// 输入标签的内容
			inputLabel1 = $('#inputLabel1').val();
			inputLabel2 = $('#inputLabel2').val();
			inputLabel3 = $('#inputLabel3').val();
			inputLabel4 = $('#inputLabel4').val();
			inputLabel5 = $('#inputLabel5').val();
			// 输入简介的内容
			inputWord = $('#inputWord').val();
			// 选择版块的内容
			inputSelect = $('#inputSelect2').val();
			msgTitle = $('#msgTitle');
			msgLabel = $('#msgLabel');
			msgTitle.css('color', 'black');
			msgLabel.css('color', 'black');
			if (inputTitle.length == 0) {
				msgTitle.html('视频标题不能为空');
				msgTitle.css('color', 'red');
				alert('视频标题不能为空');
				return false;
			}
			if (inputTitle.length > 20) {
				msgTitle.html('视频标题长度不得超过20个字符');
				msgTitle.css('color', 'red');
				alert('视频标题长度不得超过20个字符');
				return false;
			}
			if (inputLabel1.length > 6 || inputLabel2.length > 6 || inputLabel3.length > 6 || inputLabel4.length > 6 || inputLabel5.length > 6) 
			{
				msgTitle.html('标签长度不得超过6个字符');
				msgTitle.css('color', 'red');标签长度不得超过6个字符
				alert('标签长度不得超过6个字符');
				return false;
			}
			if (inputSelect.length == 0) {
				alert('上传频道未选择');
				return false;
			}
			// 前台确认格式完成后，点击上传按钮，显示上传中……
			$(this).val('正在上传…');
			// 视频相关数据，提交到后台时，先存入cookie，等待七牛云存储完毕，从七牛云的页面跳转回来之后，在执行存入数据库的操作，之后无论存入数据库成功与否，都要销毁这几个cookie
			$.ajax({
				type:'post',
				dataType:'json',
				url:'/index/upload/getCookie',
				data:{
					vName:inputTitle,
					vLabel1:inputLabel1,
					vLabel2:inputLabel2,
					vLabel3:inputLabel3,
					vLabel4:inputLabel4,
					vLabel5:inputLabel5,
					vWord:inputWord,
					vSelect:inputSelect
				},
				async:true,
				success:success
			});
			function success(data)
			{
				
			}
			// return false;
		});
	</script>
	

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