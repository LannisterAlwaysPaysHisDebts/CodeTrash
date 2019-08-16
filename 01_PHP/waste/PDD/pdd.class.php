<?php

class Pdd
{
    const CLIENT_ID = '82b5264f618a40ed8037e95a6b33b3fc';

    const CLIENT_SECRET = 'fdcc5bcc4cf9a89021e41e5327b119005c9beb25';

    const PID = '8258996_47569904';

    const HOST = 'https://gw-api.pinduoduo.com/api/router?';

    const SORT_ARR = [
        '综合排序',
        '按佣金比率升序',
        '按佣金比例降序',
        '按价格升序',
        '按价格降序',
        '按销量升序',
        '按销量降序',
        '优惠券金额排序升序',
        '优惠券金额排序降序',
        '券后价升序排序',
        '券后价降序排序'
    ];

    /**
     * 从拼多多链接中获取goodsId
     * get参数: goods_id
     *
     * @param $url
     * @return array
     */
    public function getGoodsIdByUrl($url)
    {
        $query = parse_url($url)['query'];
        if (empty($query)) {
            return [
                'Code' => 201,
                'Msg' => 'Url没有Get参数'
            ];
        }

        $query = explode('&', $query);

        foreach ($query as $key => $value) {
            unset($query[$key]);

            $tmp = explode('=', $value);

            $query[$tmp[0]] = $tmp[1];
        }

        if (!isset($query['goods_id']) || empty($query['goods_id'])) {
            return [
                'Code' => 201,
                'Msg' => '该Url没有商品Id参数'
            ];
        }

        return [
            'Code' => 200,
            'Msg' => '',
            'Data' => $query['goods_id']
        ];
    }

    /**
     * 通过拼多多商品链接获取推广链接( 转链 )
     *
     * @param $url
     * @return array
     */
    public function urlGenerate($url)
    {
        $res = $this->getGoodsIdByUrl($url);
        if ($res['Code'] != 200) {
            return $res;
        }

        return $this->transform($res['Data']);
    }

