<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\Reply as ReplyModel;
use think\Request;
use think\Db;
use think\Session;
class Reply extends Controller{
	public function reply()
	{
		$reply = new ReplyModel();
		$uname=Session::get('username');
		if(empty($uname))
			{
				
				$this->success('禁止翻墙','admin/login/login');

			}
		
		$res = Db::table('vedio_user u,vedio_rol r,vedio_user_rol ru')->field('u.id,u.username,r.rid_name,r.rid')->where('ru.id=u.id and ru.rid=r.rid and grade!=0  and grade!=1')->where('username',"$uname")->select();
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
		

		$list =$reply->name('reply')->paginate(3);
		//$list =ReportModel::paginate(3);
		$page = $list->render();
		$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re,'list'=>$list,'page'=>$page]);
		return $this->fetch();
		return $this->fetch();
	
	}
	////版主留言列表，删除
	public function  delete()
	{
		$request=Request::instance()->get();
		//$_GET
		//file_put_contents('2.php',$_GET);
		$del=Db::table('vedio_reply')->where($request)->delete();
		//file_put_contents('1.php', $del);
		if($del)
		{
			$this->redirect('admin/reply/reply');


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