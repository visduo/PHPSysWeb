<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");
?>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="#" class="brand-link">
            <img src="/static/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">数据管理系统(平台端)</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/mch/index.php" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>平台中心首页</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon bi bi-credit-card"></i>
                        <p>交易订单管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon bi bi-file-text"></i>
                        <p>
                            系统日志服务
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/mch/mchuserlog.php" class="nav-link"> <i class="nav-icon bi bi-file-text"></i>
                                <p>平台用户登录日志</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
