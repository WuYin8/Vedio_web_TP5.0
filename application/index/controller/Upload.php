<?php
namespace app\index\controller;
// 链接七牛云的自动加载
require_once __DIR__ . '../../../../php-sdk-master/autoload.php'; 
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;

use think\Controller;
use think\Db;
use app\index\model\Sqlclass; // 遍历版块与目录使用
class Upload extends Controller
{
    // 上传视频的方法
    public function upload()
    {
        // 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);
        
        // 判断是否有账号登录
        if (empty(session('id'))) {
            $msgUp = '请登陆后再使用上传功能';
            $url = '/index';
                $url1 = '/index';
                $url2 = '/index';
                $msg1 = '回到主页';
                $msg2 = '去登录';
                $i = 5; // 跳转时间
                $this->assign(['msgUp'=>$msgUp ,'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
                return $this->fetch('notice/notice');
        }

        // 判断是否是第三方登录
        if (session('grade') == '会员') {
            $msgUp = '第三方登录用户没有上传视频的权限';
            $url = '/index';
                $url1 = '/index';
                $url2 = '/index';
                $msg1 = '回到主页';
                $msg2 = '注册本站账号';
                $i = 5; // 跳转时间
                $this->assign(['msgUp'=>$msgUp , 'url'=>$url,'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
                return $this->fetch('notice/notice');
        }

        // 判断是否禁止上传视频---此功能暂未开启
        // $username = session('username');
        // $is_send = DB::name('user')->where('username' , $username)->value('is_send');
        // if ($is_send == 1) {
        //     $msgUp = '您没有上传视频的权限，请联系管理员';
        //     $url = '/index';
        //         $url1 = '/index';
        //         $url2 = '/index';
        //         $msg1 = '回到主页';
        //         $msg2 = '继续回到主页';
        //         $i = 5; // 跳转时间
        //         $this->assign(['msgUp'=>$msgUp , 'url'=>$url,'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
        //         return $this->fetch('notice/notice');
        // }

        // 上传七牛云需要的参数
        $accessKey = "Ce1D8ifktjnbymQb9jS_VIx-cIFEMknopYOS8seS";
        $secretKey = "SYVtq_AGI830hVTBWjTkgD6L_hK6d0nfKooIhT7t";
        $bucketName = "aishan-vedio";
        // 对上传策略的修改，返回的文件名直接跳转到php上
        $policy = [
            'returnUrl'=>'http://aishan.clwub.xin/index/upload/getUp', // 返回信息的接收地址
            'returnBody'=>'{"key": $(key), "mimeType": $(mimeType) , "avinfo":$(avinfo)}', // 返回的视频文件信息
            'persistentOps'=>'vframe/jpg/offset/0/w/480/h/360', // 生成视频的封面截图
            'mimeLimit'=>'video/*' // 只允许上传视频格式的文件
        ];
        // 对token的获取
        $upManager = new UploadManager();
        $auth = new Auth($accessKey, $secretKey);
        $token = $auth->uploadToken($bucketName , null , 3600 , $policy);
        list($ret, $error) = $upManager->put($token, 'formput', 'hello world');
        // 将token传给前台
       $this->assign(['token'=>$token]);

       // 遍历版块选项卡需要的参数
       $classBig = DB::name('sqlclass')->where(['pid'=>'0' , 'status'=>'1'])->select();
       $classSmall = DB::name('sqlclass')->where(['pid'=>['>' , '0'] , 'status'=>'1'])->select();
       $this->assign(['classBig'=>$classBig ,'classSmall'=>$classSmall]);

        return $this->fetch();
    }

    public function getCookie()
    {
        // 收到视频的标题等参数
         $vTitle = $_POST['vName'];
        $vLabel1 = $_POST['vLabel1'];
        $vLabel2 = $_POST['vLabel2'];
        $vLabel3 = $_POST['vLabel3'];
        $vLabel4 = $_POST['vLabel4'];
        $vLabel5 = $_POST['vLabel5'];
        $vWord = $_POST['vWord'];
        $vSelect = $_POST['vSelect'];
        $vLabel = '';
        if (!empty($vLabel1)) {
           $vLabel .= $vLabel1 . '+++';
        }
        if (!empty($vLabel2)) {
           $vLabel .= $vLabel2 . '+++';
        }
        if (!empty($vLabel3)) {
           $vLabel .= $vLabel3 . '+++';
        }
        if (!empty($vLabel4)) {
           $vLabel .= $vLabel4 . '+++';
        }
        if (!empty($vLabel5)) {
           $vLabel .= $vLabel5 . '+++';
        }
        cookie('vTitle' , $vTitle , 3600);
        cookie('vWord' , $vWord , 3600);
        cookie('vSelect' , $vSelect , 3600);
        cookie('vLabel' , $vLabel , 3600);
    }
    // 视频上传完成后，使用此方法承接返回数据
    public function getUp()
    {
        // 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);

        // 上传失败，不会返回upload_ret参数
         if (empty($_GET['upload_ret'])) {
            if ($_GET['code'] == 403) {
                $msgUp = '只允许上传视频格式的文件';
            } else {
                 $msgUp = '上传失败，请联系管理员';
            }
                $url = '/index';
                 $url1 = '/index/msg/msg';
                $url2 = '/index/upload/upload';
                $msg1 = '向管理员反馈';
                $msg2 = '继续上传';
                $i = 5; // 跳转时间
                $this->assign(['msgUp'=>$msgUp , 'url'=>$url , 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
                return $this->fetch('notice/notice');
        }
        // 上传成功，返回upload_ret参数
        $test = base64_decode($_GET['upload_ret']);
        $test = json_decode($test , true);
        // 目前的视频封面名称是在视频名称前加上D0wKvN8iuJYn_ZfkfaosZSudn3c=/，如要对上传策略中生成截图的参数进行改变的话，现行拼接的字符串也要改变

        // 生成需要传到数据库的参数
        $avinfo = $test['avinfo'];
        $timeV = $avinfo['audio']['duration']; // 视频总长度（秒）
        $timeH = floor($timeV / 3600); // 得到视频的小时长度
        $timeHleft = floor($timeV % 3600); // 剩余秒数
        $timeM = floor($timeHleft / 60); // 得到视频的分钟长度
        $timeS = floor($timeHleft % 60); // 剩余秒数

        $timeV = $timeH . ':' . $timeM . ':' . $timeS; // 视频长度（字符串带格式）
        $testVideo = $test['key']; // 视频文件名
        $testImg = 'D0wKvN8iuJYn_ZfkfaosZSudn3c=/' . $testVideo; // 视频封面文件名
        $vTitle = cookie('vTitle'); // 视频标题
        $vWord = cookie('vWord'); // 视频简介
        $vSelect = cookie('vSelect'); // 视频版块
        $vLabel = cookie('vLabel'); // 视频标签

        // 上传数据库
        $result = DB::name('res')->insert(['title'=>$vTitle, 'src'=>$testVideo , 'pic'=>$testImg , 'time_long'=>$timeV , 'label'=>$vLabel , 'content'=>$vWord , 'sid'=>$vSelect , 'up_name'=>session('username') , 'up_id'=>session('id') , 'up_photo'=>session('photo')]);
        if ($result) {
            // 上传数据库完成后显示跳转信息
            $vID = DB::name('res')->where('src' , $testVideo)->order('id' , 'desc')->value('id');
            $msgUp = '上传成功，审核人员正在加紧审核';
            $url = '/index/single/single?vid=' . $vID;
            $url1 = '/index/single/single?vid=' . $vID;
            $url2 = '/index/upload/upload';
            $msg1 = '去看看我的视频';
            $msg2 = '继续上传';
            $i = 10; // 跳转时间
            $this->assign(['msgUp'=>$msgUp , 'url1'=>$url1 , 'url'=>$url , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
        } else {
            // 上传数据库失败后显示跳转信息
            $msgUp = '上传失败，请联系管理员';
            $url = '/index';
            $url1 = '/index';
            $url2 = '/index/upload/upload';
            $msg1 = '回到主页';
            $msg2 = '继续上传';
            $i = 5; // 跳转时间
            $this->assign(['msgUp'=>$msgUp , 'url1'=>$url1, 'url'=>$url , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
        }

        // 销毁cookie
         cookie('vTitle' , null);
        cookie('vWord' , null);
        cookie('vSelect' , null);
        cookie('vLabel' , null);

        // 返回提示信息
        return $this->fetch('notice/notice');
    }
}