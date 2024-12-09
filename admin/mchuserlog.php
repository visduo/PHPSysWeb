<?php
require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/authorize.php";

$mysqlObj = new sqlhelper();

// 拼接查询条件
$sqlStr_search = " WHERE 1=1";
if (request::get("searchAccount") != "") {
    $sqlStr_search .= " AND user.account LIKE '%".request::get("searchAccount")."%'";
}
if (request::get("searchClientip") != "") {
    $sqlStr_search .= " AND log.client_ip LIKE '%".request::get("searchClientip")."%'";
}

// 查询数据总数
$sqlStr_count = "SELECT COUNT(1) AS count FROM sys_mch_user_log AS log
                    LEFT JOIN sys_mch_user AS user
                    ON log.user_id = user.id"
                    .$sqlStr_search;
$totals = $mysqlObj->executeQuery($sqlStr_count)[0]["count"];

// 计算分页参数
$pagehelper = new pagehelper($totals, 10, request::get("pageNo"));

// 查询数据列表
$sqlStr_list = "SELECT log.*, user.account FROM sys_mch_user_log AS log
                    LEFT JOIN sys_mch_user AS user
                    ON log.user_id = user.id"
                    .$sqlStr_search
                    ." ORDER BY create_time DESC"
                    ." LIMIT ".$pagehelper->limit." ,".$pagehelper->pageSize;
$dataList = $mysqlObj->executeQuery($sqlStr_list);
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <title>平台用户登录日志 - 数据管理系统(管理端)</title>
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
                            <h3>平台用户登录日志</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline mb-4">
                                <div class="card-header pb-0">
                                    <form id="searchForm">
                                        <input hidden name="pageNo" value="<?php echo $pagehelper->pageNo ?>"/>
                                        <div class="row">
                                            <div class="col-lg-3 col-12 mb-3">
                                                <div class="input-group">
                                                    <span class="input-group-text">用户账号</span>
                                                    <input type="text" class="form-control" name="searchAccount" value="<?php echo request::get("searchAccount")?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 mb-3">
                                                <div class="input-group">
                                                    <span class="input-group-text">登录IP</span>
                                                    <input type="text" class="form-control" name="searchClientip" value="<?php echo request::get("searchClientip")?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-6 mb-3">
                                                <button type="submit" class="btn btn-primary">搜索</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body p-0 table-responsive text-nowrap">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>用户账号</th>
                                            <th>客户端IP</th>
                                            <th>客户端UA</th>
                                            <th>登录时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            // 遍历数据列表
                                            foreach ($dataList as $key => $value) {
                                                echo "<tr>";
                                                echo "<td style='width: 15px;'>".($key+1)."</td>";
                                                echo "<td>".$value["account"]."</td>";
                                                echo "<td>".$value["client_ip"]."</td>";
                                                echo "<td style='width: 600px;' class='text-wrap'>".$value["client_ua"]."</td>";
                                                echo "<td>".datehelper::toDateTime($value["create_time"])."</td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="setPageNo(1)">首页</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="setPageNo(<?php echo $pagehelper->prevPageNo ?>)">上一页</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="setPageNo(<?php echo $pagehelper->nextPageNo ?>)">下一页</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="setPageNo(<?php echo $pagehelper->pages ?>)">末页</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);">当前第<?php echo $pagehelper->pageNo ?>页 / 共<?php echo $pagehelper->pages ?>页 / 共<?php echo $pagehelper->totals ?>条数据</a></li>
                                    </ul>
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
        function setPageNo(pageNo) {
            $("#searchForm input[name='pageNo']").val(pageNo);
            $("#searchForm").submit();
        }
    </script>
</body>
</html>
