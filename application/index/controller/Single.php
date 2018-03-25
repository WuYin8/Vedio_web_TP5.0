<?php
namespace app\index\controller;
use app\index\model\Report; // 遍历评论所用model
use app\index\model\Res; // 遍历视频所用model
use app\index\model\Danmu; // 遍历弹幕所用model
use app\index\model\Sqlclass; // 遍历版块与目录使用
use think\Controller;
use think\Db; // 拉取播放视频用db
use app\index\controller\Page;
class Single extends Controller
{
     // 视频播放页需要展示的数据
    public function single()
    {
        // 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);
        
        // 判断视频不存在、不允许观看
        if (empty($_GET['vid'])) {
            $msgUp = '当前视频仍在审核中';
            $url = '/index';
            $url1 = '/index';
            $url2 = '/index';
            $msg1 = '看看其他视频';
            $msg2 = '继续回到主页';
            $i = 5; // 跳转时间
            $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
            return $this->fetch('notice/notice');
        }
        $vID = $_GET['vid'];
        $hasRes = DB::name('res')->where('id' , $vID)->select();
        if ($hasRes) {
         
        } else {
            $msgUp = '当前视频仍在审核中';
            $url = '/index';
            $url1 = '/index';
            $url2 = '/index';
            $msg1 = '看看其他视频';
            $msg2 = '继续回到主页';
            $i = 5; // 跳转时间
            $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
            return $this->fetch('notice/notice');
        }
        $isPass = DB::name('res')->where('id' , $vID)->value('is_pass');
        if ($isPass == 0) {
            $msgUp = '当前视频仍在审核中';
            $url = '/index';
            $url1 = '/index';
            $url2 = '/index';
            $msg1 = '看看其他视频';
            $msg2 = '继续回到主页';
            $i = 5; // 跳转时间
            $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
            return $this->fetch('notice/notice');
        }

    	   // 获取视频的id
        	$vID = $_GET['vid'];
          cookie('vid' , $vID , 3600);

          // 判断是否需要付费
          $is_pay = DB::name('res')->where('id' , $vID)->value('is_pay');
          $author = DB::name('res')->where('id' , $vID)->value('up_name');
          $uid = session('id');
          $uGrade = DB::name('user')->where('id' , $uid)->value('grade');

          // 需要付费时
          if ($is_pay == 1) {
            // 判断是否登录
            if (empty(session('id'))) {
              $msgUp = '当前视频为付费视频，请登录后付费观看';
              $url = '/index';
              $url1 = '/index';
              $url2 = '/index';
              $msg1 = '马上登录';
              $msg2 = '继续回到主页';
              $i = 5; // 跳转时间
              $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
              return $this->fetch('notice/notice');
            }
            if ($uGrade <= 1) {
                if (session('username') != $author) {
                  // 既不是管理员，也不是投稿人的，需要付费
                  // 查询付费表判断是否付费
                  $ispay = DB::name('pay')->where(['uid'=>$uid , 'vid'=>$vID]);
                  if ($ispay) {
                      // 判断付费记录是否被删除
                      $isdel = DB::name('pay')->where(['uid'=>$uid , 'vid'=>$vID])->value('is_del');
                      if ($isdel == '0') {
                        // 已付费
                      } else {
                        // 付费记录被删除，执行付费方法
                        header("Location:/codepay/codepay.php?vid=" . $vID . "&uid=" . $uid);
                        exit;
                      }
                  } else {
                    // 执行付费方法
                    header("Location:/codepay/codepay.php?vid=" . $vID . "&uid=" . $uid);
                    exit;
                  }
                }
            }  
          }

          // 增加点击量
          $clickNum = DB::name('res')->where('id' , $vID)->value('click_num'); // 点击次数
          $clickNum = $clickNum + 1; // 点击一次会调用两次此方法,展示点击量时取出值要除2
          $result = DB::name('res')->where('id' , $vID)->update(['click_num'=>$clickNum]);
          // 获取评论数
          $reportC = Report::where(['vedio_id'=>$vID])->count('id'); // 本页面所有评论数
        	$result = DB::name('res')->where('id' , $vID)->update(['report_num'=>$reportC]);
            // 获取视频展示需要的素材
        	$vTitle = DB::name('res')->where('id' , $vID)->value('title'); // 视频标题
        	$vSrc = DB::name('res')->where('id' , $vID)->value('src'); // 视频外链
        	$vLabel = DB::name('res')->where('id' , $vID)->value('label'); // 视频标签
        	$vSid = DB::name('res')->where('id' , $vID)->value('sid'); // 所属版块
        	$vWord = DB::name('res')->where('id' , $vID)->value('content'); // 视频描述
        	$vUpName = DB::name('res')->where('id' , $vID)->value('up_name'); // 上传者姓名
        	$vUpPhoto = DB::name('res')->where('id' , $vID)->value('up_photo'); // 上传者头像
          $vUpTime = DB::name('res')->where('id' , $vID)->value('create_time'); // 上传时间
          $vLike = DB::name('res')->where('id' , $vID)->value('like_num'); // 点赞数量
          $vUpID = DB::name('user')->where('username' , $vUpName)->value('id');
        	// 视频标签转为数组
        	$vLabel = explode('+++', $vLabel);
        	// 外联拼接
        	$vSrc = "http://p3d4qx20z.bkt.clouddn.com/" . $vSrc;
        	 $this->assign(['vTitle'=>$vTitle , 'vSrc'=>$vSrc, 'vLabel'=>$vLabel , 'vSid'=>$vSid , 'vWord'=>$vWord , 'vUpName'=>$vUpName, 'vUpPhoto'=>$vUpPhoto, 'vUpTime'=>$vUpTime , 'vUpID'=>$vUpID ,'vLike'=>$vLike , 'clickNum'=>$clickNum , 'reportC'=>$reportC]);

	 // 获取随机视频展示需要的素材
          $resID = DB::name('res')->select();
          $resID = array_rand($resID , 10);
          $res = [];
          for ($i = 0 ; $i < 10 ; $i++) 
          {
               $res[] = DB::name('res')->where('id' , $resID[$i])->select();
          }
          $this->assign(['res'=>$res]);

      // 拉取视频的弹幕
          $dm = new Danmu();
          $countDm = $dm->where('vid' , $vID)->count();
          $getDm = $dm->where('vid' , $vID)->select();
          // 获得本视频的弹幕内容
          foreach ($getDm as $key => $value) {
            $oneDm = ['word'=>$value['word'] , 'color'=>$value['color'] , 'speed'=>$value['speed'] , 'top'=>$value['top'] , 'fontSize'=>$value['fontSize'] , 'action'=>$value['action'] , 'time'=>$value['time'] ];
            $allDm[] = $oneDm;
          }
          // 准备弹幕文件格式
          $data['title'] = '视频';
          $data['id'] = $vID;
          $data['time'] = '2018-02-14';
          $data['number'] = $countDm;
          $data['class'] = 'video';
          if ($countDm != 0) {
              $data['data'] = $allDm;
          } else {
              $data['data'] = '';
          }
          $dataDm = json_encode($data , JSON_UNESCAPED_UNICODE);
          // 保存弹幕文件，方便弹幕调用
          file_put_contents('./depend/comment.json', $dataDm);

        	return $this->fetch();
    }

