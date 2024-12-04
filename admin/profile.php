<?php
require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/authorize.php";

if(request::post("action") == "updateInfo") {
    // 修改基本信息
    $mysqlObj = new sqlhelper();
    
    $qqnumber = request::post("qqnumber");
    $telephone = request::post("telephone");
    $email = request::post("email");
    
    $userId = $_SESSION["adminUser"]["id"];
    
    $sqlStr = "UPDATE `sys_admin_user`
            SET `qqnumber` = '$qqnumber', `telephone` = '$telephone', `email` = '$email'
            WHERE `id` = '$userId'";
    
    $mysqlObj->executeUpdate($sqlStr);
    
    // 重新设置会话数据
    $_SESSION["adminUser"] = $mysqlObj->executeQuery("SELECT * FROM `sys_admin_user` WHERE `id` = '$userId'")[0];
    
    response::success("修改成功");
} else if(request::post("action") == "updatePassword") {
    // 修改用户密码
    $mysqlObj = new sqlhelper();
    
    $oldPassword = request::post("oldPassword");
    $newPassword = request::post("newPassword");
    
    $adminUser = $_SESSION["adminUser"];
    $userId = $adminUser["id"];

    if(encrypt::md5($oldPassword, $adminUser["salts"]) == $adminUser["password"]) {
        // 生成新的用户盐值，并加密新密码
        $newSalts = encrypt::randomSalts();
        $newPassword = encrypt::md5($newPassword, $newSalts);
        
        $sqlStr = "UPDATE `sys_admin_user`
            SET `password` = '$newPassword', `salts` = '$newSalts'
            WHERE `id` = '$userId'";
        
        $mysqlObj->executeUpdate($sqlStr);
        
        // 会话失效，重新登录
        session_destroy();
        
        response::success("修改成功");
    } else {
        response::falure("旧密码错误");
    }
}
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>个人中心 - 数据管理系统</title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/layouts/head.php";?>
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/layouts/nav.php";
            require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/layouts/aside.php";
        ?>
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h3>个人中心</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-header">
                                    修改基本信息
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">QQ号码</label>
                                                <input type="text" class="form-control" placeholder="请输入QQ号码" id="qqnumber" value="<?php echo $_SESSION["adminUser"]["qqnumber"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">手机号码</label>
                                                <input type="text" class="form-control" placeholder="请输入手机号码" id="telephone" value="<?php echo $_SESSION["adminUser"]["telephone"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">邮箱地址</label>
                                                <input type="text" class="form-control" placeholder="请输入邮箱地址" id="email" value="<?php echo $_SESSION["adminUser"]["email"] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="submit1">提交</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-header">
                                    修改用户密码
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">旧密码</label>
                                                <input type="password" class="form-control" placeholder="请输入旧密码" id="oldPassword">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">新密码</label>
                                                <input type="password" class="form-control" placeholder="请输入新密码" id="newPassword">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">再次确认新密码</label>
                                                <input type="password" class="form-control" placeholder="请再次确认新密码" id="rePassword">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="submit2">提交</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/layouts/footer.php";?>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/layouts/script.php";?>
    <script>
        $("#submit1").click(function () {
            let qqnumber = $("#qqnumber").val();
            let telephone = $("#telephone").val();
            let email = $("#email").val();
            if (qqnumber == "") {
                alert("请输入QQ号码");
                return;
            } else if (telephone == "") {
                alert("请输入手机号码");
                return;
            } else if (email == "") {
                alert("请输入邮箱地址");
                return;
            }
            
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    "qqnumber": qqnumber,
                    "telephone": telephone,
                    "email": email,
                    "action": "updateInfo"
                },
                dataType: "JSON",
                success: function (responseData) {
                    if (responseData.code == 200) {
                        alert("修改成功");
                        window.location.reload();
                    } else {
                        alert(responseData.message);
                    }
               }
            })
        })
        
        $("#submit2").click(function () {
            let oldPassword = $("#oldPassword").val();
            let newPassword = $("#newPassword").val();
            let rePassword = $("#rePassword").val();
            
            if (oldPassword == "") {
                alert("请输入旧密码");
                return;
            } else if (newPassword == "") {
                alert("请输入新密码");
                return;
            } else if (rePassword == "") {
                alert("请再次确认新密码");
                return;
            } else if (newPassword != rePassword) {
                alert("两次输入的密码不一致");
                return;
            }
            
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    "oldPassword": oldPassword,
                    "newPassword": newPassword,
                    "action": "updatePassword"
                },
                dataType: "JSON",
                success: function (responseData) {
                    if (responseData.code == 200) {
                        alert("修改成功");
                        window.location.href = "/admin/login.php";
                    } else {
                        alert(responseData.message);
                    }
               }
            })
        })
    </script>
</body>
</html>
