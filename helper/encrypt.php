<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");

// 密码加密工具类
class encrypt {
    
    public static function md5($password, $salts = "") {
        // MD5加密
        return md5($password.$salts);
    }
    
    public static function randomSalts() {
        // 生成随机盐值
        $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $len = strlen($str);
        $salt = "";
        for ($i = 0; $i < 6; $i++) {
            $salt .= $str[mt_rand(0, $len - 1)];
        }
        return $salt;
    }
    
}
