<?php
/**
 * IP上报
 */

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

class reportIP
{
    const IP_138 = 'http://2018.ip138.com/ic.asp';

    private $obj;

    public function __construct()
    {
        $this->obj = new ding();
    }

    /**
     * 使用138抓取ip地址
     *
     * @return bool
     */
    public function getIPBy138(): bool
    {
        if (!class_exists('\QL\QueryList')) {
            self::sendDing('抓取类初始化失败, 请检查脚本运行环境');
            return false;
        }

        $loop = 0;
        do{
            $html = \QL\QueryList::get(self::IP_138)->encoding('UTF-8', 'gb2312')->getHtml();
            $loop ++;
        }while(empty($html) && $loop <= 3);

        if (empty($html)) {
            self::sendDing('重复3次抓取失败, 尝试切换其他方式');
            return false;
        }

        // 手动解析....
        $start = strpos($html, "<center>");
        $end = strpos($html, "</center>");

        $string = substr($html, $start, $end - $start);
        $string = strip_tags($string);

        $message = "服务器IP地址自动上报机器人: " . $string;
        self::sendDing($message);

        return true;
    }

    private function sendDing($message)
    {
        $this->obj->send($message);
    }
}