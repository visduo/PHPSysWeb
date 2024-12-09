<?php
require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/authorize.php";

$mysqlObj = new sqlhelper();

// 查询回显数据
$sqlStr = "SELECT * FROM sys_email_sms_conf WHERE id = 1";
$result = $mysqlObj->executeQuery($sqlStr);
$emailSmsConf = $result[0];

if(request::post("action") == "edit") {
    $smtp_url = request::post("smtp_url");
    $smtp_port = request::post("smtp_port");
    $smtp_account = request::post("smtp_account");
    $smtp_password = request::post("smtp_password");
    $status = request::post("status");
    
    $sqlStr = "UPDATE sys_email_sms_conf
        SET smtp_url = '$smtp_url', smtp_port = '$smtp_port',
            smtp_account = '$smtp_account', smtp_password = '$smtp_password',
            status = $status WHERE id = 1";
    $mysqlObj->executeUpdate($sqlStr);
    
    response::success("修改成功");
}
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <title>邮箱发信接口配置 - 数据管理系统(管理端)</title>
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
                            <h3>邮箱发信接口配置</h3>
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
                                                <label class="form-label">SMTP地址 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入SMTP地址" id="smtp_url" value="<?php echo $emailSmsConf["smtp_url"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">SMTP端口号 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入SMTP端口号" id="smtp_port" value="<?php echo $emailSmsConf["smtp_port"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">SMTP发信账号 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入SMTP发信账号" id="smtp_account" value="<?php echo $emailSmsConf["smtp_account"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">SMTP发信密码 <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" placeholder="请输入SMTP发信密码" id="smtp_password" value="<?php echo $emailSmsConf["smtp_password"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">接口状态 <span class="text-danger">*</span></label>
                                                <select class="form-select" id="status">
                                                    <option value="">请选择接口状态</option>
                                                    <option value="1" <?php echo $emailSmsConf["status"] == 1 ? "selected" : "" ?>>启用</option>
                                                    <option value="0" <?php echo $emailSmsConf["status"] != 1 ? "selected" : "" ?>>禁用</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" id="submit">提交</button>
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
            let smtp_url = $("#smtp_url").val();
            let smtp_port = $("#smtp_port").val();
            let smtp_account = $("#smtp_account").val();
            let smtp_password = $("#smtp_password").val();
            let status = $("#status").val();
            
            if (smtp_url == "") {
                alert("请输入SMTP地址");
                return;
            } else if (smtp_port == "") {
                alert("请输入SMTP端口号");
                return;
            } else if (smtp_account == "") {
                alert("请输入SMTP发信账号");
                return;
            } else if (smtp_password == "") {
                alert("请输入SMTP发信密码");
                return;
            } else if (status == "") {
                alert("请选择接口状态");
                return;
            }
            
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    "smtp_url": smtp_url,
                    "smtp_port": smtp_port,
                    "smtp_account": smtp_account,
                    "smtp_password": smtp_password,
                    "status": status,
                    "action": "edit"
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
    </script>
</body>
</html>
