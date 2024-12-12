<?php
require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/authorize.php";

$mysqlObj = new sqlhelper();

// 查询回显数据
$sqlStr = "SELECT * FROM sys_tencent_sms_conf WHERE id = 1";
$result = $mysqlObj->executeQuery($sqlStr);
$tencentSmsConf = $result[0];

if(request::post("action") == "edit") {
    $sdk_appid = request::post("sdk_appid");
    $sdk_appkey = request::post("sdk_appkey");
    $signature = request::post("signature");
    $template_id = request::post("template_id");
    $status = request::post("status");
    
    $sqlStr = "UPDATE sys_tencent_sms_conf
            SET sdk_appid = '$sdk_appid', sdk_appkey = '$sdk_appkey',
            signature = '$signature', template_id = '$template_id',
            status = '$status' WHERE id = 1";
    $mysqlObj->executeUpdate($sqlStr);
    
    response::success("修改成功");
}
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <title>短信发信接口配置 - 数据管理系统(管理端)</title>
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
                            <h3>短信发信接口配置</h3>
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
                                                <label class="form-label">SdkAppId <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入SdkAppId" id="sdk_appid" value="<?php echo $tencentSmsConf["sdk_appid"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">SdkAppKey <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" placeholder="请输入SdkAppKey" id="sdk_appkey" value="<?php echo $tencentSmsConf["sdk_appkey"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">短信签名 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入短信签名" id="signature" value="<?php echo $tencentSmsConf["signature"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">短信模板id <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="请输入短信模板id" id="template_id" value="<?php echo $tencentSmsConf["template_id"] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">接口状态 <span class="text-danger">*</span></label>
                                                <select class="form-select" id="status">
                                                    <option value="">请选择接口状态</option>
                                                    <option value="1" <?php echo $tencentSmsConf["status"] == 1 ? "selected" : "" ?>>启用</option>
                                                    <option value="0" <?php echo $tencentSmsConf["status"] != 1 ? "selected" : "" ?>>禁用</option>
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
            let sdk_appid = $("#sdk_appid").val();
            let sdk_appkey = $("#sdk_appkey").val();
            let signature = $("#signature").val();
            let template_id = $("#template_id").val();
            let status = $("#status").val();
            
            if(sdk_appid == "") {
                alert("请输入SdkAppId");
                return false;
            } else if(sdk_appkey == "") {
                alert("请输入SdkAppKey");
                return false;
            } else if(signature == "") {
                alert("请输入短信签名");
                return false;
            } else if(template_id == "") {
                alert("请输入短信模板id");
                return false;
            } else if(status == "") {
                alert("请选择接口状态");
                return false;
            }
            
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    "sdk_appid": sdk_appid,
                    "sdk_appkey": sdk_appkey,
                    "signature": signature,
                    "template_id": template_id,
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
