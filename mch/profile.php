<?php
require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT']."/mch/authorize.php";

if(request::post("action") == "editInfo") {
    $mysqlObj = new sqlhelper();
    
    $qqnumber = request::post("qqnumber");
    
    $mchUser = $_SESSION["mchUser"];
    $userId = $mchUser["id"];
    
    $sqlStr = "UPDATE sys_mch_user
            SET qqnumber = '$qqnumber' WHERE id = '$userId'";
    $mysqlObj->executeUpdate($sqlStr);
    
    // 重新设置会话数据
    $_SESSION["mchUser"] = $mysqlObj->executeQuery("SELECT * FROM sys_mch_user WHERE id = '$userId'")[0];
    
    response::success("修改成功");
} else if(request::post("action") == "editPassword") {
    $mysqlObj = new sqlhelper();
    
    $oldPassword = request::post("oldPassword");
    $newPassword = request::post("newPassword");
    
    $mchUser = $_SESSION["mchUser"];
    $userId = $mchUser["id"];

    if(encrypt::md5($oldPassword, $mchUser["salts"]) == $mchUser["password"]) {
        // 生成新的用户盐值，并加密新密码
        $newSalts = encrypt::randomSalts();
        $newPassword = encrypt::md5($newPassword, $newSalts);
        
        $sqlStr = "UPDATE sys_mch_user
            SET password = '$newPassword', salts = '$newSalts'
            WHERE id = '$userId'";
        
        $mysqlObj->executeUpdate($sqlStr);
        
        // 会话失效，重新登录
        session_destroy();
        
        response::success("修改成功");
    } else {
        response::failure("旧密码错误");
    }
}
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <title>个人中心 - 数据管理系统(平台端)</title>
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
                            <h3>个人中心</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-header">
                                    修改基本信息
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">QQ号码 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入QQ号码" id="qqnumber" value="<?php echo $_SESSION["mchUser"]["qqnumber"] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="submit1">提交</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-header">
                                    修改用户密码
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">旧密码 <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" placeholder="请输入旧密码" id="oldPassword">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">新密码 <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" placeholder="请输入新密码" id="newPassword">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">再次确认新密码 <span class="text-danger">*</span></label>
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
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/mch/layouts/footer.php";?>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/mch/layouts/script.php";?>
    <script>
        $("#submit1").click(function () {
            let qqnumber = $("#qqnumber").val();
            if (qqnumber == "") {
                alert("请输入QQ号码");
                return;
            }
            
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    "qqnumber": qqnumber,
                    "action": "editInfo"
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
                    "action": "editPassword"
                },
                dataType: "JSON",
                success: function (responseData) {
                    if (responseData.code == 200) {
                        alert("修改成功");
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
