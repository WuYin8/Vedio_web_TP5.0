<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\Login as LoginModel;
use think\Session;
use think\Db;
use app\admin\model\Base;
use app\admin\controller\Code;
class Login extends Controller{
    public function login()
    {
        return $this->fetch();
    }
    public function banner()
    {
        return $this->fetch();

    }
    //后台登陆判断
    public function dologin()
    {
        //获取账号
        /*echo 111;
        die;*/
        $data=[
            'username'=>$_POST['username'],
            'password'=>($_POST['pwd']),
        ];
         //dump($data);die;
        $pwd = $data['password'];
        $code = new Code($pwd);
        $pwd2 = $code->loading();
        $data['password'] = $pwd2;

        if(empty($data['username'])||empty($data['password'])){
            return json(['status'=>0,'msg'=>"请将内容填写完整",'url'=>'/admin/login/login']);
        }
        //查询用户角色
         $res=Db::name('user')->alias('a')->where('grade!=0  and grade!=1')->where(['username'=>$data['username'],'password'=>$data['password']])->join('user_rol b','b.id= a.id')->join('rol c','c.rid=b.rid')->select();
         if(!$res){
            return   $this->error("您没有权限登录",'/admin/login/login');
         }
         $rid=$res[0]['rid'];
         $rolename=$res[0]['rid_name'];
        // var_dump($rid);die;
         // 
         // 查询用户权限
         $res2=Db::name('rol_auth')->alias('r')->where('rid',"$rid")->join('auth n','r.authid=n.authid')->select();
         if($res2){
             Session::set('username',$data['username']);
            return  $this->redirect("/admin/user/index",'登陆成功');
         }else{
            return  $this->error('/admin/login/login',"您没有权限登录");
         }
     }
    }