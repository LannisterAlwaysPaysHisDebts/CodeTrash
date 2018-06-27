<?php
return $str = <<<EOF
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>
            鬼斧神工之正则表达式-慕课网
    </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="renderer" content="webkit" />
<meta name="mobile-agent" content="format=wml"; url="https://m.imooc.com/learn/350">
<link rel="alternate" media="only screen and (max-width: 640px)" href="https://m.imooc.com/learn/350">
<meta name="mobile-agent" content="format=xhtml"; url="https://m.imooc.com/learn/350">
<meta name="mobile-agent" content="format=html5"; url="https://m.imooc.com/learn/350">
<meta property="qc:admins" content="77103107776157736375" />
<meta property="wb:webmaster" content="c4f857219bfae3cb" />
<meta http-equiv="Access-Control-Allow-Origin" content="*" />
<meta http-equiv="Cache-Control" content="no-transform " />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="dns-prefetch" href="//www.imooc.com" />
<link rel="dns-prefetch" href="//img.imooc.com" />
<link rel="dns-prefetch" href="//img.mukewang.com" />
<link rel="apple-touch-icon" sizes="76x76" href="/static/img/common/touch-icon-ipad.png">
<link rel="apple-touch-icon" sizes="120x120" href="/static/img/common/touch-icon-iphone-retina.png">
<link rel="apple-touch-icon" sizes="152x152" href="/static/img/common/touch-icon-ipad-retina.png">

<meta name="Keywords" content="" />

<meta name="description" content="在本课程中可以充分理解正则表达式的定义并掌握如何在实际开发中应用正则表达式。其中包含表单验证实际应用以及简易版模板引擎的实现" />








<link rel="stylesheet" href="/static/moco/v1.0/dist/css/moco.min.css?t=201806151756" type="text/css" />
    <link rel="stylesheet" href="/static/lib/swiper/swiper-3.4.2.min.css?t=201806151756">

<script type="text/javascript">

eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1;};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p;}('!4(){3 a={};3 c=0;3 5=[{d:\'//o.q.g/o/p/K/J.r\',6:0},{d:\'//p.q.g/I/L-O.r\',6:0}];3 w=4(){3 j,s=e N("(^| )"+"k=([^;]*)(;|$)");8(j=u.l.M(s)){m H(j[2])}E{m z}};3 y=4(t){3 n=w();3 b=e F();b.G(b.D()+13*v*v*10);u.l="k="+t+";14="+b.R()+";S=/;P=Q.g";8(t&&t!=n){X.U.V()}};3 C=4(i){3 7=e W();7.T=4(){12(a[i]);a[i]=z;9(i,0)};7.Z=4(){9(i,1)};a[i]=11(4(){7.B="";9(i,1)},Y);7.B=5[i].d};3 9=4(x,6){c++;5[x].6=6;8(c==5.f){3 h=0;A(3 i=0;i<5.f;i++){8(5[i].6==1){h=1}}y(h)}};A(3 i=0;i<5.f;i++){C(i)}}()',62,67,'|||var|function|urls|flag|imgobj|if|callback|timer|exp|count|url|new|length|com|error||arr|IMCDNS|cookie|return|_0|static|img|mukewang|png|reg||document|60|getcookie|index|setcookie|null|for|src|checkCdn|getTime|else|Date|setTime|unescape|images|logo|common|unknow|match|RegExp|80|domain|imooc|toGMTString|path|onload|location|reload|Image|window|3000|onerror|1000|setTimeout|clearTimeout|24|expires'.split('|'),0,{}))

</script>


<script type="text/javascript">

var OP_CONFIG={"module":"course","page":"learn","userout":0,"usercaution":null};
var isLogin = 0;
var is_choice = "";
var seajsTimestamp="v=201806151756";
var _msg_unread = 0; 
var _not_unread = 0; 
var _cart_num = 0;
</script>








<link href="//moco.imooc.com/captcha/style/captcha.min.css" rel="stylesheet">
<script>
/*学习页通用配置*/
var GC = {
  course: {
    id: 350,
    name: '鬼斧神工之正则表达式',
    pic: '',
    video_url: ''
  },
  classmates: 20 // 你的同学一页显示数量
};


</script>
<script>

var hasLearn;
    hasLearn = 0;

