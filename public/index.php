<?php
// [ 应用入口文件 ]
namespace think;
// 检查PHP版本
if (version_compare("7.3", PHP_VERSION, ">=")) {
    die("PHP 7.3 or greater is required");
}
require __DIR__ . '/../vendor/autoload.php';
// 执行HTTP应用并响应
$http = (new App())->http;
$response = $http->run();
$response->send();
$http->end($response);
