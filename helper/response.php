<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");

// 统一响应工具类
class response {
    
    public static function success($message, $data = null) {
        // 统一响应成功状态
        
        $result = array(
            "code" => 200,
            "message" => $message,
            "data" => $data
        );
        
        header("Content-Type: application/json");
        exit(json_encode($result));
    }
    
    public static function falure($message, $data = null) {
        // 统一响应失败状态
        
        $result = array(
            "code" => -1,
            "message" => $message,
            "data" => $data
        );
        
        header("Content-Type: application/json");
        exit(json_encode($result));
    }
    
}