</script>




    <!--百度 pvuv-->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?fb538fdd5bd62072b6a984ddbc658a16";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

<link rel="stylesheet" href="//static.mukewang.com/static/css/??base.css,common/common-less.css?t=2.5,course/common-less.css,course/view-less.css,course/learn-less.css,u/dynamic/home-less.css?v=201806151756" type="text/css" />
</head>

<body >

<div id="header">
    <div class="page-container" id="nav"  >
         <div id="logo" class="logo"><a href="/" target="_self" class="hide-text" title="首页">慕课网</a></div>
      

        <button type="button" class="navbar-toggle visible-xs-block js-show-menu" >
            <i class="icon-menu"></i>
        </button>
        <ul class="nav-item">
                        <li class="set-btn visible-xs-block"><a href="/user/newlogin" target="_self">登录</a> / <a href="/user/newsignup" target="_self">注册</a></li>
                        
            <li>
                <a href="/course/list" class="active" target="_self">免费课程</a>
            </li>           
            <li><a href="//class.imooc.com" class="" target="_self">职业路径</a></li>
            <li>
                <a href="//coding.imooc.com" target="_self">实战</a>
            </li>
            <li><a href="/wenda"  target="_self">猿问</a></li>
            <li><a href="/article"  target="_self">手记</a></li>
            <li><a href="//job.imooc.com" class="program-nav" target="_self">找工作<i class="icn-new"></i></a></li>
            
        </ul>
                <div id="login-area">
            <ul class="header-unlogin clearfix">
                <li class="app-load" id="js-app-load">
                    <a href="//www.imooc.com/mobile/app" target="_blank" style="width:60px;">下载APP</a>
                    <div class="app-load-box clearfix js-load-box">
                        <img src="/static/img/common/appload.png" class="l">
                        <div class="r">
                            <p>扫描下载慕课网APP</p>
                            <a href="https://itunes.apple.com/cn/app/mu-ke-wang/id722179140?mt=8" target="_blank"><i class="icon-apple"></i>App Store下载</a>
                            <a href="//www.imooc.com/mobile/mukewang.apk" target="_blank"><i class="icon-android"></i>Android下载</a>
                        </div>
                    </div>
                </li>

                <li class="shop-cart" id="shop-cart">
                    <a href="//order.imooc.com/pay/cart" class="shop-cart-icon" target="_blank">
                        <span class="icon-shopping-cart js-endcart"></span><span>购物车</span><span class="shopping_icon js-cart-num" data-ordernum="0"  data-cartnum="0" style='display: none'>0</span>
                    </a>
                    <div class="my-cart" id="js-my-cart"></div>
                </li>             
                <li class="header-signin">
                    <a href="#" id="js-signin-btn">登录</a> / <a href="#" id="js-signup-btn">注册</a>
                </li>             
            </ul>
        </div>
                <div class='search-warp clearfix' style='min-width: 32px; height: 72px;'>
                            <div class="pa searchTags" >
                                    <a href="//class.imooc.com/sc/20" target="_blank">前端入门</a>
                                    <a href="//class.imooc.com/sc/18" target="_blank">Java入门</a>
                                </div>
            
            <div class="search-area" data-search="top-banner">
                <input class="search-input" data-suggest-trigger="suggest-trigger"      type="text" autocomplete="off">
                <input type='hidden' class='btn_search' data-search-btn="search-btn" />
                <ul class="search-area-result" data-suggest-result="suggest-result">
                </ul>
            </div>
            <div class='showhide-search' data-show='no'><i class='icon-search'></i></div>
        </div>
    </div>
</div>

<div class="bindHintBox js-bindHintBox hide">
    <div class="pr">
        为了账号安全，请及时绑定邮箱和手机<a href="/user/setbindsns" class="ml20 color-red" target="_blank">立即绑定</a>
        <button  class="closeBindHint js-closeBindHint" type="button"></button>
        <div class="arrow"> </div>
    </div>
</div>


<div id="main">

