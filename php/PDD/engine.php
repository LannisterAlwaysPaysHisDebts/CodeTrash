<?php

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';
require __DIR__ . '/pdd.class.php';

$obj = new Pdd();

//$array = array (
//    'type' => 'pdd.ddk.goods.search',
//    'data_type' => 'JSON',
//    'timestamp' => '1546589383',
//    'client_id' => '82b5264f618a40ed8037e95a6b33b3fc',
//    'keyword' => '【30包18包8包可选】好家选本色竹浆抽纸包餐巾纸面纸卫生纸巾',
//    'page' => '1',
//    'page_size' => '20',
//    'sort_type' => '0',
//    'with_coupon' => 'false',
////    'sign' => '622687BCD8DCE12F10E1BEBEF3360BC0',
//);
//
//$sign = $obj->_sign($array);
//
//var_dump($sign);
//var_dump('622687BCD8DCE12F10E1BEBEF3360BC0');
//
//die;

/**
 * 模拟场景1: 用户发送过来的拼多多链接
 *
 */

//$url = "https://mobile.yangkeduo.com/goods2.html?goods_id=2067164789&ts=1546431170816&page_from=0&share_uin=7GHF2VHVPWVFOI232YGE4HROFE_GEXDA&refer_share_id=50ea063b8fed4fa990889d85c0d85219&refer_share_uid=3758927828&refer_share_channel=message&from=singlemessage";
//$url = "https://mobile.yangkeduo.com/goods2.html?goods_id=2569223989";
//
//$res = $obj->getGoodsIdByUrl($url);
//
//if ($res['Code'] != 200) {
//    var_dump($res);
//    exit();
//}
//
//$goodsId = $res['Data'];
//
//$res = $obj->goodsDetail($goodsId);
//
//var_dump($res);


/**
 * 模拟场景2: 用户发送过来拼多多的商品标题 或者搜索链接
 *
 */

//$title = "【30包18包8包可选】好家选本色竹浆抽纸包餐巾纸面纸卫生纸巾";
//
//$res = $obj->search($title);
//
//var_dump($res);

/**
 * 场景3: 用户发送链接, 发送转链给用户
 *
 *
 */

//$url = "https://mobile.yangkeduo.com/goods2.html?goods_id=2067164789&ts=1546431170816&page_from=0&share_uin=7GHF2VHVPWVFOI232YGE4HROFE_GEXDA&refer_share_id=50ea063b8fed4fa990889d85c0d85219&refer_share_uid=3758927828&refer_share_channel=message&from=singlemessage";
//
//$res = $obj->urlGenerate($url);
//
//var_dump($res);


/**
 * 场景4: 用户已经购买了, 发送订单号来绑定订单
 *
 *
 */

//$orderNum = '190102-676473406594052';
//
//$res = $obj->getOrderDetail($orderNum);
//var_dump($res);


/**
 * 场景5: 用户发送二维码图片来获取商品信息
 *
 *
 */

//$path = dirname(dirname(__DIR__)) . '/static/WechatIMG363.jpeg';
//
//$qrCode = new \Zxing\QrReader($path);
//$text = $qrCode->text();
//var_dump($text);
//
//$res = $obj->getGoodsIdByUrl($text);
//if ($res['Code'] != 200) {
//    var_dump($res);
//    exit();
//}
//$res = $obj->goodsDetail($res['Data']);
//var_dump($res);


/**
 * 场景6: 自动更新订单表
 *
 *
 */

$startTime = '2019-01-02 18:00:44';
$endTime = '2019-01-02 20:59:44';
$res = $obj->getOrderList($startTime, $endTime);
var_dump($res);
