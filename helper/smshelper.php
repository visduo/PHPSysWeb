<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/sqlhelper.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/client.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/datehelper.php";
require_once $_SERVER['DOCUMENT_ROOT']."/helper/phpmailer/Exception.php";
require_once $_SERVER['DOCUMENT_ROOT']."/helper/phpmailer/PHPMailer.php";
require_once $_SERVER['DOCUMENT_ROOT']."/helper/phpmailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// 验证码工具类
class smshelper {

    public function randSmsCode() {
        // 生成随机验证码
        return rand(100000, 999999);
    }
    
    public function sendEmailSms($receiver, $smscode) {
        // 发送邮箱验证码
        $mysqlObj = new sqlhelper();
        
        // 查询邮箱发信接口配置
        $sqlStr = "SELECT * FROM sys_email_sms_conf WHERE id = 1";
        $result = $mysqlObj->executeQuery($sqlStr);
        $emailSmsConf = $result[0];
        
        if($emailSmsConf["status"] != 1) {
            // 接口未开启
            return false;
        }
        
        // 实例化PHPMailer核心类
        $mail = new PHPMailer();
        // 设置使用SMTP鉴权方式发送邮件
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        // 设置SMTP地址
        $mail->Host = $emailSmsConf["smtp_url"];
        // 设置使用SSL加密方式登录鉴权
        $mail->SMTPSecure = "ssl";
        // 设置SMTP服务器的远程服务器端口号
        $mail->Port = $emailSmsConf["smtp_port"];
        // 设置发送邮件编码
        $mail->CharSet = "UTF-8";
        // 设置发件人昵称
        $mail->FromName = "数据管理系统";
        // 设置SMTP发信账号
        $mail->Username = $emailSmsConf["smtp_account"];
        // 设置SMTP发信密码
        $mail->Password = $emailSmsConf["smtp_password"];
        // 设置发件人邮箱地址，同SMTP发信账号
        $mail->From = $emailSmsConf["smtp_account"];
        // 设置收件人邮箱地址
        $mail->addAddress($receiver);
        // 设置邮件主题
        $mail->Subject = "请查收邮箱验证码";
        // 添加邮件正文
        $mail->Body = "您的验证码是：".$smscode."，有效时间5分钟。";
        
        // 发送邮件，返回状态
        $status = $mail->send();
        
        $result = $status ? 1 : 0;
        $result_message = $result ? "发送成功" : "发送失败";
        $clientip = client::ip();
        $clientua = client::ua();
        $createTime = datehelper::currentSeconds();
        
        // 保存发信日志
        $sqlStr = "INSERT INTO sys_email_sms_log (receiver, content, result, result_message, client_ip, client_ua, create_time)
                   VALUES ('$receiver', '$mail->Body', '$result', '$result_message', '$clientip', '$clientua', '$createTime')";
        $mysqlObj->executeUpdate($sqlStr);
        
        return $status;
    }


}