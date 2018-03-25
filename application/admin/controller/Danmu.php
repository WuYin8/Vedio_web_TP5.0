<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\Danmu as DanmuModel;
use think\Db;
use think\Session;
use think\Request;
use app\admin\controller\Page;
class Danmu extends Controller{
	public function danmu()
	{
		$uname=Session::get('username');
		if(empty($uname))
			{
				
				$this->success('禁止翻墙','admin/login/login');

			}
		//版主回复留言，分页
		$uname=Session::get('username');
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
		
		$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re]);
	return $this->fetch();
	}

	// ajax获取留言
	public function getDanmu()
	{
		$report = new DanmuModel();
		// 获取所有评论总数
		$numDanmu = $report->name('danmu')->count('did');
		// 启用分页类
		$page = new Page(10 , $numDanmu);
		// 获取分页url
		$pageUrl = $page->allPage();
		// 获取每页需要的数据
		$list =$report->name('danmu')->alias('d')->join('res r','d.vid=r.id')->limit($page->limit())->select();
		// 返回值到ajax
		$data['data'] = $list;
		$data['page'] = $pageUrl;
		return json_encode($data , JSON_UNESCAPED_UNICODE);
	}

	////版主留言列表，删除
	public function  delete()
	{
		$request=Request::instance()->get();
		//$_GET
		//file_put_contents('2.php',$_GET);
		$del=Db::name('danmu')->where($request)->delete();
		//file_put_contents('1.php', $del);
		if($del)
		{
			$this->redirect('admin/danmu/danmu');
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