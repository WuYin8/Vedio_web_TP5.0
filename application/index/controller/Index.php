<?php
namespace app\index\controller;
use think\Controller;
use think\Db; // 插入用户数据用db
use app\index\controller\Ucpaas; // 短信验证码使用
use app\index\controller\Code; // 密码加密使用
use app\index\controller\Open51094; // 第三方登录使用
use app\index\model\Sqlclass; // 遍历版块与目录使用
class Index extends Controller
{
    // 默认展示的主页方法
    public function index()
    {
        // 默认需要数据-满足首页的视频展示，包括排行版，随机，每个版块
        // 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);

        // 随机视频的展示方法
         $randID = DB::name('res')->select();
          $randID = array_rand($randID , 12);
          $randRes = [];
          for ($i = 0 ; $i < 12 ; $i++) 
          {
               $randRes[] = DB::name('res')->where('id' , $randID[$i])->select();
          }
          $this->assign(['randRes'=>$randRes]);

          // 获取排行榜视频展示需要的素材
          $noTime = DB::name('res')->order('create_time' , 'desc')->limit('3')->select();
          $noLike = DB::name('res')->order('like_num' , 'desc')->limit('3')->select();
          $noClick = DB::name('res')->order('click_num' , 'desc')->limit('3')->select();
          $this->assign(['noTime'=>$noTime , 'noLike'=>$noLike , 'noClick'=>$noClick]);

          // 获取频道视频展示需要的素材
          $j = 0;
          $childID = [];
          $childRes = [];
          foreach ($bigClass as $key => $value) {
            // 先获取大版块下的小版块id（数组形式）
              $childID[] = DB::name('sqlclass')->where('pid' , $value['id'])->column('id');
            // 再根据小版块id去找所有属于大版块的视频（where条件里的in，注意）
              $childRes[] = DB::name('res')->where('sid' , 'in' , $childID[$j])->limit('4 ')->order('create_time' , 'desc')->select();
              $j++;
          }
          // dump($childRes);
          $this->assign(['childRes'=>$childRes]);

        return $this->fetch();
    }

    // 第三方登录的方法
    public function three()
    {
        /*
            使用第三方登录的用户，不用有上传视频的权限，不可以直接使用账户名在本站登录（拉黑判定）
            若数据库中没有数据则创建，有数据则确认登录
        */
        $open = new Open51094();
        $code = $_GET['code'];
        $dataThree =  $open->me($code);
        // 为第三方登录用户配置ID 与其他数据库需要的参数
        $username = $dataThree['from'] . '_' . $dataThree['name'];
        $password = 'san';
        $phone = 3;
        $email = 3;
        // 判断是否需要注册，还是直接登录
        $result = DB::name('user')->where('username' , $username)->find();
        if ($result) {
            // 数据库中已存在，直接执行登录
        
        } else {
            // 若数据库中不存在，先执行添加，再执行登录
            $result = DB::name('user')->insert(['username'=>$username , 'password'=>$password , 'email'=>$email , 'phone'=>$phone , 'grade'=>0 , 'is_send'=>1 , 'is_defirend'=>1]); 
        }
        session('username', $username);
        $id = DB::name('user')->where('username' , $username)->value('id');
        session('id', $id);
        $photo = DB::name('user')->where('username' , $username)->value('photo');
        session('photo', $photo);
        $grade = DB::name('user')->where('username' , $username)->value('grade');
        if ($grade == 1) {
            $gradeName = '普通会员';
        } else if ($grade >= 2) {
            $gradeName = '管理员';
        } else if ($grade == 0) {
            $gradeName = '会员';
        }
        session('grade', $gradeName);
        // 登陆完成后，跳转回主页
        $msgUp = '第三方登录完成，正在跳转回主页';
        $url = '/index';
        $url1 = '/index';
        $url2 = '/index';
        $msg1 = '回到主页';
        $msg2 = '继续回到主页';
        $i = 0; // 跳转时间
        $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);

        // 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);
        
