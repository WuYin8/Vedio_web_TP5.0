<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\controller\Page;

class Cla extends Controller
{
    public function classNew()
    {
        //ajax获取小版块id
        $cID = $_GET['cid'];
        // 获取小版块视频总数
        $numC = DB::name('res')->where('sid' , $cID)->count('id');
        // 启用分页类
        $page = new Page(12 , $numC);
        // 获得分页url
        $pages = $page->allPage();
        // 获得每页需要的数据
        $resNow = DB::name('res')->where('sid' , $cID)->order('create_time' , 'desc')->limit($page->limit())->select();
        // 返回值到ajax
        $data['data'] = $resNow;
        $data['pages'] = $pages;
        return json_encode($data , TRUE);
    }
}