<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>eightT后台管理</title>
    <link rel="stylesheet" type="text/css" href="public/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/main.css"/>
    <script type="text/javascript" src="public/js/libs/modernizr.min.js"></script>
    <style>
        #user{
            height: 28px;
        }
    </style>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">eightT后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.php?r=index/lsts">首页</a></li>
                <li><a class="on" href="https://mp.weixin.qq.com/" target="_blank">微信公众平台</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li>
                    <select name="" id="user" class="common-text required">
                        <?php
                            include '../assets/web.php';
                            $arr = $pdo->query('select * from we_account');
                            $a = $arr->fetchAll(PDO::FETCH_ASSOC);
                            foreach($a as $k=>$v){ ?>
                                <option value="">请选择公众号</option>
                                <option value="<?php echo $v['aid']?>"><h3><?php echo $v['aname']?></h3></option>
                            <?php } ?>                        
                    </select>
                </li>
                <li><a href="">
                        <?php
                        $session = \Yii::$app->session;
                        $session->open();
                        echo $session->get("uname");
                        ?>
                    </a></li>
                <li><a href="index.php?r=login/set_pwd">修改密码</a></li>
                <li><a href="index.php?r=index/remove">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"></i>公众号管理</a>
                    <ul class="sub-menu">
                        <li><a href="index.php?r=index/add_account"></i>添加公众号</a></li>
                        <li><a href="index.php?r=index/lists_account"></i>查看公众号</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"></i>IP管理</a>
                    <ul class="sub-menu">
                        <li><a href="index.php?r=index/ip"></i>管理IP</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"></i>自定义回复</a>
                    <ul class="sub-menu">
                        <li><a href="index.php?r=reply/words"></i>文字回复</a></li>
                        <li><a href="index.php?r=reply/pictures">图片回复</a></li>
                        <li><a href="index.php?r=reply/voices">语音回复</a></li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#">菜单</a>
                    <ul class="sub-menu">
                        <li><a href="index.php?r=menu/selfmenu">自定义菜单</a></li>
                        
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <?= $content ?>
</div>
</body>
</html>
<script src="jq.js"></script>
<script>
        $(function(){
            $(document).on('change','#user',function(){
                var val = $(this).val();
                if(val==''){
                    $('#user').css('border','2px red solid');
                    alert('请选择公众号');
                }else{
                     $.getJSON('?r=index/quan',{aid:val},function(msg){
                     window.location.reload();
                    })
                }
            })            
           $.get('?r=index/moren',{a:0},function(msg){
                    $('#user').val(msg);
                }) 
            
        })


</script>
