<?PHP 
namespace app\index\controller;
use think\Controller;
use think\Db; 
use app\index\model\Sqlclass; // 遍历版块与目录使用
use app\index\controller\Code; // 密码加密使用

class Mail extends Controller
{
    // 默认展示页面
    function mail()
    {
        // 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);

        // 判断登录，已登录则跳转
        if (!empty(session('id'))) {
            $msgUp = '当前处于登录状态，请进入个人资料进行修改';
            $url = '/index';
            $url1 = '/index/user/index';
            $url2 = '/index';
            $msg1 = '前往个人资料';
            $msg2 = '继续回到主页';
            $i = 5; // 跳转时间
            $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
        }
        return $this->fetch();
    }

    // 请求邮件的方法
    function changEmail()
    {
        include 'mail/mail.php';
        // 获取表单内容进行判断
        if (!empty($_POST['inputName'])) {
            $username = $_POST['inputName'];
            $email = $_POST['inputEmail'];
            $resultName = DB::name('user')->where('username' , $username)->select();
                if ($resultName) {
                    // 用户名存在
                    $resultEmail = DB::name('user')->where('username' , $username)->value('email');
                    if ($resultEmail == '3') {
                        // 判断邮箱为第三方用户
                        $data['msg'] = 'three';
                        return json_encode($data , TRUE);
                    }
                    if ($resultEmail != $email) {
                        // 邮箱不相符
                        $data['msg'] = 'noEmail';
                        return json_encode($data , TRUE);
                    }
                    // 邮箱地址相符，发送邮件
                    $code = mt_rand(100000 , 999999); // 先生成验证码
                    session('codeEmail' , $code); // 验证码存到session中
                    $to = $email; // 获取发送邮箱地址
                    $title = '爱闪视频网-密码找回'; // 邮件标题
                    $content = "尊敬的" . $username . "用户，您好！您正在使用爱闪视频网的“忘记密码”功能修改密码，本次修改密码的验证码为：  " . $code . "  如本次并非本人操作，请及时修改个人信息，确保账户安全。";  // 邮件内容
                    $result = sendMails($to,$title,$content);
                    if ($result) {
                        $data['msg'] = 'getEmail';
                        return json_encode($data , TRUE);
                    } else {
                        $data['msg'] = 'shitEmail';
                        return json_encode($data , TRUE);
                    }

                } else {
                    // 用户名不存在
                    $data['msg'] = 'noName';
                    return json_encode($data , TRUE);
                }
        }
    }

    // 更改密码的方法
    function changePwd()
    {
        $inputCode = $_POST['inputCode'];
        $inputPwd = $_POST['inputPwd'];
        $username = $_POST['inputName'];
        // 判断验证码是正确
        if ($inputCode != session('codeEmail')) {
            // 验证码不正确
            $data['msg'] = 'wrongCode';
            return json_encode($data , TRUE);
        }
        // 验证码正确，存入密码 
        $pwd = new Code($inputPwd);
        $pwdNew = $pwd->loading();
        $result = DB::name('user')->where('username' , $username)->update(['password'=>$pwdNew]);
        // 销毁session
        session('codeEmail' , null);
        // 返回信息
        if ($result) {
            // 修改成功
            $data['msg'] = 'great';
            return json_encode($data , TRUE);
        } else {
            // 修改失败
            $data['msg'] = 'shit';
            return json_encode($data , TRUE);
        }
    }

    
}