<div class="course-infos">
    <div class="w pr">
        <div class="path">  
            <a href="/course/list">课程</a>
                        <i class="path-split">\</i><a href="/course/list?c=be">后端开发</a>
                                    <i class="path-split">\</i><a href="/course/list?c=php">PHP</a>
                        <i class="path-split">\</i><a href="/learn/350"><span>鬼斧神工之正则表达式</a></span>
        </div>
        <div class="hd clearfix">
            <h2 class="l">鬼斧神工之正则表达式</h2>
                    </div>

        <div class="statics clearfix">
                        <div class="teacher-info l">
            <a href="/u/250255/courses?sort=publish" target="_blank" >
                <img data-userid="250255" class="js-usercard-dialog" src="//img1.mukewang.com/59311bea0001e93207410741-80-80.jpg" width="80" height="80">
            </a>
            <span class="tit">
                <a href="/u/250255/courses?sort=publish" target="_blank">壞大叔badUnc...</a><i class="icon-imooc"></i>
            </span>
            <span class="job">PHP开发工程师</span>
                        <div class="teacher-course">
                <div class="teacher-course-arrow"><span></span></div>
                <div class="teacher-course-title">
                    <a href="/u/250255/courses?sort=publish" target="_blank" class="r">查看讲师更多课程 <i class="imv2-arrow2_r"></i></a>
                    壞大叔badUncle讲师的其他课程
                </div>
                <div class="teacher-course-list recom-course-list-box">
                    <ul class="recom-course-list clearfix teacher-course-big">
                                                <li class="clearfix">
                                                        <a href="//www.imooc.com/learn/845" class="clearfix" target="_blank">
                                <div class="l course-img" style="background-image: url(//img2.mukewang.com/5934bac20001a5c906000338-240-135.jpg);"></div>
                                                        
                            <div class="l content-box">
                                <p class="smalle-title">SVN从入门到放弃</p>
                                <div class="clearfix learn-detail">高级<span>·</span><i class="imv2-set-sns"></i>14966</div>
                                <div class="teacher-course-price">免费课程
                                </div>
                            </div>
                            </a>
                        </li>
                                               <li class="clearfix">
                                                        <a href="//www.imooc.com/learn/623" class="clearfix" target="_blank">
                                <div class="l course-img" style="background-image: url(//img2.mukewang.com/56e1321f0001550c06000338-240-135.jpg);"></div>
                                                        
                            <div class="l content-box">
                                <p class="smalle-title">PHP第三方登录—微博登录</p>
                                <div class="clearfix learn-detail">中级<span>·</span><i class="imv2-set-sns"></i>21261</div>
                                <div class="teacher-course-price">免费课程
                                </div>
                            </div>
                            </a>
                        </li>
                                               <li class="clearfix">
                                                        <a href="//www.imooc.com/learn/596" class="clearfix" target="_blank">
                                <div class="l course-img" style="background-image: url(//img2.mukewang.com/56a0932200014c4d06000338-240-135.jpg);"></div>
                                                        
                            <div class="l content-box">
                                <p class="smalle-title"> PHP第三方登录—QQ登录</p>
                                <div class="clearfix learn-detail">中级<span>·</span><i class="imv2-set-sns"></i>42194</div>
                                <div class="teacher-course-price">免费课程
                                </div>
                            </div>
                            </a>
                        </li>
                                               <li class="clearfix">
                                                        <a href="//www.imooc.com/learn/557" class="clearfix" target="_blank">
                                <div class="l course-img" style="background-image: url(//img2.mukewang.com/5668dc790001aa2b06000338-240-135.jpg);"></div>
                                                        
                            <div class="l content-box">
                                <p class="smalle-title">PHP第三方登录—OAuth2.0协议</p>
                                <div class="clearfix learn-detail">中级<span>·</span><i class="imv2-set-sns"></i>35348</div>
                                <div class="teacher-course-price">免费课程
                                </div>
                            </div>
                            </a>
                        </li>
                                               <li class="clearfix">
                                                        <a href="//www.imooc.com/learn/170" class="clearfix" target="_blank">
                                <div class="l course-img" style="background-image: url(//img2.mukewang.com/53ed6e6d0001122a06000338-240-135.jpg);"></div>
                                                        
                            <div class="l content-box">
                                <p class="smalle-title">在Ubuntu Server下搭建LAMP环境</p>
                                <div class="clearfix learn-detail">中级<span>·</span><i class="imv2-set-sns"></i>37568</div>
                                <div class="teacher-course-price">免费课程
                                </div>
                            </div>
                            </a>
                        </li>
                                               <li class="clearfix">
                                                        <a href="//www.imooc.com/learn/111" class="clearfix" target="_blank">
                                <div class="l course-img" style="background-image: url(//img2.mukewang.com/57035f580001a91806000338-240-135.jpg);"></div>
                                                        
                            <div class="l content-box">
                                <p class="smalle-title">Linux 达人养成计划 II</p>
                                <div class="clearfix learn-detail">入门<span>·</span><i class="imv2-set-sns"></i>104547</div>
                                <div class="teacher-course-price">免费课程
                                </div>
                            </div>
                            </a>
                        </li>
                                           </ul>
                </div>
            </div>
                    </div>
                
            <div class="static-item l">
                <span class="meta">难度</span><span class="meta-value">初级</span>
            </div>
            <div class="static-item l">
                <span class="meta">时长</span><span class="meta-value"> 3小时12分</span>
            </div>
            <div class="static-item l">
                <span class="meta">学习人数</span><span class="meta-value js-learn-num"></span>
            </div>
            <div class="static-item l score-btn">
                <span class="meta">综合评分</span><span class="meta-value">9.7</span>
                
                                
                <div class="score-wrap triangle">
                    <div class="score-box">
                        <a href="/coursescore/350" class="person-num">
                            <span class="person-num l">133人评价</span>
                        </a>
                                                    <a href="/coursescore/350?page=1" class="evaluation-btn r">查看评价</a>
                                                <div class="score-detail-box">
                            <div class="score-static-item">
                                <span class="meta-value">10.0</span>
                                <span class="meta">内容实用</span>
                            </div>
                            <div class="score-static-item">
                                <span class="meta-value">9.6</span>
                                <span class="meta">简洁易懂</span>
                            </div>
                            <div class="score-static-item">
                                <span class="meta-value">9.6</span>
                                <span class="meta">逻辑清晰</span>
                            </div>
                        </div>
                        <div class="icon-drop_down"></div>
                    </div>

                </div>
                
            </div>
            
        </div>
        <div class="extra">

            <!-- credit -->
            
            <!-- share -->
            <div class="share-action r bdsharebuttonbox">
            <!--收藏-->
                <div class="share js-follow-action"><i class="follow-action"></i><span>收藏</span></div>
                <a href="javascript:;" class="share wx js-share icon-share-weichat" data-cmd="weixin"></a>
                <a href="javascript:;" class="share qq js-share icon-share-qq" data-cmd="qzone"></a>
                <a href="javascript:;" class="share sina js-share icon-share-weibo" data-cmd="tsina"></a>
            </div>
        </div>
    </div>
    <div class="info-bg" id="js-info-bg">
        <div class="cover-img-wrap">
        <img data-src="//img3.mukewang.com/570762f300011cb006000338.jpg" alt="" style="display: none" id="js-cover-img">
        </div>
        <div class="cover-mask"></div>
    </div>
