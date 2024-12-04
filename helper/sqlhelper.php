<?php
if(basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) exit("Access denied");

require_once $_SERVER["DOCUMENT_ROOT"]."/config/database.php";

// MySQL操作工具类
class sqlhelper {
    
    // 数据库连接对象
    private $mysql;
    
    public function __construct(){
        // 在构造函数中连接数据库
        $this->mysql = mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DATABASE,MYSQL_PORT);
        mysqli_set_charset($this->mysql,MYSQL_CHARSET);
    }
    
    public function __destruct(){
        // 在析构函数中关闭数据库
        mysqli_close($this->mysql);
    }
    
    public function executeQuery($sqlStr) {
        // 查询方法，返回关联数组
        $result = mysqli_query($this->mysql, $sqlStr);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    public function executeUpdate($sqlStr) {
        // 增删改方法，返回影响行数
        return mysqli_query($this->mysql, $sqlStr);
    }
    
}
