<?php
namespace app\admin\controller;
use think\Request;
class Index
{
	public function index()
	{
		// return "这个是admin模块下index控制器的index方法";
		$request = Request::instance();
		echo $request->url();
		dump($request->get()); // 获取get传参
		dump($request->param('name')); // 获取get,post,put传参
		dump(input('param.name'));
		dump(input('param.')); // 获取所有参数
		echo '<br />';
		echo 'domain:' . $request->domain() . '<br />'; // 获取当前域名
		echo 'file:' . $request->baseFile() . '<br />'; // 获取当前入口文件
		echo 'url:' . $request->url() . '<br />'; // 获取当前url地址，不含域名
		echo 'url with domain:' . $request->url(true) . '<br />'; // 获取包含域名的完整url地址
		echo 'url without query:' . $request->baseUrl() . '<br />'; // 获取当前url地址，不含query_string
		echo 'root:' . $request->root() . '<br />'; // 获取url访问的root地址
		echo 'root with domain:' . $request->root(true) . '<br />'; // 获取url访问的root地址
		echo 'pathinfo:' . $request->pathinfo() . '<br />'; // 获取url地址中的path_info信息
		echo 'pathinfo:' . $request->path() . '<br />'; // 获取url地址中的path_info信息，不含后缀
		echo 'ext:' . $request->ext() . '<br />';


	}
	public function admin()
	{
		echo session('username');
	}
}