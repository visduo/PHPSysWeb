<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/authorize.php";

if(request::post("action") == "add") {
    // 新增管理用户
    $mysqlObj = new sqlhelper();
    
    $account = request::post("account");
    $password = request::post("password");
    $email = request::post("email");
    $telephone = request::post("telephone");
    $qqnumber = request::post("qqnumber");
    $status = request::post("status");
    $remarks = request::post("remarks");
    
    // 用户账号重复性验证
    $sqlStr = "SELECT * FROM sys_admin_user WHERE account = '$account'";
    $result = $mysqlObj->executeQuery($sqlStr);
    if(count($result) > 0) {
        response::falure("该用户账号已存在");
    }
    
    // 密码MD5盐值加密
    $salts = encrypt::randomSalts();
    $password = encrypt::md5($password, $salts);
    
    $sqlStr = "INSERT INTO sys_admin_user(account, password, salts, email, telephone, qqnumber, status, remarks)
                VALUES ('$account', '$password', '$salts', '$email', '$telephone', '$qqnumber', '$status', '$remarks')";
    $mysqlObj->executeUpdate($sqlStr);
    
    response::success("新增成功");
}
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <title>新增管理用户 - 数据管理系统(管理端)</title>
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
                            <h3>新增管理用户</h3>
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
                                                <label class="form-label">用户账号 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入用户账号" id="account">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">用户密码 <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" placeholder="请输入用户密码" id="password">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">邮箱地址 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入邮箱地址" id="email">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">手机号码 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入手机号码" id="telephone">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">QQ号码 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入QQ号码" id="qqnumber">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">用户状态 <span class="text-danger">*</span></label>
                                                <select class="form-select" id="status">
                                                    <option value="" selected>请选择用户状态</option>
                                                    <option value="1">正常</option>
                                                    <option value="0">禁用</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">用户备注 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入用户备注" id="remarks">
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
            let account = $("#account").val();
            let password = $("#password").val();
            let email = $("#email").val();
            let telephone = $("#telephone").val();
            let qqnumber = $("#qqnumber").val();
            let status = $("#status").val();
            let remarks = $("#remarks").val();
            
            // 非空验证
            if(account == "") {
                alert("请输入用户账号");
                return;
            } else if(password == "") {
                alert("请输入用户密码");
                return;
            } else if(email == "") {
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
                    account: account,
                    password: password,
                    email: email,
                    telephone: telephone,
                    qqnumber: qqnumber,
                    status: status,
                    remarks: remarks,
                    action: "add"
                },
                dataType: "JSON",
                success: function (responseData) {
                    if(responseData.code == 200) {
                        alert("新增成功");
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