    /**
     * 通过商品Id获取商品详情
     *
     * @param $goodsId: 商品Id
     *
     * @return array|mixed
     *
     * [
     *  'GoodsId': 拼多多商品Id,
     *  'GoodsName': 商品标题,
     *  'GoodsDesc': 商品描述,
     *  'Image': 商品主图,
     *  'ImageList': 商品轮播图,
     *  'Sold': 销量,
     *  'CouponDiscount': 优惠券金额,单位: 分,
     *  'CouponMinOrderAmount': 优惠券门槛金额, 单温: 分,
     *  'CouponTotalQuantity': 优惠券总数量,
     *  'CouponRemainQuantity': 优惠券剩余数量,
     *  'Rate': 佣金比例,
     *  'MinGroupPrice': 最小拼团价格,
     *  'MinNormalPrice': 最小单买价格,
     * ]
     *
     */
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
            'goods_id_list' => json_encode([$goodsId]),
            'type' => 'pdd.ddk.goods.detail'
        ];

        $result = $this->_send($data);
        if ($result['Code'] != 200) {
            return $result;
        }

        $goodsInfo = $result['Data']['goods_detail_response']['goods_details'][0];

        return [
            'Code' => 200,
            'Msg' => '',
            'Data' => [
                'GoodsId' => $goodsInfo['goods_id'],
                'GoodsName' => $goodsInfo['goods_name'],
                'GoodsDesc' => $goodsInfo['goods_desc'],
                'Image' => $goodsInfo['goods_image_url'],
                'ImageList' => $goodsInfo['goods_gallery_urls'],
                'Sold' => $goodsInfo['sold_quantity'],
                'CouponDiscount' => $goodsInfo['coupon_discount'],
                'Rate' => $goodsInfo['promotion_rate'],
                'MinGroupPrice' => $goodsInfo['min_group_price'],
                'MinNormalPrice' => $goodsInfo['min_normal_price'],
                'CouponMinOrderAmount' => $goodsInfo['coupon_min_order_amount'],
                'CouponTotalQuantity' => $goodsInfo['coupon_total_quantity'],
                'CouponRemainQuantity' => $goodsInfo['coupon_remain_quantity']
            ]
        ];
    }



    /**
     * 通过关键字搜索拼多多商品
     *
     *
     * @param string $keyWords
     *
     * @param int $page: 商品分页数, 默认为1
     *
     * @param int $pageSize: 每页商品数量, 默认为20
     *
     * @param int $sort: 排序:
     *
     *          0-综合排序;
     *          1-按佣金比率升序;
     *          2-按佣金比例降序;
     *          3-按价格升序;
     *          4-按价格降序;
     *          5-按销量升序;
     *          6-按销量降序;
     *          7-优惠券金额排序升序;
     *          8-优惠券金额排序降序;
     *          9-券后价升序排序;
     *          10-券后价降序排序;
     *
     * @param bool $coupon: 是否只返回有券的商品, 默认false
     *
     * @return array
     *
     * [
     *  'Code': 200/201
     *  'Msg': ''
     *  'Data: [
     *      'Count': 商品数量,
     *      'GoodsList': [
     *  'GoodsId': 拼多多商品Id,
     *  'GoodsName': 商品标题,
     *  'GoodsDesc': 商品描述,
     *  'Thumb': 商品缩略图
     *  'Image': 商品主图,
     *  'ImageList': 商品轮播图,
     *  'Sold': 销量,
     *  'CouponDiscount': 优惠券金额,单位: 分,
     *  'CouponMinOrderAmount': 优惠券门槛金额, 单温: 分,
     *  'CouponTotalQuantity': 优惠券总数量,
     *  'CouponRemainQuantity': 优惠券剩余数量,
     *  'Rate': 佣金比例,
     *  'MinGroupPrice': 最小拼团价格,
     *  'MinNormalPrice': 最小单买价格,
     *      ]
     *  ]
     * ]
     */
    public function search($keyWords, $page = 1, $pageSize = 20, $sort = 0, $coupon = false)
    {
        $keyWords = trim($keyWords);
        if (empty($keyWords)) {
            return [
                'Code' => 201,
                'Msg' => 'keyWord不能为空'
            ];
        }
        if ($page < 1 || $pageSize < 1 || !isset(self::SORT_ARR[$sort]) || !is_bool($coupon)) {
            return [
                'Code' => 201,
                'Msg' => '参数非法'
            ];
        }

        $coupon = $coupon ? 'true' : 'false';

        $data = [
            'type' => 'pdd.ddk.goods.search',
            'keyword' => $keyWords,
            'page' => $page,
            'page_size' => $pageSize,
            'sort_type' => $sort,
            'with_coupon' => $coupon
        ];

        $result = $this->_send($data);
        if ($result['Code'] != 200) {
            return $result;
        }

        $total = $result['Data']['goods_search_response']['total_count'];
        $searchInfo = $result['Data']['goods_search_response']['goods_list'];

        if (empty($searchInfo) && $total <= 0) {
            return [
                'Code' => 201,
                'Msg' => '未找到'
            ];
        }

        $goodsList = [];
        foreach ($searchInfo as $item) {
            $imageList = [];
            if (!empty($item['goods_gallery_urls'])) {
                $imageList = $item['goods_gallery_urls'];
            }

            $desc = '';
            if (!empty($item['goods_desc'])) {
                $desc = $item['goods_desc'];
            }

            $goodsList[] = [
                'GoodsId' => $item['goods_id'],
                'GoodsName' => $item['goods_name'],
                'GoodsDesc' => $desc,
                'Thumb' => $item['goods_thumbnail_url'],
                'Image' => $item['goods_image_url'],
                'ImageList' => $imageList,
                'Sold' => $item['sold_quantity'],
                'MinGroupPrice' => $item['min_group_price'],
                'MinNormalPrice' => $item['min_normal_price'],
                'CouponDiscount' => intval($item['coupon_discount']),
                'CouponMinOrderAmount' => intval($item['coupon_min_order_amount']),
                'CouponTotalQuantity' => intval($item['coupon_total_quantity']),
                'CouponRemainQuantity' => intval($item['coupon_remain_quantity']),
                'Rate' => $item['promotion_rate']
            ];
        }

        return [
            'Code' => 200,
            'Msg' => '',
            'Data' => [
                'Count' => $total,
                'GoodsList' => $goodsList
            ]
        ];
    }

    /**
     * 通过商品Id 获取推广链接
     *
     *
     * @param $goodsId
     *
     * @return array
     *
     * [
     *  'WechatShortUrl': 微信短链接,
     *  'WechatUrl': 微信长链接,
     *  'PddUrl': 拼多多短链接,
     *  'PddShortUrl': 拼多多长链接,
     *  'Url': 长链接
     *  'ShortUrl': 短链接
     * ]
     *
     */
    public function transform($goodsId)
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

        $result = $this->_send($data);
        if ($result['Code'] != 200) {
            return $result;
        }

        $info = $result['Data']['goods_promotion_url_generate_response']['goods_promotion_url_list'][0];

        if (empty($info)) {
            return [
                'Code' => 201,
                'Msg' => '获取转链失败'
            ];
        }

        return [
            'Code' => 200,
            'Msg' => '',
            'Data' => [
                'WechatShortUrl' => $info['we_app_web_view_short_url'],
                'WechatUrl' => $info['we_app_web_view_url'],
                'PddUrl' => $info['mobile_url'],
                'PddShortUrl' => $info['mobile_short_url'],
                'Url' => $info['url'],
                'ShortUrl' => $info['short_url']
            ]
        ];
    }

    /**
     * 获取订单详情
     *
     * @param $orderNum: 订单号
     *
     *
     * @return array
     *
     * [
     *  'OrderNum': 订单编号,
     *  'GoodsId': 商品id,
     *  'GoodsName': 商品名称
     *  'Thumb': 商品缩略图
     *  'GoodsQuantity': 商品数量,
     *  'GoodsPrice': 商品价格, 单位: 分
     *  'OrderAmount': 订单价格, 单位: 分
     *  'Rate': 佣金比率, 百分比,
     *  'Amount': 佣金金额, 单位: 分
     *  'OrderStatus': 订单状态:
     *  'OrderStatusDesc': 订单状态描述
     *  'OrderCreateTime': 订单创建时间
     *  'OrderPayTime': 订单支付时间
     *  'OrderGroupSuccessTime': 订单成团时间
     *  'OrderReceiveTime': 订单确认收货时间
     *  'OrderVerifyTime': 订单审核时间
     *  'OrderSettleTime': 订单结算时间
     *  'OrderModifyTime': 订单最后更新时间
     * ]
     */
    public function getOrderDetail($orderNum)
    {
        if (empty($orderNum)) {
            return [
                'Code' => 201,
                'Msg' => '订单号不能为空'
            ];
        }

        $data = [
            'order_sn' => $orderNum,
            'type' => 'pdd.ddk.order.detail.get'
        ];

        $result = $this->_send($data);
        if ($result['Code'] != 200) {
            return $result;
        }

        $info = $result['Data']['order_detail_response'];

        $orderInfo = [
            'OrderNum' => $info['order_sn'],
            'GoodsId' => $info['goods_id'],
            'GoodsName' => $info['goods_name'],
            'Thumb' => $info['goods_thumbnail_url'],
            'GoodsQuantity' => $info['goods_quantity'],
            'GoodsPrice' => $info['goods_price'],
            'OrderAmount' => $info['order_amount'],
            'Rate' => $info['promotion_rate'],
            'Amount' => $info['promotion_amount'],
            'OrderStatus' => $info['order_status'],
            'OrderStatusDesc' => $info['order_status_desc'],
            'OrderCreateTime' => date('Y-m-d H:i:s', $info['order_create_time']),
            'OrderPayTime' => date('Y-m-d H:i:s', $info['order_pay_time']),
            'OrderGroupSuccessTime' => date('Y-m-d H:i:s', $info['order_group_success_time']),
            'OrderReceiveTime' => date('Y-m-d H:i:s', $info['order_receive_time']),
            'OrderVerifyTime' => date('Y-m-d H:i:s', $info['order_verify_time']),
            'OrderSettleTime' => date('Y-m-d H:i:s', $info['order_settle_time']),
            'OrderModifyTime' => date('Y-m-d H:i:s', $info['order_modify_at']),
        ];

        return [
            'Code' => 200,
            'Msg' => '',
            'Data' => $orderInfo
        ];
    }

    /**
     * 根据时间来获取订单信息
     *
     * @param $startTime
     * @param $endTime
     * @param $page
     * @param $pageSize
     *
     * @return array
     */
    public function getOrderList($startTime, $endTime, $page = 1, $pageSize = 40)
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
            'end_update_time' => $endTime,
            'page' => $page,
            'page_size' => $pageSize
        ];

        $result = $this->_send($data);
        if ($result['Code'] != 200) {
            return $result;
        }

        $orderList = $result['Data']['order_list_get_response']['order_list'];
        $count = $result['Data']['order_list_get_response']['total_count'];

        if (empty($orderList) && $count <= 0) {
            return [
                'Code' => 201,
                'Msg' => '没有订单'
            ];
        }

        $orderListBuild = [];
        foreach ($orderList as $item) {
            $orderListBuild[] = [
                'OrderNum' => $item['order_sn'],
                'GoodsId' => $item['goods_id'],
                'GoodsName' => $item['goods_name'],
                'Thumb' => $item['goods_thumbnail_url'],
                'GoodsQuantity' => $item['goods_quantity'],
                'GoodsPrice' => $item['goods_price'],
                'OrderAmount' => $item['order_amount'],
                'Rate' => $item['promotion_rate'],
                'Amount' => $item['promotion_amount'],
                'OrderStatus' => $item['order_status'],
                'OrderStatusDesc' => $item['order_status_desc'],
                'OrderCreateTime' => date('Y-m-d H:i:s', $item['order_create_time']),
                'OrderPayTime' => date('Y-m-d H:i:s', $item['order_pay_time']),
                'OrderGroupSuccessTime' => date('Y-m-d H:i:s', $item['order_group_success_time']),
                'OrderReceiveTime' => date('Y-m-d H:i:s', $item['order_receive_time']),
                'OrderVerifyTime' => date('Y-m-d H:i:s', $item['order_verify_time']),
                'OrderSettleTime' => date('Y-m-d H:i:s', $item['order_settle_time']),
                'OrderModifyTime' => date('Y-m-d H:i:s', $item['order_modify_at']),
            ];
        }

        return [
            'Code' => 200,
            'Msg' => '',
            'Data' => [
                'Count' => $count,
                'OrderList' => $orderListBuild
            ]
        ];
    }

    /**
     * 拼接参数并发送请求
     * 注意传进来的data只能是一维数组
     *
     * @param $data
     * @return array
     */
    private function _send($data)
    {
        $data = array_merge($data, [
            'timestamp' => time(),
            'client_id' => self::CLIENT_ID,
            'data_type' => 'JSON'
        ]);

        $data['sign'] = $this->_sign($data);

        $url = self::HOST . http_build_query($data);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_HEADER => 0,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json']
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

        return [
            'Code' => 200,
            'Data' => $return
        ];
    }

    /**
     * 签名
     *
     * @param array $data
     *
     * @return string
     */
    private function _sign($data)
    {
        ksort($data);

        $sign = '';
        foreach ($data as $k => $v) {
            if (is_array($v)) {
                $v = json_encode($v);
            } elseif (is_bool($v)) {
                $v = $v ? 'true' : 'false';
            }
            $sign .= $k . $v;
        }

        return strtoupper(md5(self::CLIENT_SECRET . $sign . self::CLIENT_SECRET));
    }
}