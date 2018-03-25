<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\Report as ReportModel;
use think\Request;
use think\Session;
use think\Db;
use app\admin\controller\Page;
class Report extends Controller{
	public function report()
	{
		
		//版主回复留言，分页
		$report = new ReportModel();
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
		$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re]);
		return $this->fetch();
	
	}

	// ajax分页获取评论的方法
	public function getReports()
	{
		$report = new ReportModel();
		// 获取所有评论总数
		$numReports = $report->name('report')->where(['is_del'=>0])->count('id');
		// 启用分页类
		$page = new Page(10 , $numReports);
		// 获取分页url
		$pageUrl = $page->allPage();
		// 获取每页需要的数据
		$list =$report->name('report')->where(['is_del'=>0])->limit($page->limit())->select();
		// 返回值到ajax
		$data['data'] = $list;
		$data['page'] = $pageUrl;
		return json_encode($data , JSON_UNESCAPED_UNICODE);
	}
	//将评论放入回收站
	public function delete()
	{
		$request=Request::instance()->get();
		//file_put_contents('1.php', $request);
		$del = Db::table('vedio_report')->where($request)->update(['is_del'=>1]);
		
		if(!empty($del))
		{
			$this->redirect('admin/report/report');

		}else
		{
			$this->error('放入回收站失败');
		}


	}
	//回收站的恢复
	public function hreport()
	{
		//版主回复留言，分页
		$report = new ReportModel();
		$uname=Session::get('username');
		$res = Db::table('vedio_user u,vedio_rol r,vedio_user_rol ru')->field('u.id,u.username,r.rid_name,r.rid')->where('ru.id=u.id and ru.rid=r.rid and grade!=0  and grade!=1')->where('username',"$uname")->select();
		 $rid=$res[0]['rid']; 
	 //dump($rid);die;
	 //查询用户权限
	 $result=Db::name('rol_auth')->alias('r')->where('rid',"$rid")->join('auth n','r.authid=n.authid')->where('pid=0')->select();
	//dump($result);die;
	 //小版块
		$re=Db::table('vedio_auth')->where('pid!=0')->select();
		$list =$report->name('report')->where(['is_del'=>1])->paginate(10);
		$page = $list->render();
		$this->assign(['res'=>$res, 'result'=>$result,'re'=>$re,'list'=>$list,'page'=>$page]);
		return $this->fetch();
	
	}
	public function doHreport()
	{
		$request=Request::instance()->get();
		file_put_contents('1.php', $request);
		
		$del = Db::table('vedio_report')->where($request)->update(['is_del'=>0]);
		file_put_contents('2.php', $del);
		//$select = Db::table('vedio_report')->where(['is_del'=>0])->select();
		if(!empty($del))
		{
			$this->redirect('admin/report/hreport');

		}else
		{
			$this->error('恢复失败');
		}
	}
	//回收站的删除
	function doDelete()
	{
		$request=Request::instance()->get();
		
		$del=Db::table('vedio_report')->where($request)->delete();
		//file_put_contents('1.php', $del);
		if($del)
		{
			$this->redirect('admin/report/hreport');


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