    // 获取评论的方法-最新
    public function getReport()
    {
        $vID = $_GET['vid'];
         // 获取主评论展示需要的素材,主评论分页
            $user = new Report();
            $reportC = Report::where(['vedio_id'=>$vID , 'pid'=>['=' , '0'] , 'is_del'=>['=' , 0]])->count('id'); // 本页面所有评论数
            $page = new Page(6 , $reportC);
            $pages = $page->allPage();
            $reportL = $user->where(['vedio_id'=>$vID , 'pid'=>['=' , '0'] , 'is_del'=>['=' , 0]])->order('create_time' , 'desc')->limit($page->limit())->select();
             // 获取子评论展示需要的素材
            $reportS = $user->where(['vedio_id'=>$vID , 'pid'=>['>' , '0'] , 'is_del'=>['=' , 0]])->order('create_time' , 'desc')->select();
            $data['dataL'] = $reportL;
            $data['dataS'] = $reportS;
            $data['pages'] = $pages;
            return json_encode($data , JSON_UNESCAPED_UNICODE);
    }

    // 获取评论的方法-最早
    public function getReportOld()
    {
        $vID = $_GET['vid'];
         // 获取主评论展示需要的素材,主评论分页
            $user = new Report();
            $reportC = Report::where(['vedio_id'=>$vID , 'pid'=>['=' , '0'] , 'is_del'=>['=' , 0]])->count('id'); // 本页面所有评论数
            $page = new Page(6 , $reportC);
            $pages = $page->allPage();
            $reportL = $user->where(['vedio_id'=>$vID , 'pid'=>['=' , '0'] , 'is_del'=>['=' , 0]])->order('create_time' , 'asc')->limit($page->limit())->select();
             // 获取子评论展示需要的素材
            $reportS = $user->where(['vedio_id'=>$vID , 'pid'=>['>' , '0'] , 'is_del'=>['=' , 0]])->order('create_time' , 'desc')->select();
            $data['dataL'] = $reportL;
            $data['dataS'] = $reportS;
            $data['pages'] = $pages;
            return json_encode($data , JSON_UNESCAPED_UNICODE);
    }

