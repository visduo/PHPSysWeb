<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/authorize.php";

$mysqlObj = new sqlhelper();
$action = request::post("action");

$userId = request::get("id");
if(!$userId || $userId == "") {
    // 未传递用户id
    $action == "edit" ? response::falure("用户id不能为空") : header("Location: /admin/adminuserlist.php");
} else if($userId == $_SESSION["adminUser"]["id"]) {
    // 不能修改自己
    $action == "edit" ? response::falure("禁止修改") : header("Location: /admin/adminuserlist.php");
}

// 查询回显数据
$sqlStr = "SELECT * FROM sys_admin_user WHERE id = $userId";
$result = $mysqlObj->executeQuery($sqlStr);

if(count($result) != 0) {
    $adminUser = $result[0];
} else {
    // 用户id不存在
    $action == "edit" ? response::falure("用户id不存在") : header("Location: /admin/adminuserlist.php");
    exit();
}

if($action == "edit") {
    // 修改数据
    $password = request::post("password");
    $email = request::post("email");
    $telephone = request::post("telephone");
    $qqnumber = request::post("qqnumber");
    $status = request::post("status");
    $remarks = request::post("remarks");
    
    // 判断是否修改密码
    if($password && $password != "") {
        // 生成新的用户盐值，并加密新密码
        $salts = encrypt::randomSalts();
        $password = encrypt::md5($password, $salts);
    } else {
        // 未修改密码，用户盐值和密码不变
        $salts = $adminUser["salts"];
        $password = $adminUser["password"];
    }
    
    $sqlStr = "UPDATE sys_admin_user SET password = '$password', email = '$email',
                          telephone = '$telephone', qqnumber = '$qqnumber', status = $status,
                          remarks = '$remarks', salts = '$salts' WHERE id = '$userId'";
    $mysqlObj->executeUpdate($sqlStr);
    
    response::success("修改成功");
}
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <title>修改管理用户 - 数据管理系统(管理端)</title>
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
                            <h3>修改管理用户</h3>
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
                                                <label class="form-label">用户账号</label>
                                                <input type="text" class="form-control" value="<?php echo $adminUser["account"] ?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">用户密码</label>
                                                <input type="password" class="form-control" placeholder="请输入用户密码" id="password">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">邮箱地址 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入邮箱地址" id="email" value="<?php echo $adminUser["email"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">手机号码 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入手机号码" id="telephone" value="<?php echo $adminUser["telephone"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">QQ号码 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入QQ号码" id="qqnumber" value="<?php echo $adminUser["qqnumber"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">用户状态 <span class="text-danger">*</span></label>
                                                <select class="form-select" id="status">
                                                    <option value="">请选择用户状态</option>
                                                    <option value="1" <?php echo $adminUser["status"] == 1 ? "selected" : "" ?>>正常</option>
                                                    <option value="0" <?php echo $adminUser["status"] != 1 ? "selected" : "" ?>>禁用</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">用户备注 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入用户备注" id="remarks" value="<?php echo $adminUser["remarks"] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="submit">提交</button>
                                    <button type="button" class="btn btn-secondary" onclick="window.history.go(-1);">返回</button>
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
        $("#submit").click(function () {
            let password = $("#password").val();
            let email = $("#email").val();
            let telephone = $("#telephone").val();
            let qqnumber = $("#qqnumber").val();
            let status = $("#status").val();
            let remarks = $("#remarks").val();
            
            // 非空验证
            if(email == "") {
                alert("请输入邮箱地址");
                return;
            } else if(telephone == "") {
                alert("请输入手机号码");
                return;
            } else if(qqnumber == "") {
                alert("请输入QQ号码");
                return;
            } else if(status == "") {
                alert("请选择用户状态");
                return;
            } else if(remarks == "") {
                alert("请输入用户备注");
                return;
            }
            
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    password: password,
                    email: email,
                    telephone: telephone,
                    qqnumber: qqnumber,
                    status: status,
                    remarks: remarks,
                    action: "edit"
                },
                dataType: "JSON",
                success: function (responseData) {
                    if(responseData.code == 200) {
                        alert("修改成功");
                        window.location.href = "/admin/adminuserlist.php";
                    } else {
                        alert(responseData.message);
                    }
                }
            })
        })
    </script>
</body>
</html>
