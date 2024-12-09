<?php
require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT']."/mch/authorize.php";

if(request::post("action") == "sendSmscode") {
    $smshelper = new smshelper();
    $email = request::post("email");
    $smscode = $smshelper->randSmsCode();
    
    $result = $smshelper->sendEmailSms($email, $smscode);
    
    if($result) {
        // 发送成功，存储账号+验证码+发送时间到会话
        $_SESSION["mchUser_email_account"] = $email;
        $_SESSION["mchUser_email_smscode"] = $smscode;
        $_SESSION["mchUser_email_sendtime"] = datehelper::currentSeconds();
        response::success("发送成功");
    } else {
        response::failure("发送失败");
    }
} else if(request::post("action") == "edit") {
    $email = request::post("email");
    $smscode = request::post("smscode");
    
    // 验证码有效时间5分钟
    $sendtime = $_SESSION["mchUser_email_sendtime"];
    $currenttime = datehelper::currentSeconds();
    $validtime = 5 * 60;
    if($currenttime - $sendtime > $validtime) {
        unset($_SESSION["mchUser_email_account"]);
        unset($_SESSION["mchUser_email_smscode"]);
        unset($_SESSION["mchUser_email_sendtime"]);
        response::failure("邮箱验证码已失效");
    }
    
    if($email == $_SESSION["mchUser_email_account"] && $smscode == $_SESSION["mchUser_email_smscode"]) {
        $mysqlObj = new sqlhelper();
        
        $mchUser = $_SESSION["mchUser"];
        $userId = $mchUser["id"];
        
        $sqlStr = "UPDATE sys_mch_user
            SET email = '$email', email_verify = 1 WHERE id = '$userId'";
        $mysqlObj->executeUpdate($sqlStr);
        
        // 重新设置会话数据
        $_SESSION["mchUser"] = $mysqlObj->executeQuery("SELECT * FROM sys_mch_user WHERE id = '$userId'")[0];
        
        // 删除会话
        unset($_SESSION["mchUser_email_account"]);
        unset($_SESSION["mchUser_email_smscode"]);
        unset($_SESSION["mchUser_email_sendtime"]);
        
        response::success("修改成功");
    } else {
        response::failure("邮箱验证码错误");
    }
}
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <title>邮箱号码验证 - 数据管理系统(平台端)</title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/mch/layouts/head.php";?>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . "/mch/layouts/nav.php";
            require_once $_SERVER['DOCUMENT_ROOT'] . "/mch/layouts/aside.php";
        ?>
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h3>邮箱号码验证</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">邮箱号码 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入邮箱号码" id="email" value="<?php echo $_SESSION["mchUser"]["email"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">验证状态 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="<?php
                                                if($_SESSION["mchUser"]["email_verify"] == 1) {
                                                    echo "已验证";
                                                } else {
                                                    echo "未验证";
                                                }
                                                ?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">邮箱验证码 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入邮箱验证码" id="smscode">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-secondary" id="sendSmscode">发送邮箱验证码</button>
                                    <button type="button" class="btn btn-primary" id="submit">提交</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/mch/layouts/footer.php";?>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/mch/layouts/script.php";?>
    <script>
        $("#sendSmscode").click(function () {
            let email = $("#email").val();
            
            if (email == "") {
                alert("请输入邮箱号码");
                return;
            }
            
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    "email": email,
                    "action": "sendSmscode"
                },
                dataType: "JSON",
                success: function (responseData) {
                    if (responseData.code == 200) {
                        alert("发送成功");
                        
                        // 按钮倒计时
                        let countdown = 60;
                        let interval = setInterval(function () {
                            $("#sendSmscode").text(countdown + "秒后可重新发送");
                            $("#sendSmscode").attr("disabled", true)
                            countdown--;
                            if (countdown < 0) {
                                clearInterval(interval);
                                $("#sendSmscode").attr("disabled", false)
                                $("#sendSmscode").text("发送邮箱验证码");
                            }
                        }, 1000);
                    } else {
                        alert(responseData.message);
                    }
               }
            })
        })
        
        
        $("#submit").click(function () {
            let email = $("#email").val();
            let smscode = $("#smscode").val();
            
            if (email == "") {
                alert("请输入邮箱号码");
                return;
            } else if (smscode == "") {
                alert("请输入邮箱验证码");
                return;
            }
            
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    "email": email,
                    "smscode": smscode,
                    "action": "edit"
                },
                dataType: "JSON",
                success: function (responseData) {
                    if (responseData.code == 200) {
                        alert("修改成功");
                        window.location.href = "/mch/index.php";
                    } else {
                        alert(responseData.message);
                    }
               }
            })
        })
    </script>
</body>
</html>
