<?php
/**
 * 代理抓取
 */
namespace lib\util;

class Proxy
{
    /**
     * 切换IP
     */
    const PROXY_SWITCH_IP_URL = "http://proxy.abuyun.com/switch-ip";

    /**
     * 当前IP
     */
    const PROXY_CURRENT_IP_URL = "http://proxy.abuyun.com/current-ip";

    /**
     * 代理服务器
     */
    const PROXY_SERVER = "http://proxy.abuyun.com:9020";

    /**
     * 隧道身份信息
     */
    const PROXY_USER = "HKG7K8F01I5974LD";
    const PROXY_PASS = "23A86E4DAE706927";
    const PROXY_AUTH = self::PROXY_USER . ":" . self::PROXY_PASS;

    /**
     * 最大超时连接
     */
    const MAX_CONNECTION_TIMEOUT = 3;

    /**
     * 最大超时连接
     */
    const MAX_TIMEOUT = 5;

    /**
     * get方式获取
     *
     * @param $url
     * @param array|string $header
     * @param integer $timeout
     *
     * @return string
     */
    public static function get($url, $header = [], $timeout = self::MAX_TIMEOUT,$returnHeader = false)
    {
        $header = self::_parseHeader($header);
        $ch = self::_getCh($url, $header, $timeout,$returnHeader);
        $result = curl_exec($ch);
//        $info = curl_getinfo($ch);
        $error = ['time' => date('Y-m-d H:i:s')];
        if (!$result) {
            $error["code"] = curl_errno($ch);
            $error["msg"]  = curl_error($ch);

            runtime_log('proxy/get', serialize(['error' => $error, 'url' => $url]));
        }

        curl_close($ch);

        return empty($result) ? '' : $result;
    }

    /**
     * post方式获取
     *
     * @param $url
     * @param array $fields
     * @param array|string $header
     * @param integer $timeout
     *
     * @return string
     */
    public static function post($url, $fields = [], $header = [], $timeout = self::MAX_TIMEOUT)
    {
        $header = self::_parseHeader($header);
        $ch = self::_getCh($url, $header, $timeout);

        // POST 参数
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));

        $result = curl_exec($ch);
//        $info = curl_getinfo($ch);

        $error = ['time' => date('Y-m-d H:i:s')];
        if (!$result) {
            $error["code"] = curl_errno($ch);
            $error["msg"]  = curl_error($ch);

            runtime_log('proxy/post', serialize(['error' => $error, 'url' => $url, 'fields' => $fields]));
        }

        curl_close($ch);

        return empty($result) ? '' : trim($result);
    }

    /**
     * @param $url
     * @param array $header
     * @param integer $timeout
     *
     * @return resource
     */
    private static function _getCh($url, $header, $timeout,$returnHeader = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, false);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // 设置代理服务器
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        curl_setopt($ch, CURLOPT_PROXY, self::PROXY_SERVER);

        // 设置隧道验证信息
        curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, self::PROXY_AUTH);

        // 加此请求头会让每个请求都自动切换IP
        $header = array_merge($header, ["Proxy-Switch-Ip: yes"]);
        curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::MAX_CONNECTION_TIMEOUT);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        curl_setopt($ch, CURLOPT_HEADER, $returnHeader);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return $ch;
    }

    private static function _parseHeader($header)
    {
        if (is_string($header)) {
            $header = array_map(function ($item){
                return trim($item);
            }, explode("\n", trim($header)));
        }

        return $header;
    }
}