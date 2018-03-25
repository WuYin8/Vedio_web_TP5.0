<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\User as UserModel;
use think\Request;
use think\Db;
use think\Session;
use traits\model\SoftDelete;
class User extends Controller
{
	public function index()
	{

		$r = new UserModel();

		$uname=Session::get('username');
	//查询user表中登陆用户的id
		// $id = Db::table('vedio_user')->where('id')->where('grade!=0 and grade!=4')->where('username',$_POST['username'])->where('password',$_POST['pwd'])->select();
	if(empty($uname))
			{
				
				$this->success('禁止翻墙','admin/login/login');

			}


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
	$list =$r->name('user')->paginate(10);
	$page = $list->render();
	$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re,'list'=>$list,'page'=>$page]);
	return $this->fetch();


	}
	//删除
	public function delete()
	{
		$request=Request::instance()->get();
		//$_GET
		//file_put_contents('2.php',$_GET);
		$del=Db::table('vedio_user')->where($request)->delete();
		//file_put_contents('1.php', $del);
		if($del)
		{
			$this->redirect('admin/user/index');


		}else
		{
			$this->error('删除失败');
		}

	}
 

	//禁用方法，修改is_defirend=》1
	public function doStop()
	{

		$request=Request::instance()->get();
		//file_put_contents('2.php',$_GET);

		//file_put_contents('3.php', ['is_defirend'=>0])
		//dump(['is_defirend'=>0]);
		$up = Db::table('vedio_user')->where($request)->update(['is_defirend'=>1]);
		dump($up);
		//file_put_contents('1.php', $up);
		if($up)
		{

			$this->redirect('admin/user/index');


		}else
		{
			$this->error('禁用失败');
		}


	}
	//启用用F方法，修改is_defirend=》0
	public function doStart()
	{
		$request=Request::instance()->get();
		//file_put_contents('2.php',$_GET);
		//file_put_contents('3.php', ['is_defirend'=>0])
		//dump(['is_defirend'=>0]);
		$up = Db::table('vedio_user')->where($request)->update(['is_defirend'=>0]);
		dump($up);
		//file_put_contents('1.php', $up);
		if($up)
		{
			$this->redirect('admin/user/index');


		}else
		{
			$this->error('启用失败');
		}


	}
	//管理员信息表，3表联合查查询
	public function gly()
	{
		
		//$list = UserModel::paginate(2);
		//$list = Db::table('vedio_user')->where('grade != 0 and grade !=1')->select();
		//dump($list);
		/*$list =Db::field('ru.id , r.rid_name, u.*')->table('vedio_user u, vedio_rol r, vedio_user_rol ru')->where('u.grade = ru.rid and ru.id = r.rid')->where('u.grade != 0 and u.grade !=1')->paginate(3);*/
		$r = new UserModel();

		$uname=Session::get('username');
	//查询user表中登陆用户的id
		// $id = Db::table('vedio_user')->where('id')->where('grade!=0 and grade!=4')->where('username',$_POST['username'])->where('password',$_POST['pwd'])->select();
	if(empty($uname))
			{
				
				$this->success('禁止翻墙','admin/login/login');

			}
	//查询user表中登陆用户的id
		// $id = Db::table('vedio_user')->where('id')->where('grade!=0 and grade!=4')->where('username',$_POST['username'])->where('password',$_POST['pwd'])->select();
	


		//查询用户的角色
	$res = Db::table('vedio_user u,vedio_rol r,vedio_user_rol ru')->field('u.id,u.username,r.rid_name,r.rid')->where('ru.id=u.id and ru.rid=r.rid and grade!=0  and grade!=1')->where('username',"$uname")->select();
		//dump($res);die;
	
	 $rid=$res[0]['rid']; 
	 //dump($rid);die;
	 //查询用户权限
	 $result=Db::name('rol_auth')->alias('r')->where('rid',"$rid")->join('auth n','r.authid=n.authid')->where('pid=0')->select();
	//dump($result);die;
	 //小版块
	$re=Db::table('vedio_auth')->where('pid!=0')->select();

		$list = Db::table('vedio_user u,vedio_rol r,vedio_user_rol ru')->field('u.id,u.username,u.password,u.phone,u.is_defirend,r.rid_name')->where('ru.id=u.id and ru.rid=r.rid and grade!=0 and grade!=1')->paginate(3);
		//$sql = UserModel::getLastSql();
		//var_dump($sql);
		$page = $list->render();
		$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re,'list'=>$list,'page'=>$page]);
	return $this->fetch();


	}
	//用户角色的删除
	public function del()
	{
		$request=Request::instance()->get();
		//$_GET
		file_put_contents('2.php',$_GET);
		$del=Db::table('vedio_user')->where($request)->delete();
		file_put_contents('1.php', $del);
		if($del)
		{
			$this->redirect('admin/user/gly');


		}else
		{
			$this->error('删除失败');
		}

	}
	//用户角色的增加
	public function gly_Insert()
	{
		$uname=Session::get('username');
	//查询user表中登陆用户的id
		// $id = Db::table('vedio_user')->where('id')->where('grade!=0 and grade!=4')->where('username',$_POST['username'])->where('password',$_POST['pwd'])->select();
	if(empty($uname))
			{
				
				$this->success('禁止翻墙','admin/login/login');

			}
	//查询user表中登陆用户的id
		// $id = Db::table('vedio_user')->where('id')->where('grade!=0 and grade!=4')->where('username',$_POST['username'])->where('password',$_POST['pwd'])->select();
	


		//查询用户的角色
	$res = Db::table('vedio_user u,vedio_rol r,vedio_user_rol ru')->field('u.id,u.username,r.rid_name,r.rid')->where('ru.id=u.id and ru.rid=r.rid and grade!=0  and grade!=1')->where('username',"$uname")->select();
		//dump($res);die;
	
	 $rid=$res[0]['rid']; 
	 //dump($rid);die;
	 //查询用户权限
	 $result=Db::name('rol_auth')->alias('r')->where('rid',"$rid")->join('auth n','r.authid=n.authid')->where('pid=0')->select();
	//dump($result);die;
	 //小版块
	$re=Db::table('vedio_auth')->where('pid!=0')->select();
		$res=Db::name('rol')->where('rid!=0 and rid!=1' )->order('rid','desc')->select();
		//dump($re);
	$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re]);
	return $this->fetch();

	}
	
	//添加管理员角色
	public function add(){
		
		$data=[
			'username'=>$_POST['name'],
			'password'=>$_POST['pass'],
			'phone'=>$_POST['phone'],
			'email'=>$_POST['email'],
			'grade' =>$_POST['rid'],
			
		];
		//file_put_contents('1.php', $data);
		$res=Db::table('vedio_user')->insertGetId($data);
		$data2=[
			'id'=>"$res",
			'rid'=>$_POST['rid'],
		];
		//file_put_contents('2.php', $data2);
		$r=Db::table('vedio_user_rol')->insert($data2);
		


	}
	//管理员角色
	/*public function rol(){
		//查询角色，并进行分页
		$data = Db::table('vedio_rol')->where('vedio_rol.rid!=0 and vedio_rol.rid!=1')->order('rid')->paginate(3);
		$page = $data->render();
		//角色所拥有的权限查询   角色，权限，角色权限，  俩id关联，遍历出来  
		$ret = Db::table('vedio_rol r,vedio_rol_auth rp,vedio_auth p')->where('rp.rid = r.rid  and rp.authid = p.authid and r.rid!=0 and r.rid!=1')->field('r.rid_name,p.auth_name,r.rid')->select();
		$this->assign('ret',$ret);
		$this->assign('data',$data);		
		$this->assign('page',$page);
		//总数
		$count =  Db::table('vedio_rol')->order('rid')->count('rid');
		$this->assign('count',$count);
		return $this->fetch();
	}*/
	public function rol()
	{
		
		//查询权限
		$uname=Session::get('username');
	//查询user表中登陆用户的id
		// $id = Db::table('vedio_user')->where('id')->where('grade!=0 and grade!=4')->where('username',$_POST['username'])->where('password',$_POST['pwd'])->select();
	


		//查询用户的角色
	$res = Db::table('vedio_user u,vedio_rol r,vedio_user_rol ru')->field('u.id,u.username,r.rid_name,r.rid')->where('ru.id=u.id and ru.rid=r.rid and grade!=0  and grade!=1')->where('username',"$uname")->select();
		//dump($res);die;
	
	 $rid=$res[0]['rid']; 
	 //dump($rid);die;
	 //查询用户权限
	 $result=Db::name('rol_auth')->alias('r')->where('rid',"$rid")->join('auth n','r.authid=n.authid')->where('pid=0')->select();
	//dump($result);die;
	 //小版块
	$re=Db::table('vedio_auth')->where('pid!=0')->select();
		// dump($res);
		 $res2=Db::name('auth')->alias('n')->join('rol_auth rn','rn.authid= n.authid')->join('rol c','c.rid=rn.rid')->select();
		$permission = Db::table('vedio_auth')->field(['authid','auth_name'])->select();
		//获取角色列表
		$role = Db::table('vedio_rol')->field(['rid','rid_name'])->where('rid!=0 and rid!=1 and  rid!=4')->select();
		// 查询角色的总数量
		$count = Db::table('vedio_rol')->field("count('rid') as count")->select();
		$this->assign('count',$count[0]);
		$this->assign('res2',$res2);
		$this->assign('role',$role);
		$this->assign('permission',$permission);
			$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re]);
		return view();
	}
	public function ad()
	{
		//获取表单数据
		$name = $_POST['rname'];
		file_put_contents('4.php',$name);
		
		$perid = $_POST['per'];
		file_put_contents('5.php', $perid);
		// dump($_POST);
		// die;
		//将角色名字，描述，对应父id插入到角色表
		$data['rid_name'] = $name;
		
		Db::table('vedio_rol')->insert($data);
		//获取id
		$roleId = Db::table('verdio_rol')->getLastInsID();
		//将角色id和表单权限id插入角色权限表
		$result['rid'] = $roleId;
		foreach ($perid as $key => $value) {
			$result['authid'] = $value;
			Db::table('vedio_rol_auth')->insert($result);
		}
		$res = Db::table('vedio_user_rol')->getLastInsID();
		if ($res) {
			//2代表添加成功
			$this->redirect('/admin/user/rol');
		}
	}
	//角色删除
	public  function roldel()
	{
		//获取ajax传值的id
		$rid = $_POST['id'];
		file_put_contents('1.php',$rid);
		//根据id删除角色表
		 Db::table('vedio_rol')->where('rid',$rid)->delete();
		 //删除角色用户表中的内容
		 Db::table('vedio_user_rol')->where('rid',$rid)->delete();
		 //删除角色权限表中内容
		 Db::table('vedio_rol_auth')->where('rid',$rid)->delete();

	}
	//判断ajax的权限id是否已经存在
	public function per()
	{
		$authid = $_POST['content'];
		$res = Db::table('vedio_auth')->where('authid',$authid)->select();
		if ($res) {
			//9说明有值，可以添加权限
			echo 9;
		} else {
			//8说明没有值，不能添加
			echo 8;
		}
	}
	public function update()
	{
		$rid = $_POST['id'];
		file_put_contents('11.php', $rid);
		//修改的内容
		$content = $_POST['content'];	
		file_put_contents('12.php', $content);
		//根据自定义属性的值获取到修改的字段	
		$sign = $_POST['sign'];		
        file_put_contents('10.php', $sign);
		Db::table('vedio_rol')->where('rid', $rid)->update([$sign => $content]);
	}
	//修改用户权限
	public function upper()
	{
		$uname=Session::get('username');
			//查询用户的角色
	$res = Db::table('vedio_user u,vedio_rol r,vedio_user_rol ru')->field('u.id,u.username,r.rid_name,r.rid')->where('ru.id=u.id and ru.rid=r.rid and grade!=0  and grade!=1')->where('username',"$uname")->select();
		//dump($res);die;
	
	 $rid=$res[0]['rid']; 
	 //dump($rid);die;
	 //查询用户权限
	 $result=Db::name('rol_auth')->alias('r')->where('rid',"$rid")->join('auth n','r.authid=n.authid')->where('pid=0')->select();
	//dump($result);die;
	 //小版块
	$re=Db::table('vedio_auth')->where('pid!=0')->select();
	//dump($re);die;
	//$sql = UserModel::getLastSql();
	//file_put_contents('10.php', $sql);
		//获取角色id
		file_put_contents('3.php', $_GET);
		$rid = $_GET['id'];
		//获取角色
		file_put_contents('6.php', $rid);
		//查询角色表
		$rolename = Db::table('vedio_rol')->field(['rid','rid_name'])->where('rid',$rid)->find()['rid_name'];
		//查询对应的权限
		$p = Db::table('vedio_rol_auth')->field(['authid','rid'])->where('rid',$rid)->select();
		$pid = [];
		foreach ($p as $key => $value) {
			$pid[$value['authid']] = $value;
		}
		// dump($perid);
		//查询所有权限名字
		$pername = Db::table('vedio_auth')->field(['auth_name','authid'])->select();
		// dump($pername);
		$this->assign('rid',$rid);
		$this->assign('rolename',$rolename);
		$this->assign('pid',$pid);
		$this->assign('pername',$pername);
			$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re]);
		return view();
	}
	public function doupdate()
	{
		//获取到角色id和权限id
		$rid = $_POST['rid'];
		$pid = $_POST['per'];
		//清空当前角色的所有的权限
		Db::table('vedio_rol_auth')->where('rid',$rid)->delete();
		//将表单中修改后的权限重新插入数据库
		$data = [];
		$res = [];
		foreach ($pid as $value) {
			$data['rid'] = $rid;
			$data['authid'] = $value;
			$res = Db::table('vedio_rol_auth')->insert($data);
		}
		if ($res) {
			//2代表添加成功
			$this->redirect('/admin/user/rol');
		}else{
			$this->error('修改失败');
		}
	}
	
 public function logout(){
        session(null);
        $this->success('退出成功','/admin/login/login');
    }

	
}