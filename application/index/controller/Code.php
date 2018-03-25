<?php
namespace app\index\controller;
/*
	密码加密类，暂时屏蔽掉了解密方法
*/
class Code
{
	private $string; // 需要处理的文本
	private $move; // 判断是加密还是解密
	private $salt; // 密码盐，用作填充干扰信息

	public function __construct($string , $move = 'E' , $salt = '')
	{
		$this->string = $string;
		$this->move = $move;
		$this->salt = substr($this->string, 1 , 5);
	}	

	public function loading()
	{
		if ($this->move == 'E') {
			// 加密，执行加密方法
			return $this->encrypt($this->string , $this->salt);
		} else if ($this->move == 'D') {
			// 解密，执行解密方法
			return $this->decrypt($this->string , $this->salt);
		}
	}
	// 加密方法
	protected function encrypt($string , $salt)
	{
		// 将密码盐md5处理，拆分
		$salt = md5($salt);
		$salt1 = substr($salt, 0 , 13);
		$salt2 = substr($salt, 13 , 32);
		// 将文本base64处理，拆分
		$string = base64_encode($string);
		$string1 = substr($string, 0 , 3);
		$string2 = substr($string, 3 , 2);
		$string3 = substr($string, 5);
		// 将密码盐，md5的密码盐，base64的文本，以顺序拼接，记住文本拆分后的长度与插入的位置
		$result = $salt1 . $string1 . $this->salt . $string2 . $salt2 . $string3 . strrev($this->salt);
		return $result;
	}
	// 解密方法
	// protected function decrypt($string , $salt)
	// {
	// 	// 在加密语句中，将密码盐删除
	// 	$string = str_replace($salt, '', $string);
	// 	$string = str_replace(strrev($salt), '', $string);
	// 	// 根据文本插入的位置，挑选出base64文本
	// 	$result1 = substr($string, 13 , 5);
	// 	$result2 = substr($string, 37);
	// 	// 将base64的文本拼接好，逆向base64，得到原文本
	// 	$result = base64_decode($result1 . $result2);
	// 	return $result;
	// }
}
/*
使用范例
*/
// $str1 = 'abcabc';
// $salt = 'c5b2cbY';

// $code = new Code($str1 , 'E' , $salt);
// echo '加密：' . $code->loading() . '<br />';

// $str2 = $code->loading();
// $code2 = new Code($str2 , 'D' , $salt);
// echo '解密：' . $code2->loading();