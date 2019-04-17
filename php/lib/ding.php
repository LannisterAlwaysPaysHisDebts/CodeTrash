<?php
/**
 * 钉钉发送消息机器人
 * 版本1
 * 简单封装, 支持发送消息
 * 
 */

namespace lib;

class ding
{
    private $webhook_url = 'https://oapi.dingtalk.com/robot/send?access_token=179c2b683d03275bf091d482337b9a50725a1ee9fa947838de486d164dc1f965';

    public function send($message)
    {
        $data = [
            'msgtype' => 'text',
            'text' => [
                'content' => trim($message),
            ],
        ];

        return $this->_request_by_curl(json_encode($data));
    }

    private function _request_by_curl($post_string)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->webhook_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        // curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}