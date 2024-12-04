<?php
require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/authorize.php";
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>首页 - 数据管理系统(管理端)</title>
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
                            <h3>管理中心首页</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>New Orders</p>
                                </div>
                                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    More info <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>New Orders</p>
                                </div>
                                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    More info <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>New Orders</p>
                                </div>
                                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    More info <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>New Orders</p>
                                </div>
                                <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    More info <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-3 col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">关键词</span>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">关键词</span>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">关键词</span>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <button class="btn btn-primary">搜索</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Task</th>
                                            <th>Progress</th>
                                            <th style="width: 40px">Label</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="align-middle">
                                            <td>1.</td>
                                            <td>Update software</td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                </div>
                                            </td>
                                            <td><span class="badge text-bg-danger">55%</span></td>
                                        </tr>
                                        <tr class="align-middle">
                                            <td>2.</td>
                                            <td>Clean database</td>
                                            <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar text-bg-warning" style="width: 70%"></div>
                                                </div>
                                            </td>
                                            <td> <span class="badge text-bg-warning">70%</span> </td>
                                        </tr>
                                        <tr class="align-middle">
                                            <td>3.</td>
                                            <td>Cron job running</td>
                                            <td>
                                                <div class="progress progress-xs progress-striped active">
                                                    <div class="progress-bar text-bg-primary" style="width: 30%"></div>
                                                </div>
                                            </td>
                                            <td> <span class="badge text-bg-primary">30%</span> </td>
                                        </tr>
                                        <tr class="align-middle">
                                            <td>4.</td>
                                            <td>Fix and squish bugs</td>
                                            <td>
                                                <div class="progress progress-xs progress-striped active">
                                                    <div class="progress-bar text-bg-success" style="width: 90%"></div>
                                                </div>
                                            </td>
                                            <td> <span class="badge text-bg-success">90%</span> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        <li class="page-item"><a class="page-link" href="#">首页</a></li>
                                        <li class="page-item"><a class="page-link" href="#">上一页</a></li>
                                        <li class="page-item"><a class="page-link" href="#">下一页</a></li>
                                        <li class="page-item"><a class="page-link" href="#">末页</a></li>
                                        <li class="page-item"><a class="page-link" href="#">当前第N页 / 共N页 / 共N条数据</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">表单元素</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div>
                                                <label class="form-label">表单元素</label>
                                                <select class="form-select">
                                                    <option selected>Open this select menu</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary">提交</button>
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
</body>
</html>
