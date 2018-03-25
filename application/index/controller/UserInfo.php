<?php

namespace app\index\controller;

class UserInfo
{
	public function test($name , $value)
	{
		return "这里是" . $name . "控制器下的" . $value . "方法";
	}
	public function test1()
	{
		echo request()->url();
		echo '<br />';
		echo request()->domain();
		echo '<br />';
		echo request()->module(); // 模块
		echo '<br />';
		echo request()->action();
		echo '<br />';
		dump(request()->param()); // 获取参数，用已经封装好的var_dump
	}
}