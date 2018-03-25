<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use app\index\model\Sqlclass; // 遍历版块与目录使用

class Msg extends Controller
{
    // 网站信息页面只是展示一些联系方式，先直接做死的显示
    public function msg()
    {
        // 展示目录，版块
        $sqlClass = new Sqlclass();
        $bigClass = $sqlClass->where(['pid'=>'0' , 'status'=>['=' , '1']])->select();
        $smallClass = $sqlClass->where(['pid'=>['>' , '0'] , 'status'=>['=' , '1']])->select();
        $this->assign(['bigClass'=>$bigClass , 'smallClass'=>$smallClass]);
        
        return $this->fetch();
    }
}