    // 添加评论的方法
    public function addReport()
    {
    	// 发表评论前，判断是否登录
    	if (empty(session('id'))) {
    		$data['msg'] = 'noLogin';
    		return json_encode($data);
    	}
    	// 确认登录后，发表评论
    	$content = $_POST['content'];
    	$vedio_id = $_POST['vid'];
    	$userid = session('id');
    	$username = session('username');
    	$photo = session('photo');
    	// 插入评论
    	$user = new Report();
    	$user->data(['vedio_id'=>$vedio_id , 'userid'=>$userid , 'username'=>$username , 'photo'=>$photo , 'content'=>$content]);
    	$result = $user->save();

    	if ($result) {
    		$data['msg'] = 'great';
    	} else {
    		$data['msg'] = 'noAdd';
    	}
    	return json_encode($data);
    }

    // 添加楼中楼回复
    public function addReportII()
    {
        // 发表评论前，判断是否登录
        if (empty(session('id'))) {
            $data['msg'] = 'noLogin';
            return json_encode($data);
        }
        $pid = $_POST['pid'];
        $vid = $_POST['vid'];
        $content = $_POST['content'];
        $userid = session('id');
        $username = session('username');
        $photo = session('photo');
        // 插入楼中楼评论
        $user = new Report();
        $user->data(['vedio_id'=>$vid , 'userid'=>$userid , 'username'=>$username , 'photo'=>$photo , 'content'=>$content , 'pid'=>$pid]);
        $result = $user->save();

        if ($result) {
            $data['msg'] = 'great';
        } else {
            $data['msg'] = 'noAdd';
        }
        return json_encode($data);
    }

    // 给视频点赞的方法
    function dealZan()
    {
        $zan = $_POST['zan'];
        $vid = $_POST['vid'];
        if ($zan == 'yes') {
          cookie($vid , 'have' , 86400);
          $result1 = DB::name('res')->where('id' , $vid)->value('like_num');
          $result1 += 1;
          $result = DB::name('res')->where('id' , $vid)->update(['like_num'=>$result1]);
        } else if ($zan == 'no') {
            cookie($vid , null);
          $result2 = DB::name('res')->where('id' , $vid)->value('like_num');
          $result2 -= 1;
          $result = DB::name('res')->where('id' , $vid)->update(['like_num'=>$result2]);
        }
    }

