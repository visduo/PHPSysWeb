<?php
require_once $_SERVER['DOCUMENT_ROOT']."/helper/common.php";
require_once $_SERVER['DOCUMENT_ROOT']."/admin/authorize.php";

$mysqlObj = new sqlhelper();

if(request::post("action") == "delete") {
    $userId = request::post("id");
    if(!$userId || $userId == "") {
        // 未传递用户id
        response::falure("用户id不能为空");
    } else if($userId == $_SESSION["adminUser"]["id"]) {
        // 不能删除自己
        response::falure("禁止删除");
    }
    
    $sqlStr = "SELECT * FROM sys_admin_user WHERE id = $userId";
    $result = $mysqlObj->executeQuery($sqlStr);
    
    if(count($result) == 0) {
        // 用户id不存在
        response::falure("用户id不存在");
    }
    
    $sqlStr = "DELETE FROM sys_admin_user WHERE id = '$userId'";
    $mysqlObj->executeUpdate($sqlStr);
    
    response::success("删除成功");
}

// 拼接查询条件
$sqlStr_search = " WHERE 1=1";
if (request::get("searchAccount") != "") {
    $sqlStr_search .= " AND `account` LIKE '%".request::get("searchAccount")."%'";
}
if (request::get("searchRemarks") != "") {
    $sqlStr_search .= " AND `remarks` LIKE '%".request::get("searchRemarks")."%'";
}

// 查询数据总数
$sqlStr_count = "SELECT COUNT(1) AS count FROM `sys_admin_user` AS log"
                    .$sqlStr_search;
$totals = $mysqlObj->executeQuery($sqlStr_count)[0]["count"];

// 计算分页参数
$pagehelper = new pagehelper($totals, 10, request::get("pageNo"));

// 查询数据列表
$sqlStr_list = "SELECT * FROM `sys_admin_user`"
                    .$sqlStr_search
                    ." LIMIT ".$pagehelper->limit." ,".$pagehelper->pageSize;
$dataList = $mysqlObj->executeQuery($sqlStr_list);
?>
<!DOCTYPE html>
<html lang="cn">
<head>
    <title>管理用户列表 - 数据管理系统(管理端)</title>
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
                            <h3>管理用户列表</h3>
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
                                                    <span class="input-group-text">用户备注</span>
                                                    <input type="text" class="form-control" name="searchRemarks" value="<?php echo request::get("searchRemarks")?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12 mb-3">
                                                <button type="submit" class="btn btn-primary">搜索</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body p-0 table-responsive text-nowrap">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th colspan="8">
                                                <a class="btn btn-sm btn-secondary" href="/admin/addadminuser.php"><i class="bi bi-plus-square-fill"></i> 新增</a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>用户账号</th>
                                            <th>邮箱地址</th>
                                            <th>手机号码</th>
                                            <th>QQ号码</th>
                                            <th>用户备注</th>
                                            <th>用户状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            // 遍历数据列表
                                            foreach ($dataList as $key => $value) {
                                                echo "<tr>";
                                                echo "<td style='width: 15px;'>".($key+1)."</td>";
                                                echo "<td>".$value["account"]."</td>";
                                                echo "<td>".$value["email"]."</td>";
                                                echo "<td>".$value["telephone"]."</td>";
                                                echo "<td>".$value["qqnumber"]."</td>";
                                                echo "<td>".$value["remarks"]."</td>";
                                                
                                                // 判断用户状态
                                                if ($value["status"] == 1) {
                                                    echo "<td><span class='badge text-bg-success'>正常</span></td>";
                                                } else {
                                                    echo "<td><span class='badge text-bg-danger'>禁用</span></td>";
                                                }
                                                
                                                // 当前用户不能直接编辑自己或删除自己
                                                if($_SESSION["adminUser"]["id"] == $value["id"]) {
                                                    echo "<td>-</td>";
                                                } else {
                                                    echo "<td>
                                                        <a class='link-underline link-underline-opacity-0' href='/admin/editadminuser.php?id=".$value["id"]."'><i class='bi bi-pencil-square'></i> 修改</a>
                                                        ｜
                                                        <a class='link-underline link-underline-opacity-0' href='javascript:deleteById(".$value["id"].");'><i class='bi bi-trash-fill'></i> 删除</a>
                                                    </td>";
                                                }
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
        
        function deleteById(userId) {
            if (confirm("确定要删除该数据吗？")) {
                $.ajax({
                    url: "",
                    type: "POST",
                    data: {
                        id: userId,
                        action: "delete"
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.code == 200) {
                            alert("删除成功");
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    }
                })
            }
        }
    </script>
</body>
</html>
