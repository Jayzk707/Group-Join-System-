<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// [ 应用入口文件 ]
header("Content-type: text/html; charset=utf-8");
// 绝对路径
define("_PATH_",__DIR__);
// 定义应用目录
define('APP_PATH', __DIR__ . '/application/');
// 入口路由绑定
//define('BIND_MODULE','home');
// 配置文件目录
define('CONF_PATH', __DIR__ .'/config/'); 
// 定义模板入口路径
define('TMP_PATH', '/template/');
// 加载框架引导文件
//define('IS_AJAX', isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest" ? true : false);
require __DIR__ . '/thinkphp/start.php';