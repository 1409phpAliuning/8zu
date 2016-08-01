<?php
use yii\widgets\LinkPager;
?>
<!doctype html>
<html>
<body>
<style>
        .list-page li{
            float:left;

        }
    </style>
<div class="main-wrap">
    <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font">&#xe06b;</i><span>欢迎来到EightT</span> <span class="crumb-step">&gt;</span><a href="index.php?r=index/lsts">首页</a> <span class="crumb-step">&gt;</span><span class="crumb-name">展示公众号</span></div>
    </div>
   
    <div class="result-wrap">
        <div class="result-title">
            <h1>展示公众号</h1>
        </div>
       <!--  <div class="result-content">
           <form  action="index.php?r=index/edit" method="post">
            <table width="auto" border="1">
               <tr height="40">
                   <th class="text-center" >编号</th>
                   <th class="text-center">微信号</th>
                   <th class="text-center">Appid</th>
                   <th class="text-center">Appsecret</th>
                   <th class="text-center">对接地址(URL)</th>
                   <th class="text-center">Token</th>
                   <th class="text-center">操作</th>
               </tr>
               <?php foreach($arr as $k=>$v){?>
               <tr align="center">
                   <td align="center"><?php echo $v['aid']?></td>
                   <td><?php echo $v['aname']?></td>
                   <td><?php echo $v['appid']?></td>
                   <td><?php echo $v['appsecret']?></td>
                   <td><textarea cols="35" name="content" rows="1" id="content" style="float:left"><?php echo $v['aurl']?></textarea><input type="button" value="复制" onclick="jsCopy()"></td>
                   <td><textarea cols="35" name="content" rows="1" id="content" style="float:left"><?php echo $v['atoken']?></textarea><input type="button" value="复制" onclick="jsCopy()"></td>
                   <td>
                       <a href="http://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login" target="_blank">连接配置</a>
                       <a href="index.php?r=index/save_account&aid=<?php echo $v['aid']?>" >修改</a>
                       <a href="index.php?r=index/dell&aid=<?php echo $v['aid']?>">删除</a>
                   </td>
               </tr>
               <?php }?>
           </table>
           </form>
       </div> -->
       <div class="result-wrap">
        <form name="myform" id="myform" method="post">
            <div class="result-title">
                <div class="result-list">
                    <a href="index.php?r=index/add_account"><i class="icon-font"></i>新增公众号</a>
                    <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                    <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                </div>
            </div>
            <div class="result-content">

                <table class="result-tab" width="100%">
                    <tbody>
                    <tr>
                        <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                        <th>编号</th>
                        <th>微信号</th>
                        <th>Appid</th>
                        <th>Appsecret</th>
                        <th>对接地址</th>
                        <th>Token</th>
                        <th>操作</th>
                    </tr>
                    <div id="box">
                    <?php foreach($arr as $k=>$v){?>
                        <tr id="bb">
                            <td class="tc"><input class="allChoose" type="checkbox"></td>
                            <td align="center"><?php echo $v['aid']?></td>
                            <td><?php echo $v['aname']?></td>
                            <td><?php echo $v['appid']?></td>
                            <td><?php echo $v['appsecret']?></td>
                            <td><textarea cols="35" name="content" rows="1" id="content" style="float:left"><?php echo $v['aurl']?></textarea><input type="button" value="复制" onclick="jsCopy()"></td>
                            <td><textarea cols="35" name="content1" rows="1" id="content1" style="float:left"><?php echo $v['atoken']?></textarea><input type="button" value="复制" onclick="jsCopy1()"></td>
                            <td>
                                <a href="http://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login" target="_blank"><img src="public/images/lian.gif" title="连接配置"/></a>
                                <a href="index.php?r=index/save_account&aid=<?php echo $v['aid']?>" ><img src="public/images/edit.gif" title="修改" /></a>
                                <a href="index.php?r=index/dell&aid=<?php echo $v['aid']?>"><img src="public/images/del.gif" title="删除"/></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </div>
                    </tbody>
                </table>
                <div class="list-page" style="margin-left:40%">
                    <?= LinkPager::widget(['pagination' => $pagination,
                        'nextPageLabel' => '下一页',
                        'prevPageLabel' => '上一页']) ?>
                </div>
            </div>
        </form>
    </div>
    </div>
    
</div>
<!--/main-->
<script type="text/javascript">
    function jsCopy(){
        var e=document.getElementById("content");//对象是content
        e.select(); //选择对象
        document.execCommand("Copy"); //执行浏览器复制命令

       alert("已复制好，可贴粘。");
    }
    function jsCopy1(){
        var e=document.getElementById("content1");//对象是content
        e.select(); //选择对象
        document.execCommand("Copy"); //执行浏览器复制命令

       alert("已复制好，可贴粘。");
    }
</script>
</body>
</html>
