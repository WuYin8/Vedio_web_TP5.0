<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\controller\Page;
use app\index\model\Sqlclass; // 遍历版块与目录使用

class Search extends Controller
{
    // 默认展示页面
    public function search()
    {
        // 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);

        // 搜索，先展示版块搜索，视频搜索放在下一个方法，使用ajax
        // 搜索内容为空时
        if (empty($_POST['sWord'])) {
            $msgUp = '搜索内容为空';
            $url = '/index';
            $url1 = '/index';
            $url2 = '/index';
            $msg1 = '回到主页';
            $msg2 = '搜个别的？';
            $i = 5; // 跳转时间
            $this->assign(['msgUp'=>$msgUp ,'url'=>$url, 'url1'=>$url1 , 'msg1'=>$msg1 , 'url2'=>$url2 , 'msg2'=>$msg2 , 'i'=>$i]);
            return $this->fetch('notice/notice');
        }
        // 搜索内容不为空时
        $sWord = $_POST['sWord'];
        cookie('sWord' , $sWord , 3600);
        $class = DB::name('sqlclass')->where('name' , 'like' , "%$sWord%")->where('status' , '1')->select();
        $this->assign(['class'=>$class , 'sWord'=>$sWord]);
        // 搜索无结果则为空，有结果则为二维数组，在html内遍历
        // dump($result);
        return $this->fetch();
    }

    public function getVideo()
    {
        $sWord = cookie('sWord');

       // 获取需要的素材,分页
       $resC = DB::name('res')->where('title' , 'like' , "%$sWord%")->whereOr('label' , 'like' , "%$sWord%")->whereOr('content' , 'like' , "%$sWord%")->where('is_pass' , '1')->count('id'); // 本页面所有留言数
       $page = new Page(12 , $resC);

       $pages = $page->allPage();
       $Res = DB::name('res')->where('title' , 'like' , "%$sWord%")->whereOr('label' , 'like' , "%$sWord%")->whereOr('content' , 'like' , "%$sWord%")->where('is_pass' , '1')->limit($page->limit())->select();

        if (empty($Res)) {
            $data['data'] = 'no';
        } else {
            $data['data'] = $Res;
        }
        $data['pages'] = $pages;
        return json_encode($data , TRUE);
    }
}