<?php
namespace app\admin\controller;
use think\Controller;
use think\View;
use think\Db;
use think\Session;
use think\Request;
use app\admin\model\ Auth as AuthModel;
class Auth extends Controller
{ 
	public function auth(){

		//Session::set('backurl',substr($_SERVER['PHP_SELF'], 10));
		// rbac判断是否登录
		//$base = new AuthModel();
		//$base->isLogin();


		 $User= new AuthModel();  
      
        //print_r($arr);die;  
       //$r = new UserModel();

		$uname=Session::get('username');
		if(empty($uname))
			{
				
				$this->success('禁止翻墙','admin/login/login');

			}
		
	//查询user表中登陆用户的id
		// $id = Db::table('vedio_user')->where('id')->where('grade!=0 and grade!=4')->where('username',$_POST['username'])->where('password',$_POST['pwd'])->select();
	


		//查询用户的角色
	$res = Db::table('vedio_user u,vedio_rol r,vedio_user_rol ru')->field('u.id,u.username,r.rid_name,r.rid')->where('ru.id=u.id and ru.rid=r.rid and grade!=0  and grade!=1')->where('username',"$uname")->select();
		//dump($res);die;
	
	if ($res) {
		$rid=$res[0]['rid']; 
	} else {
		$this->success('禁止翻墙','admin/login/login');
	}
	 //dump($rid);die;
	 //查询用户权限
	 $result=Db::name('rol_auth')->alias('r')->where('rid',"$rid")->join('auth n','r.authid=n.authid')->where('pid=0')->select();
	//dump($result);die;
	 //小版块
	$re=Db::table('vedio_auth')->where('pid!=0')->select();
	//dump($re);die;
	//$sql = UserModel::getLastSql();
	//file_put_contents('10.php', $sql);
	//$list =$User->name('user')->paginate(3);
	//$page = $list->render();
	 

		//获取权限信息
		$permission = Db::table('vedio_auth')->field(['authid','auth_name','url','type'])->select();
		// dump($permission);
		// die;
		//获取用户总数
		$count = Db::table('vedio_auth')->field("count('authid') as count")->select();
		$this->assign('count',$count[0]);
		$this->assign('permission',$permission);
		$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re,'permission'=>$permission,]);
       // $this->assign('arr',$arr);  
       	return view(); 
	}
	//删除
	public function  delete()
	{
		$request=Request::instance()->get();
		//$_GET
		//file_put_contents('2.php',$_GET);
		$del=Db::table('vedio_auth')->where($request)->delete();
		//file_put_contents('1.php', $del);
		if($del)
		{
			$this->redirect('admin/auth/auth');


		}else
		{
			$this->error('删除失败');
		}

	}
	//增加用户
	public function add()
	{
		//获取表单数据
		$request =Request::instance()->post();
		file_put_contents('2.php', $request);
		$a= $request['auth_name'];
		$b= $request['type'];
		$c= $request['url'];
		file_put_contents('11.php', $c);
		
		//将权限名字权限路径权限描述插入权限表
		$data['auth_name'] = $a;
		$data['url'] = $b;
		$data['type'] = $c;
		//file_put_contents('12.php', json_encode($data));
		$res = Db::table('vedio_auth')->insertGetId($data);
		if ($res) {
			//2代表添加成功
			echo 2;
		}
	}
	//修改
	public function update()
	{
		$request =Request::instance()->post();
		//file_put_contents('11.php',$request);
		$id = $request['id'];	
		 //file_put_contents('16.php', $id);
		//修改的内容
		$content = $request['content'];	
		// file_put_contents('13.php', $content);
		//根据自定义属性的值获取到修改的字段	
		$sign = $request['sign'];		
       // file_put_contents('14.php', $sign);
		Db::table('vedio_auth')->where('authid', $id)->update([$sign => $content]);
		$sql = AuthModel::getLastSql();
		//file_put_contents('15.php', $sql);
	}

	 public function logout(){
        session(null);
        $this->success('退出成功','/admin/login/login');
    }


}