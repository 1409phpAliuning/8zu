<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="public/js/js/commonss.css">
    <link rel="stylesheet" type="text/css" href="public/js/js/mainss.css">
    <script type="text/javascript" src="public/js/js/modernizrss.js"></script>
</head>
<body>

<div class="main-wrap">
    <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font">&#xe06b;</i><span>欢迎来到EightT</span> <span class="crumb-step">&gt;</span><a href="index.php?r=index/lsts">首页</a> <span class="crumb-step">&gt;</span><span class="crumb-name">新增公众号</span></div>
    </div>
   
    <div class="result-wrap">
        <div class="result-title">
            <h1>添加公众号</h1>
        </div>
        <!-- <div class="result-content">
             <form  action="index.php?r=index/account_add" method="post">
            <ul class="sys-info-list">
                <li>
                    <label class="res-lab">公众号账户</label><span class="res-info"><input type="text"  name="aname" placeholder="请输入公众号账户"></span>
                </li>
                <li>
                    <label class="res-lab">Appid</label><span class="res-info"><input type="text" name="appid" placeholder="请输入Appid"></span>
                </li>
                <li>
                    <label class="res-lab">Appsecret</label><span class="res-info"><input type="text"  name="appsecret" placeholder="请输入Appsecret"></span>
                </li>
                <li>
                    <label class="res-lab">内容</label><span class="res-info"><textarea  rows="4" cols="50" name="account"></textarea></span>
                </li>
                
            </ul>
            <label class="res-lab"><input type="submit" value="添加"/></label>
             </form>
        </div> -->
        <div class="result-content">
             <form  action="#" method="post">
                 <table class="insert-tab" width="100%">
                     <tbody>
                     <tr>
                         <th><i class="require-red">*</i>公众号账户:</th>
                         <td><input class="common-text required" type="text"  id="aname" name="aname" size="50" placeholder="请输入公众号账户"></td>
                     </tr>
                     <tr>
                         <th><i class="require-red">*</i>Appid:</th>
                         <td><input type="text" id="appid" name="appid" placeholder="请输入Appid"></td>
                     </tr>
                     <tr>
                         <th><i class="require-red">*</i>Appsecret:</th>
                         <td><input type="text"  id="appsecret" name="appsecret" placeholder="请输入Appsecret"></td>
                     </tr>
                     <tr>
                         <th><i class="require-red">*</i>内容:</th>
                         <td><textarea  rows="4" cols="50" id="account" name="account"></textarea></td>
                     </tr>
                     <tr>
                         <th></th>
                         <td>
                             <input class="btn btn-primary btn6 mr10" value="提交" id="button" type="button">
                             <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button" >&nbsp;&nbsp;&nbsp;&nbsp;
                             <span id="ok"></span>
                         </td>
                     </tr>
                     </tbody>
                 </table>
             </form>
        </div>
    </div>
    
</div>
<!--/main-->

</body>
</html>
<script src="jq.js"></script>
<script >
    $("#button").click(function(){
        var aname=$("#aname").val();
        var appid=$("#appid").val();
        var appsecret=$("#appsecret").val();
        var account=$("#account").val();
        //alert(account)
        $.ajax({
            url:"index.php?r=index/account_add",
            type:"POST",
            data:{
                aname:aname,
                appid:appid,
                appsecret:appsecret,
                account:account
            },
            success:function(data){
                if(data == 1){
                    //alert("已经添加过这个IP了")
                    $("#ok").html("<span style='color: red'>已经添加过这个账户了</span>");
                }else{
                    //alert(data);
                    //alert("添加成功")
                    $("#ok").html("<span style='color: red'>添加成功</span>");
                }
            }
        })
    })
</script>