        return $this->fetch('notice/notice');
    }

    // 登录用的方法
    public function login()
    {
    	// 判断注册需要数据，不同的值代表不同的错误情况
        $username = input('post.username');
        $password = input('post.password');
        // 用户名是否注册
        $result = DB::name('user')->where('username' , $username)->find();
        if ($result) {
        } else {
            $data['msg'] = 'noN';
            return json_encode($data , JSON_UNESCAPED_UNICODE);
        }
        // 密码是否正确
        $result = DB::name('user')->where('username' , $username)->value('password');
        $code = new Code($password);
        $code1 = $code->loading();
        if ($result !== $code1) {
            $data['msg'] = 'wrongP';
            return json_encode($data , JSON_UNESCAPED_UNICODE);
        }
        // 是否被拉黑
        $shitList = DB::name('user')->where('username' , $username)->value('is_defirend');
        if ($shitList == 1) {
            $data['msg'] = 'shit';
            return json_encode($data , JSON_UNESCAPED_UNICODE);
        }
        // 需要展示的session值，id，用户名，头像，权限
        session('username', $username);
        $id = DB::name('user')->where('username' , $username)->value('id');
        session('id', $id);
        $photo = DB::name('user')->where('username' , $username)->value('photo');
        session('photo', $photo);
        $grade = DB::name('user')->where('username' , $username)->value('grade');
        if ($grade == 1) {
            $gradeName = '普通会员';
        } else if ($grade >= 2) {
            $gradeName = '管理员';
        } else if ($grade == 0) {
            $gradeName = '会员';
        }
        session('grade', $gradeName);

        $data['msg'] = 'great';
        return json_encode($data , JSON_UNESCAPED_UNICODE);
    }

    // 注册用的方法
    public function register()
    {
    	// 判断注册需要数据，不同的值代表不同的错误情况
        $scode = session('code');
        $username = input('post.username');
        $password = input('post.password');
        $email = input('post.email');
        $phone = input('post.phone');
        $code = input('post.code');
        // 验证码是否获取
        if (empty(session('code'))) {
            $data['msg'] = 'noC';
            return json_encode($data , JSON_UNESCAPED_UNICODE);
        }
        // 用户名是否注册
         $result = DB::name('user')->where('username' , $username)->find(); 
        if ($result) {
            $data['msg'] = 'haveN';
            return json_encode($data , JSON_UNESCAPED_UNICODE);
        }
        // 邮箱是否注册
        $result = DB::name('user')->where('email' , $email)->find();
        if ($result) {
            $data['msg'] = 'haveE';
            return json_encode($data , JSON_UNESCAPED_UNICODE);
        }
        // 手机号是否注册
        $result = DB::name('user')->where('phone' , $phone)->find();
        if ($result) {
            $data['msg'] = 'haveP';
            return json_encode($data , JSON_UNESCAPED_UNICODE);
        }
        // 验证码输入是否正确
        if ($code !== $scode) {
            $data['msg'] = 'wrongC';
            return json_encode($data , JSON_UNESCAPED_UNICODE);
        }
        // 密码加密
        $code = new Code($password);
        $password = $code->loading();
        // 数据库插入是否成功
       $result = DB::name('user')->insert(['username'=>$username , 'password'=>$password , 'email'=>$email , 'phone'=>$phone]); 

        $data['msg'] = 'great';
        return json_encode($data , JSON_UNESCAPED_UNICODE);
    }

    // 退出用的方法
    public function logout()
    {
        // 需要销毁的session值，id，用户名，头像，权限
        session(null);
    }

    // 点击获取短信，调用接口
    function Code()
    {
        //初始化必填
        $options['accountsid']='19a6efc75833a611174be919347c4e48';
        $options['token']='0cebe3d404b6405cba9412dcdaac438c';

        //初始化 $options必填
        $ucpass = new Ucpaas($options);
        //开发者账号信息查询默认为json或xml
        header("Content-Type:text/html;charset=utf-8");


        //封装验证码
        $str = '1234567890123567654323894325789';
        $code = substr(str_shuffle($str),0,5);
        session('code', $code); 
        //短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
        $appId = "5957fe0cfb234f68bff623c7fcded2f8";
        $to = $_GET['phone'];

        $templateId = "279577";
        //这就是验证码
        $param=$code;
        $word = $ucpass->templateSMS($appId,$to,$templateId,$param); 
        file_put_contents('1.txt', $word);
         $data['msg'] = 'hello';
         return json_encode($data , JSON_UNESCAPED_UNICODE);
    }

    public function class()
    {
         // 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);

        // 页面需要，先做大版块的默认展示，再做小版块的选择展示
        // 收到id后，先判断是否是大版块，不是大版块的话就跳转到大版块的地址，
        if (empty($_GET['cid'])) {
            $msgUp = '未选择版块';
            $url = '/index';
            $url1 = '/index';
            $url2 = '/index';
            $msg1 = '回到主页';
            $msg2 = '继续回到主页';
            $i = 0; // 跳转时间
            $this->assign(['msgUp'=>$msgUp , 'url'=>$url,'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
            return $this->fetch('notice/notice');
        }

        // 判断输入的id是否存在
        $classID = $_GET['cid'];
        $classTitle = DB::name('sqlclass')->where(['id'=>$classID , 'status'=>'1'])->value('name');
        if ($classTitle) {
            // 存在，继续下一步
        } else {
            $msgUp = '未选择版块';
            $url = '/index';
            $url1 = '/index';
            $url2 = '/index';
            $msg1 = '回到主页';
            $msg2 = '继续回到主页';
            $i = 0; // 跳转时间
            $this->assign(['msgUp'=>$msgUp , 'url'=>$url,'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
            return $this->fetch('notice/notice');
        }

        // 判断输入的是大版块还是小版块,统一转为大版块ID
        $classPid = DB::name('sqlclass')->where(['id'=>$classID , 'status'=>'1'])->value('pid');
        if ($classPid > 0) {
            // 如果url里是小版块
            $cID = $classID; // 小版块的id
            $pID = $classPid; // 大版块的id
        } else if ($classPid == 0) {
           // 如果是大版块的id，要获取默认展示的小版块的id来继续上述步骤
            $pID = $classID; // 大版块的id
            $cID = DB::name('sqlclass')->where(['pid'=>$pID , 'status'=>'1'])->value('id'); // 小版块的id
        }
        // 获取大版块标题
        $bigTitle = DB::name('sqlclass')->where('id', $pID)->value('name');
        // 获取所有小版块标题和id
        $littleTitles = DB::name('sqlclass')->where(['pid'=>$pID , 'status'=>'1'])->select();
        // 连接网页
        $this->assign(['cID'=>$cID , 'pID'=>$pID , 'bigTitle'=>$bigTitle , 'littleTitles'=>$littleTitles ]);
        return $this->fetch();

        // $this->assign();
        // return $this->fetch();
    }

}