</div>
<div class="course-info-menu ">
	<div class="w">
		<ul class="course-menu">
			<li><a class="moco-change-big-btn active" id="learnOn"  href="/learn/350">课程章节</a></li>
			
			<li><span>1209</span><a id="qaOn" class="moco-change-big-btn " href="/qa/350/t/0">问答评论</a></li>
			<li><a id="noteOn" class="moco-change-big-btn " href="/note/350?sort=last&page=1">同学笔记</a></li>
			<li><span>133</span><a id="commentOn" class="moco-change-big-btn " href="/coursescore/350">用户评价</a></li>
		</ul>
	</div>


	
</div><!-- 课程面板 -->

<div class="course-info-main clearfix w">

    <div class="content-wrap clearfix">
        <div class="content">
                        <!-- 课程简介 -->
            <div class="course-description course-wrap">
                简介：本课程通过实际的同步命令演示和形象的概念介绍并以PHP语言为蓝本，让小伙伴们了解正则表达式的基本语法以及理解正则表达式在实际开发中的强大用处。
            </div>
            <!-- 课程简介 end -->
    
            <!-- 课程章节 -->
            <div class="course-chapters">
                                        <div class="chapter course-wrap ">
                    <!-- 章节标题 -->
                    <h3>
                        1章 初识正则表达式
                    </h3>
                    <div class="chapter-description">
                        介绍正则表达式的产生背景，并通过简单的实例，描述正则表达式在编程中的广泛应用。
                    </div>
                    <!-- 章节标题 end -->
                    <!-- 章节小节 -->
                                        <ul class="video">
                                                <li data-media-id="6781">
                                                            <a href='/video/6781' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    1-1 正则表达式历史背景与发展历程 
                                                                            (02:31)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6783">
                                                            <a href='/video/6783' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    1-2 正则表达式应用范围—我们是老盆友了 
                                                                            (03:11)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6784">
                                                            <a href='/video/6784' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    1-3 正则表达式应用范围—各编程语言对正则的支持 
                                                                            (02:04)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6785">
                                                            <a href='/video/6785' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    1-4 正则表达式应用范围—正则表达式是什么 
                                                                            (02:12)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                            </ul>
                                        <!-- 章节小节 end -->
                </div>
                            <div class="chapter course-wrap ">
                    <!-- 章节标题 -->
                    <h3>
                        2章 正则表达式函数解析
                    </h3>
                    <div class="chapter-description">
                        介绍PHP中常用的正则表达式函数的基本使用以及注意事项。
                    </div>
                    <!-- 章节标题 end -->
                    <!-- 章节小节 -->
                                        <ul class="video">
                                                <li data-media-id="6786">
                                                            <a href='/video/6786' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    2-1 课程准备 
                                                                            (02:17)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6787">
                                                            <a href='/video/6787' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    2-2 正则表达式函数参数说明 
                                                                            (00:55)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6788">
                                                            <a href='/video/6788' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    2-3 正则表达式数据输出函数简介 
                                                                            (01:02)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6789">
                                                            <a href='/video/6789' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    2-4 正则表达式函数之preg_match与preg_match_all 
                                                                            (06:23)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6790">
                                                            <a href='/video/6790' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    2-5 正则表达式函数之preg_replace与preg_filter 
                                                                            (07:08)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6791">
                                                            <a href='/video/6791' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    2-6 正则表达式函数之preg_grep 
                                                                            (02:29)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6792">
                                                            <a href='/video/6792' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    2-7 正则表达式函数之preg_split 
                                                                            (02:20)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6793">
                                                            <a href='/video/6793' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    2-8 正则表达式函数之preg_quote 
                                                                            (02:01)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6794">
                                                            <a href='/video/6794' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    2-9 正则表达式函数总结 
                                                                            (01:48)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                            </ul>
                                        <!-- 章节小节 end -->
                </div>
                            <div class="chapter course-wrap ">
                    <!-- 章节标题 -->
                    <h3>
                        3章 正则表达式基本语法
                    </h3>
                    <div class="chapter-description">
                        介绍正则表达式的基本用法，通过regexpal工具演示并讲解了界定符、原子、元字符、量词，以及边界控制和模式单元的基本使用和注意事项。
                    </div>
                    <!-- 章节标题 end -->
                    <!-- 章节小节 -->
                                        <ul class="video">
                                                <li data-media-id="6796">
                                                            <a href='/video/6796' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-1 概述 
                                                                            (01:37)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6797">
                                                            <a href='/video/6797' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-2 [正则表达式] 界定符 
                                                                            (01:59)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6798">
                                                            <a href='/video/6798' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-3 [正则表达式] regexpal工具 
                                                                            (03:49)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6799">
                                                            <a href='/video/6799' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-4 [正则表达式] 原子概念 
                                                                            (02:13)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6800">
                                                            <a href='/video/6800' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-5 [正则表达式] 可见原子演示 
                                                                            (04:45)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6801">
                                                            <a href='/video/6801' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-6 [正则表达式] 不可见原子 
                                                                            (02:28)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6804">
                                                            <a href='/video/6804' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-7 [正则表达式] 元字符之原子的筛选方式 
                                                                            (08:12)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6803">
                                                            <a href='/video/6803' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-8 [正则表达式] 元字符之原子的集合 
                                                                            (04:44)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6805">
                                                            <a href='/video/6805' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-9 [正则表达式] 量词 
                                                                            (07:22)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6806">
                                                            <a href='/video/6806' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-10 [正则表达式] 边界控制 
                                                                            (02:09)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6808">
                                                            <a href='/video/6808' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    3-11 [正则表达式] 模式单元 
                                                                            (02:11)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                            </ul>
                                        <!-- 章节小节 end -->
                </div>
                            <div class="chapter course-wrap ">
                    <!-- 章节标题 -->
                    <h3>
                        4章 模式修正
                    </h3>
                    <div class="chapter-description">
                        介绍贪婪匹配、懒惰匹配、忽略大小写等模式修正的使用方法。
                    </div>
                    <!-- 章节标题 end -->
                    <!-- 章节小节 -->
                                        <ul class="video">
                                                <li data-media-id="6951">
                                                            <a href='/video/6951' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    4-1 懒惰匹配与贪婪匹配 
                                                                            (06:07)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6952">
                                                            <a href='/video/6952' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    4-2 忽略大小写 
                                                                            (02:44)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6953">
                                                            <a href='/video/6953' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    4-3 忽略空白符 
                                                                            (01:19)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="6954">
                                                            <a href='/video/6954' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    4-4 修正模式 
                                                                            (00:20)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                            </ul>
                                        <!-- 章节小节 end -->
                </div>
                            <div class="chapter course-wrap ">
                    <!-- 章节标题 -->
                    <h3>
                        5章 实战篇—常见正则表达式书写
                    </h3>
                    <div class="chapter-description">
                        介绍日常开发中常见的正则表达式的书写，包括手机、email、URL地址等的匹配规则讲解。
                    </div>
                    <!-- 章节标题 end -->
                    <!-- 章节小节 -->
                                        <ul class="video">
                                                <li data-media-id="7166">
                                                            <a href='/video/7166' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    5-1 实战内容概述 
                                                                            (00:57)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7167">
                                                            <a href='/video/7167' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    5-2 常见正则表达式—非空匹配 
                                                                            (02:10)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7168">
                                                            <a href='/video/7168' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    5-3 常见正则表达式—浮点数匹配 
                                                                            (03:00)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7169">
                                                            <a href='/video/7169' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    5-4 常见正则表达式—手机号匹配 
                                                                            (02:16)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7170">
                                                            <a href='/video/7170' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    5-5 常见正则表达式—email地址匹配 
                                                                            (04:46)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7171">
                                                            <a href='/video/7171' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    5-6 常见正则表达式—URL地址匹配 
                                                                            (02:56)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7172">
                                                            <a href='/video/7172' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    5-7 常见正则表达式总述 
                                                                            (00:49)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                            </ul>
                                        <!-- 章节小节 end -->
                </div>
                            <div class="chapter course-wrap ">
                    <!-- 章节标题 -->
                    <h3>
                        6章 实战篇—正则工具类开发
                    </h3>
                    <div class="chapter-description">
                        介绍正则工具类的开发思路和实现过程。
                    </div>
                    <!-- 章节标题 end -->
                    <!-- 章节小节 -->
                                        <ul class="video">
                                                <li data-media-id="7173">
                                                            <a href='/video/7173' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    6-1 [正则表达式] 工具类开发—成员属性 
                                                                            (03:02)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7174">
                                                            <a href='/video/7174' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    6-2 [正则表达式] 工具类开发—构造方法 
                                                                            (01:15)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7175">
                                                            <a href='/video/7175' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    6-3 [正则表达式] 工具类开发—核心匹配方法 
                                                                            (10:37)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7176">
                                                            <a href='/video/7176' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    6-4 [正则表达式] 工具类开发—数据验证方法 
                                                                            (10:36)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7177">
                                                            <a href='/video/7177' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    6-5 [正则表达式] 验证工具类 
                                                                            (03:49)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                            </ul>
                                        <!-- 章节小节 end -->
                </div>
                            <div class="chapter course-wrap ">
                    <!-- 章节标题 -->
                    <h3>
                        7章 实战篇—注册表单验证
                    </h3>
                    <div class="chapter-description">
                        介绍如何使用开发的正则工具类，完成注册表单的验证。
                    </div>
                    <!-- 章节标题 end -->
                    <!-- 章节小节 -->
                                        <ul class="video">
                                                <li data-media-id="7178">
                                                            <a href='/video/7178' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    7-1 [正则表达式] 前台页面准备 
                                                                            (02:34)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7179">
                                                            <a href='/video/7179' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    7-2 [正则表达式] 注册表单验证 
                                                                            (04:37)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                            </ul>
                                        <!-- 章节小节 end -->
                </div>
                            <div class="chapter course-wrap ">
                    <!-- 章节标题 -->
                    <h3>
                        8章 实战篇—仿Smarty简易模板引擎
                    </h3>
                    <div class="chapter-description">
                        介绍简易的模板引擎类的开发和实现过程。
                    </div>
                    <!-- 章节标题 end -->
                    <!-- 章节小节 -->
                                        <ul class="video">
                                                <li data-media-id="7180">
                                                            <a href='/video/7180' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-1 模板引擎简介 
                                                                            (01:31)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7181">
                                                            <a href='/video/7181' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-2 模式单元进阶篇 
                                                                            (04:02)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7182">
                                                            <a href='/video/7182' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-3 模板引擎类—成员属性 
                                                                            (05:00)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7183">
                                                            <a href='/video/7183' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-4 模板引擎类—构造函数 
                                                                            (02:02)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7184">
                                                            <a href='/video/7184' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-5 模板引擎类—写入和获取数据 
                                                                            (01:56)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7185">
                                                            <a href='/video/7185' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-6 模板引擎类—获取模板源文件 
                                                                            (02:37)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7186">
                                                            <a href='/video/7186' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-7 模板引擎类—模板编译（一） 
                                                                            (02:22)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7187">
                                                            <a href='/video/7187' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-8 模板源文件创建及正则匹配 
                                                                            (04:00)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7188">
                                                            <a href='/video/7188' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-9 模板引擎类—模板编译（二） 
                                                                            (08:30)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7189">
                                                            <a href='/video/7189' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-10 正则替换测试 
                                                                            (05:24)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7190">
                                                            <a href='/video/7190' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-11 模板引擎类—模板编译（三） 
                                                                            (01:37)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7191">
                                                            <a href='/video/7191' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-12 模板引擎类—显示模板 
                                                                            (01:45)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7192">
                                                            <a href='/video/7192' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-13 模板引擎测试 
                                                                            (04:47)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7193">
                                                            <a href='/video/7193' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-14 关于编译文件 
                                                                            (00:54)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                                <li data-media-id="7194">
                                                            <a href='/video/7194' class="J-media-item">
                                    <i class="imv2-play_circle type"></i>
                                    8-15 模板引擎总述 
                                                                            (03:02)
                                                                        
                                                                        <button class="r moco-btn moco-btn-red preview-btn">开始学习</button>
                                                                        
                                </a>
                                                    </li>
                                            </ul>
                                        <!-- 章节小节 end -->
                </div>
                                    </div>
            <!-- 课程章节 end -->
        </div><!--content end-->
        <div class="aside r">
                <div class="course-wrap course-aside-info js-usercard-box">
        <div class="learn-btn">

        
                    <a href="/video/6781" class="moco-btn moco-btn-red moco-btn-lg J-learn-course">开始学习</a>
                </div>
        



                <div class="course-info-tip">
                        <dl class="first">
                <dt>课程须知</dt>
                <dd class="autowrap">学习本课程之前需要掌握基本的PHP语法，基本的OOP思想，基本的MVC模式知识。</dd>
            </dl>
                                    <dl>
                <dt>老师告诉你能学到什么？</dt>
                <dd class="autowrap">在本课程中可以充分理解正则表达式的定义并掌握如何在实际开发中应用正则表达式。其中包含表单验证实际应用以及简易版模板引擎的实现。</dd>
            </dl>
                    </div>
        
        
                
    </div>


    <div class="js-commend-box">
