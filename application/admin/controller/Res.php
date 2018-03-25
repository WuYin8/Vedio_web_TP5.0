<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\Res as ResModel;
use think\Request;
use think\Session;
use think\Db;
class Res extends Controller{
	public function res()
	{
		//版主回复留言，分页
		$r = new ResModel();
		$uname=Session::get('username');
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
	$list =$r->where(['is_pass'=>1])->paginate(10);
	$page = $list->render();
	$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re,'list'=>$list,'page'=>$page]);
	return $this->fetch();
	
	}

	
	public function delete()
	{
		$request=Request::instance()->get();
		
		$del=Db::table('vedio_res')->where($request)->delete();
		//file_put_contents('1.php', $del);
		if($del)
		{
			$this->redirect('admin/res/res');


		}else
		{
			$this->error('删除失败');
		}


	}
	//视频放入回收站
	public function huires()
	{
		$request=Request::instance()->get();
		file_put_contents('1.php', $request);
		$del = Db::table('vedio_res')->where($request)->update(['is_pass'=>0]);
		$sql = ResModel::getLastSql();
		file_put_contents('2.php', $sql);
		if(!empty($del))
		{
			$this->redirect('admin/res/res');

		}else
		{
			$this->error('放入回收站失败');
		}

	}
	//视频修改付费模式
	public function changePay()
	{
		$request=Request::instance()->get();
		file_put_contents('1.php', $request);
		// 获取视频目前的付费模式
		$nowPay = Db::table('vedio_res')->where($request)->value('is_pay');
		if ($nowPay == 1) {
			$del = Db::table('vedio_res')->where($request)->update(['is_pay'=>0]);
		} else if ($nowPay == 0) {
			$del = Db::table('vedio_res')->where($request)->update(['is_pay'=>1]);
		}
		$sql = ResModel::getLastSql();
		file_put_contents('2.php', $sql);
		if(!empty($del))
		{
			$this->redirect('admin/res/res');

		}else
		{
			$this->error('修改付费模式失败');
		}

	}
	//
	public function hres()
	{
		//版主回复留言，分页
		$r = new ResModel();
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
	$list =$r->where(['is_pass'=>0])->paginate(3);
	$page = $list->render();
	$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re,'list'=>$list,'page'=>$page]);
	return $this->fetch();
	}
	//恢复
	public function dohres()
	{
		$request=Request::instance()->get();
		file_put_contents('4.php', $request);
		
		$del = Db::table('vedio_res')->where($request)->update(['is_pass'=>1]);
		$sql = ResModel::getLastSql();
		file_put_contents('5.php', $sql);
		//$select = Db::table('vedio_report')->where(['is_del'=>0])->select();
		if(!empty($del))
		{
			$this->redirect('admin/res/hres');

		}else
		{
			$this->error('恢复失败');
		}
	}
	//回收站视频删除
	public function dodelete()
	{
		$request=Request::instance()->get();
		
		$del=Db::table('vedio_res')->where($request)->delete();
		//file_put_contents('1.php', $del);
		if($del)
		{
			$this->redirect('admin/res/hres');


		}else
		{
			$this->error('删除失败');
		}


	}
	//视频上传
	public function sc()
	{
		return $this->fetch();
	}

	 public function logout(){
        session(null);
        $this->success('退出成功','/admin/login/login');
    }


}