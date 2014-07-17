<?php
session_start();

//应用zj_php框架
require_once '../../zj_php/zj_php.php';
//设置应用路径
setC("APP_PATH", dirname(__FILE__));
setC("TPL_PATH", getC("APP_PATH") . "/_Tpl/");
//设置 APP URL
$arr1 = explode("index.php", $_SERVER["SCRIPT_NAME"]);
setC("APP_URL", $arr1[0]);
setC("APP_URL_ACTIONTAG", "a/");

//添加应用自动加载类路径
add_autoload_path(getC("APP_PATH") . "/0.Common", true);
add_autoload_path(getC("APP_PATH") . "/1.Action", true);
add_autoload_path(getC("APP_PATH") . "/2.Business", true);
add_autoload_path(getC("APP_PATH") . "/3.DataServer", true);
add_autoload_path(getC("APP_PATH") . "/4.ApiProxy", true);
add_autoload_path(getC("APP_PATH") . "/5.Entity", true);
add_autoload_path(getC("APP_PATH") . "/6.Factory", true);
add_autoload_path(getC("APP_PATH") . "/_Lib", true);

//添加应用配置文件
add_app_config(getC("APP_PATH") . "/_Conf/app.config.php");
add_app_config(getC("APP_PATH") . "/_Conf/" . strtolower(getC("APP_STATE")) . ".config.php");

//加载自定义函数
require_once "./_Function/app.define.php";
require_once "./_Function/app.function.php";
require_once "./_Function/simple_html_dom.php";

//执行请求
Runtime::doQuery();