<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\Logout as LogoutModel;
use think\Request;
use think\Db;
use think\Session;
class Logout extends Controller{
	 public function logout(){
        session(null);
        $this->success('退出成功','/admin/login/login');
    }


}