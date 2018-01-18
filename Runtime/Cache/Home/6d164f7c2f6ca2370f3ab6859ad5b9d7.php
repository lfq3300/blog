<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo ($title); ?></title>
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<link rel="icon" type="image/png" href="/Application/Home/Static/i/favicon.png">
<meta name="mobile-web-app-capable" content="yes">
<link rel="icon" sizes="192x192" href="/Application/Home/Static/i/app-icon72x72@2x.png">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="Amaze UI"/>
<link rel="apple-touch-icon-precomposed" href="/Application/Home/Static/i/app-icon72x72@2x.png">
<meta name="msapplication-TileImage" content="/Application/Home/Static/i/app-icon72x72@2x.png">
<meta name="msapplication-TileColor" content="#0e90d2">
<link rel="stylesheet" href="/Application/Home/Static/css/amazeui.min.css">
<link rel="stylesheet" href="/Application/Home/Static/css/app.css">
</head>

<body id="blog-article-sidebar">
<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <div class="am-u-sm-12">
        <article class="am-article blog-article-p">
            <div class="am-article-hd">
                <h1 class="am-article-title blog-text-center"><?php echo ($data["title"]); ?></h1>
                <p class="am-article-meta blog-text-center">
                    <span><a href="#" class="blog-color"><?php echo ($data["author"]); ?> &nbsp;</a></span>-
                    <span><a href="#"><?php echo ($data["add_time"]); ?></a></span>
                </p>
            </div>
            <div class="am-article-bd">
                <?php echo html_entity_decode($data["blog"]);?>
            </div>
        </article>

        <div class="am-g blog-article-widget blog-article-margin">
            <div class="am-u-lg-4 am-u-md-5 am-u-sm-7 am-u-sm-centered blog-text-center">
                <span class="am-icon-tags"> &nbsp;</span><a href="#">标签</a> , <a href="#">TAG</a> , <a href="#">啦啦</a>
                <hr>
                <a href=""><span class="am-icon-qq am-icon-fw am-primary blog-icon"></span></a>
                <a href=""><span class="am-icon-wechat am-icon-fw blog-icon"></span></a>
                <a href=""><span class="am-icon-weibo am-icon-fw blog-icon"></span></a>
            </div>
        </div>

        <hr>
        <div class="am-g blog-author blog-article-margin">
            <div class="am-u-sm-3 am-u-md-3 am-u-lg-2">
                <img src="/Application/Home/Static/i/f15.jpg" alt="" class="blog-author-img am-circle">
            </div>
            <div class="am-u-sm-9 am-u-md-9 am-u-lg-10">
                <h3><span>作者 &nbsp;: &nbsp;</span><span class="blog-color"><?php echo ($data["author"]); ?></span></h3>
                <p><?php echo ($data["introduction"]); ?></p>
            </div>
        </div>
        <hr>
        <ul class="am-pagination blog-article-margin">
            <li class="am-pagination-prev"><a href="#" class="">&laquo; 一切的回顾</a></li>
            <li class="am-pagination-next"><a href="">不远的未来 &raquo;</a></li>
        </ul>

        <hr>

        <!--<form class="am-form am-g">-->
            <!--<h3 class="blog-comment">评论</h3>-->
            <!--<fieldset>-->
                <!--<div class="am-form-group am-u-sm-4 blog-clear-left">-->
                    <!--<input type="text" class="" placeholder="名字">-->
                <!--</div>-->
                <!--<div class="am-form-group am-u-sm-4">-->
                    <!--<input type="email" class="" placeholder="邮箱">-->
                <!--</div>-->

                <!--<div class="am-form-group am-u-sm-4 blog-clear-right">-->
                    <!--<input type="password" class="" placeholder="网站">-->
                <!--</div>-->

                <!--<div class="am-form-group">-->
                    <!--<textarea class="" rows="5" placeholder="一字千金"></textarea>-->
                <!--</div>-->

                <!--<p><button type="submit" class="am-btn am-btn-default">发表评论</button></p>-->
            <!--</fieldset>-->
        <!--</form>-->
    </div>
</div>
<!-- content end -->
<footer class="blog-footer">
    <div class="am-g am-g-fixed blog-fixed am-u-sm-centered blog-footer-padding">
        <div class="am-u-sm-12 am-u-md-4- am-u-lg-4">
            <h3>模板简介</h3>
            <p class="am-text-sm">这是一个使用amazeUI做的简单的前端模板。<br> 博客/ 资讯类 前端模板 <br> 支持响应式，多种布局，包括主页、文章页、媒体页、分类页等<br>嗯嗯嗯，不知道说啥了。外面的世界真精彩<br><br>
                Amaze UI 使用 MIT 许可证发布，用户可以自由使用、复制、修改、合并、出版发行、散布、再授权及贩售 Amaze UI 及其副本。</p>
        </div>
        <div class="am-u-sm-12 am-u-md-4- am-u-lg-4">
            <h3>社交账号</h3>
            <p>
                <a href=""><span class="am-icon-qq am-icon-fw am-primary blog-icon blog-icon"></span></a>
                <a href=""><span class="am-icon-github am-icon-fw blog-icon blog-icon"></span></a>
                <a href=""><span class="am-icon-weibo am-icon-fw blog-icon blog-icon"></span></a>
                <a href=""><span class="am-icon-reddit am-icon-fw blog-icon blog-icon"></span></a>
                <a href=""><span class="am-icon-weixin am-icon-fw blog-icon blog-icon"></span></a>
            </p>
            <h3>Credits</h3>
            <p>我们追求卓越，然时间、经验、能力有限。Amaze UI 有很多不足的地方，希望大家包容、不吝赐教，给我们提意见、建议。感谢你们！</p>
        </div>
        <div class="am-u-sm-12 am-u-md-4- am-u-lg-4">
            <h1>我们站在巨人的肩膀上</h1>
            <h3>Heroes</h3>
            <p>
            <ul>
                <li>jQuery</li>
                <li>Zepto.js</li>
                <li>Seajs</li>
                <li>LESS</li>
                <li>...</li>
            </ul>
            </p>
        </div>
    </div>
    <div class="blog-text-center">© 2015 AllMobilize, Inc. Licensed under MIT license. Made with love By LWXYFER</div>
</footer>





<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/Application/Home/Static/js/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/Application/Home/Static/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="/Application/Home/Static/js/amazeui.min.js"></script>
</body>
</html>