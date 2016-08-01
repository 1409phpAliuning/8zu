<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <script type="text/javascript" src="public/js/js/jquery-1.8.2.min.js"></script>
</head>
<body>
<div class="container clearfix">
    <include file="Public:left" />
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php?r=index/lsts">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="#">菜单管理</a><span class="crumb-step">&gt;</span><span>添加菜单</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="index.php?r=menu/add" method="post">
                        <table>
                            <tr> <div>
                                <?php 
                                    $session = \Yii::$app->session;
                                    $session->open();
                                    $aid = $session->get("aid");
                                ?>
                                <input type="hidden" value='<?php echo $aid;?>' name="aid">
                            </div>
                            </tr>

                            <tr>
                                <div style="margin-top:6px;" >
                                    <span style="width: 120px; padding-top: 6px; margin-left: 150px;">左侧 : </span>
                                    <input  style="width: 300px;height: 32px; margin-left:70px;" type="text" name="left[]" placeholder="左侧菜单" required="">

                                    <input type="button" class="subcatalog" mid="left" style="width: 100px;height: 32px;" value="添加子目录">
                        <span id="delleft">
                            <select style="width: 100px;height: 32px;" name="leftgenre[]" class="genre" kid="leftgenre" fid="leftmold">
                                <option value="0">选择类型</option>
                                <option value="click">点击</option>
                                <option value="view">链接地址</option>
                            </select>
                            <span id="leftgenre">

                            </span>
                        </span>

                                </div>
                                <span>
                                    <span id="left" aid="一"></span>
                                </span>
                            </tr>
                            <tr>
                                <div style="margin-top:6px;" >
                                    <span style="width: 120px; padding-top: 6px; margin-left: 150px;">中间 : </span>
                                    <input  style="width: 300px;height: 32px;margin-left:70px; " type="text" name="centre[]"  placeholder="中间">

                                    <input type="button" class="subcatalog" mid="centre" style="width: 100px;height: 32px;" value="添加子目录">
                        <span id="delcentre">
                            <select style="width: 100px;height: 32px;" name="centregenre[]" class="genre" kid="centregenre" fid="centremold">
                                <option value="0">选择类型</option>
                                <option value="click">点击</option>
                                <option value="view">链接地址</option>
                            </select>
                            <span id="centregenre">

                            </span>
                        </span>
                                </div>
                                <span>
                                    <span id="centre"  aid="一"></span>
                                </span>
                            </tr>
                            <tr>
                                <div style="margin-top:6px;" >
                                    <span style="width: 120px; padding-top: 6px; margin-left: 150px;">右侧 : </span>
                                    <input  style="width: 300px;height: 32px;margin-left:70px; " type="text" name="right[]"  placeholder="右侧">

                                    <input type="button" class="subcatalog" mid="right" style="width: 100px;height: 32px;0" value="添加子目录">
                            <span id="delright">
                                <select style="width: 100px;height: 32px;" name="rightgenre[]" class="genre" kid="rightgenre" fid="rightmold">
                                    <option value="0">选择类型</option>
                                    <option value="click">点击</option>
                                    <option value="view">链接地址</option>
                                </select>
                            <span id="rightgenre"> </span></span>
                                </div>
                                <span class="del_right">
                                    <span id="right"  aid="一"></span>
                                </span>
                            </tr>
                            <tr>
                                <div  style="width: 100px; margin-left: 400px;margin-top:6px;">
                                    <input type="submit" style="width: 100px;height: 32px; background: reseda" value="添&nbsp;&nbsp;&nbsp; 加"/>
                                </div>
                            </tr>
                            <tr>
                        </table>
                    </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>
