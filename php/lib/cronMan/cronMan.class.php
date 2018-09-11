<?php
/**
 * cron Manage
 * 功能:
 * 1. 管理系统cron, 可以使用命令端, 也有web端
 * 2. 管理特定地址的cron脚本 (脚本需要按照格式编写 )
 */


/**
 * Class cronMan
 * System Crontab Manage
 */
class cronMan
{
    public function start()
    {
        $common = "crontab";
        $output = '';
        exec($common, $output);

        var_dump($output);
    }
}

