<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");

// 客户端信息工具类
class client {
    
    public static function ip() {
        // 获取客户端IP地址
        return $_SERVER['REMOTE_ADDR'];
    }
    
    public static function ua() {
        // 获取客户端UA信息
        return $_SERVER['HTTP_USER_AGENT'];
    }
    
}
