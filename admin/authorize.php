<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");

if(!isset($_SESSION["adminUser"])) {
    // 未登录，强制跳转到登录页面
    header("Location: /admin/login.php");
    exit();
}
