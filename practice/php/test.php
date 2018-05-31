<?php
    //分页大小
    $pageSize = 50;
    //数据
    $data;
    //计算页数
    $pages = ceil($data / $pageSize);
    //开始分页
    for ($page = 0; $page < $pages; $page++) {
        $start = $page * $pageSize;
        $end = $pageSize + $start - 1;
        
        //分页的逻辑操作
    }