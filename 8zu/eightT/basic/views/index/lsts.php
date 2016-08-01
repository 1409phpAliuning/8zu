<!doctype html>
<html>
<body>

<div class="main-wrap">
    <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font">&#xe06b;</i><span>欢迎来到eightT</span></div>
    </div>
    <div class="result-wrap">
        <div class="result-title">
            <h1>快捷操作</h1>
        </div>
        <div class="result-content">
            <div class="short-wrap">
                <a href="#"><i class="icon-font">&#xe001;</i>新增作品</a>
                <a href="#"><i class="icon-font">&#xe005;</i>新增博文</a>
                <a href="#"><i class="icon-font">&#xe048;</i>新增作品分类</a>
                <a href="#"><i class="icon-font">&#xe041;</i>新增博客分类</a>
                <a href="#"><i class="icon-font">&#xe01e;</i>作品评论</a>
            </div>
        </div>
    </div>
    <div class="result-wrap">
        <div class="result-title">
            <h1>系统基本信息</h1>
        </div>
        <div class="result-content">
            <ul class="sys-info-list">
                <li>
                    <label class="res-lab">操作系统</label><span class="res-info"><?= $arr['system'] ?></span>
                </li>
                <li>
                    <label class="res-lab">运行环境</label><span class="res-info"><?= $_SERVER['SERVER_SOFTWARE']?></span>
                </li>
                <li>
                    <label class="res-lab">PHP运行方式</label><span class="res-info"><?= $arr['php_edition'] ?></span>
                </li>
                <li>
                    <label class="res-lab">设计-版本</label><span class="res-info">v-0.1</span>
                </li>
                <li>
                    <label class="res-lab">上传附件限制</label><span class="res-info">10M</span>
                </li>
                <li>
                    <label class="res-lab">北京时间</label><span class="res-info"><?= date("Y年m月d日",time()) ?></span>
                </li>
                <li>
                    <label class="res-lab">服务器域名/IP</label><span class="res-info"><?= $arr['realip']  ?></span>
                </li>
                <li>
                    <label class="res-lab">Host</label><span class="res-info"><?= $_SERVER["REMOTE_ADDR"]?></span>
                </li>
                <li>
                    <label class="res-lab">开发成员</label><span class="res-info">刘宁,王久旺,刘志祥,侯文康,王照华</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="result-wrap">
        <div class="result-title">
            <h1>使用帮助</h1>
        </div>
        <div class="result-content">
            <ul class="sys-info-list">
                <li>
                    <label class="res-lab">官方交流网站：</label><span class="res-info"><a href="http://user.qzone.qq.com/913737303/infocenter?ptsig=fwuIGucgSq7VB3N8vMjtbG8F-lEbvyN44NaOi-8MrHw_" title="有主机上线设计" target="_blank">jscss.me</a></span>
                </li>
                <li>
                    <label class="res-lab">官方交流QQ群：</label><span class="res-info"><a class="qq-link" target="_blank" href="http://user.qzone.qq.com/913737303/infocenter?ptsig=fwuIGucgSq7VB3N8vMjtbG8F-lEbvyN44NaOi-8MrHw_"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="JS-前端开发" title="JS-前端开发"></a> </span>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--/main-->

</body>
</html>