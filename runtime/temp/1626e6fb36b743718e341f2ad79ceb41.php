<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/home/wwwroot/aishan.clwub.xin/public/../application/admin/view/login/login.html";i:1519741877;}*/ ?>

<!-- saved from url=(0066)http://www.17sucai.com/preview/171072/2016-10-18/login1/index.html -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>后台登陆</title>
<link href="/static/css1/style2.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/static/js/jquery-1.11.3.min.js"></script>
</head>

<body>
<div id="web">
<p style="height:180px;"></p>
<p align="center">管理员请登录吧！！</p>
<p style="height:40px;"></p>
<div class="login">
   <div class="banner">
   <iframe id="frame_banner" src="banner.html" height="218" width="100%" allowtransparency="true" title="test" scrolling="no" frameborder="0"></iframe>
   </div>
   <form action="dologin" method="post">
       <div class="logmain">
          <h1>&nbsp;</h1>
          <div class="logdv">
             <span class="logzi">账 号：</span>
            <input name="username" type="text" id="username" class="ipt" placeholder="请输入用户名" ><br /><span id="tip"  style="position: absolute;color: tomato;font-size: 15px;"></span>
          </div>
          <div class="logdv">
          <span class="logzi" style="margin-top:10px">密 码：</span><br /><span id="pwd" style="position: absolute;color: tomato;font-size: 15px;margin-top: 25px;margin-left: 50px;" ></span>
            <input name="pwd" type="password" id="pwd" class="pwd" style="width:190px;height:26px;margin-left: 50px;margin-top: -10px"  placeholder="admin">
          </div>
         
          <div class="logdv" style="height:40px;">
            <p class="logzi">&nbsp;</p>    
            <input name="提交" type="submit" class="btnbg"id="btnbg" value="点击登录" style="background:blue;margin-top: 20px;margin-left: 50px">
          </div>

         
        </div>
   </form>
   <div class="footer">
    <p><a href="/index" data-toggle="tooltip" data-placement="left">回到前台 →</a></p>
  </div>
</div>
<p style="height:100px;"></p>
<p align="center">爱闪视频网</p>
</div>
<!-- <script type="text/javascript">
  $('.ipt').blur(function(){
    var method = $('form').attr('method');
    var value=$('#username').val();
    //var pwd=$('#pwd').val();
    $.ajax({
      type:method,
      url:'/admin/login/doLogin',
     

      data:{username:value},
      success:success
  });
    return false;
});
  
 function success(data)
 {
  //console.log(111);


  console.log(data);
      //判断传过来的数据不能为空
        if(data.state==0)
        {
          $('#tip').html('账号正确');
         

        }
        
          else{
            $('#tip').html('账号错误');
            
          }

         
      //判断传过来的密码与账号是否一致
 }
 
 //密码展示
 $('.pwd').blur(function(){
   var value=$('#username').val();
   var pwd=$('#pwd').val();
  $.ajax({
    type:'post',
    url:'/admin/login/loginPwd',
    data:{username:value,
          password:pwd},
    success:successPwd
   });
  return false;
 });
 function successPwd(data)
 {
  //console.log(data);
  if(data=='1')
  {
    $('#pwd').html('密码与账号一致');
    $('.btnbg').attr('disabled',false);
    
  }else{
    $('#pwd').html('密码与账号不一致');
    $('.btnbg').attr('disabled',true);
    
  }
 

 }
  
</script>
 -->
 <script>
 $('[data-toggle="tooltip"]').tooltip();

$('#btnbg').click(function(){
  if($('#username').val() === ''){
    $(this).text('用户名不能为空');
  }else if($('#pwd').val() === ''){
    $(this).text('密码不能为空');
  }else{
    $(this).text('请稍后...');
  }
});
</script>

</body></html>