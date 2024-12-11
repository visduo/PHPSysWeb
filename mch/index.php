<?php
require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT']."/mch/authorize.php";
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <title>首页 - 数据管理系统(平台端)</title>
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
                            <h3>平台中心首页</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-primary">
                                <div style="padding: 1rem 1.5rem;">
                                    <h3>¥ <?php echo $_SESSION["mchUser"]["balance"] ?> 元</h3>
                                    <p class="mb-0">用户余额</p>
                                </div>
                                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    立即充值
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-primary">
                                <div style="padding: 1rem 1.5rem;">
                                    <h3>
                                        <?php
                                            if($_SESSION["mchUser"]["telephone_verify"] == 1) {
                                                echo "已验证";
                                            } else {
                                                echo "未验证";
                                            }
                                        ?>
                                    </h3>
                                    <p class="mb-0">手机号码：<?php echo $_SESSION["mchUser"]["telephone"] ?></p>
                                </div>
                                <a href="/mch/edittelephone.php" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    立即修改
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-primary">
                                <div style="padding: 1rem 1.5rem;">
                                    <h3>
                                        <?php
                                        if($_SESSION["mchUser"]["email_verify"] == 1) {
                                            echo "已验证";
                                        } else {
                                            echo "未验证";
                                        }
                                        ?>
                                    </h3>
                                    <p class="mb-0">邮箱地址：<?php echo $_SESSION["mchUser"]["email"] ?></p>
                                </div>
                                <a href="/mch/editemail.php" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    立即修改
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/mch/layouts/footer.php";?>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/mch/layouts/script.php";?>
</body>
</html>
