<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");

if(!isset($_SESSION["mchUser"])) {
    // 未登录，强制跳转到登录页面
    header("Location: /mch/login.php");
    exit();
}
