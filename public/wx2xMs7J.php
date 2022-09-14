<?php
// [ 应用入口文件 ]
namespace think;
if (version_compare ("7.3", PHP_VERSION, ">=")) {
    die("PHP 7.3 or greater is required");
}
require __DIR__ . '/../vendor/autoload.php';
// 执行HTTP应用并响应
$http = (new App())->http;
$response = $http->name ('admin')->run ();
$response->send ();
$http->end ($response);
