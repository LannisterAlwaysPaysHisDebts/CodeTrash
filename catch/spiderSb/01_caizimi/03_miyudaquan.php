<?php
/**
 * 谜语大全抓取: http://gs.jzb.com/my/
 */

 // url + page, 这里的 page 需要乘 20
 $list_url = 'http://gs.jzb.com/my/?pg=';

 // base_url + a href 
 $base_url = 'http://gs.jzb.com';

 // 最大的页面: 100
 $max_page = 100;

 // 列表抓取规则
 $list_rule = [
     'url' => ['.riddles_Lst h3 a', 'href']
 ];

 
 

 