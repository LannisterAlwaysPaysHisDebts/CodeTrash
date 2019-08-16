<?php
$jump_url = "http://dd.myapp.com/16891/0279607A317EA7F2DCDA72F5DE60DEA3.apk?fsname=com.weiliu.sqxbs_2.0.0_2000000.apk"; //要跳转的url
$ios_url = 'http://dd.myapp.com/16891/0279607A317EA7F2DCDA72F5DE60DEA3.apk?fsname=com.weiliu.sqxbs_2.0.0_2000000.apk';//ios打开地址
// 是否为微信
function isWechatBrowser() {
    $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    if(empty($userAgent)) return false;
    $reg_wechat = '/MicroMessenger\//i';
    return preg_match($reg_wechat, $userAgent);
}

function get_device_type()
{
    //全部变成小写字母
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $type = 'other';
    //分别进行判断
    if(strpos($agent, 'iphone') || strpos($agent, 'ipad'))
    {
        $type = 'ios';
    } 

    if(strpos($agent, 'android'))
    {
        $type = 'android';
    }
    return $type;
}
$device = get_device_type();
if(isWechatBrowser()){
    if($device == 'android'){
        $filename = "123.apk";
        $encoded_filename = urlencode($filename);
        $encoded_filename = str_replace("+", "%20", $encoded_filename);
        header('Content-Type: text/plain; charset=utf-8');
        header('tx-powered-by=Express');
        header('content-range:bytes 0-1/1');
        header("Content-Length: 0");
        header("Content-Disposition: attachment; filename=$filename");
        exit;
    }
}

if($device == 'ios'){
    $open_url = 0;
}else{
    $open_url = 1;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta content="false" name="twcClient" id="twcClient"/>
    <style>
body,html{width:100%;height:100%}
*{margin:0;padding:0}
body{background-color:#fff}
.top-bar-guidance{font-size:15px;color:#fff;height:40%;line-height:1.8;padding-left:20px;padding-top:20px;background:url(./images/tupian.png) center top/contain no-repeat}
.top-bar-guidance .icon-safari{width:25px;height:25px;vertical-align:middle;margin:0 .2em}
.app-download-btn{display:block;width:214px;height:40px;line-height:40px;margin:18px auto 0 auto;text-align:center;font-size:18px;color:#2466f4;border-radius:20px;border:.5px #2466f4 solid;text-decoration:none}
    </style>
</head>
<body>
      <div id="two" style="display: none;">
    </div>
<div class="top-bar-guidance">
    <p>点击右上角<img src="//gw.alicdn.com/tfs/TB1xwiUNpXXXXaIXXXXXXXXXXXX-55-55.png" class="icon-safari" /> Safari打开</p>
    <p>可以继续访问本站哦~</p>
</div>
  <a class="app-download-btn" id="BtnClick"  onclick="q()">
    点此继续访问
</a>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script>

var url = '<?php echo $jump_url;?>'; //填写要跳转到的网址

document.querySelector('body').addEventListener('touchmove', function (event) {
    event.preventDefault();
});
window.mobileUtil = (function(win, doc) {
    var UA = navigator.userAgent,
        isAndroid = /android|adr/gi.test(UA),
        isIOS = /iphone|ipod|ipad/gi.test(UA) && !isAndroid,
        isBlackBerry = /BlackBerry/i.test(UA),
        isWindowPhone = /IEMobile/i.test(UA),
        isMobile = isAndroid || isIOS || isBlackBerry || isWindowPhone;
    return {
        isAndroid: isAndroid,
        isIOS: isIOS,
        isMobile: isMobile,
        isWeixin: /MicroMessenger/gi.test(UA),
        isQQ: /QQ/gi.test(UA)
    };
})(window, document);
//if(mobileUtil.isIOS && !mobileUtil.isWeixin){
//    location.href='<?php //echo $ios_url;?>//';
//}
//if(mobileUtil.isAndroid && !mobileUtil.isWeixin){
//     location.href='<?php //echo $jump_url;?>//';
//}
if(mobileUtil.isWeixin || mobileUtil.isMobile){
    if(mobileUtil.isIOS){


    }else if(mobileUtil.isAndroid){
        // url = '?open=1';
        // document.getElementById('BtnClick').href=url;
        // var iframe = document.createElement("iframe");
        // iframe.style.display = "none";
        // iframe.src = url;
        // document.body.appendChild(iframe);
    }
}else{
    // document.getElementById('BtnClick').href=url;
    // window.location.replace(url);
}
$(function(){
    var open_url=<?php echo $open_url;?>;

    if(open_url == 1){
        // setTimeout(function(){
        //     // window.location.replace(url); 旧的
        //     window.location.replace('<?php echo  $jump_url;?>'); //新的
        // }, 500);
    }else{
        q();
    }
})
function q(){
    $("#two").show();
    $(".top-bar-guidance").hide();
    $("#BtnClick").hide();
}
//setTimeout('WeixinJSBridge.invoke("closeWindow", {}, function(e) {})', 2000);
</script>
<div style="display: none;">
    <script src="https://s22.cnzz.com/z_stat.php?id=1273445637&web_id=1273445637" language="JavaScript"></script>
</div>
</body>
</html>