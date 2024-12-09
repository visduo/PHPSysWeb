<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/smshelper.php";

$smshelper = new smshelper();

$smsCode = $smshelper->randSmsCode();

$smshelper->sendEmailSms("160529412@qq.com", $smsCode);