</div>
<div class="js-tag-box">
</div>
<div class="js-related-box">
</div>

        </div>
    </div>
    <div class="clear"></div>

</div>
<!-- 视频介绍 -->
<div id="js-video-wrap" class="video pop-video" style="display:none">
    <div class="video_box" id="js-video"></div>
    <a href="javascript:;" class="pop-close icon-close"></a>
</div>

</div>

<div id="footer" data="course,learn">
    <div class="waper">
        <div class="footerwaper clearfix">
            <div class="followus r">
                <a class="followus-weixin" href="javascript:;"  target="_blank" title="微信">
                    <div class="flw-weixin-box"></div>
                </a>
                <a class="followus-weibo" href="http://weibo.com/u/3306361973"  target="_blank" title="新浪微博"></a>
                <a class="followus-qzone" href="http://user.qzone.qq.com/1059809142/" target="_blank" title="QQ空间"></a>
            </div>
            <div class="footer_intro l">
                <div class="footer_link">
                    <ul>
                        <li><a href="//www.imooc.com/" target="_blank">网站首页</a></li>
                        <li><a href="/about/cooperate" target="_blank" title="企业合作">企业合作</a></li>
                        <li><a href="/about/job" target="_blank">人才招聘</a></li>
                        <li> <a href="/about/contact" target="_blank">联系我们</a></li>
                        <li> <a href="/about/recruit" target="_blank">讲师招募</a></li>
                        <li> <a href="/about/faq" target="_blank">常见问题</a></li>
                        <li> <a href="/user/feedback" target="_blank">意见反馈</a></li>
                        <li><a href="http://daxue.imooc.com/" target="_blank">慕课大学</a></li>
                        <li> <a href="/about/friendly" target="_blank">友情链接</a></li>
                       <!--  <li><a href="/corp/index" target="_blank">合作专区</a></li>
                        <li><a href="/about/us" target="_blank">关于我们</a></li> -->
                    </ul>
                </div>
                <p>Copyright © 2018 imooc.com All Rights Reserved | 京ICP备 12003892号-11 </p>
            </div>
        </div>
    </div>