<script>
    //键盘弹起事件判断子父级填写字段长度

    //光标离开事件判断子父级填写字段长度
    $(document).on('click','.subcatalog',function(){
          var mid = $(this).attr('mid');//获取当前定位标记
       // alert(mid);
          var aid = $('#'+mid+'').attr('aid');//获取定位标记下的子级定位位置
      //  alert(aid);
        $('#del'+mid).html('<input type="button" class="del" mid="'+mid+'" style="width: 100px;height: 32px;" value="删除子目录">');
        if(aid=="一"){
          var bid  = "二";
          var nid  = mid+1;//定位change事件效果位置
            $('#'+mid+'').parent('span').html('<p style="margin-top:6px;margin-left:35px;"><span style="width: 120px; padding-top: 6px; margin-left: 160px;">子目录'+aid+' : </span><input  style="width: 200px;height: 32px;" type="text" name="'+mid+'[]" placeholder="子目录'+aid+'"><select style="width: 100px;height: 32px;margin-left:10px;" name="'+mid+'genre[]" class="genre" kid="'+nid+'genre" fid="'+mid+'mold"><option value="0">选择类型</option><option value="click">点击</option><option value="view">链接地址</option></select><span id="'+nid+'genre"> </span></p><span><span id="'+mid+'" aid="'+bid+'"></span></span>');
        }else if(aid=="二"){
             bid = "三";
            var nid  = mid+2;
            $('#'+mid+'').parent('span').html('<p style="margin-top:6px;margin-left:35px;"><span style="width: 120px; padding-top: 6px; margin-left: 160px;">子目录'+aid+' : </span><input  style="width: 200px;height: 32px;" type="text" name="'+mid+'[]" placeholder="子目录'+aid+'"><select style="width: 100px;height: 32px;margin-left:10px;" name="'+mid+'genre[]" class="genre" kid="'+nid+'genre" fid="'+mid+'mold"><option value="0">选择类型</option><option value="click">点击</option><option value="view">链接地址</option></select><span id="'+nid+'genre"> </span></p><span><span id="'+mid+'" aid="'+bid+'"></span></span>');
        }else if(aid=="三"){
             bid = "四";
            var nid  = mid+3;
            $('#'+mid+'').parent('span').html('<p style="margin-top:6px;margin-left:35px;"><span style="width: 120px; padding-top: 6px; margin-left: 160px;">子目录'+aid+' : </span><input  style="width: 200px;height: 32px;" type="text" name="'+mid+'[]" placeholder="子目录'+aid+'"><select style="width: 100px;height: 32px;margin-left:10px;" name="'+mid+'genre[]" class="genre" kid="'+nid+'genre" fid="'+mid+'mold"><option value="0">选择类型</option><option value="click">点击</option><option value="view">链接地址</option></select><span id="'+nid+'genre"> </span></p><span><span id="'+mid+'" aid="'+bid+'"></span></span>');
        }else if(aid=="四"){
             bid = "五";
            var nid  = mid+4;
            $('#'+mid+'').parent('span').html('<p style="margin-top:6px;margin-left:35px;"><span style="width: 120px; padding-top: 6px; margin-left: 160px;">子目录'+aid+' : </span><input  style="width: 200px;height: 32px;" type="text" name="'+mid+'[]" placeholder="子目录'+aid+'"><select style="width: 100px;height: 32px;margin-left:10px;" name="'+mid+'genre[]" class="genre" kid="'+nid+'genre" fid="'+mid+'mold"><option value="0">选择类型</option><option value="click">点击</option><option value="view">链接地址</option></select><span id="'+nid+'genre"> </span></p><span><span id="'+mid+'" aid="'+bid+'"></span></span>');
        }else if(aid=="五"){
            bid = "六";
            var nid  = mid+5;
            $('#'+mid+'').parent('span').html('<p style="margin-top:6px;margin-left:35px;"><span style="width: 120px; padding-top: 6px; margin-left: 160px;">子目录'+aid+' : </span><input  style="width: 200px;height: 32px;" type="text" name="'+mid+'[]" placeholder="子目录'+aid+'"><select style="width: 100px;height: 32px;margin-left:10px;" name="'+mid+'genre[]" class="genre" kid="'+nid+'genre" fid="'+mid+'mold"><option value="0">选择类型</option><option value="click">点击</option><option value="view">链接地址</option></select><span id="'+nid+'genre"> </span></p><span><span id="'+mid+'" aid="'+bid+'"></span></span>');
        }else{
            alert('最多存五个子目录哦!!!');
        }
    })
    //删除子目录
    $(document).on('click','.del',function(){
        var mid = $(this).attr('mid');//获取当前定位标记
        var aid = $('#'+mid+'').attr('aid');//获取定位标记下的子级定位位置
       //alert(aid);
        if(aid=='六'){
         var bid = "五";
            $('#'+mid+'').parent('span').parent('span').html('<span id="'+mid+'" aid="'+bid+'"></span>');
        }else if(aid=='五'){
             bid = "四";
            $('#'+mid+'').parent('span').parent('span').html('<span id="'+mid+'" aid="'+bid+'"></span>');
        }else if(aid=='四'){
            bid = "三";
            $('#'+mid+'').parent('span').parent('span').html('<span id="'+mid+'" aid="'+bid+'"></span>');
        }else if(aid=='三'){
            bid = "二";
            $('#'+mid+'').parent('span').parent('span').html('<span id="'+mid+'" aid="'+bid+'"></span>');
        }else if(aid=='二'){
            $('#'+mid+'').parent('span').parent('span').html('<span id="'+mid+'" aid="一"></span>');
            $('#del'+mid).html('<select style="width: 100px;height: 32px;" name="'+mid+'genre[]" class="genre" kid="'+mid+'genre" fid="'+mid+'mold"><option value="0">选择类型</option><option value="click">点击</option><option value="view">链接地址</option></select><span id="'+mid+'genre"></span>');
        }
    })
    //类型样式
    $(document).on('change','.genre',function(){
        var genre = $(this).val();
        var kid   = $(this).attr('kid');
        var fid   = $(this).attr('fid');
       // var mid =
      //   alert(fid);
        if(genre==0){
            $('#'+kid+'').html('');
            alert('请重新选择此类型');
        }else if(genre=='click'){
            $('#'+kid+'').html('<input style="width: 200px;height: 27px;margin-left:3px;" type="text" name="'+fid+'[]" required=""/>&nbsp;&nbsp;&nbsp;&nbsp;点击');
        }else if(genre=='view'){
            $('#'+kid+'').html('<input style="width: 200px;height: 27px;margin-left:3px;" type="text" name="'+fid+'[]" required=""/>');
        }
    })


</script>
