<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/helper/common.php";

if(request::post("action") == "register") {
    $mysqlObj = new sqlhelper();
    
    $account = request::post("account");
    $password = request::post("password");
    $email = request::post("email");
    $telephone = request::post("telephone");
    $qqnumber = request::post("qqnumber");
    
    // 用户账号重复性验证
    $sqlStr = "SELECT * FROM sys_mch_user WHERE account = '$account'";
    $result = $mysqlObj->executeQuery($sqlStr);
    if(count($result) > 0) {
        response::falure("该用户账号已存在");
    }
    
    // 密码MD5盐值加密
    $salts = encrypt::randomSalts();
    $password = encrypt::md5($password, $salts);
    
    // 注册时间
    $registerTime = datehelper::currentSeconds();
    
    $sqlStr = "INSERT INTO sys_mch_user (account, password, salts, email, telephone, qqnumber, create_time)
                VALUES ('$account', '$password', '$salts', '$email', '$telephone', '$qqnumber', '$registerTime')";
    $mysqlObj->executeUpdate($sqlStr);
    
    response::success("注册成功");
}
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <title>平台用户注册 - 数据管理系统(平台端)</title>
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
                <h2 class="mb-0"><b>数据管理系统(平台端)</b></h2>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">欢迎您，请先注册</p>
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
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="password" class="form-control" placeholder="" id="rePassword">
                            <label for="rePassword">请再次输入用户密码</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="" id="email">
                            <label for="email">请输入邮箱地址</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-mailbox"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="" id="telephone">
                            <label for="telephone">请输入手机号码</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-phone"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="" id="qqnumber">
                            <label for="qqnumber">请输入QQ号码</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-tencent-qq"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-primary" id="submit">注册</button>
                                <a class="btn btn-primary" href="/mch/login.php">登录</a>
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
            let rePassword = $("#rePassword").val();
            let email = $("#email").val();
            let telephone = $("#telephone").val();
            let qqnumber = $("#qqnumber").val();

            if(account == "") {
                alert("请输入用户账号");
                return;
            } else if (password == "") {
                alert("请输入用户密码");
                return;
            } else if (rePassword == "") {
                alert("请再次输入用户密码");
                return;
            } else if (email == "") {
                alert("请输入邮箱地址");
                return;
            } else if (telephone == "") {
                alert("请输入手机号码");
                return;
            } else if (qqnumber == "") {
                alert("请输入QQ号码");
                return;
            } else if (password != rePassword) {
                alert("两次输入的密码不一致");
                return;
            }

            $.ajax({
                url: "",
                type: "POST",
                data: {
                    account: account,
                    password: password,
                    email: email,
                    telephone: telephone,
                    qqnumber: qqnumber,
                    action: "register"
                },
                dataType: "JSON",
                success: function (responseData) {
                    if(responseData.code == 200) {
                        alert("注册成功");
                        window.location.href = "/mch/login.php";
                    } else {
                        alert(responseData.message);
                    }
                }
            })
        })
    </script>
</body>
</html>
