<!doctype html>
<html>
<body>

<div class="main-wrap">
    <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font">&#xe06b;</i><span>欢迎来到eightT</span></div>
    </div>
   
    <div class="result-wrap">
        <div class="result-title">
            <h1>修改公众号</h1>
        </div>
        <div class="result-content">
             <form  action="index.php?r=index/edit" method="post">
               <input type="hidden" name="aid" value="<?php echo $arr['aid']?>">
            <ul class="sys-info-list">
                <li>
                    <label class="res-lab">公众号账户</label><span class="res-info"><input type="text"  name="aname" value="<?php echo $arr['aname']?>" placeholder="请输入公众号账户"></span>
                </li>
                <li>
                    <label class="res-lab">Appid</label><span class="res-info"><input type="text" name="appid" value="<?php echo $arr['appid']?>" placeholder="请输入Appid"></span>
                </li>
                <li>
                    <label class="res-lab">Appsecret</label><span class="res-info"><input type="text" value="<?php echo $arr['appsecret']?>"  name="appsecret" placeholder="请输入Appsecret"></span>
                </li>
                <li>
                    <label class="res-lab">内容</label><span class="res-info"><textarea  rows="4" cols="50" name="account"><?php echo $arr['account']?></textarea></span>
                </li>
                
            </ul>
            <label class="res-lab"><input type="submit" value="修改"/></label>
             </form>
        </div>
    </div>
    
</div>
<!--/main-->

</body>
</html>
