<?php
// 相当于setInterval，是持续触发的
swoole_timer_tick(2000, function($timer_id){
    echo "tick-2000-ms\n";
});

// 相当于setTimeout，仅在约定的时间触发一次
swoole_timer_after(3000, function(){
    echo "after 3000ms.\n";
});