<?php
require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";

// 清除会话
session_destroy();
// 跳转到登录页面
header("Location: /mch/login.php");
