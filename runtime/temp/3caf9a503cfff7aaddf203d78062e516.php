<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/aishan.clwub.xin/public/../application/index/view/single/single.html";i:1519889404;s:71:"/home/wwwroot/aishan.clwub.xin/application/index/view/layoutSingle.html";i:1519797592;}*/ ?>
<!-- 
	本模板页为视频播放页面所使用
	模板本身包含顶栏（搜索，注册登录）、侧边栏（菜单目录）和底栏（网站信息）
	引用模板时需要补充的部分为中部的展示内容
	简单格式为<div class="show-top-grids"></div>在此div中添加，class名称满足bootstrap要求

	需要修改的问题：
	1. 其实视频播放页面本来就是单一模板，不需要分成两个模板，暂时根据后续使用情况判断是否需要合为一个模板
	2. 根据url在菜单栏上对不同的栏目高亮显示（目前只高亮了主页），
	3. 需要运用无限极分类展示大版块，小版块，视频标题的递进
	4. 判断登录状态以更改登录注册栏（在登录注册栏中直接写判断语句，要修改模板内容）
 -->

<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $vTitle; ?>-爱闪视频网</title>
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
<!-- 视频播放器与弹幕使用 -->
<link rel="stylesheet" href="/depend/videoCT.css">
<link rel="stylesheet" href="/depend/index.css">
<script type='text/javascript' src="/depend/jquery.min.js"></script>
<script type='text/javascript' src="/depend/videoCT.js"></script>
<script type='text/javascript' src="/depend/index.js"></script>
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
					<script type="text/javascript" src="/js/modernizr.custom.min.js"></script>    
					<link href="/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
					<script src="/js/jquery.magnific-popup.js" type="text/javascript"></script>
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
								} else if (obj['msg'] == 'great') {
									alert('登录成功');
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
				</ul>
			</li>
				<!-- script-for-menu -->
				<script>
					$(function () {
					$( "li a.menu<?php echo $bigValue['id']; ?>" ).click(function() {
						$( "ul.cl-effect-<?php echo $bigValue['id']; ?>" ).slideToggle( 300);
					});
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
		
	<script type="text/javascript">
	</script>
		<div class="show-top-grids">
			<!-- 视频播放页面 -->
				<div class="col-sm-9 single-left">
					<!-- 视频播放区域 -->
					<div class="song">
						<div class="song-info">
							<h3><b><?php echo $vTitle; ?></b></h3>	
						</div>
						<div class="video-gird">
							<section>
								<video width="100%" height="100%" id="video1" src=""></video>
								<span id="videoS" style="display: none;"><?php echo $vSrc; ?></span>
							</section>
						</div>
					</div>
					<script type="text/javascript">
						window.onscroll = function () {
							var vBox = document.getElementsByClassName('video-gird');
							// 视频区域，距窗口顶部的距离
							var vBoxTop = vBox['0'].offsetTop;
							var vBoxHeight = vBox['0'].offsetHeight;
							//得到卷起的高度
							var scrollTop = document.documentElement.scrollTop;
							if (scrollTop > vBoxTop + vBoxHeight) {
								$('.video-gird').eq(0).css({
									'position': 'fixed',
									'right': '0',
									'top': '10%',
									'width': '30%',
									'height': '20%',
									'z-index':'999',
									'background-color': 'transparent',
									'border': '0',
								});
							} else {
								$('.video-gird').eq(0).css({
									'display': 'block',
									'width': '100%',
									'height': '100%',
									'position': 'relative',
									'margin': 'auto',
									'border': '5px solid #000',
									'background-color': '#000000',
								});
							}
						};
					</script>
					<!-- 完成-视频播放区 -->
					<!-- 分享按钮区域 -->
					<div class="song-grid-right">
						<div class="bdsharebuttonbox">
							<h5 style="color: #ED62ED; position: relative;left: -6px;">分享到</h5>
							<a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
							<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
							<a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
							<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
							<a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a>
							<a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
							<a href="#" class="bds_copy" data-cmd="copy" title="分享到复制网址"></a>
							<a href="#" class="bds_more" data-cmd="more"></a>
						</div>
						<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"来自“爱闪视频网”的分享","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{},"image":{"viewList":["qzone","tsina","renren","weixin","tieba","douban","sqq","youdao","copy"],"viewText":"分享到：","viewSize":"32"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","renren","weixin","tieba","douban","sqq","youdao","copy"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
					</div>
					<!-- 完成-分享按钮区域 -->
					<div class="clearfix"> </div>
					<!-- 视频信息 -->
					<div class="published">
							<div class="load_more">	
								<ul id="myList">
									<li>
										<a href="/index/user/showMsg?whoID=<?php echo $vUpID; ?>"><img src="<?php echo $vUpPhoto; ?>" width="65px"/></a>
										<b style="font-size: 16px; color: #ED62ED;"><?php echo $vUpName; ?></b>
										<?php if(!empty($vLabel)): ?>
										<span class="glyphicon glyphicon-tags"></span>
										<?php foreach($vLabel as $value): if(!empty($value)): ?>
										<button class="tagBtn"><?php echo $value; ?></button>
										<?php endif; endforeach; endif; ?>
										<span><b>|</b></span>
										<!-- <?php echo $likeID = $_GET['vid']; ?> -->
										<?php if(empty(cookie($likeID))): ?>	
											<button id="zan" class="glyphicon glyphicon-heart-empty" style="font-size: 16px; color: red;background-color: transparent; height: 20px; line-height: 20px;">赞一赞</button>
										<?php else: ?>
											<button id="zan" class="glyphicon glyphicon-heart" style="font-size: 16px; color: red;background-color: transparent; height: 20px; line-height: 20px;">超赞的！！</button>
										<?php endif; ?>
										<span id="likeNum"><?php echo $vLike; ?></span>人赞过
										<script type="text/javascript">
											$('#zan').click(function() {
												var likeNum = parseInt($('#likeNum').html());
												if ($(this).html() == '赞一赞') {
													$(this).removeClass('glyphicon-heart-empty').addClass('glyphicon-heart');
													$(this).html('超赞的！！')
													likeNum = likeNum + 1;
													$('#likeNum').html(likeNum);
													$.ajax({
														type:'post',
														url:'/index/single/dealZan',
														data:{
															zan:'yes',
															vid:<?php echo $_GET['vid']; ?>,
														},
														dataType:'json',
														async:true,
													});
												} else if ($(this).html() == '超赞的！！') {
													$(this).removeClass('glyphicon-heart').addClass('glyphicon-heart-empty');
													$(this).html('赞一赞')
													likeNum = likeNum - 1;
													$('#likeNum').html(likeNum);
													$.ajax({
														type:'post',
														url:'/index/single/dealZan',
														data:{
															zan:'no',
															vid:<?php echo $_GET['vid']; ?>,
														},
														dataType:'json',
														async:true,
													});
												}
												
											});
										</script>
										<style type="text/css" media="screen">
											.tagBtn {
												height: 18px;
												padding: 0 2px 0;
												margin-left: 2px;
											}	
										</style>
									</li>
									<li>
										<h4>发布于：<?php echo $vUpTime; ?></h4>
										<p><?php echo $vWord; ?></p>
									</li>
									
								</ul>
							</div>
					</div>
					<!-- 完成-视频信息 -->
					<div class="all-comments">
						<!-- 评论编辑区 -->
						<div class="all-comments-info">
							<div class="box">
									<textarea placeholder="请登陆后发表评论" class="msgReport"></textarea>
									<input type="submit" value="发布评论" class="addReport" />
									<input type="hidden" value="<?php echo $_GET['vid']; ?>" class="vid" />
									<div class="clearfix"> </div>
								<script type="text/javascript">
								// ajax插入评论的方法，不用ajax直接展示，而是插入数据库后，重新调用ajax拉取后台数据即可
									$('.addReport').on('click', function(event) {
										var vid = $('.vid').val();
										var msgReport = $('.msgReport').val();
										if (msgReport.length == 0) {
											alert('未输入评论');
											return false;
										}
										$.ajax({
											type:'post',
											url:'/index/single/addReport',
											data:{
												content:msgReport,
												vid:vid,
											},
											dataType:'json',
											async:false,
											success:addNum,
										});
										function addNum(data)
										{
											var obj = JSON.parse(data);
											if (obj['msg'] == 'noAdd') {
												alert('评论失败');
												return false;
											}
											if (obj['msg'] == 'noLogin') {
												alert('请登录后再评论');
												return false;
											}
											if (obj['msg'] == 'great') {
												$('.msgReport').val('');
												var reportNum = $('#reportNum').html();
												var newNum = parseInt(reportNum) + 1;
												$('#reportNum').html(newNum);
											}
										}
										$.ajax({
											type:'post',
											url:'/index/single/getReport?vid=' + <?php echo $_GET['vid']; ?>,
											data:{
												page:1,
											},
											dataType:'json',
											async:false,
											success:success
										});
										return false;
									});
								</script>
							</div>
						</div>
						<!-- 完成-评论编辑区 -->
						<!-- 评论展示区，需要分页，楼中楼分页与评论分页要区分 -->
						<div class="media-grids">
								<b style="font-size: 16px; color: #ED62ED;">所有评论（<span id="reportNum"><?php echo $reportC; ?></span>）</b>
							<div class="all-comments-buttons">
								<ul>
									<li><a href="" class="top newest">最新评论</a></li>
									<li><a href="" class="top oldest">最早评论</a></li>
								</ul>
								<script type="text/javascript">
									// 最新评论与默认的评论浏览方式一致
									$('.newest').on('click', function() {
										$.ajax({
											type:'post',
											url:'/index/single/getReport?vid=' + <?php echo $_GET['vid']; ?>,
											data:{
												page:1,
											},
											dataType:'json',
											async:true,
											success:success
										});
										return false;
									});
									// 最早评论要更新ajax的传值
									$('.oldest').on('click', function() {
										$.ajax({
											type:'post',
											url:'/index/single/getReportOld?vid=' + <?php echo $_GET['vid']; ?>,
											data:{
												page:1,
											},
											dataType:'json',
											async:true,
											success:success
										});
										return false;
									});
								</script>
							</div>
							<hr style="width: 90%; margin:20px auto;height:1px;border:none;border-top:1px dashed #C1C1C1;" />
							<span id="position" style="display: none;"></span>
							<div id="bigBox" style="margin-top: 10px;"></div>
							<!-- 在此进行ajax分页展示 -->
						</div>
						<!-- 完成-评论展示区 -->
						<!-- 分页区 -->
						<div class="pages">
							<a href ="" class="aPage">首页</a>
							<a href ="" class="aPage">前页</a>
							<a href ="" class="aPage">后页</a>
							<a href ="" class="aPage">尾页</a>
						</div>
						<style type="text/css">
							.pages {
								margin-top: 10px;
								position: relative;
								left: 42%;
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
						<!-- 评论展示方法 -->
						<script type="text/javascript">
							var bBox = document.getElementById('bigBox');
							var pA = document.getElementsByClassName('aPage');
							$(function () {
								$.ajax({
									type:'post',
									url:'/index/single/getReport?vid=' + <?php echo $_GET['vid']; ?>,
									data:{
										page:1,
									},
									dataType:'json',
									async:true,
									success:success
								});
							});

							function success(data)
							{
								bBox.innerHTML = '';
								var obj = JSON.parse(data);
								// 开始主评论遍历展示
								for (var i =  0; i < obj['dataL'].length; i++) {
									var Box = document.getElementById('bigBox');
									// 添加第一层标签
									var lDiv = document.createElement('div');
									var sBox = document.createElement('div');
									lDiv.className = 'media';
									$(lDiv).val(obj['dataL'][i]['id']);
									sBox.className = 'smallBox';
									$(lDiv).css({
										'box-shadow': '0px 0 2px #C1C1C1',
										'padding': '5px',
										'margin-top': '2em',
										'margin-bottom': '2em',
									});
									$(sBox).css({
										'max-height': '500px',
										'overflow':'auto',
									});
									Box.appendChild(lDiv);
									Box.appendChild(sBox);
									// 添加第二层标签
									var mH5 = document.createElement('h5');
									$(mH5).html(obj['dataL'][i]['username']);
									$(mH5).css({
										'font-size': '14px',
										'margin':0,
										'color':'#21DEEF',
										'font-weight':'bolder',
									});
									var mSpan = document.createElement('span');
									$(mSpan).html(obj['dataL'][i]['create_time']);
									$(mSpan).css({
										'background-color': '#f7f7f7',
									});
									// 创建一个楼中楼回复的输入框
									var mA = document.createElement('a');
									$(mA).html('回复');
									mA.href = '#zan';
									$(mA).css({
										'float': 'right',
										'display':'block',
										'padding':'5px',
										'text-decoration':'none',
										'font-weight':'bolder',
										'background-color':'#cdcdcd',
										'border-radios':'5px',
										'color':'white',

									});
									$(mA).on('click', function() {
										var oId = $(this).parent().val();
										// 点击时，弹出另一个输入楼中楼回复的输入框
										// 创建一个div
										var bDiv = document.createElement('div');
										// 加属性
										$(bDiv).css({
											'position': 'fixed',
											'z-index':'200',
											'top':'30%',
											'left':'30%',
											'background-color':'#e7e7e7',
											'padding':'30px',
											'width':'500px',
											'border-radios':'20px',
											'box-shadow': '5px 5px 5px #C1C1C1',
										});
										// div插入页面
										document.body.appendChild(bDiv);
										// 创建输入框
										var aText = document.createElement('textarea');
										var aBtn = document.createElement('button');
										// 输入框属性
										$(aText).css({
											'width': '400px',
											'height': '200px',
										});
										$(aBtn).html('发表楼中楼回复');
										$(aBtn).css({
											'font-size':'16px',
											'padding':'5px',
											'background-color':'#ED62ED',
											'border-radios':'10px',
										});
										// 输入框插入div
										bDiv.appendChild(aText);
										bDiv.appendChild(aBtn);

										// 创建叉
										var aSpan = document.createElement('span');
										// 叉属性
										aSpan.style.fontSize = '50px';
										aSpan.innerHTML = '×';
										$(aSpan).css({
											'position': 'absolute',
											'top': '0',
											'right': '0',
										});
										// 插入页面
										bDiv.appendChild(aSpan);

										// 点击事件
										aSpan.onclick = del;
										function del() {
											document.body.removeChild(bDiv);
										}
										aBtn.onclick = reportS;
										function reportS()
										{
											aText = $(aText).val();
											if (aText.length == 0) {
												alert('评论不能为空');
												document.body.removeChild(bDiv);
											} else {
												$.ajax({
													type:'post',
													url:'/index/single/addReportII',
													data:{
														vid:<?php echo $_GET['vid']; ?>,
														pid:oId,
														content:aText,
													},
													dataType:'json',
													async:true,
													success:suc
												});
												function suc(data)
												{	
													var obj = JSON.parse(data);
													if (obj['msg'] == 'noLogin') {
														alert('请登录后再评论');
														document.body.removeChild(bDiv);
														return false;
													}
													if (obj['msg'] == 'noAdd') {
														alert('评论失败');
														document.body.removeChild(bDiv);
														return false;
													}
													window.location.reload();
												}
											}
										}
										return false;
									});
									// 完成-楼中楼输入框
									var mDiv = document.createElement('div');
									mDiv.className = 'media-left';
									var mDiv1 = document.createElement('div');
									mDiv1.className = 'media-body';
									lDiv.appendChild(mH5);
									lDiv.appendChild(mSpan);
									lDiv.appendChild(mA);
									lDiv.appendChild(mDiv);
									lDiv.appendChild(mDiv1);
									// 添加第三层标签
									var sA = document.createElement('a');
									var sP = document.createElement('p');
									sA.href = '/index/user/showMsg?whoID=' + obj['dataL'][i]['userid'];
									$(sP).html(obj['dataL'][i]['content']);
									mDiv.appendChild(sA);
									mDiv1.appendChild(sP);
									// 添加第四层标签
									var sImg = document.createElement('img');
									sImg.src = obj['dataL'][i]['photo'];
									$(sImg).css({
										'width': '65px',
										'height': '65px'
									});
									sA.appendChild(sImg);
									// 完成-主评论遍历展示
									for (var j =  0; j < obj['dataS'].length; j++) {
										// 楼中楼回复遍历展示，先确认展示条件
										if (obj['dataS'][j]['pid'] == obj['dataL'][i]['id']) {
											/// 添加第一层标签
											var sDiv = document.createElement('div');
											sDiv.className = 'media-child';
											$(sDiv).css({
												'margin': '10px 0 0 40px',
												'padding-left': '10px',
												'border-left': '2px solid #cdcdcd',
											});;
											sBox.appendChild(sDiv);
											// 添加第二层标签
											var mH5 = document.createElement('h5');
											$(mH5).html(obj['dataS'][j]['username']);
											$(mH5).css({
												'font-size': '14px',
												'margin':0,
												'color':'#21DEEF',
												'font-weight':'bolder',
											});
											var mSpan = document.createElement('span');
											$(mSpan).html(obj['dataS'][j]['create_time']);
											$(mSpan).css({
												'background-color': '#f7f7f7',
											});
											var mDiv = document.createElement('div');
											mDiv.className = 'media-left';
											var mDiv1 = document.createElement('div');
											mDiv1.className = 'media-body';
											sDiv.appendChild(mH5);
											sDiv.appendChild(mSpan);
											sDiv.appendChild(mDiv);
											sDiv.appendChild(mDiv1);
											// 添加第三层标签
											var sA = document.createElement('a');
											var sP = document.createElement('p');
											sA.href = '/index/user/showMsg?whoID=' + obj['dataS'][j]['userid'];
											$(sP).html(obj['dataS'][j]['content']);
											mDiv.appendChild(sA);
											mDiv1.appendChild(sP);
											// 添加第四层标签
											var sImg = document.createElement('img');
											sImg.src = obj['dataS'][j]['photo'];
											$(sImg).css({
												'width': '65px',
												'height': '65px'
											});
											sA.appendChild(sImg);
											// 完成-楼中楼回复遍历展示
										}
										
									}
									
								}

								// 把allpage的链接赋值到a标签上
								var oPage = obj['pages'];
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
									success:success
								});
							}
						</script>
						<!-- 完成-评论展示方法 -->
					</div>
				</div>
				<div class="col-md-3 single-right">
					<!-- 视频列表区域，需要遍历 -->
					<h3>推荐列表</h3>
					<div class="single-grid-right">
						<?php foreach($res as $vRes): if(!empty($vRes['0'])): ?>
						<div class="single-right-grids">
							<div class="col-md-4 single-right-grid-left">
								<a href="/index/single/single?vid=<?php echo $vRes['0']['id']; ?>"><img src="http://p3d4qx20z.bkt.clouddn.com/<?php echo $vRes['0']['pic']; ?>" alt="" /></a>
							</div>
							<div class="col-md-8 single-right-grid-right">
								<a href="/index/single/single?vid=<?php echo $vRes['0']['id']; ?>" class="title"><?php echo $vRes['0']['title']; ?></a>
								<p class="author"><?php echo $vRes['0']['up_name']; ?></p>
								<p class="views" style="color:#21DEEF;"><?php echo $vRes['0']['click_num'] / 2; ?>次浏览</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<?php endif; endforeach; ?>
					</div>
				</div>
				<!-- 完成-视频列表区域 -->
				<div class="clearfix"> </div>
			</div>
			<!-- 完成-视频播放页面 -->
	

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