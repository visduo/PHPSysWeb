<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");

// 日期时间工具类
class datehelper {
    
    public static function currentSeconds() {
        // 获取当前时间戳
        return time();
    }
    
    public static function toDateTime($currentSeconds) {
        // 设置时区
        date_default_timezone_set('PRC');
        // 格式化时间戳
        return date("Y-m-d H:i:s", $currentSeconds);
    }
    
}
