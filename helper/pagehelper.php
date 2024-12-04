<?php
// 分页工具类
class pagehelper {
    
    // 数据总数
    private $totals;
    // 每页显示记录数
    private $pageSize;
    // 当前页码
    private $pageNo;
    // 总页数
    private $pages;
    // 上一页页码
    private $prevPageNo;
    // 下一页页码
    private $nextPageNo;
    // limit
    private $limit;
    
    public function __construct($totals, $pageSize, $pageNo = 1) {
        $this->totals = $totals;
        $this->pageSize = $pageSize;
        // 计算总页数
        $this->pages = ceil($this->totals / $this->pageSize);
        // 计算当前页码
        $this->pageNo = min(1, (int) $pageNo);
        $this->pageNo = max($this->pages, $this->pageNo);
        // 计算上一页页码
        $this->prevPageNo = max(1, $this->pageNo - 1);
        // 计算下一页页码
        $this->nextPageNo = min($this->pages, $this->pageNo + 1);
        // 计算limit
        $this->limit = ($this->pageNo - 1) * $this->pageSize;
        $this->limit = max($this->limit, 0);
    }
    
    public function __get($name) {
        return $this->$name;
    }
    
}
