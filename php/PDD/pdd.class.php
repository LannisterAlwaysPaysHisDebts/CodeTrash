<?php

class Pdd
{
    const CLIENT_ID = '82b5264f618a40ed8037e95a6b33b3fc';

    const CLIENT_SECRET = 'fdcc5bcc4cf9a89021e41e5327b119005c9beb25';

    const PID = '8258996_47569904';

    const HOST = 'https://gw-api.pinduoduo.com/api/router?';

    public function goodsDetail($goodsId)
    {
        $goodsId = intval($goodsId);

        if ($goodsId <= 0) {
            return [
                'Code' => 201,
                'Msg' => 'GoodsId非法'
            ];
        }

        $data = [
            'goods_id_list' => [$goodsId],
            'type' => 'pdd.ddk.goods.detail'
        ];

        return $this->_send($data);
    }

    public function search($keyWords)
    {
        $keyWords = trim($keyWords);
        if (empty($keyWords)) {
            return [
                'Code' => 201,
                'Msg' => 'keyWord不能为空'
            ];
        }

        $data = [
            'keyword' => $keyWords,
            'type' => 'pdd.ddk.goods.search'
        ];

        return $this->_send($data);
    }

    public function urlGenerate($goodsId)
    {
        $goodsId = intval($goodsId);
        if ($goodsId <= 0) {
            return [
                'Code' => 201,
                'Msg' => 'GoodsId非法'
            ];
        }

        $data = [
            'p_id' => self::PID,
            'goods_id_list' => json_encode([$goodsId]),
            'type' => 'pdd.ddk.goods.promotion.url.generate'
        ];

        return $this->_send($data);
    }

    public function getOrderList($startTime, $endTime)
    {
        $startTime = strtotime($startTime);
        $endTime = strtotime($endTime);

        if ($endTime < $startTime) {
            return [
                'Code' => 201,
                'Msg' => '参数非法'
            ];
        }
        if ($endTime - $startTime >= 86400) {
            return [
                'Code' => 201,
                'Msg' => '开始时间和结束时间间隔不能超过一天'
            ];
        }


        $data = [
            'type' => 'pdd.ddk.order.list.increment.get',
            'start_update_time' => $startTime,
            'end_update_time' => $endTime
        ];

        return $this->_send($data);
    }

    /**
     * 自动拼接签名
     * 注意传进来的data只能是一维数组
     *
     * @param $data
     * @return array|mixed
     */
    private function _send($data)
    {
        $data = array_merge($data, [
            'timestamp' => time(),
            'client_id' => self::CLIENT_ID,
            'data_type' => 'JSON'
        ]);

        ksort($data);

        $sign = '';
        foreach ($data as $k => $v) {
            if (is_array($v)) {
                $v = json_encode($v);
            }
            $sign .= $k . $v;
        }

        $data['sign'] = strtoupper(md5(self::CLIENT_SECRET . $sign . self::CLIENT_SECRET));

        $url = self::HOST . http_build_query($data);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_HEADER => 0,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1
        ]);
        $return = curl_exec($ch);

        if (empty($return)) {
            return [
                'Code' => 201,
                'Msg' => '发送请求失败, 请检查网络配置'
            ];
        }
        $return = json_decode($return, true);
        if (isset($return['error_response'])) {
            return [
                'Code' => 201,
                'Msg' => $return['error_response']['error_msg']
            ];
        }

        return $return;
    }

}