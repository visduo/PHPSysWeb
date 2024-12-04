<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");

// 请求参数处理工具类
class request {
    
    public static function get($key, $default = "") {
        if(!isset($_GET[$key])) {
            return null;
        }
        
        // 获取GET参数并转码
        return htmlspecialchars($_GET[$key], ENT_QUOTES, "UTF-8");
    }
    
    public static function post($key, $default = "") {
        if(!isset($_POST[$key])) {
            return null;
        }
        
        // 获取POST参数并转码
        return htmlspecialchars($_POST[$key], ENT_QUOTES, "UTF-8");
    }
    
}
