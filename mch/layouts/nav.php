<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");

require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";
?>
<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-menu">
                <?php
                // 从会话中获取管理用户信息并展示
                ?>
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="https://q1.qlogo.cn/g?b=qq&nk=<?php echo $_SESSION["mchUser"]["qqnumber"] ?>&s=640" class="user-image rounded-circle shadow" alt="User Image">
                    <span class="d-none d-md-inline"><?php echo $_SESSION["mchUser"]["account"] ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <img src="https://q1.qlogo.cn/g?b=qq&nk=<?php echo $_SESSION["mchUser"]["qqnumber"] ?>&s=640" class="rounded-circle shadow" alt="User Image">
                        <p>
                            <?php echo $_SESSION["mchUser"]["account"] ?> - 普通用户
                            <small>欢迎您使用数据管理系统</small>
                        </p>
                    </li>
                    <li class="user-body">
                        <div class="row">
                            <div class="col-6 text-center">
                                <a href="/mch/profile.php">个人中心</a>
                            </div>
                            <div class="col-6 text-center">
                                <a href="/mch/logout.php">退出登录</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
