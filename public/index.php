<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
if (!file_exists(__DIR__ . '/../install.lock')) {
    header('Location: /install/index.html');
    exit;
}

// 引入 Composer 自动加载文件
require __DIR__ . '/../vendor/autoload.php';

// 定义全局常量
define('IDCSMART_ROOT', dirname(__DIR__) . '/');
define('WEB_ROOT', __DIR__ . '/');
define('UPLOAD_DEFAULT', __DIR__ . '/upload/common/default/');

// 引入 think\App 类
use think\App;

// 执行HTTP应用并响应
$app = new App();
$http = $app->http;
$response = $http->run();
$response->send();
$http->end($response);
