<?php
// 禁止PHP文件直接被访问
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");

// 引入工具类和公共方法
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/sqlhelper.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/response.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/request.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/encrypt.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/client.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/datehelper.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/pagehelper.php";

// 开启会话
session_start();
