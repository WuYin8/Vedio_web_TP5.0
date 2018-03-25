<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\Pay as payModel;
use think\Db;
use think\Session;
use think\Request;
use app\admin\controller\Page;
class Pay extends Controller{
	public function pay()
	{
		$r = new PayModel();

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
	$list =$r->name('pay')->paginate(10);
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
		$del=Db::table('vedio_pay')->where($request)->delete();
		//file_put_contents('1.php', $del);
		if($del)
		{
			$this->redirect('admin/pay/pay');


		}else
		{
			$this->error('删除失败');
		}

	}
	public function logout(){
        session(null);
        $this->success('退出成功','/admin/login/login');
    }
}