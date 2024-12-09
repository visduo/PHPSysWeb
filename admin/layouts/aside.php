<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");
?>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="#" class="brand-link">
            <img src="/static/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">数据管理系统(管理端)</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/admin/index.php" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                        <p>管理中心首页</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/adminuserlist.php" class="nav-link"> <i class="nav-icon bi bi-people-fill"></i>
                        <p>管理用户管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon bi bi-person-hearts"></i>
                        <p>平台用户管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon bi bi-credit-card"></i>
                        <p>交易订单管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"> <i class="nav-icon bi bi-toggles2"></i>
                        <p>
                            系统核心配置
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link"> <i class="nav-icon bi bi-alipay"></i>
                                <p>支付宝接口配置</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"> <i class="nav-icon bi bi-chat-left-dots-fill"></i>
                                <p>短信发信接口配置</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"> <i class="nav-icon bi bi-mailbox2"></i>
                                <p>邮箱发信接口配置</p>
                            </a>
                        </li>
                    </ul>
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
                            <a href="/admin/adminuserlog.php" class="nav-link"> <i class="nav-icon bi bi-file-text"></i>
                                <p>管理用户登录日志</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/mchuserlog.php" class="nav-link"> <i class="nav-icon bi bi-file-text"></i>
                                <p>平台用户登录日志</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"> <i class="nav-icon bi bi-file-text"></i>
                                <p>短信发信日志</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"> <i class="nav-icon bi bi-file-text"></i>
                                <p>邮箱发信日志</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
