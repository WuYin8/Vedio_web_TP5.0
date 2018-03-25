<?php  
namespace app\admin\controller;  
use think\View;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\admin\model\Sqlclass as Classmodel; 
class Sqlclass extends Controller {  
    //查询全部数据  
    public function sqlclass(){  
        //实例化model  
        $User= new Classmodel();  
        $arr = $User->sel_all();  
        //print_r($arr);die;  
       //$r = new UserModel();

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
	$list =$User->name('user')->paginate(3);
	$page = $list->render();
	$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re,'list'=>$list,'page'=>$page]);
        $this->assign('arr',$arr);  
       	return view();  
    }  
    public function delete()
    {

		$request=Request::instance()->get();
		//$_GET
		file_put_contents('55.php', $request);
		$del = Db::table('vedio_sqlclass')->where($request)->delete();
		
		if(!empty($del))
		{
			$this->redirect('admin/sqlclass/sqlclass');

		}else
		{
			$this->error('放入回收站失败');
		}

	}

	//假删除
	public function wdel()
	{
		$request=Request::instance()->get();
		//file_put_contents('1.php', $request);
		$del = Db::table('vedio_sqlclass')->where($request)->update(['status'=>0]);
		dump($del);
		if(!empty($del))
		{
			$this->redirect('admin/sqlclass/sqlclass');

		}else
		{
			$this->error('放入回收站失败');
		}


	}
	/*恢复*/
	public function huifu()
	{
		$request=Request::instance()->get();
		//file_put_contents('111.php', $request);
		$del = Db::table('vedio_sqlclass')->where($request)->update(['status'=>1]);
		dump($del);
		if(!empty($del))
		{
			$this->redirect('admin/sqlclass/sqlclass');

		}else
		{
			$this->error('失败');
		}


	}

	public function add(){
		$request = Request::instance()->post();
		//file_put_contents('333.php',$request);
		 $res=Db::table('vedio_sqlclass')->insert($request); 
		 if (!empty($res)) {
			$this->redirect('admin/sqlclass/sqlclass');
		}
	}

	 public function logout(){
        session(null);
        $this->success('退出成功','/admin/login/login');
    }


}  