</div>


<div id="J_GotoTop" class="elevator">

    <a href="/user/feedback" class="elevator-msg" target="_blank">
        <i class="icon-feedback"></i>
        <span class="">意见反馈</span>
    </a>
    <a href="/about/faq" class="elevator-faq" target="_blank">
        <i class="icon-ques"></i>
        <span class="">常见问题</span>
    </a>
    <a href="//www.imooc.com/mobile/app" target="_blank" class="elevator-app" >
        <i class="icon-appdownload"></i>
        <span class="">APP下载</span>
        <div class="elevator-app-box"></div>
    </a>
    <a href="javascript:void(0)" class="elevator-weixin no-goto" id="js-elevator-weixin" >
        <i class="icon-wxgzh"></i>
        <span class="">官方微信</span>
        <div class="elevator-weixin-box"></div>
    </a>
    <a href="javascript:void(0)" class="elevator-top no-goto" style="display:none" id="backTop">
        <i class="icon-up2"></i>
        <span class="">返回顶部</span>
    </a>
</div>



<!--script-->
<script type="text/javascript" src="//moco.imooc.com/static/monitor/error.js"></script>
<script src="/passport/static/scripts/ssologin.js?v=2.0"></script>
<script type="text/javascript" src="/static/sea-modules/seajs/seajs/2.1.1/sea.js"></script>
<script type="text/javascript" src="/static/sea_config.js?v="></script>
<script type="text/javascript">seajs.use("/static/page/"+OP_CONFIG.module+"/"+OP_CONFIG.page);</script>

 
<script src="//moco.imooc.com/captcha/script/captcha.min.js?v=1.0"></script>
<script type="text/javascript">
  (function(){
    var imgPic = GC.course.pic || 'https://www.imooc.com/static/img/index/logo_new.png',
        text = '我正在参加@慕课网  的一门课程【' + GC.course.name + '】，很不错哦！快来一起学习吧！', //节名称
        url = 'https://www.imooc.com' + window.location.pathname;

    window._bd_share_config = {
        "common": {
            "bdUrl": url,
            "bdSnsKey": {
              'tsina':'2254855082'
            },
            "bdText": text,
            "bdMini": "2",
            "bdMiniList": false,
            "bdPic": imgPic,
            "bdStyle": "0",
            "bdSize": "16"
        },
        "share": {}
    };
    setTimeout(function(){
            with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = '/static/lib/baiduShare/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
        },1000)

  })();
</script>
<div class="mask"></div>




<div style="display: none">
<script type="text/javascript">
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?f0cfcccd7b1393990c78efdeebff3968";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
(function (d) {
window.bd_cpro_rtid="rHT4P1c";
var s = d.createElement("script");s.type = "text/javascript";s.async = true;s.src = location.protocol + "//cpro.baidu.com/cpro/ui/rt.js";
var s0 = d.getElementsByTagName("script")[0];s0.parentNode.insertBefore(s, s0);
})(document);
</script>
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
</div>
</body>
</html>

EOF;