    // 添加弹幕的方法
    function addDM()
    {
        // 未登录状态不允许发送弹幕
        if (empty(session('id'))) {
          $data['msg'] = 'noLogin';
          return json_encode($data , JSON_UNESCAPED_UNICODE);
        }
        $uid = session('id');
        $username = session('username');

        // 弹幕发送的id是否允许发送弹幕
        $is_speak = DB::name('user')->where('id' , $uid)->value('is_speak');
        if ($is_speak == '1') {
          $data['msg'] = 'noAddDM';
          return json_encode($data , JSON_UNESCAPED_UNICODE);
        }

        // 判断弹幕不为空
        if (empty($_POST['word'])) {
          $data['msg'] = 'noDM';
          return json_encode($data , JSON_UNESCAPED_UNICODE);
        }

        // 连接数据库
        $vID = cookie('vid');
        $word = $_POST['word'];
        $fontSize = $_POST['fontSize'];
        $top = $_POST['top'];
        $color = $_POST['color'];
        $speed = $_POST['speed'];
        $action = $_POST['action'];
        $currentTime = floor($_POST['currentTime']);
        if ($currentTime == 0) {
          $currentTime = 1;
        }

        $user = new Danmu();
        $user->data(['vid'=>$vID , 'word'=>$word , 'fontSize'=>$fontSize , 'top'=>$top , 'color'=>$color , 'speed'=>$speed , 'action'=>$action , 'time'=>$currentTime , 'uid'=>$uid, 'username'=>$username]);
        $result = $user->save();

        // 判断弹幕是否发送成功
        if ($result) {
            $data['msg'] = 'add';
            return json_encode($data , JSON_UNESCAPED_UNICODE);
        } else {
            $data['msg'] = 'noAd';
            return json_encode($data , JSON_UNESCAPED_UNICODE);
        }
    }

    // 支付后的方法
    public function getpay()
    {
        // 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);

        if (empty($_GET)) {
            $msgUp = '支付失败，请联系管理员处理';
            $url = '/index';
            $url1 = '/index/msg/msg';
            $url2 = '/index';
            $msg1 = '联系管理员';
            $msg2 = '继续回到主页';
            $i = 10; // 跳转时间
            $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
            return $this->fetch('notice/notice');
        }

        // dump($_GET);
        // exit;
        if ($_GET['status'] == 0 && !empty($_GET['pay_id']) && !empty($_GET['param'])) {
          // 支付订单获取成功，准备需要存到数据库里的数据
          $uid = intval($_GET['pay_id']); // 用户id
          $vid = intval($_GET['param']); // 视频id
          $price = floatval($_GET['price']); // 支付价格，浮点格式两位小数

          // 查看订单是否重复
          $hasPay = DB::name('pay')->where(['uid'=>$uid , 'vid'=>$vid])->value('is_del');
          if ($hasPay) {
           if ($hasPay == 0) {
              $msgUp = '订单已生效，请勿重复购买';
              $url = '/index/single/single?vid=' . $vid;
              $url1 = '/index/single/single?vid=' . $vid;
              $url2 = '/index';
              $msg1 = '立马欣赏';
              $msg2 = '随便转转';
              $i = 5; // 跳转时间
              $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
              return $this->fetch('notice/notice');
            }
          }

          $username = DB::name('user')->where('id' , $uid)->value('username'); // 用户名
          $title = DB::name('res')->where('id' , $vid)->value('title'); // 视频标题
          $addPay = DB::name('pay')->insert(['uid'=>$uid , 'username'=>$username , 'vid'=>$vid , 'title'=>$title , 'price'=>$price]);

          if ($addPay) {
              // 插入数据库成功
              $msgUp = '支付成功，敬请欣赏';
              $url = '/index/single/single?vid=' . $vid;
              $url1 = '/index/single/single?vid=' . $vid;
              $url2 = '/index';
              $msg1 = '立马欣赏';
              $msg2 = '随便转转';
              $i = 5; // 跳转时间
              $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
              return $this->fetch('notice/notice');
          } else {
              // 插入数据库失败
              $msgUp = '支付失败，请联系管理员处理';
              $url = '/index';
              $url1 = '/index/msg/msg';
              $url2 = '/index';
              $msg1 = '联系管理员';
              $msg2 = '继续回到主页';
              $i = 10; // 跳转时间
              $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
              return $this->fetch('notice/notice');
          }
        } else{
          // 支付订单获取失败
          $msgUp = '支付失败，请联系管理员处理';
          $url = '/index';
          $url1 = '/index/msg/msg';
          $url2 = '/index';
          $msg1 = '联系管理员';
          $msg2 = '继续回到主页';
          $i = 10; // 跳转时间
          $this->assign(['msgUp'=>$msgUp , 'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
          return $this->fetch('notice/notice');
        }
        // $_GET['status']为状态码，为0时表示支付成功
        // 此时不依赖他建的数据库，自己新建一个简单的数据库
        exit;
    }
}
