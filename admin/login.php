<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/common.php";

if(isset($_SESSION["adminUser"])) {
    // 已经登录，跳转到后台首页
    header("Location: /admin/index.php");
}

if(request::post("action")) {
    // 处理登录请求
    $mysqlObj = new sqlhelper();
    
    $account = request::post("account");
    $password = request::post("password");

    $sqlStr = "SELECT * FROM `sys_admin_user` WHERE `account` = '$account'";
    $result = $mysqlObj->executeQuery($sqlStr);

    // 数据库查询结果数组长度为0，即账号不存在
    if(count($result) != 0) {
        $adminUser = $result[0];
        
        // 密码校验
        if(encrypt::md5($password, $adminUser["salts"]) == $adminUser["password"]) {
            // 用户状态校验
            if($adminUser["status"] != 1) {
                response::falure("该用户已被禁用");
            }
            
            // 校验通过，将管理用户对象存入会话
            $_SESSION["adminUser"] = $adminUser;
            
            // 保存登录日志
            $userId = $adminUser["id"];
            $clientip = client::ip();
            $clientua = client::ua();
            $createTime = datehelper::currentSeconds();
            
            $sqlStr = "INSERT INTO `sys_admin_user_log` (`user_id`, `client_ip`, `client_ua`, `create_time`)
                        VALUES ('$userId', '$clientip', '$clientua', '$createTime')";
            $mysqlObj->executeUpdate($sqlStr);
            
            response::success("登录成功");
        } else {
            response::falure("用户密码错误");
        }
    } else {
        response::falure("用户账号不存在");
    }
}
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>管理用户登录 - 数据管理系统(管理端)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/static/css/adminlte.css">
</head>
<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h2 class="mb-0"><b>数据管理系统(管理端)</b></h2>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">欢迎您，请先登录</p>
                <form>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="" id="account">
                            <label for="account">请输入用户账号</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-people"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="password" class="form-control" placeholder="" id="password">
                            <label for="password">请输入用户密码</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary" id="submit">登录</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="/static/js/adminlte.js"></script>
    <script src="https://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
    <script>
        $("#submit").click(function () {
            let account = $("#account").val();
            let password = $("#password").val();

            if(account == "") {
                alert("请输入用户账号");
                return;
            } else if (password == "") {
                alert("请输入用户密码");
                return;
            }

            $.ajax({
                url: "",
                type: "POST",
                data: {
                    account: account,
                    password: password,
                    action: "login"
                },
                dataType: "JSON",
                success: function (responseData) {
                    if(responseData.code == 200) {
                        alert("登录成功");
                        window.location.href = "/admin/index.php";
                    } else {
                        alert(responseData.message);
                    }
                }
            })
        })
    </script>
</body>
</html>
