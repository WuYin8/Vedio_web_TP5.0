<?php

namespace app\index\controller;
use app\index\model\Liuyan; // 遍历留言所用model
use app\index\model\Res; // 遍历视频所用model
use app\index\model\Sqlclass; // 遍历版块与目录使用
use app\index\controller\Page; // 分页使用
use think\Controller;
use think\Db; // 查询用户数据用db
use app\index\controller\Code; // 密码加密使用
class User extends Controller
{

	// 个人中心默认展示页面
	public function index()
	{
		/*
			 首先对登录状况判断，
			 1. 未登录不予展示，直接退回首页，提示信息--登陆后才能访问
			 2. 区分来访者是本人还是访客
			 3. 确定是本人以后，根据管理员权限，展示后台入口
			 4. 第三方登录用户不允许登录个人中心
			 5. 个人资料页是根据url传参确定的，不是根据session确定的
		*/
		// 展示目录，版块
	        $sqlClass = new Sqlclass();
	        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
	        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
	        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);
		// 判断是否有账号登录
		if (empty(session('id'))) {
			$msgUp = '请登陆后再进入个人中心';
			$url = '/index';
		        $url1 = '/index';
		        $url2 = '/index';
		        $msg1 = '回到主页';
		        $msg2 = '去登录';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp ,'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}

		// 判断是否是第三方登录
		if (session('grade') == '会员') {
		 	$msgUp = '第三方登录用户没有管理资料的权限';
			$url = '/index';
		        $url1 = '/index';
		        $url2 = '/index';
		        $msg1 = '回到主页';
		        $msg2 = '注册本站账号';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp , 'url'=>$url,'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}

		// 判断是否是本人登录
		if (empty($_GET['userID'])) {
			$_GET['userID'] = session('id');
		}
		if (session('id') != $_GET['userID']) {
			$msgUp = '无法编辑他人资料';
			$url = '/index/user/index';
		        $url1 = '/index';
		        $url2 = '/index/user/index';
		        $msg1 = '回到主页';
		        $msg2 = '看看自己的资料';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp , 'url'=>$url ,'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}

		// 判断完成后提供个人资料需要的数据
		$username = DB::name('user')->where('id' , session('id'))->value('username');
		$email = DB::name('user')->where('id' , session('id'))->value('email');
		$phone = DB::name('user')->where('id' , session('id'))->value('phone');
		$password = DB::name('user')->where('id' , session('id'))->value('password');
		$this->assign(['email'=>$email , 'phone'=>$phone , 'username'=>$username]);
		 return $this->fetch();
	}

	// 获取个人投稿记录与个人消费记录
	public function getRes()
	{
		// 获取留言投稿需要的素材,分页
	          $user = new Res();
	          $resC = Res::where(['up_id'=>session('id') , 'is_pass'=>1])->count('id'); // 本页面所有留言数
	          $page = new Page(12 , $resC);
		
	          $pages = $page->allPage();
	          $Res = $user->where(['up_id'=>session('id') , 'is_pass'=>1])->order('create_time' , 'desc')->limit($page->limit())->select();
		$data['Res'] = $Res;
		$data['pages'] = $pages;

		// 获取消费记录需要的素材,分页
	          $payC = DB::name('pay')->where('uid' , session('id'))->count('id'); // 所有交易数量
	          $pageP = new Page(10 , $payC);
		
	          $pagesP = $pageP->allPage();
	          $pays = DB::name('pay')->where('uid' , session('id'))->order('create_time' , 'desc')->limit($pageP->limit())->select();
		$data['pay'] = $pays;
		$data['pagesP'] = $pagesP;

	          return json_encode($data , JSON_UNESCAPED_UNICODE);
	}

	// 更改个人资料
	public function changeInfo()
	{
		// 判断是否有账号登录
		if (empty(session('id'))) {
			$msgUp = '请登陆后再进入个人中心';
			$url = '/index';
		        $url1 = '/index';
		        $url2 = '/index';
		        $msg1 = '回到主页';
		        $msg2 = '去登录';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp ,'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}
		// 获得字段与值
		$names = $_POST['name'];
		$values = $_POST['value'];
		// 连接数据库
		$result = DB::name('user')->where('id' , session('id'))->update([$names=>$values]);
		if ($result) {
			$data['msg'] = '修改成功';
		} else {
			$data['msg'] = '未做修改';
		}
		// 更改页面显示的名字
		if ($names == 'username') {
			$newName = DB::name('user')->where('id' , session('id'))->value('username');
			session('username' , $newName);
		}
		// 更改页面显示的头像
		return json_encode($data , JSON_UNESCAPED_UNICODE);

	}

	// 更改密码
	public function changePwd()
	{
		// 展示目录，版块
	        $sqlClass = new Sqlclass();
	        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
	        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
	        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);
		// 判断是否有账号登录
		if (empty(session('id'))) {
			$msgUp = '请登陆后再进入个人中心';
			$url = '/index';
		        $url1 = '/index';
		        $url2 = '/index';
		        $msg1 = '回到主页';
		        $msg2 = '去登录';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp ,'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}
		// 获得新密码和旧密码
		$pwdOld = $_POST['pwdOld'];
		$pwdNew = $_POST['pwdNew'];
		// 对比旧密码是否正确
		$password = DB::name('user')->where('id' , session('id'))->value('password');
		$code = new Code($pwdOld);
		$code1 = $code->loading();
		if ($password !== $code1) {
			$data['msg'] = '旧密码错误';
			return json_encode($data , JSON_UNESCAPED_UNICODE);
		}
		// 数据库修改
		$code = new Code($pwdNew);
		$codeNew = $code->loading();
		$result = DB::name('user')->where('id' , session('id'))->update(['password'=>$codeNew]);
		if ($result) {
			$data['msg'] = '修改密码成功';
		} else {
			$data['msg'] = '密码未做修改';
		}
		return json_encode($data , JSON_UNESCAPED_UNICODE);
	}

	// 更换头像
	public function changePhoto()
	{
		// 展示目录，版块
	        $sqlClass = new Sqlclass();
	        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
	        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
	        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);
		// 判断是否有账号登录
		if (empty(session('id'))) {
			$msgUp = '请登陆后再进入个人中心';
			$url = '/index';
		        $url1 = '/index';
		        $url2 = '/index';
		        $msg1 = '回到主页';
		        $msg2 = '去登录';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp ,'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}
		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('image');
		if (empty($file)) {
			$msgUp = '未选择图片';
			$url = '/index/user/index';
		        $url1 = '/index/user/index';
		        $url2 = '/index';
		        $msg1 = '去往个人中心';
		        $msg2 = '回到主页';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
	     		return $this->fetch('notice/notice');
		}
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if ($info) {
			// 成功上传后 获取上传信息
			// 输出 文件格式
			$data['mime'] = $info->getExtension();
			// 判断文件格式
			$mimeArr = ['jpg' , 'jpeg' , 'png' , 'gif'];
			if (!in_array(strtolower($data['mime']), $mimeArr)) {
				$msgUp = '头像图片格式不正确';
				$url = '/index/user/index';
			        $url1 = '/index/user/index';
			        $url2 = '/index';
			        $msg1 = '去往个人中心';
			        $msg2 = '回到主页';
			        $i = 5; // 跳转时间
			        $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		     		return $this->fetch('notice/notice');
			}

			// 输出 从uploads底下开始的文件路径+文件名
			$data['path'] = str_replace('\\', '/', $info->getSaveName());
			// 输出 文件名
			$data['name'] = $info->getFilename();
			$path = '/uploads/' . $data['path'];
			// 上传到数据库
			$result = DB::name('user')->where('id' , session('id'))->update(['photo'=>$path]);
			if ($result) {
				session('photo' , $path);
			}
			$msgUp = '头像修改完成';
			$url = '/index/user/index';
		        $url1 = '/index/user/index';
		        $url2 = '/index';
		        $msg1 = '去往个人中心';
		        $msg2 = '回到主页';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}else{
			// 上传失败获取错误信息
			$msgFail =  $file->getError();
			$msgUp = '头像修改失败';
			$url = '/index/user/index';
		        $url1 = '/index/user/index';
		        $url2 = '/index';
		        $msg1 = '去往个人中心';
		        $msg2 = '回到主页';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}
	}

	// 删除视频
	public function delVideo()
	{
		// 判断是否有账号登录
		if (empty(session('id'))) {
			$msgUp = '请登陆后再进入个人中心';
			$url = '/index';
		        $url1 = '/index';
		        $url2 = '/index';
		        $msg1 = '回到主页';
		        $msg2 = '去登录';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp ,'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}
		$vID = $_POST['videoID'];
		// 连接数据库进行删除
		$resutl = DB::name('res')->where('id' , $vID)->delete();
		// 评论随之删除
		$delReport = DB::name('report')->where('vedio_id' , $vID)->delete();
		if ($resutl) {
			$data['msg'] = 'great';
		} else {
			$data['msg'] = 'noDel';
		}
		return json_encode($data , JSON_UNESCAPED_UNICODE);
	}

	// 个人留言板-展示
	public function showMsg()
	{
		// 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);
		// 判断是否有账号登录
		if (empty(session('id'))) {
			$msgUp = '请登陆后再进入留言板';
			$url = '/index';
		        $url1 = '/index';
		        $url2 = '/index';
		        $msg1 = '回到主页';
		        $msg2 = '去登录';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp ,'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}

		// 打开以后，现根据get的id，判断是谁的留言板
		if (empty($_GET['whoID'])) {
			$whoID = session('id');
		} else {
			$whoID = $_GET['whoID'];
		}
		$whoName = DB::name('user')->where('id' , $whoID)->value('username');
		$this->assign(['whoName'=>$whoName , 'whoID'=>$whoID]);
		return $this->fetch();
	}


	// 获取留言
	public function getMsg()
	{
		$whoID = $_GET['whoID'];
		// 获取留言展示需要的素材,分页
	          $user = new Liuyan();
	          $LiuyanC = Liuyan::where(['pid'=>$whoID , 'is_del'=>['=' , 0]])->count('id'); // 本页面所有留言数
	          $page = new Page(10 , $LiuyanC);
		
	          $pages = $page->allPage();
	          $Liuyan = $user->where(['pid'=>$whoID , 'is_del'=>['=' , 0]])->order('create_time' , 'desc')->limit($page->limit())->select();
		$data['liuyan'] = $Liuyan;
		$data['pages'] = $pages;
	          return json_encode($data , JSON_UNESCAPED_UNICODE);
	}

	// 增加留言
	public function addMsg()
	{
		// 判断是否有账号登录
		if (empty(session('id'))) {
			$msgUp = '请登陆后再进入留言板';
			$url = '/index';
		        $url1 = '/index';
		        $url2 = '/index';
		        $msg1 = '回到主页';
		        $msg2 = '去登录';
		        $i = 5; // 跳转时间
		        $this->assign(['msgUp'=>$msgUp ,'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
		        return $this->fetch('notice/notice');
		}
		$pid = $_GET['whoID'];
		$content = $_POST['content'];
		$photo = session('photo');
		$name = session('username');
		$user_id = session('id');
		$result = DB::name('liuyan')->insert(['user_id'=>$user_id , 'photo'=>$photo , 'name'=>$name , 'content'=>$content , 'pid'=>$pid]); 
		if ($result) {
			$data['msg'] = 'great';
		} else {
			$data['msg'] = 'noAdd';
		}
		return json_encode($data , JSON_UNESCAPED_UNICODE);
	}
}